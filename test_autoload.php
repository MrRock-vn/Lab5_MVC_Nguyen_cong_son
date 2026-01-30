<?php
require 'vendor/autoload.php';

// KHÔNG CẦN require/include thủ công nữa!
// Composer sẽ tự động load class nhờ namespace
use App\Models\Student;

// Tạo các sinh viên mẫu
$sv1 = new Student(); // Sinh viên mặc định

$sv2 = new Student("Trần Thị Hoa", 21, "Kinh tế");

$sv3 = new Student("Lê Văn Bình", 22, "Khoa học máy tính");

$sv4 = new Student("Phạm Thị Lan", 20, "Quản trị kinh doanh");

// Tạo mảng sinh viên
$students = [$sv1, $sv2, $sv3, $sv4];

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2: Autoload Demo</title>
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
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        h1 {
            text-align: center;
            color: white;
            margin-bottom: 30px;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .success-message {
            background: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        
        .student-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .student-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .student-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        
        .student-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .student-id {
            font-size: 0.9em;
            opacity: 0.9;
        }
        
        .student-name {
            font-size: 1.3em;
            font-weight: bold;
            margin: 5px 0;
        }
        
        .student-body {
            padding: 10px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .label {
            font-weight: bold;
            color: #555;
        }
        
        .value {
            color: #333;
        }
        
        .code-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .code-section h2 {
            color: #667eea;
            margin-bottom: 15px;
        }
        
        .code-block {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #667eea;
            overflow-x: auto;
        }
        
        .code-block code {
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            color: #333;
        }
        
        .highlight {
            background: yellow;
            padding: 2px 5px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📚 Danh sách Sinh viên - Autoload Demo</h1>
        
        <div class="success-message">
            ✅ Autoload hoạt động thành công! Class được load tự động nhờ namespace.
        </div>
        
        <div class="student-grid">
            <?php foreach ($students as $index => $student): ?>
                <div class="student-card">
                    <div class="student-header">
                        <div class="student-id">Mã SV: <?php echo $student->getId(); ?></div>
                        <div class="student-name"><?php echo $student->getName(); ?></div>
                    </div>
                    
                    <div class="student-body">
                        <div class="info-row">
                            <span class="label">🎂 Tuổi:</span>
                            <span class="value"><?php echo $student->getAge(); ?> tuổi</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="label">📖 Ngành:</span>
                            <span class="value"><?php echo $student->getMajor(); ?></span>
                        </div>
                        
                        <div class="info-row">
                            <span class="label">📧 Email:</span>
                            <span class="value"><?php echo $student->getEmail(); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="code-section">
            <h2>💡 Giải thích Autoload</h2>
            
            <p style="margin-bottom: 15px; line-height: 1.6;">
                Trước đây, để sử dụng class, bạn phải viết:
            </p>
            
            <div class="code-block">
                <code>
                    require 'app/Models/Student.php';<br>
                    $student = new Student();
                </code>
            </div>
            
            <p style="margin: 15px 0; line-height: 1.6;">
                Với <strong>PSR-4 Autoload</strong>, bạn chỉ cần:
            </p>
            
            <div class="code-block">
                <code>
                    require 'vendor/autoload.php';<br>
                    <span class="highlight">use App\Models\Student;</span><br>
                    $student = new Student();
                </code>
            </div>
            
            <p style="margin-top: 15px; line-height: 1.6;">
                Composer tự động tìm và load file <code>app/Models/Student.php</code> 
                dựa trên namespace <code>App\Models</code>.
            </p>
        </div>
    </div>
</body>
</html>