<?php
class Products extends Controller
{
    protected $productModel;

    public function __construct()
    {
        parent::__construct();
        $this->productModel = $this->model('Product');
    }

    public function index($category_slug = null)
    {
        // Support for query param ?cat=slug or ?category=slug
        if (!$category_slug) {
            if (isset($_GET['cat'])) {
                $category_slug = trim($_GET['cat']);
            } elseif (isset($_GET['category'])) {
                $category_slug = trim($_GET['category']);
            }
        }

        // Get filters from GET
        $params = [
            'q' => isset($_GET['q']) ? trim($_GET['q']) : '',
            'price' => isset($_GET['price']) ? $_GET['price'] : [],
            'sort' => isset($_GET['sort']) ? $_GET['sort'] : ''
        ];

        $current_category = null;
        if ($category_slug) {
            $current_category = $this->productModel->getCategoryBySlug($category_slug);
            $products = $this->productModel->getProductsByCategory($category_slug);
            $title = $current_category ? $current_category->name : ucfirst($category_slug);

            // Re-apply filters on category subset
            if (!empty($params['q']) || !empty($params['price']) || !empty($params['sort'])) {
                // For simplicity, we could merge category check into getFilteredProducts but this works too
                $data_products = $this->productModel->getFilteredProducts($params);
                $products = array_filter($data_products, fn($p) => $p->category_slug == $category_slug);
            }

        } else {
            $products = $this->productModel->getFilteredProducts($params);
            $title = 'All Arrangements';
        }

        $data = [
            'products' => $products,
            'title' => $title,
            'all_categories' => $this->productModel->getCategories(),
            'current_category' => $current_category,
            'category_slug' => $category_slug
        ];

        $this->view('products/index', $data);
    }

    public function show($id)
    {
        $product = $this->productModel->getProductById($id);

        $data = [
            'product' => $product
        ];

        $this->view('products/show', $data);
    }
}
