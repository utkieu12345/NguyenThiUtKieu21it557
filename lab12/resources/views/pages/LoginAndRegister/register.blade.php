<!DOCTYPE html>
<html lang="en">
  <head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Đăng Ký Tài Khoản</title>
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
                <h4>Đăng Ký Tài Khoản</h4>
                <h6 class="font-weight-light">Đăng ký rất dễ dàng. Nó chỉ mất một vài bước!</h6>
                <form class="pt-3" action="{{ URL::to('/create-customer') }}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <input type="text" name="customer_name" class="form-control form-control-lg" id="" placeholder="Tài Khoản">
                  </div>
                  <div class="form-group">
                    <input type="email" name="customer_email" class="form-control form-control-lg" id="" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input type="text" name="customer_sdt" class="form-control form-control-lg" id="" placeholder="Số Điện Thoại">
                  </div>
                  <div class="form-group">
                    <input type="password" name="customer_password" class="form-control form-control-lg" id="" placeholder="Mật Khẩu">
                  </div>
                  <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                    <br />
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="invalid-feedback" style="display:block">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif
                </div>
                  <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" name="checkbox" class="form-check-input" value="YES"> Tôi đồng ý với tất cả các Điều khoản & Điều kiện </label>
                    </div>
                  </div>
                  <div class="mt-3">
                    <input type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="Đăng Ký">
                  </div>
                  <div class="text-center mt-4 font-weight-light">Bạn Đã Có Tài Khoản? <a href="{{ URL::to('login-checkout') }}" style="color: black;text-decoration: none;"  class="text-primary">Ấn Vào Để Đăng Nhập</a>
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </body>
</html>