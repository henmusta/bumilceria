@extends('backend.layouts.master')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <form id="formUpdate" action="{{ route('backend.lb3kytd.update', Request::segment(3)) }}">
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
                                    <option value="{{ $data['lb3kytd']['puskesmas']['id'] }}">{{$data['lb3kytd']['puskesmas']['name'] }}</option>
                                </select>
                             </div>
                         </div>

                         <div class="col-sm-6">
                              <div class="mb-3">
                                  <label for="Nama">Tanggal<span class="text-danger">*</span></label>
                                  <select id="select2Datepicker" style="width: 100% !important;" name="tanggal">
                                    <option value="{{ $data['lb3kytd']['tanggal'] }}">{{ \Carbon\Carbon::parse($data['lb3kytd']['tanggal'])->isoFormat('MMMM YYYY') }}</option>
                                  </select>
                              </div>
                          </div>

                    </div>
                    <div class="row">
                        <div class="col-2"></div>
                            <div class="col-8">
                                <div class="d-flex flex-column">
                                    <div class="mb-3">
                                        <label for="Nama">Unmeed Need<span class="text-danger">*</span></label>
                                        <input type="number" value="{{ $data['lb3kytd']['unmet_need'] }}" class="form-control"  name="unmet_need">
                                    </div>


                                    <div class="mb-3">
                                        <label for="Nama">Kehamilan Di Luar Nikah<span class="text-danger">*</span></label>
                                        <input type="number"  value="{{ $data['lb3kytd']['kehamilan_diluar_nikah'] }}" class="form-control"  name="kehamilan_diluar_nikah">
                                    </div>


                                    <div class="mb-3">
                                        <label for="Nama">Kegagalan KB<span class="text-danger">*</span></label>
                                        <input type="number"  value="{{ $data['lb3kytd']['kegagalan_kb'] }}" class="form-control"  name="kegagalan_kb">
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
