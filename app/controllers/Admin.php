<?php
class Admin extends Controller
{
    protected $productModel;
    protected $orderModel;

    public function __construct()
    {
        parent::__construct();
        if (!isAdmin()) {
            header('location: ' . URLROOT . '/users/login');
        }
        $this->productModel = $this->model('Product');
        $this->orderModel = $this->model('Order');
    }

    public function index()
    {
        // Get Order Stats
        $orderStats = $this->orderModel->getStats();

        // Get User Count
        $userModel = $this->model('User');
        $userCount = $userModel->countAll();

        $data = [
            'title' => 'Admin Dashboard',
            'orders_count' => $orderStats['total_orders'],
            'users_count' => $userCount,
            'total_revenue' => $orderStats['total_revenue'],
            'pending_orders_count' => $orderStats['pending_count']
        ];

        $this->view('admin/index', $data);
    }

    public function users()
    {
        $search = isset($_GET['q']) ? trim($_GET['q']) : null;
        $userModel = $this->model('User');
        $users = $userModel->getAllUsers($search);
        $this->view('admin/users/index', ['users' => $users, 'search' => $search]);
    }

    public function add_user()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!checkRateLimit('admin_action', 30, 60)) {
                die('Too many administrative actions. Please wait.');
            }

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'role' => trim($_POST['role'])
            ];
            $userModel = $this->model('User');
            if ($userModel->addUser($data)) {
                header('location: ' . URLROOT . '/admin/users');
            } else {
                die('Something went wrong');
            }
        } else {
            $this->view('admin/users/add');
        }
    }

    public function edit_user($id)
    {
        $userModel = $this->model('User');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!checkRateLimit('admin_action', 30, 60)) {
                die('Too many administrative actions. Please wait.');
            }

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'role' => trim($_POST['role'])
            ];
            if ($userModel->updateUser($data)) {
                header('location: ' . URLROOT . '/admin/users');
            } else {
                die('Something went wrong');
            }
        } else {
            $user = $userModel->getUserById($id);
            $this->view('admin/users/edit', ['user' => $user]);
        }
    }

    public function delete_user($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }
            $userModel = $this->model('User');
            if ($userModel->deleteUser($id)) {
                header('location: ' . URLROOT . '/admin/users');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function orders()
    {
        $search = isset($_GET['q']) ? trim($_GET['q']) : null;
        $orders = $this->orderModel->getAllOrders($search);
        $this->view('admin/orders/index', ['orders' => $orders, 'search' => $search]);
    }

    public function order_details($id)
    {
        $order = $this->orderModel->getOrderById($id);
        if (!$order) {
            header('location: ' . URLROOT . '/admin/orders');
        }
        $this->view('admin/orders/show', ['order' => $order]);
    }

    public function update_order_status($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }

            if (isset($_POST['status'])) {
                if ($this->orderModel->updateStatus($id, $_POST['status'])) {
                    // flash('order_message', 'Order status updated');
                }
            }
            header('location: ' . URLROOT . '/admin/order_details/' . $id);
        } else {
            header('location: ' . URLROOT . '/admin/orders');
        }
    }

    public function update_payment($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }

            if (isset($_POST['payment_status'])) {
                $this->orderModel->updatePaymentStatus($id, $_POST['payment_status']);
            }
            header('location: ' . URLROOT . '/admin/order_details/' . $id);
        }
    }

    // Product CRUD
    public function products()
    {
        $search = isset($_GET['q']) ? trim($_GET['q']) : null;
        if ($search) {
            $products = $this->productModel->searchProducts($search);
        } else {
            $products = $this->productModel->getProducts();
        }

        $data = [
            'products' => $products,
            'search' => $search
        ];
        $this->view('admin/products/index', $data);
    }

    public function add_product()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!checkRateLimit('admin_action', 30, 60)) {
                die('Too many administrative actions. Please wait.');
            }

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }

            // Handle Image Upload Securely
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $img_name = $_FILES['image']['name'];
                $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp'];

                if (in_array($ext, $allowed)) {
                    $new_name = uniqid('prod_') . '.' . $ext;
                    $img_tmp = $_FILES['image']['tmp_name'];
                    $img_path = APPROOT . '/../public/img/products/' . $new_name;
                    if (move_uploaded_file($img_tmp, $img_path)) {
                        $image = $new_name;
                    }
                }
            }

            $data = [
                'name' => trim($_POST['name']),
                'category_id' => trim($_POST['category_id']),
                'price' => trim($_POST['price']),
                'stock' => trim($_POST['stock']),
                'description' => trim($_POST['description']),
                'image' => $image,
                'slug' => strtolower(str_replace(' ', '-', trim($_POST['name'])))
            ];

            if (!empty($data['name']) && !empty($data['price'])) {
                if ($this->productModel->addProduct($data)) {
                    flash('product_message', 'Product Added');
                    header('location: ' . URLROOT . '/admin/products');
                } else {
                    die('Something went wrong');
                }
            }
        } else {
            $categories = $this->productModel->getCategories();
            $data = [
                'categories' => $categories
            ];
            $this->view('admin/products/add', $data);
        }
    }

    public function edit_product($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!checkRateLimit('admin_action', 30, 60)) {
                die('Too many administrative actions. Please wait.');
            }

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'category_id' => trim($_POST['category_id']),
                'price' => trim($_POST['price']),
                'stock' => trim($_POST['stock']),
                'description' => trim($_POST['description']),
                'slug' => strtolower(str_replace(' ', '-', trim($_POST['name'])))
            ];

            // Handle Image - only update if a new file is uploaded securely
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $img_name = $_FILES['image']['name'];
                $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp'];
                if (in_array($ext, $allowed)) {
                    $new_name = uniqid('prod_') . '.' . $ext;
                    $img_tmp = $_FILES['image']['tmp_name'];
                    $img_path = APPROOT . '/../public/img/products/' . $new_name;
                    if (move_uploaded_file($img_tmp, $img_path)) {
                        $data['image'] = $new_name;
                    }
                }
            }

            if ($this->productModel->updateProduct($data)) {
                // flash('product_message', 'Product Updated');
                header('location: ' . URLROOT . '/admin/products');
            } else {
                die('Something went wrong');
            }

        } else {
            $product = $this->productModel->getProductById($id);
            $categories = $this->productModel->getCategories();
            if (!$product) {
                header('location: ' . URLROOT . '/admin/products');
            }
            $data = [
                'product' => $product,
                'categories' => $categories
            ];
            $this->view('admin/products/edit', $data);
        }
    }

    public function delete_product($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }
            if ($this->productModel->deleteProduct($id)) {
                // flash('product_message', 'Product Deleted');
                header('location: ' . URLROOT . '/admin/products');
            } else {
                die('Something went wrong');
            }
        }
    }

    // Category CRUD
    public function categories()
    {
        $categoryModel = $this->model('Category');
        $categories = $categoryModel->getCategories();
        $this->view('admin/categories/index', ['categories' => $categories]);
    }

    public function add_category()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!checkRateLimit('admin_action', 30, 60)) {
                die('Too many administrative actions. Please wait.');
            }

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }

            // Handle Image Securely
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $img_name = $_FILES['image']['name'];
                $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp'];
                if (in_array($ext, $allowed)) {
                    $new_name = uniqid('cat_') . '.' . $ext;
                    $img_tmp = $_FILES['image']['tmp_name'];
                    $img_path = APPROOT . '/../public/img/' . $new_name;
                    if (move_uploaded_file($img_tmp, $img_path)) {
                        $image = $new_name;
                    }
                }
            }

            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'image' => $image,
                'slug' => strtolower(str_replace(' ', '-', trim($_POST['name'])))
            ];

            $categoryModel = $this->model('Category');
            if ($categoryModel->addCategory($data)) {
                header('location: ' . URLROOT . '/admin/categories');
            } else {
                die('Something went wrong');
            }
        } else {
            $this->view('admin/categories/add');
        }
    }

    public function edit_category($id)
    {
        $categoryModel = $this->model('Category');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!checkRateLimit('admin_action', 30, 60)) {
                die('Too many administrative actions. Please wait.');
            }

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'slug' => strtolower(str_replace(' ', '-', trim($_POST['name'])))
            ];

            // Handle Image Securely
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $img_name = $_FILES['image']['name'];
                $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp'];
                if (in_array($ext, $allowed)) {
                    $new_name = uniqid('cat_') . '.' . $ext;
                    $img_tmp = $_FILES['image']['tmp_name'];
                    $img_path = APPROOT . '/../public/img/' . $new_name;
                    if (move_uploaded_file($img_tmp, $img_path)) {
                        $data['image'] = $new_name;
                    }
                }
            }

            if ($categoryModel->updateCategory($data)) {
                header('location: ' . URLROOT . '/admin/categories');
            } else {
                die('Something went wrong');
            }
        } else {
            $category = $categoryModel->getCategoryById($id);
            if (!$category) {
                header('location: ' . URLROOT . '/admin/categories');
            }
            $this->view('admin/categories/edit', ['category' => $category]);
        }
    }

    public function delete_category($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }
            $categoryModel = $this->model('Category');
            if ($categoryModel->deleteCategory($id)) {
                header('location: ' . URLROOT . '/admin/categories');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function reports()
    {
        $salesData = $this->orderModel->getSalesReport();
        $this->view('admin/reports', ['sales_data' => $salesData]);
    }

    public function export_orders()
    {
        $orders = $this->orderModel->getAllOrders();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=orders_report_' . date('Y-m-d') . '.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Order ID', 'Customer', 'Amount', 'Status', 'Date']);

        foreach ($orders as $order) {
            // Get user name for each order (could be pre-fetched in model for optimization)
            $orderData = $this->orderModel->getOrderById($order->id);
            fputcsv($output, [
                $order->id,
                $orderData->user_name,
                $order->total_amount,
                $order->status,
                $order->created_at
            ]);
        }
        fclose($output);
        exit();
    }
}
