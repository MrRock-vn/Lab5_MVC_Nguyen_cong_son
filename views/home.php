<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - MVC</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 100%;
        }
        
        h1 {
            color: #667eea;
            margin-bottom: 20px;
            text-align: center;
            font-size: 2em;
        }
        
        .message {
            background: #f0f4ff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        
        .message h3 {
            color: #667eea;
            margin-bottom: 10px;
        }
        
        .student-info {
            background: #fff3cd;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            border-left: 4px solid #ffc107;
            line-height: 1.8;
        }
        
        .nav-buttons {
            margin-top: 30px;
            text-align: center;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            margin: 5px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            font-weight: bold;
        }
        
        .btn:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #666;
            font-size: 0.9em;
        }
        
        .mvc-diagram {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2196F3;
        }
        
        .mvc-diagram h4 {
            color: #2196F3;
            margin-bottom: 10px;
        }
        
        .mvc-flow {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 10px;
            flex-wrap: wrap;
        }
        
        .mvc-item {
            text-align: center;
            margin: 5px;
        }
        
        .mvc-box {
            background: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            color: #2196F3;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .arrow {
            font-size: 1.5em;
            color: #2196F3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎯 <?php echo $message; ?></h1>
        
        <div class="message">
            <h3>📚 Thông tin sinh viên:</h3>
            <div class="student-info">
                <?php echo $studentInfo; ?>
            </div>
        </div>
        
        <div class="mvc-diagram">
            <h4>💡 Luồng hoạt động MVC:</h4>
            <div class="mvc-flow">
                <div class="mvc-item">
                    <div class="mvc-box">Router</div>
                    <small>index.php</small>
                </div>
                <span class="arrow">→</span>
                <div class="mvc-item">
                    <div class="mvc-box">Controller</div>
                    <small>HomeController</small>
                </div>
                <span class="arrow">→</span>
                <div class="mvc-item">
                    <div class="mvc-box">Model</div>
                    <small>Student</small>
                </div>
                <span class="arrow">→</span>
                <div class="mvc-item">
                    <div class="mvc-box">View</div>
                    <small>home.php</small>
                </div>
            </div>
        </div>
        
        <div class="nav-buttons">
            <a href="index.php?page=home" class="btn">🏠 Trang chủ</a>
            <a href="test_autoload.php" class="btn btn-secondary">📚 Danh sách SV</a>
        </div>
        
        <div class="footer">
            <p>✨ Ứng dụng MVC với PHP & Composer</p>
            <p><small>Bài 3: Mini MVC Framework</small></p>
        </div>
    </div>
</body>
</html>