@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <form id="formStore" action="{{ route('backend.lb3brtk.store') }}" autocomplete="off">
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
                                    <label for="Nama">BBLR<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah bayi dengan risiko tinggi/komplikasi berat lahir < 2500 gram</p>
                                    <input type="number" class="form-control"  name="bblr">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Asfiksia<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah bayi dengan risiko tinggi/komplikasi asfiksia</p>
                                    <input type="number" class="form-control"  name="asfiksia">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Infeksi<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah bayi dengan risiko tinggi/komplikasi infeksi</p>
                                    <input type="number" class="form-control"  name="infeksi">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Tetanus Neonatorum<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah bayi dengan risiko tinggi/komplikasi tetanus neonatorum</p>
                                    <input type="number" class="form-control"  name="tetanus">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Kelainan kongenital<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah bayi dengan risiko tinggi/komplikasi kelainan kongenital</p>
                                    <input type="number" class="form-control"  name="kelainan">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Covid-19<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah bayi dengan risiko tinggi/komplikasi Covid-19
                                    </p>
                                    <input type="number" class="form-control"  name="covid19">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Hipotiroid Kongenital<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah bayi dengan risiko tinggi/komplikasi kelainan Hipotiroid Kongenital</p>
                                    <input type="number" class="form-control"  name="hipotiroid">
                                </div>

                                <div class="mb-3">
                                    <label for="Nama">Lain-Lain<span class="text-danger">*</span></label>
                                    <p style="font-size:10px;">Jumlah bayi dengan risiko tinggi/komplikasi lainnya yang tidak disebutkan di atas</p>
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
