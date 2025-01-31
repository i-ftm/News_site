<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['isadmin']) || $_SESSION['isadmin'] != 1) {
    header("Location: login.php");
    exit;
}

$link = mysqli_connect('localhost:3306', 'root', '', 'news');
if (!$link) {
    die('خطا در اتصال به پایگاه داده: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_admin'])) {
    $user_id = intval($_POST['user_id']);
    $new_admin_value = $_POST['isadmin'] == 1 ? 0 : 1;

    $update_query = "UPDATE users SET isadmin = $new_admin_value WHERE id = $user_id";
    if (!mysqli_query($link, $update_query)) {
        die('خطا در به‌روزرسانی وضعیت ادمین: ' . mysqli_error($link));
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $user_id = intval($_POST['user_id']);

    $delete_query = "DELETE FROM users WHERE id = $user_id";
    if (!mysqli_query($link, $delete_query)) {
        die('خطا در حذف کاربر: ' . mysqli_error($link));
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_share'])) {
    $news_id = intval($_POST['news_id']);
    $new_share_value = $_POST['share'] == 1 ? 0 : 1;

    $update_query = "UPDATE news SET share = $new_share_value WHERE id = $news_id";
    if (!mysqli_query($link, $update_query)) {
        die('خطا در به‌روزرسانی وضعیت share: ' . mysqli_error($link));
    }
}

$users_query = "SELECT * FROM users";
$users_result = mysqli_query($link, $users_query);
if (!$users_result) {
    die('خطا در دریافت کاربران: ' . mysqli_error($link));
}
$users = mysqli_fetch_all($users_result, MYSQLI_ASSOC);

$published_news_query = "SELECT * FROM news WHERE share = 1";
$published_news_result = mysqli_query($link, $published_news_query);
if (!$published_news_result) {
    die('خطا در دریافت اخبار منتشر شده: ' . mysqli_error($link));
}
$published_news = mysqli_fetch_all($published_news_result, MYSQLI_ASSOC);

$unpublished_news_query = "SELECT * FROM news WHERE share = 0";
$unpublished_news_result = mysqli_query($link, $unpublished_news_query);
if (!$unpublished_news_result) {
    die('خطا در دریافت اخبار منتشر نشده: ' . mysqli_error($link));
}
$unpublished_news = mysqli_fetch_all($unpublished_news_result, MYSQLI_ASSOC);

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
    <title>مدیریت</title>
    <style>
        .management-section {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .management-section h2 {
            color: #32222c;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 10px;
            text-align: center;
        }
        .table th {
            background-color: #87314e;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn-toggle, .btn-delete {
            background-color: #87314e;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin: 2px;
        }
        .btn-toggle:hover, .btn-delete:hover {
            background-color: #6b2540;
        }
        .scrollable-section {
            max-height: 400px; /* ارتفاع ثابت برای بخش اسکرول */
            overflow-y: auto; /* فعال‌کردن اسکرول عمودی */
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <li class="nav-item dropdown d-flex align-items-center">
                    <i class="logo"><img src="images/5.png" alt="لوگو"></i>
                    <a class="nav-link dropdown-toggle m-1 fs-6" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      مدیریت
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="index.php">صفحه اصلی</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="managment.php">مدیریت</a></li>
                    </ul>
                </li>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-person-plus"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container management-section">
            <h2>مدیریت کاربران</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام کاربری</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>وضعیت ادمین</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['family']); ?></td>
                            <td><?php echo $user['isadmin'] == 1 ? 'ادمین' : 'کاربر عادی'; ?></td>
                            <td>
                                <form action="managment.php" method="post" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <input type="hidden" name="isadmin" value="<?php echo $user['isadmin']; ?>">
                                    <button type="submit" name="toggle_admin" class="btn-toggle">
                                        <?php echo $user['isadmin'] == 1 ? 'تنزل به کاربر عادی' : 'ارتقا به ادمین'; ?>
                                    </button>
                                </form>
                                <form action="managment.php" method="post" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" name="delete_user" class="btn-delete">حذف کاربر</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="container management-section">
            <h2>اخبار منتشر شده</h2>
            <div class="scrollable-section">
                <table class="table">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>عنوان</th>
                            <th>متن خبر</th>
                            <th>وضعیت انتشار</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($published_news as $newsItem): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($newsItem['id']); ?></td>
                                <td><?php echo htmlspecialchars($newsItem['title']); ?></td>
                                <td><?php echo htmlspecialchars($newsItem['newstext']); ?></td>
                                <td>منتشر شده</td>
                                <td>
                                    <form action="managment.php" method="post" style="display:inline;">
                                        <input type="hidden" name="news_id" value="<?php echo $newsItem['id']; ?>">
                                        <input type="hidden" name="share" value="1">
                                        <button type="submit" name="toggle_share" class="btn-toggle">غیرفعال کردن</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container management-section">
            <h2>اخبار منتشر نشده</h2>
            <div class="scrollable-section">
                <table class="table">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>عنوان</th>
                            <th>متن خبر</th>
                            <th>وضعیت انتشار</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($unpublished_news as $newsItem): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($newsItem['id']); ?></td>
                                <td><?php echo htmlspecialchars($newsItem['title']); ?></td>
                                <td><?php echo htmlspecialchars($newsItem['newstext']); ?></td>
                                <td>غیرفعال</td>
                                <td>
                                    <form action="managment.php" method="post" style="display:inline;">
                                        <input type="hidden" name="news_id" value="<?php echo $newsItem['id']; ?>">
                                        <input type="hidden" name="share" value="0">
                                        <button type="submit" name="toggle_share" class="btn-toggle">فعال کردن</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

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