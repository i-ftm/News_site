<?php

function has_error($field) {
    global $errors;
    return isset($errors[$field]);
}

function get_error($field) {
    global $errors;
    return has_error($field) ? $errors[$field] : null;
}

$errors = [];

function request($field) {
    return isset($_REQUEST[$field]) && $_REQUEST[$field] != "" ? trim($_REQUEST[$field]) : null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = request('username');
    $password = request('password');
    $name = request('name');
    $family = request('family');

    if (is_null($username)) {
        $errors['username'] = 'فیلد نام کاربری نمی‌تواند خالی بماند';
    }

    if (is_null($password)) {
        $errors['password'] = 'فیلد پسورد نمی‌تواند خالی بماند';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'فیلد پسورد نمی‌تواند کمتر از 8 کاراکتر باشد';
    }

    if (is_null($name)) {
        $errors['name'] = 'فیلد نام نمی‌تواند خالی بماند';
    }

    if (is_null($family)) {
        $errors['family'] = 'فیلد نام خانوادگی نمی‌تواند خالی بماند';
    }

    if (empty($errors)) {
        $link = mysqli_connect('localhost', 'root', '', 'NEWS');

        if (!$link) {
            echo 'could not connect : ' . mysqli_connect_error();
            exit;
        }

        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $statement = mysqli_prepare($link, "INSERT INTO users (username, password, name, family) VALUES (?, ?, ?, ?)");
        
        if (!$statement) {
            echo 'خطا در آماده‌سازی کوئری: ' . mysqli_error($link);
            exit;
        }

        mysqli_stmt_bind_param($statement, 'ssss', $username, $password, $name, $family);

        if (mysqli_stmt_execute($statement)) {
            echo 'ثبت نام با موفقیت انجام شد.';

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>ثبت نام</title>
</head>
<body>
<div class="card">
  <div class="card-body d-flex justify-content-around flex-wrap border logdiv">
  <h5 class="card-title title" style="color:rgb(64 ,35, 41)">ثبت نام</h5><br>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label class='mt-2' for="">نام کاربری : </label><br>
            <input type="text" name="username"><br>
            <?php if(has_error('username')) { ?>
                <span class="text-danger"><?php echo get_error('username'); ?></span><br>
            <?php } ?>

            <label class='labels' for="">کلمه عبور : </label><br>
            <input type="password" name="password"><br>
            <?php if(has_error('password')) { ?>
                <span class="text-danger"><?php echo get_error('password'); ?></span><br>
            <?php } ?>

            <label class='labels' for="">نام : </label><br>
            <input type="text" name="name"><br>
            <?php if(has_error('name')) { ?>
                <span class="text-danger"><?php echo get_error('name'); ?></span><br>
            <?php } ?>

            <label class='labels' for="">نام خانوادگی : </label><br>
            <input type="text" name="family"><br>
            <?php if(has_error('family')) { ?>
                <span class="text-danger"><?php echo get_error('family'); ?></span><br>
            <?php } ?><br>

            <div class="d-flex justify-content-around btns">
            <button type="submit" class="btn"  >ثبت</button>
            <a href="index.php" type="submit" class="btn">صفحه اصلی</a>
            </div>
        </form>
  </div>
</div>

</body>
</html>