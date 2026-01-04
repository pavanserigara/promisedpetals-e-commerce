<?php
class Pages extends Controller
{
    protected $productModel;

    public function __construct()
    {
        parent::__construct();
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        $products = $this->productModel->getProducts();
        $categories = $this->productModel->getCategories();

        $data = [
            'title' => 'Promised Petals',
            'description' => 'Experience the elegance of nature',
            'featured_products' => array_slice($products, 0, 8),
            'categories' => $categories
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us',
            'description' => 'Our story'
        ];

        $this->view('pages/about', $data);
    }
}
