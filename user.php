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

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM news WHERE user_id = $user_id";
$result = mysqli_query($link, $query);

if (!$result) {
    die('خطا در اجرای کوئری: ' . mysqli_error($link));
}

$newsItems = [];
while ($row = mysqli_fetch_assoc($result)) {
    $newsItems[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_news'])) {
    $news_id = intval($_POST['news_id']);
    $delete_query = "DELETE FROM news WHERE id = $news_id AND user_id = $user_id";
    if (mysqli_query($link, $delete_query)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        die('خطا در حذف خبر: ' . mysqli_error($link));
    }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/index.css" rel="stylesheet" type="text/css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>پنل کاربری</title>
</head>
<body>
    <div>
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
                            <a class="nav-link" href="addnews.php"><i class="bi bi-plus-circle"></i> درج خبر</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-4">
            <h2 class="text-center mb-4">اخبار منتشر شده توسط شما</h2>
            <div class="row">
                <?php if (count($newsItems) > 0): ?>
                    <?php foreach ($newsItems as $newsItem): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="<?php echo htmlspecialchars($newsItem['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($newsItem['title']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($newsItem['title']); ?></h5>
                                    <p class="card-text"><?php echo nl2br(htmlspecialchars(substr($newsItem['content'], 0, 100) . '...')); ?></p>
                                    <a href="edit_news.php?id=<?php echo $newsItem['id']; ?>" class="btn btn-warning">ویرایش خبر</a>
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="news_id" value="<?php echo $newsItem['id']; ?>">
                                        <button type="submit" name="delete_news" class="btn btn-danger" onclick="return confirm('آیا مطمئن هستید که می‌خواهید این خبر را حذف کنید؟')">حذف خبر</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-center">شما هیچ خبری منتشر نکرده‌اید.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

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