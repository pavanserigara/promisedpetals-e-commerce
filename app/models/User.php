<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Register User
    public function register($data)
    {
        $insertData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'customer'
        ];
        return $this->db->insert('users', $insertData);
    }

    // Login User
    public function login($email, $password)
    {
        $row = $this->db->findOne('users', ['email' => $email]);

        if ($row) {
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                return (object) $row;
            }
        }
        return false;
    }

    // Find user by email
    public function findUserByEmail($email)
    {
        $row = $this->db->findOne('users', ['email' => $email]);
        return $row ? true : false;
    }

    // Get User by ID
    public function getUserById($id)
    {
        $row = $this->db->findOne('users', ['id' => $id]);
        return $row ? (object) $row : false;
    }

    public function countAll()
    {
        $users = $this->db->findAll('users');
        return count($users);
    }

    public function getAllUsers($search = null)
    {
        $users = $this->db->findAll('users');
        if ($search) {
            $users = array_filter($users, function ($u) use ($search) {
                return stripos($u['name'], $search) !== false ||
                    stripos($u['email'], $search) !== false;
            });
        }
        return $this->db->toObjects($users);
    }

    public function deleteUser($id)
    {
        return $this->db->delete('users', $id);
    }

    public function updateUser($data)
    {
        // Password handling needs to be careful if empty
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role']
        ];
        if (!empty($data['password'])) {
            $updateData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $this->db->update('users', $data['id'], $updateData);
    }

    // Safe Profile Update (No role change)
    public function updateProfile($data)
    {
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email']
        ];
        if (!empty($data['password'])) {
            $updateData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $this->db->update('users', $data['id'], $updateData);
    }

    public function addUser($data)
    {
        $insertData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => $data['role']
        ];
        return $this->db->insert('users', $insertData);
    }
}
