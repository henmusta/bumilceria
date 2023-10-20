@extends('backend.layouts.master')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <form id="formUpdate" action="{{ route('backend.lb3ibubersalin.update', Request::segment(3)) }}">
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
                                <option value="{{ $data['lb3ibubersalin']['puskesmas']['id'] }}">{{$data['lb3ibubersalin']['puskesmas']['name'] }}</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Nama">Tanggal<span class="text-danger">*</span></label>
                                <select id="select2Datepicker" style="width: 100% !important;" name="tanggal">
                                <option value="{{ $data['lb3ibubersalin']['tanggal'] }}">{{ \Carbon\Carbon::parse($data['lb3ibubersalin']['tanggal'])->isoFormat('MMMM YYYY') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <div class="d-flex flex-column">

                                <div class="mb-3">
                                    <label for="Nama">Jumlah Sasaran Ibu Bersalin<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{ $data['lb3ibubersalin']['jsib'] }}" name="jsib">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Ibu Bersalin<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah seluruh ibu bersalin</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3ibubersalin']['ibu_bersalin'] }}"  name="ibu_bersalin">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Ibu Bersalin Nakes<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah ibu bersalin ditolong oleh tenaga kesehatan baik di faskes atau di rumah</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3ibubersalin']['ibu_bersalin_nakes'] }}" name="ibu_bersalin_nakes">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Ibu bersalin faskes<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah ibu bersalin di fasilitas kesehatan</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3ibubersalin']['ibu_bersalin_faskes'] }}"  name="ibu_bersalin_faskes">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">KF1<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah kunjungan nifas KF1</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3ibubersalin']['kf1'] }}" name="kf1">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">KF Lengkap<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu nifas yang telah melakukan kunjungan nifas lengkap</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3ibubersalin']['kf_lengkap'] }}" name="kf_lengkap">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Vit A Ibu Nifas<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu nifas mendapatkan Vit A</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3ibubersalin']['vita_ibu_nifas'] }}" name="vita_ibu_nifas">
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
@endsection

@section('css')
@endsection
@section('script')
  <script>
    $(document).ready(function () {
        let select2Datepicker = $('#select2Datepicker');
     select2Datepicker.select2({
        dropdownParent:select2Datepicker.parent(),
        searchInputPlaceholder: 'Cari',
        width: '100%',
        placeholder: 'select bulan Tahun',
        ajax: {
          url: "{{ route('datepicker.index') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
            //   id : $('#user_puskes_id').val(),
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
            console.log(data.id);
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
