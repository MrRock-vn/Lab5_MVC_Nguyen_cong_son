<?php
/**
 * FILE: index.php
 * MỤC ĐÍCH: Router - Điều hướng các request đến Controller tương ứng
 */

// Load Composer autoload
require 'vendor/autoload.php';

// Import các Controller
use App\Controllers\HomeController;
use App\Controllers\ProductController;

// Lấy tham số 'page' từ URL (mặc định là 'home')
$page = $_GET['page'] ?? 'home';

// Router - Điều hướng đến Controller
switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
        
    case 'about':
        $controller = new HomeController();
        $controller->about();
        break;
        
    case 'products':
        $controller = new ProductController();
        $controller->index();
        break;
        
    case 'product-detail':
        $controller = new ProductController();
        $controller->detail();
        break;
        
    default:
        // Trang 404
        ?>
        <!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <title>404 - Không tìm thấy trang</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    padding: 50px;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    min-height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin: 0;
                }
                .error-container {
                    background: white;
                    padding: 40px;
                    border-radius: 15px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                }
                h1 { 
                    color: #e74c3c; 
                    font-size: 4em;
                    margin: 0;
                }
                p {
                    font-size: 1.2em;
                    color: #666;
                    margin: 20px 0;
                }
                a {
                    display: inline-block;
                    margin: 10px;
                    padding: 12px 30px;
                    background: #667eea;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    transition: all 0.3s;
                }
                a:hover {
                    background: #764ba2;
                    transform: translateY(-2px);
                }
            </style>
        </head>
        <body>
            <div class="error-container">
                <h1>404</h1>
                <p>😕 Trang bạn tìm không tồn tại!</p>
                <a href="index.php?page=home">🏠 Trang chủ</a>
                <a href="index.php?page=products">🛍️ Sản phẩm</a>
                <a href="index.php?page=about">ℹ️ Giới thiệu</a>
            </div>
        </body>
        </html>
        <?php
        break;
}