<?php
defined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>پنل فروش LAST VPN</title>
  <link href="https://cdn.jsdelivr.net/gh/rastikerdar/sahel-font@v3.4.0/dist/font-face.css" rel="stylesheet" type="text/css" />
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
              <a class="nav-link active" href="#">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">پنل فروش</span>
              </a>
            </li>
            <?php
            if($me->isAdmin==1){
              ?>
            <li class="nav-item">
              <a class="nav-link" href="/admin/resellers">
                <i class="ni ni-ui-04 text-primary"></i>
                <span class="nav-link-text">پنل مدیر</span>
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
            <li class="text-white">پنل مدیریت فروش وی پی ان</li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-md-auto ">

          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <br>
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">شارژ حساب</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo number_format($me->charge); ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-diamond"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"></span>
                    <span class="text-nowrap">روز</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">کاربران فعال</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $panelInfo['activeUser']; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-single-02"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">کاربران غیرفعال</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $panelInfo['deactiveUser']; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-single-02"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">سرور ها</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $panelInfo['serverCount']; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-world-2"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="row">
              <div class="col-auto">
                <div class="card-header border-0">
                  <button data-toggle="modal" data-target="#newUserModal" class="btn btn-sm btn-success">
                      <strong>+</strong> کاربر جدید
                  </button>
                </div>
              </div>
              <div class="col-3">
                <select onchange="changeShowFilter(this.value)" class="form-control form-control-sm mt-3" id="">
                  <option value="all">همه</option>
                  <option value="active">فعال</option>
                  <option value="deactive">غیرفعال</option>
                </select>
                <script>
                  function changeShowFilter(f){
                    if(f=="active"){
                      document.getElementById("showFilter").innerHTML = '<style>.userRow:not([data-expired=no]){display:none}</style>';
                    }
                    else if(f=="deactive"){
                      document.getElementById("showFilter").innerHTML = '<style>.userRow:not([data-expired=yes]){display:none}</style>';
                    }
                    else{
                      document.getElementById("showFilter").innerHTML = '';
                    }
                  }
                </script>
                <div id="showFilter"></div>
              </div>
            </div>
            <!-- Modal -->
            <form method="post" action="" class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="newUserModalLabel">کاربر جدید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <hr style="margin-top: -10px">
                    <div class="text-center" style="margin-top: -44px;margin-bottom: 23px;">
                      <span class="bg-white px-2">مشخصات کاربر</span>
                    </div>
                    <div class="form-group">
                        <label for="newUserName" class="form-control-label">نام و نام خانوادگی</label>
                        <input class="form-control" type="text" name="newUserName" required>
                    </div>
                    <style>
                      .tsel option[disabled] {
                          background: #77777722;
                      }
                    </style>
                    <div class="form-group">
                        <label for="newUserTime" class="form-control-label">مدت زمان</label>
                        <select name="newUserTime" class="form-control tsel">
                          <option <?php if($me->charge<1){echo 'disabled';} ?> value="1">یک روز<?php if($me->charge<1){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<3){echo 'disabled';} ?> value="3">سه روز<?php if($me->charge<3){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<7){echo 'disabled';} ?> value="7">هفت روز<?php if($me->charge<7){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<10){echo 'disabled';} ?> value="10">ده روز<?php if($me->charge<10){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<30){echo 'disabled';} ?> value="30">یک ماه<?php if($me->charge<30){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<60){echo 'disabled';} ?> value="60">دو ماه<?php if($me->charge<60){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<90){echo 'disabled';} ?> value="90">سه ماه<?php if($me->charge<90){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<180){echo 'disabled';} ?> value="180">شش ماه<?php if($me->charge<180){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<365){echo 'disabled';} ?> value="365">یک سال<?php if($me->charge<365){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<730){echo 'disabled';} ?> value="730">دو سال<?php if($me->charge<730){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<1095){echo 'disabled';} ?> value="1095">سه سال<?php if($me->charge<1095){echo ' (شارژ ناکافی)';} ?></option>
                        </select>
                    </div>

                    <br>
                    <hr>
                    <div class="text-center" style="margin-top: -44px;margin-bottom: 23px;">
                      <span class="bg-white px-2">انتخاب سرور ها</span>
                    </div>
                    <div class="row">
                    <?php
                    $sers = [];
                    foreach($panelInfo['servers'] as $kk=>$ss){
                      foreach($ss as $rr){
                        array_push($sers,$rr);
                      }
                    }
                    foreach($sers as $row){
                      echo '<div class="col-12">';
                      ?>
                      <label class="custom-toggle">
                        <input name="servers[<?php echo $row->id; ?>]" type="checkbox" checked>
                        <span class="custom-toggle-slider rounded-circle"></span>
                      </label>
                      <?php
                      echo '<label style="transform: translateY(-6px);margin-right: 10px;">' . $row->name . ' <small class="text-gray">' . $row->serverProto . '</small></label>';
                      echo '</div>';
                    }
                    ?>
                    </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                    <button type="submit" class="btn btn-primary">ایجاد کاربر</button>
                  </div>
                </div>
              </div>
            </form>
            <?php
            foreach($messages as $m){
              echo '<div class="alert alert-' . $m[0] . '">' . $m[1] . '</div>';
            }
            ?>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">نام</th>
                    <th scope="col" class="sort" data-sort="budget">انقضا</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php
                  foreach($panelInfo['users'] as $u){
                    $exp = round((strtotime($u->expireDate) - time()) / (60*60*24));
                    if($exp < 0){
                      $exp = 0;
                    }
                    ?>
                    <tr class="userRow" data-expired="<?php echo $exp==0?'yes':'no'; ?>">
                      <th scope="row">
                        <div class="media align-items-center">
                          <a href="#" class="avatar rounded-circle mr-3 d-none d-lg-inline-block d-md-inline-block d-xl-inline-block">
                            <img alt="Image placeholder" src="https://source.boringavatars.com/beam/120/<?php echo urlencode($u->fullName); ?>?colors=CAF729,79DD7E,2ECBAA,21B6B6,888DDA">
                          </a>
                          <div class="media-body">
                            <span class="name mb-0 text-sm"><?php echo $u->fullName; ?></span>
                          </div>
                        </div>
                      </th>
                      <td class="budget">
                      <strong><?php
                        echo $exp;
                      ?></strong>
                      روز
                      </td>
                      <td class="text-right">
                        <div class="btn-group btn-group-sm" dir="ltr">
                          <form method="post" action="">
                          <input type="hidden" name="removeUser" value="<?php echo $u->id; ?>">
                          <input type="hidden" name="token" value="<?php echo $token; ?>">
                            <button onclick="return confirm('این کاربر حذف شود؟')" type="submit" dir="rtl" class="btn btn-sm btn-secondary text-danger"><i class="fa fa-trash"></i></button>
                          </form>
                          <button onclick='openEditUser(<?php echo json_encode($u); ?>)' data-toggle="modal" data-target="#editUserModal" dir="rtl" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></button>
                        </div>
                        <div class="btn-group btn-group-sm" dir="ltr">
                          <button data-toggle="modal" data-target="#chargeUserModal" onclick="document.getElementById('chargeUserID').value=<?php echo $u->id; ?>;" dir="rtl" class="btn btn-success">+ شارژ</button>
                          <button onclick="createQrCodes(<?php echo $u->id; ?>)" data-toggle="modal" data-target="#qrcodeUserModal" dir="rtl" class="btn btn-secondary"><span class="d-none d-lg-inline-block d-md-inline-block d-xl-inline-block">نمایش</span> QR</button>
                        </div>
                        <div style="display:none;"><?php 
                            $sers = [];
                            foreach(json_decode($u->allowServerList) as $ser){
                              $tmp = $panelInfo['allServers']['server_' . $ser]->serverConfig;
                              $tmp = str_replace([
                                "{userRandomKey}",
                                "{userFullName}"
                              ],[
                                $u->randomKey,
                                $u->fullName
                              ],$tmp);
                              array_push($sers,base64_encode($tmp));
                            }
                        ?><input type="hidden" value='<?php echo json_encode($sers); ?>' id="userConfigs_<?php echo $u->id; ?>" /></div>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <script>
              function openEditUser(u){
                document.getElementById("editUserID").value=u.id;
                document.getElementById("editUserName").value=u.fullName;
                <?php
                  foreach($panelInfo['servers'] as $s){
                    echo 'document.getElementById("edit_servers_' . $s->id . '").checked=false;';
                  }
                ?>
                let sers = JSON.parse(u.allowServerList);
                for(i = 0;i<sers.length;i++){
                  document.getElementById("edit_servers_" + sers[i]).checked=true;
                }
              }
            </script>
            <!-- Modal -->
            <form method="post" action="" class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">ویرایش کاربر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <hr style="margin-top: -10px">
                    <input type="hidden" id="editUserID" name="editUserID">
                    <div class="text-center" style="margin-top: -44px;margin-bottom: 23px;">
                      <span class="bg-white px-2">مشخصات کاربر</span>
                    </div>
                    <div class="form-group">
                        <label for="editUserName" class="form-control-label">نام و نام خانوادگی</label>
                        <input class="form-control" type="text" name="editUserName" id="editUserName" required>
                    </div>
                    <hr style="margin-top: 10px">
                    <div class="text-center" style="margin-top: -44px;margin-bottom: 23px;">
                      <span class="bg-white px-2">انتخاب سرور ها</span>
                    </div>
                    <div class="row">
                    <?php
                    foreach($panelInfo['servers'] as $row){
                      echo '<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">';
                      ?>
                      <label class="custom-toggle">
                        <input name="edit_servers[<?php echo $row->id; ?>]" id="edit_servers_<?php echo $row->id; ?>" type="checkbox" checked>
                        <span class="custom-toggle-slider rounded-circle"></span>
                      </label>
                      <?php
                      echo '<label style="transform: translateY(-6px);margin-right: 10px;">' . $row->name . '</label>';
                      echo '</div>';
                    }
                    ?>
                    </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                    <button type="submit" class="btn btn-primary">ثبت تغییرات</button>
                  </div>
                </div>
              </div>
            </form>

            <!-- Modal -->
            <div class="modal fade" id="qrcodeUserModal" tabindex="-1" role="dialog" aria-labelledby="qrcodeUserModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="qrcodeUserModalLabel">نمایش QRCode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <div id="qrs"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <form method="post" action="" class="modal fade" id="chargeUserModal" tabindex="-1" role="dialog" aria-labelledby="chargeUserModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="chargeUserModalLabel">شارژ کاربر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <input type="hidden" id="chargeUserID" name="chargeUserID">
                    <style>
                      .tsel option[disabled] {
                          background: #77777722;
                      }
                    </style>
                    <div class="form-group">
                        <label for="chargeUserTime" class="form-control-label">مدت زمان</label>
                        <select name="chargeUserTime" class="form-control tsel">
                          <option <?php if($me->charge<1){echo 'disabled';} ?> value="1">یک روز<?php if($me->charge<1){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<3){echo 'disabled';} ?> value="3">سه روز<?php if($me->charge<3){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<7){echo 'disabled';} ?> value="7">هفت روز<?php if($me->charge<7){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<10){echo 'disabled';} ?> value="10">ده روز<?php if($me->charge<10){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<30){echo 'disabled';} ?> value="30">یک ماه<?php if($me->charge<30){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<60){echo 'disabled';} ?> value="60">دو ماه<?php if($me->charge<60){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<90){echo 'disabled';} ?> value="90">سه ماه<?php if($me->charge<90){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<180){echo 'disabled';} ?> value="180">شش ماه<?php if($me->charge<180){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<365){echo 'disabled';} ?> value="365">یک سال<?php if($me->charge<365){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<730){echo 'disabled';} ?> value="730">دو سال<?php if($me->charge<730){echo ' (شارژ ناکافی)';} ?></option>
                          <option <?php if($me->charge<1095){echo 'disabled';} ?> value="1095">سه سال<?php if($me->charge<1095){echo ' (شارژ ناکافی)';} ?></option>
                        </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                    <button type="submit" class="btn btn-primary">اعمال شارژ</button>
                  </div>
                </div>
              </div>
            </form>
            <!-- Card footer -->
            <br><br>
          </div>
        </div>
      </div>
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
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script>
    function createQrCodes(uid){
      $("#qrs").html("");
      let sers = JSON.parse(document.getElementById("userConfigs_" + uid).value);
      sers.forEach((s)=>{
        new QRCode(document.getElementById("qrs"), {text: s});
      });
    }
</script>
<style>
  #qrs{
    text-align:center;
  }
  #qrs img{
    width: calc(100% - 30px);
    max-width: 230px;
    margin: 15px;
    display: inline-block !important;
  }
</style>
</body>

</html>