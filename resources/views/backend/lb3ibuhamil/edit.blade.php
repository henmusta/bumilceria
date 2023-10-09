@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
      <div class="card">
        <div class="row row-sm">
            <div class="col-lg-12 col-md-12">
                <form id="formUpdate" action="{{ route('backend.lb3ibuhamil.update', Request::segment(3)) }}">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @method('PUT')
                    <div class="card-header">
                        <div id="errorEdit" class="mb-3" style="display:none;">
                            <div class="alert alert-danger" role="alert">
                              <div class="alert-text">
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="card-body">
                        <input hidden id="user_puskes_id" value="{{Auth::user()->puskesmas->id ?? ''}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                   <label for="select2Puskesmas">UPDT Puskesmas<span class="text-danger">*</span></label>
                                   <select id="select2Puskesmas" style="width: 100% !important;" name="updt_puskesmas_id">
                                    <option value="{{ $data['lb3ibuhamil']['puskesmas']['id'] }}">{{$data['lb3ibuhamil']['puskesmas']['name'] }}</option>
                                   </select>
                               </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="Nama">Tahun<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['tahun'] }}" placeholder="Pilih Tahun" id="tahun" name="tahun">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="d-flex flex-column">
                                    <input hidden id="user_puskes_id" value="{{Auth::user()->puskesmas->id}}">
                                    <div class="mb-3">
                                        <label for="Nama">Jumlah Sasaran Ibu Hamil<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['jsih'] }}"  name="jsih">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">K1 Total<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah Seluruh K1 (Akses dan Murni)</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['k1_total'] }}"  name="k1_total">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">K1 Murni<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah K1 pada kehamilan trimester 1</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['k1_murni'] }}"  name="k1_murni">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">K4<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah ibu hamil telah memenuhi K4</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['k4'] }}"  name="k4">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">K6<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah Ibu hamil memenuhi K6 (K4 ditambah 2 kali pemeriksaan oleh dokter)</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['k6'] }}" name="k6">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">Ibu Hamil Terlalu Tua/Muda<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Usia kurang dari 20 th atau lebih dari 35 th</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['ihttm'] }}" name="ihttm">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">Ibu hamil dengan jarak terlalu dekat<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Spasi antar kehamilan kurang dari 2 tahun</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['ibdjtd'] }}"  name="ibdjtd">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">Ibu hamil dengan kehamilan terlalu banyak<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah Ibu hamil dengan kehamilan ke-5 atau lebih</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['ihdktb'] }}"  name="ihdktb">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">K1 oleh dokter<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah Ibu hamil pertama kali pemeriksaan oleh dokter dengan dan tanpa USG</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['k1_ok'] }}" name="k1_ok">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">K5 oleh dokter<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah Ibu hamil memenuhi K4 ditambah 1 kali pemeriksaan oleh dokter dengan dan tanpa USG</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['k5_ok'] }}" name="k5_ok">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">K1 USG oleh dokter<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah Ibu hamil pertama kali pemeriksaan oleh dokter dengan menggunakan USG</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['k1_usg_ok'] }}" name="k1_usg_ok">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">K5 USG oleh dokter<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah Ibu hamil memenuhi K4 ditambah 1 kali pemeriksaan oleh dokter dengan menggunakan USG</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['k5_usg_ok'] }}"  name="k5_usg_ok">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Nama">Ibu hamil mempunyai buku KIA<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah seluruh Ibu yang sedang hamil dan memiliki buku KIA pada bulan ini</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3ibuhamil']['ibmb_kia'] }}" name="ibmb_kia">
                                    </div>
                                  </div>
                            </div>
                            <div class="col-2"></div>
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
    </div>
  </div>
@endsection

@section('css')
@endsection
@section('script')
  <script>
    $(document).ready(function () {
        $('#tahun').flatpickr({
            disableMobile: "true",
            plugins: [
                new monthSelectPlugin({
                shorthand: true,
                dateFormat: "Y",
                theme: "dark"
                })
            ]
         });

         let select2Puskesmas = $('#select2Puskesmas');
      select2Puskesmas.select2({
        dropdownParent: select2Puskesmas.parent(),
        searchInputPlaceholder: 'Cari Puskesmas',
        width: '100%',
        placeholder: 'select puskesmas',
        ajax: {
          url: "{{ route('backend.puskesmas.select2') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
              id : $('#user_puskes_id').val(),
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
            console.log(data.id);
      });






      $("#formUpdate").submit(function (e) {
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
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          cache: false,
          processData: false,
          contentType: false,
          type: "POST",
          url: url,
          data: data,
          success: function (response) {
            let errorEdit = $('#errorEdit');
            errorEdit.css('display', 'none');
            errorEdit.find('.alert-text').html('');
            btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
            if (response.status === "success") {
              toastr.success(response.message, 'Success !');
              setTimeout(function () {
                if (!response.redirect || response.redirect === "reload") {
                  location.reload();
                } else {
                  location.href = response.redirect;
                }
              }, 1000);
            } else {
              toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
              if (response.error !== undefined) {
                errorEdit.removeAttr('style');
                $.each(response.error, function (key, value) {
                  errorEdit.find('.alert-text').append('<span style="display: block">' + value + '</span>');
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




    });
  </script>
@endsection
