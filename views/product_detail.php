<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm - <?php echo htmlspecialchars($product['name']); ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background: #f8f9fa;
        }
        .product-image-large {
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 150px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .info-label {
            font-weight: bold;
            color: #667eea;
            min-width: 120px;
            display: inline-block;
        }
        .price-large {
            font-size: 2.5rem;
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-shop"></i> Quản lý Sản phẩm
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php?page=home">
                    <i class="bi bi-house"></i> Trang chủ
                </a>
                <a class="nav-link" href="index.php?page=product-list">
                    <i class="bi bi-list"></i> Danh sách
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="index.php?page=product-list">Sản phẩm</a></li>
                <li class="breadcrumb-item active">Chi tiết</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Cột trái: Hình ảnh -->
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="product-image-large">
                            <?php
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
                        <div class="d-grid gap-2">
                            <a href="index.php?page=product-edit&id=<?php echo $product['id']; ?>" 
                               class="btn btn-warning btn-lg">
                                <i class="bi bi-pencil"></i> Chỉnh sửa sản phẩm
                            </a>
                            <a href="index.php?page=product-delete&id=<?php echo $product['id']; ?>" 
                               class="btn btn-danger btn-lg"
                               onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                <i class="bi bi-trash"></i> Xóa sản phẩm
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Thông tin -->
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-info-circle"></i> Thông tin chi tiết</h4>
                    </div>
                    <div class="card-body">
                        <!-- Tên sản phẩm -->
                        <h2 class="mb-3"><?php echo htmlspecialchars($product['name']); ?></h2>
                        
                        <!-- Giá -->
                        <div class="mb-4">
                            <span class="price-large">
                                <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                            </span>
                        </div>

                        <!-- Thông tin khác -->
                        <div class="mb-3">
                            <span class="info-label"><i class="bi bi-hash"></i> Mã sản phẩm:</span>
                            <span class="badge bg-secondary">#<?php echo $product['id']; ?></span>
                        </div>

                        <div class="mb-3">
                            <span class="info-label"><i class="bi bi-tag"></i> Danh mục:</span>
                            <span class="badge bg-info"><?php echo htmlspecialchars($product['category']); ?></span>
                        </div>

                        <div class="mb-3">
                            <span class="info-label"><i class="bi bi-box-seam"></i> Tồn kho:</span>
                            <span class="badge <?php echo $product['stock'] > 10 ? 'bg-success' : 'bg-warning'; ?>">
                                <?php echo $product['stock']; ?> sản phẩm
                            </span>
                        </div>

                        <div class="mb-3">
                            <span class="info-label"><i class="bi bi-calendar"></i> Ngày tạo:</span>
                            <span><?php echo date('d/m/Y H:i', strtotime($product['created_at'])); ?></span>
                        </div>

                        <hr>

                        <!-- Mô tả -->
                        <h5><i class="bi bi-file-text"></i> Mô tả sản phẩm:</h5>
                        <div class="alert alert-light">
                            <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                        </div>

                        <!-- Nút quay lại -->
                        <a href="index.php?page=product-list" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>