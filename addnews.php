<?php
session_start();
$errors = [];

function has_error($field) {
    global $errors;
    return isset($errors[$field]);
}

function get_error($field) {
    global $errors;
    return has_error($field) ? $errors[$field] : null;
}

function request($field) {
    return isset($_REQUEST[$field]) && $_REQUEST[$field] != "" ? trim($_REQUEST[$field]) : null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = request('title'); // عنوان خبر
    $content = request('newstext'); // متن خبر
    $category = request('category'); // دسته‌بندی خبر
    $user_id = $_SESSION['user_id']; // شناسه کاربر از سشن

    // مسیر برای بارگذاری تصویر
    $uploadDir = __DIR__ . '/uploads/'; // استفاده از مسیر کامل
    $imageName = basename($_FILES['image']['name']);
    $uploadPath = $uploadDir . $imageName;

    // بررسی وجود دایرکتوری uploads و ایجاد آن در صورت عدم وجود
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            die('Unable to create the directory ' . $uploadDir); // خطا در ایجاد دایرکتوری
        }
    }

    // بارگذاری تصویر
    if (empty($_FILES['image']['name'])) {
        $errors['image'] = 'لطفاً یک تصویر انتخاب کنید.';
    } else {
        // بررسی نوع فایل و اجازه بارگذاری فقط برای تصاویر
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']; // فرمت‌های مجاز
        $fileType = strtolower(pathinfo($uploadPath, PATHINFO_EXTENSION));

        if (!in_array($fileType, $allowedTypes)) {
            $errors['image'] = 'فقط فایل‌های تصویری (JPG, JPEG, PNG, GIF) مجاز هستند.';
        } else {
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                $errors['image'] = 'خطا در بارگذاری تصویر. دایرکتوری بارگذاری وجود ندارد یا دسترسی مربوطه را ندارد.';
            }
        }
    }

    // بررسی خطاها و پر بودن فیلدها
    if (empty($title) || empty($content) || empty($category) || !empty($errors)) {
        echo 'لطفاً تمامی فیلدها را پر کنید و خطاها را برطرف کنید.';
    } else {
        // اتصال به پایگاه داده
        $link = mysqli_connect('localhost:3306', 'root', '', 'news');
        if (!$link) {
            echo 'could not connect : ' . mysqli_connect_error();
            exit;
        }

        // ذخیره مسیر نسبی تصویر در دیتابیس
        $relativePath = 'uploads/' . $imageName;

        // ذخیره خبر و اطلاعات کاربر
        $statement = mysqli_prepare($link, "INSERT INTO news (title, image, newstext, user_id, category) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($statement, 'sssis', $title, $relativePath, $content, $user_id, $category);

        if (mysqli_stmt_execute($statement)) {
            echo "<script>alert('خبر با موفقیت ثبت شد.'); window.location.href='user.php';</script>";
        } else {
            echo 'خطا در اجرای کوئری: ' . mysqli_error($link);
        }

        mysqli_stmt_close($statement);
        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- style -->
    <link href="css/login.css" rel="stylesheet" type="text/css" media="screen">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>افزودن خبر</title>
</head>
<body>
<div class="card">
  <div class="card-body d-flex justify-content-around flex-wrap border logdiv">
  <h5 class="card-title title" style="color:rgb(64 ,35, 41)">افزودن خبر</h5><br>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label class='mt-2' for="">عنوان خبر : </label><br>
            <input type="text" name="title" id="title" required><br> 
            <?php if(has_error('title')) { ?>
                <span class="text-danger"><?php echo get_error('title'); ?></span><br>
            <?php } ?>

            <label class='labels' for="">تصویر : </label><br>
            <input type="file" name="image" id="image" accept="image/*" required><br>
            <?php if(has_error('image')) { ?>
                <span class="text-danger"><?php echo get_error('image'); ?></span><br>
            <?php } ?>

            <label class='labels' for="">متن خبر : </label><br>
            <textarea name="newstext" id="newstext" rows="12" class="w-100 m-2" required></textarea><br> 
            <?php if(has_error('newstext')) { ?>
                <span class="text-danger"><?php echo get_error('newstext'); ?></span><br>
            <?php } ?>

            <label class='labels' for="">دسته‌بندی : </label><br>
            <input type="text" name="category" id="category" required><br>
            <?php if(has_error('category')) { ?>
                <span class="text-danger"><?php echo get_error('category'); ?></span><br>
            <?php } ?>

            <div class="d-flex justify-content-around btns">
                <button type="submit" class="btn btn-primary">ثبت</button>
                <a href="index.php" class="btn btn-secondary">صفحه اصلی</a>
                <a href="user.php" class="btn btn-secondary">صفحه کاربر</a>
            </div>
        </form>
  </div>
</div>

<script>
    function validateForm() {
        var title = document.getElementById('title').value;
        var newstext = document.getElementById('newstext').value;
        var category = document.getElementById('category').value;
        var image = document.getElementById('image').value;

        if (title.trim() === '' || newstext.trim() === '' || category.trim() === '' || image.trim() === '') {
            alert('لطفاً همه فیلدها را پر کنید.');
            return false;
        }
        return true;
    }
</script>
</body>
</html>