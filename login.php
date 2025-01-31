<?php
session_start();
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

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = request('username');
    $password = request('password');

    if (is_null($username)) {
        $errors['username'] = 'فیلد نام کاربری نمی‌تواند خالی بماند';
    }

    if (is_null($password)) {
        $errors['password'] = 'فیلد پسورد نمی‌تواند خالی بماند';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'فیلد پسورد نمی‌تواند کمتر از 8 کاراکتر باشد';
    }

    if (empty($errors)) {
        $link = mysqli_connect('localhost:3306', 'root', '', 'news');
        if (!$link) {
            echo 'could not connect : ' . mysqli_connect_error();
            exit;
        }

        $statement = mysqli_prepare($link, "SELECT * FROM users WHERE username = ? AND password = ?");
        mysqli_stmt_bind_param($statement, 'ss', $username, $password);
        
        if (!$statement) {
            echo 'خطا در آماده‌سازی کوئری: ' . mysqli_error($link);
            exit;
        }

        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $user['id']; // ذخیره شناسه کاربر در سشن
            $_SESSION['isadmin'] = $user['isadmin']; // ذخیره وضعیت ادمین در سشن

            // هدایت کاربر بر اساس مقدار isadmin
            if ($user['isadmin'] == 1) {
                header("Location: managment.php");
            } else {
                header("Location: user.php");
            }
            exit;
        } else {
            $errors['login'] = 'نام کاربری یا کلمه عبور نادرست است'; 
        }

        mysqli_stmt_close($statement);
        mysqli_close($link);
    }
}
?>

<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" rel="stylesheet" type="text/css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>ورود</title>
</head>
<body>
<div class="card">
  <div class="card-body d-flex justify-content-around flex-wrap border logdiv">
  <h5 class="card-title title" style="color:rgb(64 ,35, 41)">ورود</h5><br>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"> 
            <br><label class='mt-2' for="">نام کاربری : </label><br>
            <input type="text" name="username"><br>
            <?php if(has_error('username')) { ?>
                <span class="text-danger"><?php echo get_error('username'); ?></span><br>
            <?php } ?>
            <label class='labels' for="">کلمه عبور : </label><br>
            <input type="password" name="password"><br>
            <?php if(has_error('password')) { ?>
                <span class="text-danger"><?php echo get_error('password'); ?></span><br>
            <?php } ?>
            <?php if(has_error('login')) { ?>
                <span class="text-danger"><?php echo get_error('login'); ?></span><br>
            <?php } ?>
            <div class="d-flex justify-content-around btns">
            <button type="submit" class="btn">ورود</button> 
            <a href="index.php" type="submit" class="btn">صفحه اصلی</a>
            </div>
        </form>
  </div>
</div>

</body>
</html>