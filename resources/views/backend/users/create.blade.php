@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="row row-sm">
        <div class="col-lg-6 col-md-12">
            <form id="formStore" action="{{ route('backend.users.store') }}">
                @csrf
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">{{ $config['page_title'] ?? '' }}</h6>
                      </div><br>
                  <div id="errorCreate" class="mb-3" style="display:none;">
                    <div class="alert alert-danger" role="alert">
                      <div class="alert-text">
                      </div>
                    </div>
                  </div>
                  <div class="d-flex flex-column">
                    {{-- <div class="mb-3">
                      <label class="mx-0 text-bold d-block">Photo</label>
                      <img id="avatar" src="{{ asset('assets/backend/images/users/avatar-1.jpg') }}"
                           style="object-fit: cover; border: 1px solid #d9d9d9" class="mb-2 border-2 mx-auto"
                           height="150px"
                           width="150px" alt="">
                      <input type="file" class="image d-block" name="image" accept=".jpg, .jpeg, .png">
                      <p class="text-muted ms-75 mt-50"><small>Allowed JPG, JPEG or PNG. Max
                          size of
                          2000kB</small></p>
                    </div> --}}
                    <div class="mb-3">
                      <label>Nama Lengkap <span class="text-danger">*</span></label>
                      <input type="text" name="name" class="form-control" placeholder="Enter nama lengkap"/>
                    </div>
                    <div class="mb-3">
                      <label>Email <span class="text-danger">*</span></label>
                      <input type="text" name="email" class="form-control" placeholder="Enter email"/>
                    </div>
                    <div class="mb-3">
                      <label>Username <span class="text-danger">*</span></label>
                      <input type="text" name="username" class="form-control" placeholder="Enter username"/>
                    </div>
                    <div class="mb-3">
                      <label>Password <span class="text-danger">*</span></label>
                      <input type="password" name="password" class="form-control" placeholder="Enter password"/>
                    </div>
                    <div class="mb-3">
                      <label>Retype Password <span class="text-danger">*</span></label>
                      <input type="password" name="password_confirmation" class="form-control"
                             placeholder="Enter retype password"/>
                    </div>
                    <div class="mb-3">
                      <label for="activeSelect">Status <span class="text-danger">*</span></label>
                      <select class="form-select select2" id="activeSelect" name="active">
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="select2Role">Role <span class="text-danger">*</span></label>
                      <select id="select2Role" style="width: 100% !important;" name="role_id">
                      </select>
                    </div>

                    <div class="mb-3" id="div_puskesmas">
                        <label for="select2Puskesmas">UPDT Puskesmas<span class="text-danger">*</span></label>
                        <select id="select2Puskesmas" style="width: 100% !important;" name="updt_puskesmas_id">
                        </select>
                    </div>

                  </div>
                </div>
                <div class="card-footer">
                  <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary me-2" onclick="window.history.back();">
                      Cancel
                    </button>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>
              </form>
        </div>
    </div>

  </div>
@endsection

@section('css')
@endsection
@section('script')
  <script>
    $(document).ready(function () {

     let select2Puskesmas = $('#select2Puskesmas');
      select2Puskesmas.select2({
        dropdownParent: select2Puskesmas.parent(),
        searchInputPlaceholder: 'Cari Puskesmas',
        allowClear: true,
        width: '100%',
        placeholder: 'select puskesmas',
        ajax: {
          url: "{{ route('backend.puskesmas.select2') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
            console.log(data.id);
      });



      let select2Role = $('#select2Role');

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
            let errorCreate = $('#errorCreate');
            errorCreate.css('display', 'none');
            errorCreate.find('.alert-text').html('');
            btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
            if (response.status === "success") {
              toastr.success(response.message, 'Success !');
              setTimeout(function () {
                if (response.redirect === "" || response.redirect === "reload") {
                  location.reload();
                } else {
                  location.href = response.redirect;
                }
              }, 1000);
            } else {
              toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
              if (response.error !== undefined) {
                errorCreate.removeAttr('style');
                $.each(response.error, function (key, value) {
                  errorCreate.find('.alert-text').append('<span style="display: block">' + value + '</span>');
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

      select2Role.select2({
        dropdownParent: select2Role.parent(),
        searchInputPlaceholder: 'Cari Role',
        allowClear: true,
        width: '100%',
        placeholder: 'select role',
        ajax: {
          url: "{{ route('backend.roles.select2') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
              parent_true: true,
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
            console.log(data.id);

            if(data.id == '5'){
                $("#div_puskesmas").attr("hidden",false);
            }else{
                $("#div_puskesmas").attr("hidden",true);
            }
      });




      $(".image").change(function () {
        let thumb = $(this).parent().find('img');
        if (this.files && this.files[0]) {
          let reader = new FileReader();
          reader.onload = function (e) {
            thumb.attr('src', e.target.result);
          }
          reader.readAsDataURL(this.files[0]);
        }
      });
    });
  </script>
@endsection
