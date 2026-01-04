<?php
class Users extends Controller
{
    protected $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Rate Limit: 10 attempts per 5 minutes
            if (!checkRateLimit('register', 10, 300)) {
                flash('register_error', 'Too many registration attempts. Please try again later.', 'bg-red-100 text-red-800');
                $this->view('users/register', ['name' => '', 'email' => '', 'password' => '', 'confirm_password' => '', 'name_err' => '', 'email_err' => '', 'password_err' => '', 'confirm_password_err' => '']);
                return;
            }

            // Process form
            $data = [
                'name' => isset($_POST['name']) ? trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS)) : '',
                'email' => isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '',
                'password' => isset($_POST['password']) ? $_POST['password'] : '',
                'confirm_password' => isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Validated

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can log in');
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong');
                }

            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }

        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Rate Limit: 10 attempts per minute
            if (!checkRateLimit('login', 10, 60)) {
                flash('login_error', 'Too many login attempts. Please try again later.', 'bg-red-100 text-red-800');
                $this->view('users/login', ['email' => '', 'password' => '', 'email_err' => '', 'password_err' => '']);
                return;
            }

            // Process form
            $data = [
                'email' => isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '',
                'password' => isset($_POST['password']) ? $_POST['password'] : '',
                'email_err' => '',
                'password_err' => '',
            ];

            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/email
            if ($this->userModel->findUserByEmail($data['email'])) {
                // User found
            } else {
                // User not found
                $data['email_err'] = 'No user found';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';

                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }


        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_role'] = $user->role;
        header('location: ' . URLROOT . '/pages/index');
    }

    public function profile()
    {
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/users/login');
        }

        $orderModel = $this->model('Order');
        $orders = $orderModel->getOrdersByUserId($_SESSION['user_id']);

        $user = $this->userModel->getUserById($_SESSION['user_id']);

        $data = [
            'user' => $user,
            'orders' => $orders
        ];

        $this->view('users/profile', $data);
    }

    public function edit()
    {
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Rate Limit: 10 profile updates per hour
            if (!checkRateLimit('edit_profile', 10, 3600)) {
                flash('profile_message', 'Too many update attempts. Please try again later.', 'bg-red-100 text-red-800');
                header('location: ' . URLROOT . '/users/profile');
                return;
            }

            // Process form
            // Get raw POST for passwords, sanitize others if needed
            $data = [
                'id' => $_SESSION['user_id'],
                'name' => isset($_POST['name']) ? trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS)) : '',
                'email' => isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '',
                'password' => isset($_POST['password']) ? $_POST['password'] : '',
                'current_password' => isset($_POST['current_password']) ? $_POST['current_password'] : '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'current_password_err' => ''
            ];

            // Validate CSRF
            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                flash('profile_message', 'Security token mismatch. Please try again.', 'bg-red-100 text-red-800');
                header('location: ' . URLROOT . '/users/edit');
                return;
            }

            // Validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                $currentUser = $this->userModel->getUserById($_SESSION['user_id']);
                if ($data['email'] != $currentUser->email) {
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = 'Email is already taken';
                    }
                }
            }

            // Password change logic
            if (!empty($data['password'])) {
                if (empty($data['current_password'])) {
                    $data['current_password_err'] = 'Please enter current password to change it';
                } else {
                    $user = $this->userModel->getUserById($_SESSION['user_id']);
                    if (!password_verify($data['current_password'], $user->password)) {
                        $data['current_password_err'] = 'Current password incorrect';
                    }
                }

                if (strlen($data['password']) < 6) {
                    $data['password_err'] = 'New password must be at least 6 characters';
                }
            }

            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['current_password_err'])) {
                if ($this->userModel->updateProfile($data)) {
                    $_SESSION['user_name'] = $data['name'];
                    $_SESSION['user_email'] = $data['email'];
                    flash('profile_message', 'Profile updated successfully');
                    header('location: ' . URLROOT . '/users/profile');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('users/edit', $data);
            }
        } else {
            $user = $this->userModel->getUserById($_SESSION['user_id']);
            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'current_password_err' => ''
            ];
            $this->view('users/edit', $data);
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        header('location: ' . URLROOT . '/users/login');
    }
}
