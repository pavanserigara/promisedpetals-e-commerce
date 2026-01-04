<?php
class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getProducts()
    {
        $products = $this->db->findAll('products');
        $categories = $this->db->findAll('categories');

        // Manual Join
        foreach ($products as &$p) {
            foreach ($categories as $c) {
                if ($p['category_id'] == $c['id']) {
                    $p['category_name'] = $c['name'];
                    $p['category_slug'] = $c['slug'];
                    break;
                }
            }
        }

        // Sort DESC
        usort($products, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        return $this->db->toObjects($products);
    }

    public function getProductsByCategory($category_slug)
    {
        $categories = $this->db->findAll('categories');
        $catId = null;
        $catName = '';
        foreach ($categories as $c) {
            if ($c['slug'] == $category_slug) {
                $catId = $c['id'];
                $catName = $c['name'];
                break;
            }
        }

        if (!$catId)
            return [];

        $allProducts = $this->getProducts(); // reusing logic to get joined data
        $filtered = [];
        foreach ($allProducts as $p) {
            if ($p->category_id == $catId) {
                $filtered[] = $p;
            }
        }
        return $filtered;
    }

    public function getProductById($id)
    {
        $product = $this->db->findOne('products', ['id' => $id]);
        if ($product) {
            // get category name
            $categories = $this->db->findAll('categories');
            foreach ($categories as $c) {
                if ($product['category_id'] == $c['id']) {
                    $product['category_name'] = $c['name'];
                    break;
                }
            }
            return (object) $product;
        }
        return false;
    }

    public function getCategories()
    {
        return $this->db->toObjects($this->db->findAll('categories'));
    }

    public function getCategoryBySlug($slug)
    {
        $cat = $this->db->findOne('categories', ['slug' => $slug]);
        return $cat ? (object) $cat : false;
    }

    public function searchProducts($keyword)
    {
        $products = $this->getProducts(); // Get all joined products

        $filtered = array_filter($products, function ($p) use ($keyword) {
            return stripos($p->name, $keyword) !== false || stripos($p->description, $keyword) !== false;
        });

        return array_values($filtered);
    }

    public function addProduct($data)
    {
        return $this->db->insert('products', $data);
    }

    public function updateProduct($data)
    {
        return $this->db->update('products', $data['id'], $data);
    }

    public function deleteProduct($id)
    {
        return $this->db->delete('products', $id);
    }

    public function getFilteredProducts($params)
    {
        $products = $this->getProducts();

        // Filter by Search Query
        if (!empty($params['q'])) {
            $keyword = $params['q'];
            $products = array_filter($products, function ($p) use ($keyword) {
                return stripos($p->name, $keyword) !== false || stripos($p->description, $keyword) !== false;
            });
        }

        // Filter by Price Range
        if (!empty($params['price'])) {
            $ranges = is_array($params['price']) ? $params['price'] : [$params['price']];
            $products = array_filter($products, function ($p) use ($ranges) {
                foreach ($ranges as $range) {
                    if ($range == '0-50' && $p->price <= 50)
                        return true;
                    if ($range == '50-100' && $p->price > 50 && $p->price <= 100)
                        return true;
                    if ($range == '100+' && $p->price > 100)
                        return true;
                }
                return false;
            });
        }

        // Sort by Popularity/Price (Mock logic for sort)
        if (!empty($params['sort'])) {
            if ($params['sort'] == 'price_low') {
                usort($products, fn($a, $b) => $a->price <=> $b->price);
            } elseif ($params['sort'] == 'price_high') {
                usort($products, fn($a, $b) => $b->price <=> $a->price);
            }
        }

        return array_values($products);
    }
}
