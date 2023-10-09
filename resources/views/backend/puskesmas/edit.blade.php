@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
      <div class="card">
        <div class="row row-sm">
            <div class="col-lg-12 col-md-12">
                <form id="formUpdate" action="{{ route('backend.puskesmas.update', Request::segment(3)) }}">
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

                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="d-flex flex-column">
                                    <div
                                     class="mb-3">
                                        <label for="select2Wilayah">Wilayah<span class="text-danger">*</span></label>
                                        <select id="select2Wilayah" style="width: 100% !important;" name="wilayah_id">
                                            <option value="{{ $data['puskesmas']['wilayah']['id'] }}">{{$data['puskesmas']['wilayah']['alamat'] }}</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Nama">Nama<span class="text-danger">*</span></label>
                                        <input class="form-control" value="{{ $data['puskesmas']['name'] }}" placeholder="Masukan Nama" name="name">
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat">Keterangan<span class="text-danger">*</span></label>
                                        <textarea class="form-control" placeholder="Masukan Keterangan" name="keterangan">{{ $data['puskesmas']['keterangan'] }}</textarea>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>
                    {{-- <div class="card-body">

                      <div class="d-flex flex-column">
                        <div
                         class="mb-3">
                            <label for="select2Provinsi">Provinsi<span class="text-danger">*</span></label>
                            <select id="select2Provinsi" style="width: 100% !important;" name="provinsi_id">
                                <option value="{{ $data['wilayah']['provinsi']['id'] }}">{{ $data['wilayah']['provinsi']['name'] }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="select2Kabupaten">Kabupaten<span class="text-danger">*</span></label>
                            <select id="select2Kabupaten" style="width: 100% !important;" name="kabupaten_id">
                                <option value="{{ $data['wilayah']['kabupaten']['id'] }}">{{ $data['wilayah']['kabupaten']['name'] }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="select2Kecamatan">Kecamatan<span class="text-danger">*</span></label>
                            <select id="select2Kecamatan" style="width: 100% !important;" name="kecamatan_id">
                                <option value="{{ $data['wilayah']['kecamatan']['id'] }}">{{ $data['wilayah']['kecamatan']['name'] }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat">Alamat<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alamat">{{ $data['wilayah']['alamat'] }}</textarea>
                        </div>


                      </div>

                    </div> --}}
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
        let select2Wilayah = $('#select2Wilayah');
      select2Wilayah.select2({
        dropdownParent: select2Wilayah.parent(),
        searchInputPlaceholder: 'Cari Wilayah',
        allowClear: true,
        width: '100%',
        placeholder: 'select wilayah',
        ajax: {
          url: "{{ route('backend.wilayah.select2') }}",
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
