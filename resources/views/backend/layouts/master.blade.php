<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Sep 2023 10:09:06 GMT -->
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
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{URL::to('storage/images/logo/'.Setting::get_setting()->favicon)}}">
    @include('backend.layouts.headercss')
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
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <!-- Sidebar Start -->
      <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
          <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="index-2.html" class="text-nowrap logo-img">
              <img src="{{URL::to('storage/images/logo/'.Setting::get_setting()->sidebar_logo)}}" class="dark-logo" width="180" alt="" />
              <img src="{{URL::to('storage/images/logo/'.Setting::get_setting()->sidebar_logo)}}" class="light-logo"  width="180" alt="" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-8 text-muted"></i>
            </div>
          </div>
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            {!! Menu::sidebar() !!}
          </nav>

        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <div class="body-wrapper">
        @include('backend.layouts.header')
        <div class="container-fluid mw-100">
            <!-- --------------------------------------------------- -->
            <!--  table advance Start -->
            <!-- --------------------------------------------------- -->

            <div class="card bg-light-info shadow-none position-relative overflow-hidden">
                <div class="card-body px-4 py-3">
                    @component('components.breadcrumb', ['page_breadcrumbs' => $page_breadcrumbs])
                    @slot('title'){{ $config['page_title'] }}@endslot
                    @endcomponent
                </div>
              </div>

            @yield('content')
            <!-- ------      --------------------------------------------- -->
            <!--  table advance End -->
            <!-- --------------------------------------------------- -->
          </div>

      </div>
      <div class="dark-transparent sidebartoggler"></div>
    <div class="dark-transparent sidebartoggler"></div>
    </div>


<div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog"
    aria-labelledby="modalChangePasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalResetLabel">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="errorChangePassword" class="form-group m-4" style="display:none;">
                <div class="alert alert-danger" role="alert">
                    <div class="alert-icon"><i class="flaticon-danger text-danger"></i></div>
                    <div class="alert-text">
                    </div>
                </div>
            </div>
            <form id="formChangePassword" method="POST" action="{{ route('backend.users.changepassword', Auth::id()) }}">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                         <label>Password Lama <span class="text-danger">*</span></label>
                        <div class="input-group auth-pass-inputgroup ">

                                <input type="password" id="old_password" name="old_password" class="form-control"
                                    placeholder="Input password lama" />
                                    <button class="btn btn-light shadow-none ms-0" type="button" onclick="myFunction()" id="password-addon"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                    <div class="mb-3">
                        <label>Password Baru<span class="text-danger">*</span></label>
                        <div class="input-group auth-pass-inputgroup ">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Input password baru" />
                            <button class="btn btn-light shadow-none ms-0" type="button" onclick="myFunctionnew()" id="password-addon"><i class="fa fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Retype Password Baru<span class="text-danger">*</span></label>
                        <div class="input-group auth-pass-inputgroup ">
                             <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            placeholder="Input password baru kembali" />
                            <button class="btn btn-light shadow-none ms-0" type="button" onclick="myFunctionconfirm()" id="password-addon"><i class="fa fa-eye"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                  </div>
            </form>
        </div>
    </div>
</div>



  {{-- @include('backend.layouts.option') --}}
  @include('backend.layouts.footerjs')
    <script type="text/javascript">
        $(document).ajaxError(function (event, jqxhr, settings, thrownError) {
            if (jqxhr.status === 302) {
                location.reload();
            }
            });
        $(document).ready(function () {



                let modalChangePassword = document.getElementById('modalChangePassword');
                const bsChangePassword = new bootstrap.Modal(modalChangePassword);

                modalChangePassword.addEventListener('show.bs.modal', function (event) {
                });

                modalChangePassword.addEventListener('hidden.bs.modal', function (event) {
                });

                $("#formChangePassword").submit(function (e) {
                    e.preventDefault();
                    let form = $(this);
                    let btnSubmit = form.find("[type='submit']");
                    let btnSubmitHtml = btnSubmit.html();
                    let url = form.attr("action");
                    let data = new FormData(this);
                    $.ajax({
                    beforeSend: function () {
                        btnSubmit.addClass("disabled").html("<i class='fa fa-spinner fa-pulse fa-fw'></i> Loading ...").prop("disabled", "disabled");
                    },
                    cache: false,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    url: url,
                    data: data,
                    success: function (response) {
                        let errorChangePassword = $('#errorChangePassword');
                        errorChangePassword.css('display', 'none');
                        errorChangePassword.find('.alert-text').html('');
                        btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
                        if (response.status === "success") {
                        toastr.success(response.message, 'Success !');
                        bsChangePassword.hide();
                        } else {
                        toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
                        if (response.error !== undefined) {
                            errorChangePassword.removeAttr('style');
                            $.each(response.error, function (key, value) {
                            errorChangePassword.find('.alert-text').append('<span style="display: block">' + value + '</span>');
                            });
                        }
                        }
                    },
                    error: function (response) {
                        btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
                        toastr.error(response.responseJSON.message, 'Failed !');
                    }
                    });
                });

            $('body').addClass('loaded');
            $('h1').css('color', '#222222');

        });
        function myFunction() {
            var x = document.getElementById("old_password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        function myFunctionnew() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        function myFunctionconfirm() {
            var x = document.getElementById("password_confirmation");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
  </body>

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Sep 2023 10:09:41 GMT -->
</html>
