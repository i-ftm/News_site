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
<div class="card " >
  <div class="card-body d-flex justify-content-around flex-wrap border border-warning-subtle logdiv">
  <h5 class="card-title title" style="color:rgb(64 ,35, 41)">ثبت نام</h5><br>
  <form action="/" method="post">
            <br><label class='mt-2' for="">نام کاربری : </label><br>
            <input type="text" name="username"><br>
            <?php if(has_error('username')) { ?>
                <span><?php  echo get_error('username'); ?></span><br>
            <?php  } ?>
            <label class='labels' for="">کلمه عبور : </label><br>
            <input type="password" name="password"><br>
            <?php if(has_error('password')) { ?>
                <span><?php  echo get_error('password'); ?></span><br>
            <?php  } ?>
            <label class='labels' for=""> نام :  </label><br>
            <input type="text" name="name"><br>
            <?php if(has_error('name')) { ?>
                <span><?php  echo get_error('name'); ?></span><br>
            <?php  } ?>
            <label class='labels' for=""> نام خانوادگی : </label><br>
            <input type="text" name="family"><br>
            <?php if(has_error('family')) { ?>
                <span><?php  echo get_error('family'); ?></span><br>
            <?php  } ?><br>
            <div class="d-flex justify-content-around " >
            <button type="submit" class="btn " >ثبت</button>
            </div>
        </form>
  </div>
</div>

<!-- <?php

function has_error($field) {
    global $errors;

    return isset($errors[$field]);
}

function get_error($field) {
    global $errors;

    return has_error($field) ? $errors[$field] : null;
}

$errors = [];

?> -->

</body>
</html>



