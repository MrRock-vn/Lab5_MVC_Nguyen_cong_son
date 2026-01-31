<?php
/**
 * FILE: index.php
 * MỤC ĐÍCH: Router - Điều hướng các request đến Controller tương ứng
 */

// BƯỚC 1: Khởi động Session (QUAN TRỌNG!)
session_start();

// BƯỚC 2: Load Composer autoload
require 'vendor/autoload.php';

// BƯỚC 3: Import các Controller
use App\Controllers\HomeController;
use App\Controllers\ProductController;

// BƯỚC 4: Lấy tham số 'page' từ URL (mặc định là 'home')
$page = $_GET['page'] ?? 'home';

// BƯỚC 5: Router - Điều hướng đến Controller
switch ($page) {
    // ========== TRANG CHỦ ==========
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    
    case 'about':
        $controller = new HomeController();
        $controller->about();
        break;
    
    // ========== QUẢN LÝ SẢN PHẨM (CRUD) ==========
    
    // READ - Danh sách sản phẩm
    case 'product-list':
    case 'products':
        $controller = new ProductController();
        $controller->index();
        break;
    
    // READ - Chi tiết sản phẩm
    case 'product-detail':
        $controller = new ProductController();
        $controller->detail();
        break;
    
    // DELETE - Xóa sản phẩm
    case 'product-delete':
        $controller = new ProductController();
        $controller->delete();
        break;
    
    // CREATE - Hiển thị form thêm mới
    case 'product-add':
        $controller = new ProductController();
        $controller->create();
        break;
    
    // CREATE - Xử lý lưu sản phẩm mới
    case 'product-store':
        $controller = new ProductController();
        $controller->store();
        break;
    
    // UPDATE - Hiển thị form sửa
    case 'product-edit':
        $controller = new ProductController();
        $controller->edit();
        break;
    
    // UPDATE - Xử lý cập nhật sản phẩm
    case 'product-update':
        $controller = new ProductController();
        $controller->update();
        break;
    
    // ========== TRANG 404 ==========
    default:
        ?>
        <!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>404 - Không tìm thấy trang</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
            <style>
                body {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .error-card {
                    background: white;
                    border-radius: 15px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                    padding: 50px;
                    text-align: center;
                    max-width: 500px;
                }
                .error-icon {
                    font-size: 100px;
                    color: #e74c3c;
                }
                .error-code {
                    font-size: 80px;
                    font-weight: bold;
                    color: #667eea;
                    margin: 20px 0;
                }
            </style>
        </head>
        <body>
            <div class="error-card">
                <i class="bi bi-exclamation-triangle error-icon"></i>
                <div class="error-code">404</div>
                <h3>Trang không tồn tại</h3>
                <p class="text-muted mb-4">Trang bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.</p>
                <div class="d-grid gap-2">
                    <a href="index.php?page=home" class="btn btn-primary">
                        <i class="bi bi-house"></i> Về trang chủ
                    </a>
                    <a href="index.php?page=product-list" class="btn btn-secondary">
                        <i class="bi bi-box-seam"></i> Danh sách sản phẩm
                    </a>
                </div>
            </div>
        </body>
        </html>
        <?php
        break;
}