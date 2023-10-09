@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
      <div class="card">
        <div class="row row-sm">
            <div class="col-lg-12 col-md-12">
                <form id="formUpdate" action="{{ route('backend.lb3bayi.update', Request::segment(3)) }}">
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
                                    <option value="{{ $data['lb3bayi']['puskesmas']['id'] }}">{{$data['lb3bayi']['puskesmas']['name'] }}</option>
                                   </select>
                               </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="Nama">Tahun<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{ $data['lb3bayi']['tahun'] }}" placeholder="Pilih Tahun" id="tahun" name="tahun">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="d-flex flex-column">

                                    <div class="mb-3">
                                        <label for="Nama">Sasaran Bayi Laki laki<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah sasaran bayi laki-laki</p>
                                        <input type="number" class="form-control"  value="{{ $data['lb3bayi']['sasaran_bayi_laki-laki'] }}"  name="sasaran_bayi_laki-laki">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">Sasaran Bayi Perempuan<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah Sasaran Bayi Perempuan</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3bayi']['sasaran_bayi_perempuan'] }}"  name="sasaran_bayi_perempuan">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">Bayi Lahir Laki-Laki<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah bayi lahir hidup laki-laki</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3bayi']['bayi_lahir_laki-laki'] }}"  name="bayi_lahir_laki-laki">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">Bayi lahir perempuan<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah bayi lahir hidup perempuan</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3bayi']['sasaran_bayi_perempuan'] }}"  name="bayi_lahir_perempuan">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">KN1 Laki-laki<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah bayi laki-laki telah mendapatkan pelayanan KN1</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3bayi']['kn1_laki-laki'] }}"  name="kn1_laki-laki">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">KN1 Perempuan<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah bayi perempuan telah mendapatkan pelayanan KN1</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3bayi']['kn1_perempuan'] }}"  name="kn1_perempuan">
                                    </div>


                                    <div class="mb-3">
                                      <label for="Nama">KN3 Laki-laki<span class="text-danger">*</span></label>
                                      <p style="font-size:10px;">Jumlah bayi laki-laki telah mendapatkan pelayanan KN3</p>
                                      <input type="number" class="form-control" value="{{ $data['lb3bayi']['kn3_laki-laki'] }}"  name="kn3_laki-laki">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">KN3 Perempuan<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Jumlah bayi perempuan telah mendapatkan pelayanan KN3</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3bayi']['kn3_perempuan'] }}" name="kn3_perempuan">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">BBL laki-laki diperiksa SHK<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Bayi laki-laki diperiksa Skrining Hipotiroid Kongenital (SHK)</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3bayi']['bbl_lld_shk'] }}"  name="bbl_lld_shk">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nama">BBL perempuan diperiksa SHK<span class="text-danger">*</span></label>
                                        <p style="font-size:10px;">Bayi perempuan diperiksa Skrining Hipotiroid Kongenital (SHK)</p>
                                        <input type="number" class="form-control" value="{{ $data['lb3bayi']['bbl_pd_shk'] }}" name="bbl_pd_shk">
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
