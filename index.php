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
    <title>NEWS</title>
</head>
<body>
    <div class="page">
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid ">
                <li class="nav-item dropdown d-flex align-items-center">
                    <i class="logo"><img src="images/5.png" alt=""></i>
                    <a class="nav-link dropdown-toggle m-1 fs-6" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      اخبار
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">سیاسی</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">ورزشی</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">اقتصادی</a></li>
                    </ul>
                </li>
                <form class="d-flex align-items-center" role="search">
                    <input class="form-control p-2" type="search" placeholder="جست و جو" aria-label="Search" style="height: 5vh;">
                    <button class="sbtn p-2 m-2" type="submit"><i class="bi bi-search"></i></button>
                  </form>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-person-plus"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">ورود</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link "  href="#" >ثبت نام</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>
        <!-- slider -->
        <div class="m-2">
          <div class="title">
            <h2 class="fs-4 fw-bold">
                اخبار ویژه
            </h2>
          </div>
          <div id="carouselExampleCaptions" class="carousel slide mt-5">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div class="row">
                      <div class="col-4"><img src="images/1.jpg" class="d-block w-100" alt="..."></div>
                      <div class="col-8">
                        <div class="mt-4 d-none d-md-block">
                          <h2>First slide label</h2><br>
                          <p>Some representative placeholder content for the first slide.Some representative placeholder content for the first slide.
                            Some representative placeholder content for the first slide.Some representative placeholder content for the first slide.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="row">
                      <div class="col-4"><img src="images/2.jpg" class="d-block w-100" alt="..."></div>
                      <div class="col-8">
                        <div class="mt-4 d-none d-md-block">
                          <h5>Second slide label</h5>
                          <p>Some representative placeholder content for the second slide.</p>
                        </div>
                    </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="row">
                      <div class="col-4"><img src="images/3.jpg" class="d-block w-100" alt="..."></div>
                      <div class="col-8">
                        <div class="mt-4 d-none d-md-block">
                          <h5>Third slide label</h5>
                          <p>Some representative placeholder content for the third slide.</p>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="row">
                    <div class="col-4"><img src="images/3.jpg" class="d-block w-100" alt="..."></div>
                    <div class="col-8">
                      <div class="mt-4 d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                      </div>
                  </div>
                </div>
              </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
          </div>
        </div>
        <!-- news -->
        <div class="title">
          <h2 class="fs-4 fw-bolder">
              اخبار
          </h2>
        </div>
        <div>
          <div class="news">
            <div class="title-news">
              <h2 class="fs-5 fw-bold">
                  سیاسی
              </h2>
            </div>
            <div class="option-imgs d-flex flex-wrap justify-content-evenly p-5" style="width: 100%;">
              <div class="option-img col-12 col-xl-3 mt-5 mb-5">
                  <img src="assets/images/4-1.jpg" alt="">
                  <div class="option-disceription">
                      <h4 class="pt-3 px-2 fs-2 fw-semibold">App 1</h4>
                      <p class="pt-3 px-2 fs-5 fw-mibold text-uppercase mt-2 text-truncate">Lorem ipsum, dolor sit amet consectetur</p>
                      <a class="show-news" href="#">مشاهده خبر</a>
                  </div>
              </div>
              <div class="option-img col-12 col-xl-3 mt-5 mb-5">
                  <img src="assets/images/4-2.jpg" alt="">
                  <div class="option-disceription">
                      <h4 class="pt-3 px-2 fs-2 fw-semibold">Product 1</h4>
                      <p class="pt-3 px-2 fs-5 fw-mibold text-uppercase mt-2 text-truncate">Lorem ipsum, dolor sit amet consectetur</p>
                      <a class="show-news" href="#">مشاهده خبر</a>
                  </div>
              </div>
              <div class="option-img col-12 col-xl-3 mt-5 mb-5">
                  <img src="assets/images/4-3.jpg" alt="">
                  <div class="option-disceription">
                      <h4 class="pt-3 px-2 fs-2 fw-semibold">Branding 1</h4>
                      <p class="pt-3 px-2 fs-5 fw-mibold text-uppercase mt-2 text-truncate">Lorem ipsum, dolor sit amet consectetur</p>
                      <a class="show-news" href="#">مشاهده خبر</a>
                  </div>
              </div>
              <div class="option-img col-12 col-xl-3 mt-5 mb-5">
                  <img src="assets/images/4-4.jpg" alt="">
                  <div class="option-disceription">
                      <h4 class="pt-3 px-2 fs-2 fw-semibold">Books 1</h4>
                      <p class="pt-3 px-2 fs-5 fw-mibold text-uppercase mt-2 text-truncate">Lorem ipsum, dolor sit amet consectetur</p>
                      <a class="show-news" href="#">مشاهده خبر</a>
                  </div>
              </div>
            </div>
          </div>
          <div class="news">
            <div class="title-news">
              <h2 class="fs-5 fw-bold">
                  اقتصادی
              </h2>
            </div>
            <div class="option-imgs d-flex flex-wrap justify-content-evenly p-5" style="width: 100%;">
              <div class="option-img col-12 col-xl-3 mt-5 mb-5">
                  <img src="assets/images/4-1.jpg" alt="">
                  <div class="option-disceription">
                      <h4 class="pt-3 px-2 fs-2 fw-semibold">App 1</h4>
                      <p class="pt-3 px-2 fs-5 fw-mibold text-uppercase mt-2 text-truncate">Lorem ipsum, dolor sit amet consectetur</p>
                      <a class="show-news" href="#">مشاهده خبر</a>
                  </div>
              </div>
              <div class="option-img col-12 col-xl-3 mt-5 mb-5">
                  <img src="assets/images/4-2.jpg" alt="">
                  <div class="option-disceription">
                      <h4 class="pt-3 px-2 fs-2 fw-semibold">Product 1</h4>
                      <p class="pt-3 px-2 fs-5 fw-mibold text-uppercase mt-2 text-truncate">Lorem ipsum, dolor sit amet consectetur</p>
                      <a class="show-news" href="#">مشاهده خبر</a>
                  </div>
              </div>
              <div class="option-img col-12 col-xl-3 mt-5 mb-5">
                  <img src="assets/images/4-3.jpg" alt="">
                  <div class="option-disceription">
                      <h4 class="pt-3 px-2 fs-2 fw-semibold">Branding 1</h4>
                      <p class="pt-3 px-2 fs-5 fw-mibold text-uppercase mt-2 text-truncate">Lorem ipsum, dolor sit amet consectetur</p>
                      <a class="show-news" href="#">مشاهده خبر</a>
                  </div>
              </div>
              <div class="option-img col-12 col-xl-3 mt-5 mb-5">
                  <img src="assets/images/4-4.jpg" alt="">
                  <div class="option-disceription">
                      <h4 class="pt-3 px-2 fs-2 fw-semibold">Books 1</h4>
                      <p class="pt-3 px-2 fs-5 fw-mibold text-uppercase mt-2 text-truncate">Lorem ipsum, dolor sit amet consectetur</p>
                      <a class="show-news" href="#">مشاهده خبر</a>
                  </div>
              </div>
            </div>
          </div>
          <div class="news">
            <div class="title-news">
              <h2 class="fs-5 fw-bold">
                  ورزشی
              </h2>
            </div>
            <div class="option-imgs d-flex flex-wrap justify-content-evenly p-5" style="width: 100%;">
              <div class="option-img col-12 col-xl-3 mt-5 mb-5">
                  <img src="assets/images/4-1.jpg" alt="">
                  <div class="option-disceription">
                      <h4 class="pt-3 px-2 fs-2 fw-semibold">App 1</h4>
                      <p class="pt-3 px-2 fs-5 fw-mibold text-uppercase mt-2 text-truncate">Lorem ipsum, dolor sit amet consectetur</p>
                      <a class="show-news" href="#">مشاهده خبر</a>
                  </div>
              </div>
              <div class="option-img col-12 col-xl-3 mt-5 mb-5">
                  <img src="assets/images/4-2.jpg" alt="">
                  <div class="option-disceription">
                      <h4 class="pt-3 px-2 fs-2 fw-semibold">Product 1</h4>
                      <p class="pt-3 px-2 fs-5 fw-mibold text-uppercase mt-2 text-truncate">Lorem ipsum, dolor sit amet consectetur</p>
                      <a class="show-news" href="#">مشاهده خبر</a>
                  </div>
              </div>
              <div class="option-img col-12 col-xl-3 mt-5 mb-5">
                  <img src="assets/images/4-3.jpg" alt="">
                  <div class="option-disceription">
                      <h4 class="pt-3 px-2 fs-2 fw-semibold">Branding 1</h4>
                      <p class="pt-3 px-2 fs-5 fw-mibold text-uppercase mt-2 text-truncate">Lorem ipsum, dolor sit amet consectetur</p>
                      <a class="show-news" href="#">مشاهده خبر</a>
                  </div>
              </div>
              <div class="option-img col-12 col-xl-3 mt-5 mb-5">
                  <img src="assets/images/4-4.jpg" alt="">
                  <div class="option-disceription">
                      <h4 class="pt-3 px-2 fs-2 fw-semibold">Books 1</h4>
                      <p class="pt-3 px-2 fs-5 fw-mibold text-uppercase mt-2 text-truncate">Lorem ipsum, dolor sit amet consectetur</p>
                      <a class="show-news" href="#">مشاهده خبر</a>
                  </div>
              </div>
            </div>
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