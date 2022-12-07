<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>پنل مدیریت LAST VPN</title>
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/sahel-font@v3.4.0/dist/font-face.css" rel="stylesheet"
        type="text/css" />
    <!-- Favicon -->
    <link rel="icon" href="/assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css">
    <link rel="stylesheet" href="/assets/css/rtl.css">
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                    <img src="/assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">پنل فروش</span>
                            </a>
                        </li>
                        <?php
            if($me->isAdmin==1){
              ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if($page=="resellers"){echo 'active';} ?>" href="/admin/resellers">
                                <i class="ni ni-shop text-primary"></i>
                                <span class="nav-link-text">فروشندگان</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($page=="servers"){echo 'active';} ?>" href="/admin/servers">
                                <i class="ni ni-world-2 text-primary"></i>
                                <span class="nav-link-text">سرورها</span>
                            </a>
                        </li>
                        <?php
            }
            ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center">
                        <li class="text-white">پنل مدیریت وی پی ان</li>
                    </ul>
                    <ul class="navbar-nav align-items-center  ml-md-auto ">

                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="/assets/img/theme/team-4.jpg">
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold"><?php echo $me->username; ?></span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">خوش آمدید!</h6>
                                </div>
                                <a href="https://t.me/mylastvpn" target="_blank" class="dropdown-item">
                                    <i class="ni ni-support-16"></i>
                                    <span>پشتیبانی</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="?logout" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>خروج</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content -->
        <div class="container-fluid">
            <br>
            <?php
            
            foreach($messages as $m){
              echo '<div class="alert alert-' . $m[0] . '">' . $m[1] . '</div>';
            }
            
            if($page=="resellers"){
                ?>
                <div class="card">
                    <div class="card-header">فروشندگان</div>
                    <div class="card-body">
                        <button data-toggle="modal" data-target="#newResellerModal" class="btn btn-success btn-sm"><i class="ni ni-fat-add"></i> فروشنده جدید</button>
                        <form action="" method="post" class="modal fade" id="newResellerModal" tabindex="-1" role="dialog" aria-labelledby="newResellerModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newResellerModalLabel">فروشنده جدید</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                                    <div class="form-group">
                                        <label for="newResellerName" class="form-control-label">نام کاربری</label>
                                        <input required class="form-control" type="text" name="newResellerName" id="newResellerName" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="newResellerPass" class="form-control-label">پسورد</label>
                                        <input required class="form-control" type="password" name="newResellerPass" id="newResellerPass" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="newResellerCharge" class="form-control-label">شارژ (روز)</label>
                                        <input required class="form-control" type="number" name="newResellerCharge" id="newResellerCharge" required>
                                    </div>
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="newResellerIsAdmin">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                    <label style="transform: translateY(-6px);margin-right: 10px;">دسترسی مدیریت</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                    <button type="submit" class="btn btn-success">ایجاد</button>
                                </div>
                                </div>
                            </div>
                        </form>
                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>نام کاربری</th>
                                    <th>شارژ حساب</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                <?php
                                $i=0;
                                foreach($panelInfo['resellers'] as $row){
                                    $i+=1;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row->username . ($row->id==$me->id?' <label class="badge bg-success text-white">شما</label>':($row->isAdmin?' <label class="badge bg-danger text-white">مدیر</label>':'')); ?></td>
                                        <td><?php echo number_format($row->charge); ?> روز</td>
                                        <td style="width: 250px;text-align:center">
                                            <div class="btn-group btn-group-sm" dir="ltr">
                                                <button data-toggle="modal" data-target="#passResellerModal" onclick="document.getElementById(`passRessellerID`).value=<?php echo $row->id; ?>;$(`#passResellerName`).html(`<?php echo $row->username; ?>`);document.getElementById('passUserValue').value=''" class="btn btn-warning"><i class="ni ni-key-25"></i> پسورد</button>
                                                <button data-toggle="modal" data-target="#chargeResellerModal" onclick="document.getElementById(`chargeRessellerID`).value=<?php echo $row->id; ?>;$(`#chargeResellerName`).html(`<?php echo $row->username; ?>`);document.getElementById('chargeUserValue').value=<?php echo $row->charge; ?>" class="btn btn-secondary" style="margin-left:0 !important"><i class="ni ni-sound-wave"></i> شارژ</button>
                                                <?php if($row->id!=$me->id){ echo '<button data-toggle="modal" data-target="#deleteResellerModal" class="btn btn-danger" onclick="document.getElementById(`deleteRessellerID`).value=' . $row->id . ';$(`#resellerName`).html(`' . $row->username . '`)"><i class="ni ni-fat-remove"></i> حذف</button>'; }else{echo '<button class="btn btn-danger" style="opacity:.3;cursor: not-allowed !important;" disabled><i class="ni ni-fat-remove"></i> حذف</button>';} ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <form action="" method="post" class="modal fade" id="deleteResellerModal" tabindex="-1" role="dialog" aria-labelledby="deleteResellerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteResellerModalLabel">حذف فروشنده</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="token" value="<?php echo $token; ?>">
                            <input type="hidden" name="deleteresseller" id="deleteRessellerID">
                            <strong id="resellerName"></strong> حذف شود؟
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </div>
                        </div>
                    </div>
                </form>
                <form action="" method="post" class="modal fade" id="chargeResellerModal" tabindex="-1" role="dialog" aria-labelledby="chargeResellerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="chargeResellerModalLabel">تغییر میزان شارژ <strong id="chargeResellerName"></strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="token" value="<?php echo $token; ?>">
                            <input type="hidden" name="chargeresseller" id="chargeRessellerID">
                            <div class="form-group">
                                <label for="chargeUserValue" class="form-control-label">میزان شارژ (روز)</label>
                                <input class="form-control" type="number" name="chargeUserValue" id="chargeUserValue" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                            <button type="submit" class="btn btn-danger">تغییر شارژ</button>
                        </div>
                        </div>
                    </div>
                </form>
                <form action="" method="post" class="modal fade" id="passResellerModal" tabindex="-1" role="dialog" aria-labelledby="passResellerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="passResellerModalLabel">تغییر گذرواژه <strong id="passResellerName"></strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="token" value="<?php echo $token; ?>">
                            <input type="hidden" name="passresseller" id="passRessellerID"> 
                            <div class="form-group">
                                <label for="chargeUserValue" class="form-control-label">گذرواژه جدید</label>
                                <input class="form-control" type="password" name="passUserValue" id="passUserValue" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                            <button type="submit" class="btn btn-danger">تغییر پسورد</button>
                        </div>
                        </div>
                    </div>
                </form>
                <?php
            }
            else{
                echo '404';
            }
            ?>
        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/assets/js/qrcode.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    <script src="/assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="/assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <!-- Argon JS -->
    <script src="/assets/js/argon.js?v=1.2.0"></script>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</body>

</html>