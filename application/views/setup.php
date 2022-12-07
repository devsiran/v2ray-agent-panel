<?php
defined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>نصب اسکریپت</title>
  <link href="https://cdn.jsdelivr.net/gh/rastikerdar/sahel-font@v3.4.0/dist/font-face.css" rel="stylesheet" type="text/css" />
  <!-- Favicon -->
  <link rel="icon" href="/assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="/assets/css/rtl.css">
</head>

<body class="bg-secondary">
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-success py-6 py-lg-6 pt-lg-6">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">نصب اسکریپت</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-secondary" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
                <?php
                if(isset($_POST['dbhost'])){
                  echo '<div class="alert alert-warning">خطا در اتصال به دیتابیس.</div>';
                }
                ?>
              <div class="text-center text-muted mb-4">
                <small>اطلاعات دیتابیس</small>
              </div>
              <form role="form" method="post" action="/">
              <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-world"></i></span>
                    </div>
                    <input value="localhost" class="form-control" placeholder="هاست" type="text" name="dbhost">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-app"></i></span>
                    </div>
                    <input class="form-control" placeholder="نام دیتابیس" type="text" name="dbname">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-user-run"></i></span>
                    </div>
                    <input class="form-control" placeholder="نام کاربری دیتابیس" type="text" name="dbuser">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                    </div>
                    <input class="form-control" placeholder="پسورد دیتابیس" type="password" name="dbpass">
                  </div>
                </div>
                <div class="text-center text-muted mb-4">
                    <small>اطلاعات ادمین</small>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                    </div>
                    <input class="form-control" placeholder="نام کاربری" type="text" name="aduser">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input onkeyup="checkPassword(this)" onchange="checkPassword(this)" class="form-control" placeholder="پسورد" type="password" name="adpass">
                  </div>
                  <ul class="small mt-2">
                        <li id="pr_length" class="text-danger">حداقل 8 کاراکتر</li>
                        <li id="pr_lower" class="text-danger">حروف کوچک</li>
                        <li id="pr_upper" class="text-danger">حروف بزرگ</li>
                        <li id="pr_number" class="text-danger">اعداد</li>
                    </ul>
                </div>
                <div class="text-center">
                  <button disabled id="subBTN" type="submit" class="btn w-100 btn-success my-4">نصب اسکریپت</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <br><br><br>
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="/assets/js/argon.js?v=1.2.0"></script>
  <script>
    function checkPassword(e){
        let isOk = true;

        if(/\d/.test(e.value)){$("#pr_number").attr("class","text-success")}
        else{$("#pr_number").attr("class","text-danger");isOk=false;}

        if(e.value.length>=8){$("#pr_length").attr("class","text-success")}
        else{$("#pr_length").attr("class","text-danger");isOk=false;}

        if(/[a-z]/.test(e.value)){$("#pr_lower").attr("class","text-success")}
        else{$("#pr_lower").attr("class","text-danger");isOk=false;}

        if(/[A-Z]/.test(e.value)){$("#pr_upper").attr("class","text-success")}
        else{$("#pr_upper").attr("class","text-danger");isOk=false;}

        if(isOk){
            $("#subBTN").attr("disabled",false);
        }
        else{
            $("#subBTN").attr("disabled",true);
        }

    }
  </script>
</body>

</html>