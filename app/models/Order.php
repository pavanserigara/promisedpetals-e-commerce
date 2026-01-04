<?php
class Order
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addOrder($data)
    {
        $data['status'] = 'pending';
        $data['payment_status'] = 'unpaid';
        return $this->db->insert('orders', $data);
    }

    public function addOrderItem($order_id, $product_id, $qty, $price)
    {
        $data = [
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quantity' => $qty,
            'price' => $price
        ];
        return $this->db->insert('order_items', $data);
    }

    public function getOrdersByUserId($id)
    {
        $orders = $this->db->findWhere('orders', ['user_id' => $id]);
        // Sort DESC
        usort($orders, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        return $this->db->toObjects($orders);
    }

    public function getAllOrders($search = null)
    {
        $orders = $this->db->findAll('orders');

        if ($search) {
            $orders = array_filter($orders, function ($o) use ($search) {
                return stripos($o['id'], $search) !== false ||
                    stripos($o['user_id'], $search) !== false;
            });
        }

        // Sort DESC
        usort($orders, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        return $this->db->toObjects($orders);
    }

    public function getOrderById($id)
    {
        $order = $this->db->findOne('orders', ['id' => $id]);
        if (!$order)
            return false;

        // Get Order Items
        $items = $this->db->findWhere('order_items', ['order_id' => $id]);

        // Get Products details for items
        $productModel = new Product(); // Helper usage
        foreach ($items as &$item) {
            $product = $this->db->findOne('products', ['id' => $item['product_id']]);
            $item['product_name'] = $product ? $product['name'] : 'Deleted Product';
            $item['product_image'] = $product ? $product['image'] : '';
        }

        $order['items'] = $items;

        // Get User details
        $user = $this->db->findOne('users', ['id' => $order['user_id']]);
        $order['user_name'] = $user ? $user['name'] : 'Unknown';
        $order['user_email'] = $user ? $user['email'] : 'Unknown';

        return (object) $order;
    }

    public function updateStatus($id, $status)
    {
        return $this->db->update('orders', $id, ['status' => $status]);
    }

    public function updatePaymentStatus($id, $status)
    {
        return $this->db->update('orders', $id, ['payment_status' => $status]);
    }

    public function getStats()
    {
        $orders = $this->db->findAll('orders');
        $totalOrders = count($orders);
        $totalRevenue = 0;
        $pendingCount = 0;

        foreach ($orders as $order) {
            if ($order['status'] !== 'cancelled') {
                $totalRevenue += (float) $order['total_amount'];
            }
            if ($order['status'] == 'pending') {
                $pendingCount++;
            }
        }

        return [
            'total_orders' => $totalOrders,
            'total_revenue' => $totalRevenue,
            'pending_count' => $pendingCount
        ];
    }

    public function getSalesReport()
    {
        $orders = $this->db->findAll('orders');
        $report = [];
        foreach ($orders as $order) {
            $date = date('Y-m-d', strtotime($order['created_at']));
            if (!isset($report[$date])) {
                $report[$date] = ['orders' => 0, 'revenue' => 0];
            }
            $report[$date]['orders']++;
            $report[$date]['revenue'] += (float) $order['total_amount'];
        }
        ksort($report);
        return $report;
    }
}
