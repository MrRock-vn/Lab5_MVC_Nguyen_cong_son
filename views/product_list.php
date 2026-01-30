<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm - MVC</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Header */
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .stats {
            background: rgba(255,255,255,0.2);
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
        
        /* Navigation */
        .nav {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .nav a {
            display: inline-block;
            padding: 8px 16px;
            margin: 5px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .nav a:hover {
            background: #764ba2;
            transform: translateY(-2px);
        }
        
        /* Categories */
        .categories {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .categories h3 {
            color: #667eea;
            margin-bottom: 10px;
        }
        
        .category-tag {
            display: inline-block;
            padding: 6px 12px;
            margin: 5px;
            background: #e3f2fd;
            color: #1976d2;
            border-radius: 15px;
            font-size: 0.9em;
        }
        
        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }
        
        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        
        .product-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3em;
        }
        
        .product-info {
            padding: 20px;
        }
        
        .product-category {
            display: inline-block;
            background: #e3f2fd;
            color: #1976d2;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.8em;
            margin-bottom: 10px;
        }
        
        .product-name {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            min-height: 50px;
        }
        
        .product-price {
            font-size: 1.5em;
            color: #e74c3c;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .product-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
            font-size: 0.9em;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .product-id {
            background: #ecf0f1;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85em;
            color: #7f8c8d;
        }
        
        .stock {
            font-size: 0.85em;
            color: #27ae60;
            font-weight: bold;
        }
        
        .stock.low {
            color: #e67e22;
        }
        
        .stock.out {
            color: #e74c3c;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .empty-state h2 {
            color: #667eea;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header>
            <h1>🛍️ Cửa hàng Điện tử</h1>
            <div class="stats">
                📦 Tổng số sản phẩm: <?php echo $total; ?>
            </div>
        </header>

        <!-- Navigation -->
        <div class="nav">
            <a href="index.php?page=home">🏠 Trang chủ</a>
            <a href="index.php?page=products">🛍️ Sản phẩm</a>
            <a href="test_autoload.php">📚 Sinh viên</a>
        </div>

        <!-- Categories -->
        <?php if (!empty($categories)): ?>
        <div class="categories">
            <h3>📂 Danh mục sản phẩm:</h3>
            <?php foreach ($categories as $category): ?>
                <span class="category-tag"><?php echo htmlspecialchars($category); ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Product Grid -->
        <?php if (empty($products)): ?>
            <div class="empty-state">
                <h2>📭 Chưa có sản phẩm nào</h2>
                <p>Vui lòng thêm sản phẩm vào database</p>
            </div>
        <?php else: ?>
            <div class="product-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?php
                            // Icon theo danh mục
                            $icons = [
                                'Laptop' => '💻',
                                'Smartphone' => '📱',
                                'Tablet' => '📱',
                                'Audio' => '🎧',
                                'Wearable' => '⌚',
                                'TV' => '📺',
                                'Gaming' => '🎮'
                            ];
                            echo $icons[$product['category']] ?? '📦';
                            ?>
                        </div>
                        
                        <div class="product-info">
                            <span class="product-category">
                                <?php echo htmlspecialchars($product['category']); ?>
                            </span>
                            
                            <div class="product-name">
                                <?php echo htmlspecialchars($product['name']); ?>
                            </div>
                            
                            <div class="product-price">
                                <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                            </div>
                            
                            <div class="product-description">
                                <?php echo htmlspecialchars($product['description']); ?>
                            </div>
                            
                            <div class="product-footer">
                                <span class="product-id">ID: #<?php echo $product['id']; ?></span>
                                <span class="stock <?php echo $product['stock'] < 10 ? 'low' : ''; ?>">
                                    📦 <?php echo $product['stock']; ?> sản phẩm
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>