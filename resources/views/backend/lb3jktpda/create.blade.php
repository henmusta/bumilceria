@extends('backend.layouts.master')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <form id="formStore" action="{{ route('backend.lb3jktpda.store') }}" autocomplete="off">
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
                                  </select
                                  >
                                {{-- <input type="number" value="{{ \Carbon\Carbon::now()->startOfYear()->format('Y') }}" class="form-control" placeholder="Pilih Tahun" id="tahun" name="tahun"> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <section class="datatables">
                            <div class="table-responsive">
                              <table id="DatatableDetail" class="table table-bordered" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th>Jenis</th>
                                          <th>0 sampai 15</th>
                                          <th>16 sampai 45</th>
                                          <th>46 sampai 60</th>
                                          <th>60 Keatas</th>
                                        </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
                              </table>
                            </div>
                        </section>

                        <div class="mb-3">
                            <label for="Nama">Ketarangan<span class="text-danger">*</span></label>
                            <textarea class="form-control" value="-"  name="keterangan"></textarea>
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

        var dummy = [
             {  'name': 'Mental', '0_sampai_15' : '','16_sampai_45' : '', '46_sampai_60' : '', '60_keatas' : '' },
             {  'name': 'Fisik', '0_sampai_15' : '','16_sampai_45' : '', '46_sampai_60' : '', '60_keatas' : '' },
             {  'name': 'Emosional', '0_sampai_15' : '','16_sampai_45' : '', '46_sampai_60' : '', '60_keatas' : '' },
             {  'name': 'Penelantaran', '0_sampai_15' : '','16_sampai_45' : '', '46_sampai_60' : '', '60_keatas' : '' },
             {  'name': 'Penanganan', '0_sampai_15' : '','16_sampai_45' : '', '46_sampai_60' : '', '60_keatas' : '' },
        ]
        const tableDetail = $('#DatatableDetail').DataTable({
            // responsive: true,
			paging		: false,
			searching 	: false,
			ordering 	: false,
			info 		: false,
			data 		: dummy ,
			columns : [
                {
					data 		: 'name',
					className 	: 'text-left',
                    width 		: '20%',
					render 		: function ( columnData, type, rowData, meta ) {
                        return String(`
                            <input type="text" class="form-control" value="`+ columnData +`" style="background-color:#ebf3fe" readonly name="detail[`+ meta.row +`][name]"">
						`).trim();
					}
				},
                {
					data 		: '0_sampai_15',
					className 	: 'text-center',
                    width 		: '20%',
					render 		: function ( columnData, type, rowData, meta ) {
                        return String(`
                            <input type="number" min="0" max="15" class="form-control" value="`+ columnData +`" name="detail[`+ meta.row +`][0_sampai_15]"">
						`).trim();
					}
				},
				{
					data 		: '16_sampai_45',
					className 	: 'text-right',
                    width 		: '20%',
					render 		: function ( columnData, type, rowData, meta ) {
                        return String(`
                            <input type="number" min="16" max="45" class="form-control" value="`+ columnData +`" name="detail[`+ meta.row +`][16_sampai_45]"">
						`).trim();
					}
				},
                {
					data 		: '46_sampai_60',
					className 	: 'text-right',
                    width 		: '20%',
					render 		: function ( columnData, type, rowData, meta ) {
                        return String(`
                            <input type="number" min="16" max="45" class="form-control" value="`+ columnData +`" name="detail[`+ meta.row +`][46_sampai_60]"">
						`).trim();
					}
				},
                {
					data 		: '60_keatas',
					className 	: 'text-right',
                    width 		: '20%',
					render 		: function ( columnData, type, rowData, meta ) {
                        return String(`
                            <input type="number" min="60" class="form-control" value="`+ columnData +`" name="detail[`+ meta.row +`][60_keatas]"">
						`).trim();
					}
				},


			],
			initComplete : function(settings, json){
				let api = this.api()
			},
			createdRow : function( row, data, index ){

			},
			rowCallback : function( row, data, displayNum, displayIndex, index ){
				let api = this.api();


			},
			drawCallback : function( settings ){

			}
	    });

     let select2Type = $('.select2Type');
     select2Type.select2({
        dropdownParent:select2Type.parent(),
        searchInputPlaceholder: 'Cari',
        width: '100%',
        placeholder: ''
      }).on('select2:select', function (e) {
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
