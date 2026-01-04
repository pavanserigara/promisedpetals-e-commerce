<?php
class Orders extends Controller
{
    protected $orderModel;

    public function __construct()
    {
        parent::__construct();
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/users/login');
        }
        $this->orderModel = $this->model('Order');
    }

    public function checkout()
    {
        $data = [
            'cart' => isset($_SESSION['cart']) ? $_SESSION['cart'] : [],
            'total' => $this->calculateTotal()
        ];

        if (empty($data['cart'])) {
            header('location: ' . URLROOT . '/products');
        }

        $this->view('orders/checkout', $data);
    }

    public function place()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_SESSION['cart'])) {
                header('location: ' . URLROOT . '/products');
            }

            if (!checkRateLimit('place_order', 5, 300)) {
                flash('order_error', 'Too many order attempts. Please wait.', 'bg-red-100 text-red-800');
                header('location: ' . URLROOT . '/cart');
                return;
            }

            // Sanitize
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
                die('Security Token Error');
            }

            $data = [
                'user_id' => $_SESSION['user_id'],
                'shipping_address' => trim($_POST['address']) . ', ' . trim($_POST['city']) . ', ' . trim($_POST['zip']) . ' | Phone: ' . trim($_POST['phone']),
                'total_amount' => $this->calculateTotal(),
                'payment_method' => $_POST['payment']
            ];

            // Add Order
            $order_id = $this->orderModel->addOrder($data);

            if ($order_id) {
                // Add Items
                foreach ($_SESSION['cart'] as $id => $item) {
                    $this->orderModel->addOrderItem($order_id, $id, $item['qty'], $item['price']);
                }

                // Clear Cart
                unset($_SESSION['cart']);

                // Redirect to success
                flash('order_success', 'Thank you! Your order has been placed.');
                header('location: ' . URLROOT . '/users/profile'); // Redirect to Profile
            } else {
                die('Something went wrong');
            }
        }
    }

    public function history()
    {
        $orders = $this->orderModel->getOrdersByUserId($_SESSION['user_id']);

        $data = [
            'orders' => $orders
        ];

        $this->view('orders/history', $data);
    }

    private function calculateTotal()
    {
        $total = 0;
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $total += $item['price'] * $item['qty'];
            }
        }
        return $total;
    }
}
