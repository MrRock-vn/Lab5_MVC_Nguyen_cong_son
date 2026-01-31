<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm - Danh sách</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
        .action-btns .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=home">
                            <i class="bi bi-house"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?page=product-list">
                            <i class="bi bi-list"></i> Sản phẩm
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2><i class="bi bi-box-seam"></i> Danh sách Sản phẩm</h2>
                <p class="text-muted">Tổng số: <strong><?php echo $total; ?></strong> sản phẩm</p>
            </div>
            <a href="index.php?page=product-add" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Thêm sản phẩm mới
            </a>
        </div>

        <!-- Thông báo -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> <?php echo $_SESSION['success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle"></i> <?php echo $_SESSION['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Bảng sản phẩm -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="10%">Hình ảnh</th>
                                <th width="25%">Tên sản phẩm</th>
                                <th width="15%">Giá</th>
                                <th width="10%">Danh mục</th>
                                <th width="10%">Tồn kho</th>
                                <th width="25%" class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($products)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="text-muted mt-3">Chưa có sản phẩm nào</p>
                                        <a href="index.php?page=product-add" class="btn btn-primary">
                                            <i class="bi bi-plus-circle"></i> Thêm sản phẩm đầu tiên
                                        </a>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td><strong>#<?php echo $product['id']; ?></strong></td>
                                        <td>
                                            <div class="bg-primary text-white product-img d-flex align-items-center justify-content-center">
                                                <i class="bi bi-box-seam"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($product['name']); ?></strong>
                                            <br>
                                            <small class="text-muted">
                                                <?php echo mb_substr(htmlspecialchars($product['description']), 0, 50); ?>...
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge bg-danger fs-6">
                                                <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                <?php echo htmlspecialchars($product['category']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge <?php echo $product['stock'] > 10 ? 'bg-success' : 'bg-warning'; ?>">
                                                <?php echo $product['stock']; ?>
                                            </span>
                                        </td>
                                        <td class="text-center action-btns">
                                            <a href="index.php?page=product-detail&id=<?php echo $product['id']; ?>" 
                                               class="btn btn-info btn-sm" 
                                               title="Chi tiết">
                                                <i class="bi bi-eye"></i> Xem
                                            </a>
                                            
                                            <a href="index.php?page=product-edit&id=<?php echo $product['id']; ?>" 
                                               class="btn btn-warning btn-sm" 
                                               title="Sửa">
                                                <i class="bi bi-pencil"></i> Sửa
                                            </a>
                                            
                                            <a href="index.php?page=product-delete&id=<?php echo $product['id']; ?>" 
                                               class="btn btn-danger btn-sm" 
                                               onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"
                                               title="Xóa">
                                                <i class="bi bi-trash"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>