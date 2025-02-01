<?php

$link = mysqli_connect('localhost:3306', 'root', '', 'news');
if (!$link) {
    die('خطا در اتصال به پایگاه داده: ' . mysqli_connect_error());
}


$category = isset($_GET['category']) ? $_GET['category'] : 'همه'; 
$category = mysqli_real_escape_string($link, $category); 


$search = isset($_GET['search']) ? $_GET['search'] : ''; 
$search = mysqli_real_escape_string($link, $search); 


if ($category === 'همه') {
    $query = "SELECT * FROM news WHERE share = 1"; 
} else {
    $query = "SELECT * FROM news WHERE category = '$category' AND share = 1"; 
}


if (!empty($search)) {
    $query .= " AND title LIKE '%$search%'";
}

$result = mysqli_query($link, $query);

if (!$result) {
    die('خطا در اجرای کوئری: ' . mysqli_error($link));
}

$newsItems = [];
while ($row = mysqli_fetch_assoc($result)) {
    $newsItems[] = $row;
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
    <title>اخبار <?php echo htmlspecialchars($category); ?></title>
</head>
<body>
    <div>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <li class="nav-item dropdown d-flex align-items-center">
                    <i class="logo"><img src="images/5.png" alt="لوگو"></i>
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
                    <input class="form-control p-2" type="search" name="search" placeholder="جست و جو" aria-label="Search" style="height: 5vh;" value="<?php echo htmlspecialchars($search); ?>">
                    <button class="sbtn p-2 m-2" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-person-plus"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">ورود</a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registration.php">ثبت نام</a> 
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- نمایش اخبار -->
        <div class="container mt-4">
            <h2 class="title text-center mb-4">اخبار <?php echo htmlspecialchars($category); ?></h2>
            <div class="row">
                <?php if (count($newsItems) > 0): ?>
                    <?php foreach ($newsItems as $newsItem): ?>
                        <div class="col-md-4 mb-4 d-flex">
                            <div class="card flex-fill d-flex flex-column">
                                <img src="<?php echo htmlspecialchars($newsItem['image']); ?>" class="card-img-top flex-grow-1" alt="<?php echo htmlspecialchars($newsItem['title']); ?>">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="title-news card-title"><?php echo htmlspecialchars($newsItem['title']); ?></h5>
                                    <p class="card-text flex-grow-1"><?php echo nl2br(htmlspecialchars(substr($newsItem['content'], 0, 100) . '...')); ?></p>
                                    <a href="shownews.php?id=<?php echo $newsItem['id']; ?>" class="show-news sbtn mt-auto">مشاهده کامل خبر</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-center">هیچ خبری در این دسته‌بندی یافت نشد.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- footer -->
        <div class="footer w-100">
            <div class="container text-center">
                <p class="footer-text">تمامی حقوق محفوظ است &copy; 2025</p>
                <ul class="footer-links">
                    <li><a href="#">درباره ما</a></li>
                    <li><a href="#">تماس با ما</a></li>
                    <li><a href="#">حریم خصوصی</a></li>
                    <li><a href="#">شرایط و قوانین</a></li>
                </ul>
                <ul class="footer-links">
                    <li><a href="#"><i class="bi bi-whatsapp"></i></a></li>
                    <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                    <li><a href="#"><i class="bi bi-twitter-x"></i></a></li>
                    <li><a href="#"><i class="bi bi-telegram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>