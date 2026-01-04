<?php
class Cart extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function index()
    {
        $data = [
            'cart_items' => $_SESSION['cart'],
            'total' => $this->calculateTotal()
        ];
        $this->view('cart/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get raw POST data
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            $id = $data['id'] ?? null;
            $qty = $data['qty'] ?? 1;

            if ($id) {
                $productModel = $this->model('Product');
                $product = $productModel->getProductById($id);

                if ($product) {
                    // Check if item in cart
                    if (isset($_SESSION['cart'][$id])) {
                        $_SESSION['cart'][$id]['qty'] += $qty;
                    } else {
                        $_SESSION['cart'][$id] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'image' => $product->image,
                            'qty' => $qty
                        ];
                    }

                    echo json_encode(['status' => 'success', 'count' => count($_SESSION['cart'])]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Product not found']);
                }
            }
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            $id = $data['id'] ?? null;
            $qty = $data['qty'] ?? 1;

            if ($id && isset($_SESSION['cart'][$id])) {
                if ($qty > 0) {
                    $_SESSION['cart'][$id]['qty'] = $qty;
                } else {
                    unset($_SESSION['cart'][$id]);
                }
                echo json_encode(['status' => 'success', 'total' => $this->calculateTotal(), 'item_total' => $_SESSION['cart'][$id]['price'] * $qty]);
            }
        }
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            $id = $data['id'] ?? null;

            if ($id && isset($_SESSION['cart'][$id])) {
                unset($_SESSION['cart'][$id]);
                echo json_encode(['status' => 'success', 'count' => count($_SESSION['cart']), 'total' => $this->calculateTotal()]);
            }
        }
    }

    // API to get cart count
    public function count()
    {
        echo json_encode(['count' => count($_SESSION['cart'])]);
    }

    private function calculateTotal()
    {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['qty'];
        }
        return $total;
    }
}
