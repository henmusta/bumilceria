@extends('backend.layouts.master')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <form id="formStore" action="{{ route('backend.lb3rtk.store') }}" autocomplete="off">
                @csrf
                <div class="card-header">
                    <div id="errorCreate" class="mb-3" style="display:none;">
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
                                <option value="{{ Auth::user()->puskesmas->id ?? '' }}">{{Auth::user()->puskesmas->name ?? '' }}</option>
                               </select>
                           </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Nama">Tahun<span class="text-danger">*</span></label>
                                  <select id="select2Datepicker" style="width: 100% !important;" name="tanggal">
                                  </select>
                                {{-- <input type="number" value="{{ \Carbon\Carbon::now()->startOfYear()->format('Y') }}" class="form-control" placeholder="Pilih Tahun" id="tahun" name="tahun"> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <div class="d-flex flex-column">

                                <div class="mb-3">
                                    <label for="Nama">Anemia Trimester I<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan Hb < 11gr/dl pada Trimester I</p>
                                    <input type="number" class="form-control"  name="anemia_trimester1">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Anemia Trimester III<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan Hb < 11gr/dl pada Trimester III</p>
                                    <input type="number" class="form-control"  name="anemia_trimester3">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Pendarahan<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi perdarahan</p>
                                    <input type="number" class="form-control"  name="pendarahan">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Pre Eklamsia<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi pre eklamsia</p>
                                    <input type="number" class="form-control"  name="pre_eklamsia">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Infeksi<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi infeksi</p>
                                    <input type="number" class="form-control"  name="infeksi">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Tuberculosis<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi tuberculosis
                                    </p>
                                    <input type="number" class="form-control"  name="tuberculosis">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Malaria<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi malaria</p>
                                    <input type="number" class="form-control"  name="malaria">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Jantung<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi penyakit jantung</p>
                                    <input type="number" class="form-control"  name="jantung">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Diabetes Mellitus<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi Diabetes Mellitus</p>
                                    <input type="number" class="form-control"  name="diabetes_mellitus">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Obesitas<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi Obesitas</p>
                                    <input type="number" class="form-control"  name="obesitas">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Covid 19<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi Covid-19</p>
                                    <input type="number" class="form-control"  name="covid19">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Abortus<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi abortus</p>
                                    <input type="number" class="form-control"  name="abortus">
                                </div>
                                <div class="mb-3">
                                    <label for="Nama">Lain-lain<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi lainnya yang tidak tersebut di atas</p>
                                    <input type="number" class="form-control"  name="lain-lain">
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





    });
  </script>
@endsection
