<?php
namespace App\Controllers;

use App\Models\Product;

/**
 * CLASS: ProductController
 * MỤC ĐÍCH: Xử lý logic liên quan đến sản phẩm
 */
class ProductController 
{
    /**
     * Hiển thị danh sách tất cả sản phẩm
     */
    public function index() 
    {
        // BƯỚC 1: Lấy dữ liệu từ Model
        $productModel = new Product();
        $products = $productModel->getAllProducts();
        $total = $productModel->getTotalProducts();
        $categories = $productModel->getCategories();
        
        // BƯỚC 2: Gọi View và truyền dữ liệu
        include 'views/product_list.php';
    }
    
    /**
     * Hiển thị chi tiết một sản phẩm
     */
    public function detail()
    {
        // Lấy ID từ URL
        $id = $_GET['id'] ?? 0;
        
        // Lấy thông tin sản phẩm
        $productModel = new Product();
        $product = $productModel->getProductById($id);
        
        // Nếu không tìm thấy sản phẩm
        if (!$product) {
            echo "<h1>Không tìm thấy sản phẩm!</h1>";
            echo '<a href="index.php?page=products">← Quay lại</a>';
            return;
        }
        
        // Hiển thị view
        include 'views/product_detail.php';
    }
}