@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <form id="formStore" action="{{ route('backend.lb3balita.store') }}" autocomplete="off">
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
                                <input type="number" value="{{ \Carbon\Carbon::now()->startOfYear()->format('Y') }}" class="form-control" placeholder="Pilih Tahun" id="tahun" name="tahun">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <div class="d-flex flex-column">

                                <div class="mb-3">
                                    <label for="Nama">Sasaran Balita Laki laki<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah sasaran balita laki-laki</p>
                                    <input type="number" class="form-control"  name="sasaran_balita_laki-laki">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Sasaran Balita Perempuan<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah Sasaran Balita Perempuan</p>
                                    <input type="number" class="form-control"  name="sasaran_balita_perempuan">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Balita laki-laki memiliki buku KIA<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah seluruh balita laki-laki memiliki buku KIA pada bulan ini</p>
                                    <input type="number" class="form-control"  name="bllmb_kia">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Balita perempuan memiliki buku KIA<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah seluruh balita perempuan memiliki buku KIA pada bulan ini</p>
                                    <input type="number" class="form-control"  name="bpmb_kia">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Balita laki-laki dipantau tumbuh kembang<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah seluruh laki-laki laki-laki dipantau pertumbuhan dan perkembangan</p>
                                    <input type="number" class="form-control"  name="blldtk">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Balita perempuan dipantau tumbuh kembang<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah seluruh balita perempuan dipantau pertumbuhan dan perkembangan</p>
                                    <input type="number" class="form-control"  name="bpdtk">
                                </div>


                                <div class="mb-3">
                                  <label for="Nama">Balita laki-laki dengan gangguan perkembangan<span class="text-danger">*</span></label>
                                  <p style="font-size:10px;">Jumlah seluruh balita laki-laki dgn gangguan perkembangan setelah diagnosa dokter</p>
                                  <input type="number" class="form-control"  name="blldgp">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Balita perempuan dengan gangguan perkembangan<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah seluruh balita perempuan dgn gangguan perkembangan setelah diagnosa dokter</p>
                                    <input type="number" class="form-control"  name="bpdgp">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">SDIDTK balita laki-laki<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah seluruh balita laki-laki mendapat pelayanan SDIDTK</p>
                                    <input type="number" class="form-control"  name="sdidtk_bll">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">SDIDTK balita perempuan<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah seluruh balita perempuan mendapat pelayanan SDIDTK</p>
                                    <input type="number" class="form-control"  name="sdidtk_bp">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Kunjungan balita sakit (laki-laki)<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah seluruh kunjungan balita laki-laki yang sakit</p>
                                    <input type="number" class="form-control"  name="kbs_ll">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Kunjungan balita sakit (perempuan)<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah seluruh kunjungan balita perempuan yang sakit</p>
                                    <input type="number" class="form-control"  name="kbs_p">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">MTBS laki-laki<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah seluruh balita laki-laki mendapat pelayanan MTBS</p>
                                    <input type="number" class="form-control"  name="mtbs_ll">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">MTBS Perempuan<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah seluruh balita perempuan mendapat pelayanan MTBS</p>
                                    <input type="number" class="form-control"  name="mtbs_p">
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
