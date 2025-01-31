<?php
// اتصال به پایگاه داده
$link = mysqli_connect('localhost:3306', 'root', '', 'news');
if (!$link) {
    die('خطا در اتصال به پایگاه داده: ' . mysqli_connect_error());
}

// دریافت شناسه خبر از URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// بررسی معتبر بودن شناسه
if ($id <= 0) {
    die('شناسه خبر نامعتبر است.');
}

// خواندن خبر از جدول news و اطلاعات کاربر از جدول users
$query = "
    SELECT n.*, u.name, u.family 
    FROM news n
    JOIN users u ON n.user_id = u.id
    WHERE n.id = $id
";
$result = mysqli_query($link, $query);

if (!$result) {
    die('خطا در اجرای کوئری: ' . mysqli_error($link));
}

if (mysqli_num_rows($result) == 0) {
    die('خبر مورد نظر یافت نشد.');
}

$newsItem = mysqli_fetch_assoc($result);
mysqli_close($link);

// تبدیل مسیر نسبی تصویر به URL کامل
$baseUrl = "http://localhost/your-project-folder/"; // آدرس پایه پروژه
$imagePath = $baseUrl . $newsItem['image'];
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- style -->
    <link href="css/shownews.css" rel="stylesheet" type="text/css" media="screen">
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
    <title><?php echo htmlspecialchars($newsItem['title']); ?></title>
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
                            <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-person-plus"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">ورود</a> <!-- لینک به صفحه ورود -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registration.php">ثبت نام</a> <!-- لینک به صفحه ثبت‌نام -->
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- نمایش کامل خبر -->
    <div class="container news mt-4">
        <h2 class="mb-4 title"><?php echo htmlspecialchars($newsItem['title']); ?></h2>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php if (!empty($newsItem['image'])): ?>
                    <img src="<?php echo htmlspecialchars($newsItem['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($newsItem['title']); ?>">
                <?php else: ?>
                    <p class="text-muted">تصویری برای این خبر وجود ندارد.</p>
                <?php endif; ?>
                <p class="news-text"><?php echo nl2br(htmlspecialchars($newsItem['newstext'])); ?></p>
                <p class="text-muted">زمان انتشار: <?php echo htmlspecialchars($newsItem['created_at']); ?></p>
                <p class="text-muted">نویسنده: <?php echo htmlspecialchars($newsItem['name'] . ' ' . $newsItem['family']); ?></p>
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
</body>
</html>