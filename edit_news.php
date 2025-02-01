<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit();
}


$link = mysqli_connect('localhost:3306', 'root', '', 'news');
if (!$link) {
    die('خطا در اتصال به پایگاه داده: ' . mysqli_connect_error());
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die('شناسه خبر نامعتبر است.');
}

$query = "SELECT * FROM news WHERE id = $id AND user_id = {$_SESSION['user_id']}";
$result = mysqli_query($link, $query);

if (!$result) {
    die('خطا در اجرای کوئری: ' . mysqli_error($link));
}

if (mysqli_num_rows($result) == 0) {
    die('شما اجازه ویرایش این خبر را ندارید.');
}

$newsItem = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($link, $_POST['title']);
    $content = mysqli_real_escape_string($link, $_POST['content']);
    $image = mysqli_real_escape_string($link, $_POST['image']);

    $updateQuery = "UPDATE news SET title = '$title', content = '$content', image = '$image' WHERE id = $id";
    if (mysqli_query($link, $updateQuery)) {
        header('Location: user.php'); 
        exit();
    } else {
        die('خطا در ویرایش خبر: ' . mysqli_error($link));
    }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- style -->
    <link href="css/index.css" rel="stylesheet" type="text/css" media="screen">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>ویرایش خبر</title>
</head>
<body>
    <div>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <li class="nav-item dropdown d-flex align-items-center">
                    <a href="index.php" class="logo">
                        <img src="images/5.png" alt="لوگو">
                    </a>
                    <a class="nav-link dropdown-toggle m-1 fs-6" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      اخبار
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="index.php?category=همه">همه اخبار</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="index.php?category=سیاسی">سیاسی</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="index.php?category=ورزشی">ورزشی</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="index.php?category=اقتصادی">اقتصادی</a></li>
                    </ul>
                </li>
                <form class="d-flex align-items-center" role="search" action="index.php" method="get">
                    <input class="form-control p-2" type="search" name="search" placeholder="جست و جو" aria-label="Search" style="height: 5vh;">
                    <button class="sbtn p-2 m-2" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php"><i class="bi bi-house"></i> صفحه اصلی</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user.php">خروج</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- فرم ویرایش خبر -->
        <div class="container mt-4">
            <h2 class="text-center mb-4">ویرایش خبر</h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان خبر</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($newsItem['title']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">محتوا</label>
                            <textarea class="form-control" id="content" name="content" rows="5" required><?php echo htmlspecialchars($newsItem['newstext']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">آدرس تصویر</label>
                            <input type="text" class="form-control" id="image" name="image" value="<?php echo htmlspecialchars($newsItem['image']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- footer -->
        <div class="footer w-100">
            <div class="container text-center">
                <p class="footer-text">تمامی حقوق محفوظ است &copy; 2023</p>
                <ul class="footer-links">
                    <li><a href="#">درباره ما</a></li>
                    <li><a href="#">تماس با ما</a></li>
                    <li><a href="#">حریم خصوصی</a></li>
                    <li><a href="#">شرایط و قوانین</a></li>
                </ul>
                <ul>
                    <i class="bi bi-whatsapp"></i>
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-twitter-x"></i>
                    <i class="bi bi-telegram"></i>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>