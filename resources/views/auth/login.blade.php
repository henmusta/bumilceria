<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Sep 2023 10:12:39 GMT -->
<head>
    <!--  Title -->
    <title>{{Setting::get_setting()->name}}</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" href="{{URL::to('storage/images/logo/'.Setting::get_setting()->favicon)}}">
    <!-- Core Css -->
    <link  id="themeColors"  rel="stylesheet" href="{{asset('assets/backend/dist/css/style.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"  />
  </head>
  <body>
    <!-- Preloader -->
    <div class="preloader">
      <img src="{{URL::to('storage/images/logo/'.Setting::get_setting()->favicon)}}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
      <img src="{{URL::to('storage/images/logo/'.Setting::get_setting()->favicon)}}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <div class="position-relative overflow-hidden radial-gradient min-vh-100">
        <div class="position-relative z-index-5">
          <div class="row">
            <div class="col-xl-7 col-xxl-8">
              {{-- <a href="index-2.html" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg" width="180" alt="">
              </a> --}}
              <div class="d-none d-xl-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
                <img src="{{asset('assets/backend/res/images/login.png')}}" alt="" class="img-fluid" width="500">
              </div>
            </div>
            <div class="col-xl-5 col-xxl-4">
              <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                <div class="col-sm-8 col-md-6 col-xl-9">

                      <a href="index-2.html" class="text-nowrap logo-img text-center d-block mb-5 w-100">
                        <img src="{{URL::to('storage/images/logo/'.Setting::get_setting()->icon)}}" width="100" alt="">
                      </a>

                      <div class="position-relative text-center my-4">
                        <p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative">Login</p>
                        <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                      </div>

                  <form id="formStore" method="POST" action="{{ route('backend.login') }}">
                    @csrf
                    @error('email')
                        <span class="invalid-feedback"  style="display:block;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Username</label>
                      <input type="text" class="form-control" name="email"  aria-describedby="emailHelp">
                    </div>
                    @error('password')
                    <span class="invalid-feedback" style="display:block;">
                        <strong>{{ $message }}</strong>
                    </span>
                     @enderror
                    <div class="mb-4">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      {{-- <input type="password" class="form-control" name="password" > --}}
                      <div class="input-group auth-pass-inputgroup ">
                        <input type="password" id="password" name="password" class="form-control"/>
                       <button class="btn btn-light shadow-none ms-0" type="button" onclick="myFunction()" id="password-addon"><i class="fa fa-eye"></i></button>
                   </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">

                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!--  Import Js Files -->
    <script src="{{asset('assets/backend/dist/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/backend/dist/libs/simplebar/dist/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/backend/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!--  core files -->
    <script src="{{asset('assets/backend/dist/js/app.min.js')}}"></script>
    <script src="{{asset('assets/backend/dist/js/app.init.js')}}"></script>
    <script src="{{asset('assets/backend/dist/js/app-style-switcher.js')}}"></script>
    <script src="{{asset('assets/backend/dist/js/sidebarmenu.js')}}"></script>

    <script src="{{asset('assets/backend/dist/js/custom.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>


      function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
       }

        $(document).ready(function () {
            $("#formStore").submit(function (e) {
                e.preventDefault();



                let form = $(this);
                let btnSubmit = form.find("[type='submit']");
                let btnSubmitHtml = btnSubmit.html();
                let url = form.attr("action");
                let data = new FormData(this);
                $.ajax({
                beforeSend: function () {
                    btnSubmit.addClass("disabled").html("<span aria-hidden='true' class='spinner-border spinner-border-sm' role='status'></span> Loading ...").prop("disabled", "disabled");
                },
                cache: false,
                processData: false,
                contentType: false,
                type: "POST",
                url: url,
                data: data,
                success: function (response) {
                    btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
                    let errorCreate = $('#errorCreate');
                    errorCreate.css('display', 'none');
                    errorCreate.find('.alert-text').html('');
                    if (response.status === "success") {
                        toastr.success(response.message, 'Success !');
                        window.location.href = response.redirect;
                    } else {
                        Swal.fire({
                            title: 'Gagal Untuk Login!',
                            text: response.message,
                            icon: response.status,
                            confirmButtonText: 'Ok'
                        }).then(function() {
                            window.location.reload();
                        });
                    }
                },
                error: function (response) {
                    btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
                        Swal.fire({
                            title: 'Gagal Untuk Login Perikasa Email Dan Password!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        }).then(function() {
                            window.location.reload();
                        });
                }
                });
            });

        });



      </script>


  </body>

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Sep 2023 10:12:39 GMT -->
</html>
