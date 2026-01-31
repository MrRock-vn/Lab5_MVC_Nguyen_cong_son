<?php
namespace App\Controllers;

use App\Models\Product;

/**
 * CLASS: ProductController
 * MỤC ĐÍCH: Xử lý tất cả request liên quan đến sản phẩm
 */
class ProductController 
{
    private $productModel;
    
    public function __construct()
    {
        $this->productModel = new Product();
    }
    
    /**
     * Hiển thị danh sách sản phẩm
     */
    public function index() 
    {
        $products = $this->productModel->all();
        $total = $this->productModel->count();
        
        include 'views/product_list.php';
    }
    
    /**
     * Hiển thị chi tiết một sản phẩm
     */
    public function detail()
    {
        $id = $_GET['id'] ?? 0;
        $product = $this->productModel->find($id);
        
        if (!$product) {
            $_SESSION['error'] = "Không tìm thấy sản phẩm!";
            header("Location: index.php?page=product-list");
            exit;
        }
        
        include 'views/product_detail.php';
    }
    
    /**
     * Xóa sản phẩm
     */
    public function delete()
    {
        $id = $_GET['id'] ?? 0;
        
        if ($this->productModel->delete($id)) {
            $_SESSION['success'] = "Xóa sản phẩm thành công!";
        } else {
            $_SESSION['error'] = "Xóa sản phẩm thất bại!";
        }
        
        header("Location: index.php?page=product-list");
        exit;
    }
    
    /**
     * Hiển thị form thêm sản phẩm
     */
    public function create()
    {
        $categories = $this->productModel->getCategories();
        include 'views/product_add.php';
    }
    
    /**
     * Xử lý lưu sản phẩm mới
     */
    public function store()
    {
        // Validate dữ liệu
        $errors = [];
        
        if (empty($_POST['name'])) {
            $errors[] = "Tên sản phẩm không được để trống!";
        }
        
        if (empty($_POST['price']) || $_POST['price'] <= 0) {
            $errors[] = "Giá sản phẩm phải lớn hơn 0!";
        }
        
        // Nếu có lỗi, quay lại form
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $_POST;
            header("Location: index.php?page=product-add");
            exit;
        }
        
        // Lưu vào database
        $data = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'description' => $_POST['description'] ?? '',
            'category' => $_POST['category'] ?? 'Other',
            'stock' => $_POST['stock'] ?? 0,
            'image' => $_POST['image'] ?? 'default.jpg'
        ];
        
        if ($this->productModel->insert($data)) {
            $_SESSION['success'] = "Thêm sản phẩm thành công!";
            header("Location: index.php?page=product-list");
        } else {
            $_SESSION['error'] = "Thêm sản phẩm thất bại!";
            header("Location: index.php?page=product-add");
        }
        exit;
    }
    
    /**
     * Hiển thị form sửa sản phẩm
     */
    public function edit()
    {
        $id = $_GET['id'] ?? 0;
        $product = $this->productModel->find($id);
        
        if (!$product) {
            $_SESSION['error'] = "Không tìm thấy sản phẩm!";
            header("Location: index.php?page=product-list");
            exit;
        }
        
        $categories = $this->productModel->getCategories();
        include 'views/product_edit.php';
    }
    
    /**
     * Xử lý cập nhật sản phẩm
     */
    public function update()
    {
        $id = $_POST['id'] ?? 0;
        
        // Validate
        $errors = [];
        
        if (empty($_POST['name'])) {
            $errors[] = "Tên sản phẩm không được để trống!";
        }
        
        if (empty($_POST['price']) || $_POST['price'] <= 0) {
            $errors[] = "Giá sản phẩm phải lớn hơn 0!";
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: index.php?page=product-edit&id={$id}");
            exit;
        }
        
        // Cập nhật
        $data = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'description' => $_POST['description'] ?? '',
            'category' => $_POST['category'] ?? 'Other',
            'stock' => $_POST['stock'] ?? 0,
            'image' => $_POST['image'] ?? 'default.jpg'
        ];
        
        if ($this->productModel->update($id, $data)) {
            $_SESSION['success'] = "Cập nhật sản phẩm thành công!";
        } else {
            $_SESSION['error'] = "Cập nhật sản phẩm thất bại!";
        }
        
        header("Location: index.php?page=product-list");
        exit;
    }
}