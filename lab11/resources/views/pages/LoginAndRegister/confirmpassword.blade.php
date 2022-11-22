<!DOCTYPE html>
<html lang="en">
  <head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Khôi Phục Tài Khoản</title>
  <!-- plugins:css -->

  <link rel="stylesheet" href=" {{ asset('public/backend/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href=" {{ asset('public/backend/assets/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{ asset('public/backend/assets/css/style.css') }}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href=" {{ asset('public/backend/assets/images/favicon.ico') }}" />
  </head>
  <style>
    @font-face {
        font-family: nhanf;
        src: url({{ asset('public/backend/assets/fonts/Mt-Regular.otf') }});
        font-display: swap;
    }
   .chongloihuhu{}
</style>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                    <img src=" {{ asset('public/backend/assets/images/logo.svg') }}">
                </div>
                <h4>Xác Nhận Mật Khẩu</h4>
                <h6 class="font-weight-light"> Chào {{ session()->get('rc_customer_name')}} , Hãy Nhập Lại Mật Khẩu Mới Của Bạn !</h6>
                <form class="pt-3" action="{{ URL::to('confirm-password') }}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <input type="text" name="password1" class="form-control form-control-lg" id="" placeholder="Nhập Mật Khẩu!">
                  </div>
                  <div class="form-group">
                    <input type="text" name="password2" class="form-control form-control-lg" id="" placeholder="Nhập Lại Mật Khẩu!">
                  </div>

                  <div class="mt-3">
                    <input type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="Xác Nhận">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('public/backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('public/backend/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/misc.js') }}"></script>
    <!-- endinject -->
  </body>
</html>