@extends('backend.layouts.master')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <form id="formUpdate" action="{{ route('backend.lb3rtk.update', Request::segment(3)) }}">
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
                                <option value="{{ $data['lb3rtk']['puskesmas']['id'] }}">{{$data['lb3rtk']['puskesmas']['name'] }}</option>
                               </select>
                           </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Nama">Tanggal<span class="text-danger">*</span></label>
                                <select id="select2Datepicker" style="width: 100% !important;" name="tanggal">
                                  <option value="{{ $data['lb3rtk']['tanggal'] }}">{{ \Carbon\Carbon::parse($data['lb3rtk']['tanggal'])->isoFormat('MMMM YYYY') }}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <div class="d-flex flex-column">

                                <div class="mb-3">
                                    <label for="Nama">Anemia Trimester I<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan Hb < 11gr/dl pada Trimester I </p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['anemia_trimester1'] }}" name="anemia_trimester1">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Anemia Trimester III<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan Hb < 11gr/dl pada Trimester III</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['anemia_trimester3'] }}"  name="anemia_trimester3">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Pendarahan<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi perdarahan</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['pendarahan'] }}"  name="pendarahan">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Pre Eklamsia<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi pre eklamsia</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['pre_eklamsia'] }}"  name="pre_eklamsia">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Infeksi<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi infeksi</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['infeksi'] }}" name="infeksi">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Tuberculosis<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi tuberculosis
                                    </p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['tuberculosis'] }}"  name="tuberculosis">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Malaria<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi malaria</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['malaria'] }}"  name="malaria">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Jantung<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi penyakit jantung</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['jantung'] }}" name="jantung">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Diabetes Mellitus<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi Diabetes Mellitus</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['diabetes_mellitus'] }}"  name="diabetes_mellitus">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Obesitas<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi Obesitas</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['obesitas'] }}"  name="obesitas">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Covid 19<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi Covid-19</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['covid19'] }}"  name="covid19">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Abortus<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi abortus</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['abortus'] }}"  name="abortus">
                                </div>
                                <div class="mb-3">
                                    <label for="Nama">Lain-lain<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi lainnya yang tidak tersebut di atas</p>
                                    <input type="number" class="form-control" value="{{ $data['lb3rtk']['lain_lain'] }}"  name="lain-lain">
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
