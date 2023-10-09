@extends('backend.layouts.master')

@section('title') {{ $config['page_title'] }} @endsection

@section('content')

    <div class="card">
        <div class="card-header mb-3">
            <div class="col-xl-12">
                <div class="mt-xl-0 mt-4">
                    <div class="d-flex align-items-start">


                        <div class="flex-grow-1">
                            <div class="col-xl-12">
                                <div class="d-flex gap-2 flex-wrap mb-3 text-center">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="true" aria-controls="multiCollapseExample2">Filter</button>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="float-end">
                                {{-- <a onclick="printDiv('printableArea')" class="btn btn-success me-1"><i class="fa fa-print"></i></a> --}}

                                <div class="float-end" id="print">
                                </div>
                                <div class="dt-buttons btn-group flex-wrap">
                                     {{-- <button id="excel" class="btn btn-secondary buttons-excel buttons-html5"  tabindex="0" aria-controls="Datatable" type="button"><span>Excel</span></button> --}}
                                    <button class="btn btn-secondary buttons-pdf buttons-html5"  tabindex="0" aria-controls="Datatable" id="pdf" type="button"><span>PDF</span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="multi-collapse collapse show" id="multiCollapseExample2" style="">
                                <div class="card border shadow-none card-body text-muted mb-0">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label>Tahun</label>
                                                <div class=" input-group mb-3">
                                                <input type="text" id="tahun" class="form-control datePicker"  placeholder="Tanggal Awal"  value="{{ \Carbon\Carbon::now()->startOfYear()->format('Y') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="select2Puskesmas">UPDT Puskesmas<span class="text-danger"></span></label>
                                                <select id="select2Puskesmas" name="updt_puskesmas_id[]"  style="width: 100% !important;" class="js-example-basic-multiple"  multiple="multiple" style="width: 100% !important;" name="updt_puskesmas_id">
                                                </select>
                                              </div>
                                        </div>
                                        <div class="col-md-2 text-end" style="padding-top:30px; padding-left:0px !important;">
                                            <a id="terapkan_filter" class="btn btn-success">
                                                Terapkan Filter
                                                <i class="fas fa-align-justify"></i>
                                            </a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-body">
            <section class="datatables">
              <div class="table">
                <table id="Datatable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Puskesmas</th>
                            {{-- ibu hamil --}}
                            <th  class="text-center">Jumlah Sasaran Ibu Hamil</th>
                            <th class="text-center">K1 Total</th>
                            <th class="text-center">K1 Murni</th>
                            <th class="text-center">K4</th>
                            <th class="text-center">K6</th>
                            <th class="text-center">Ibu Hamil Terlalu Tua/Muda</th>
                            <th class="text-center">Ibu hamil dengan jarak terlalu dekat</th>
                            <th class="text-center">Ibu hamil dengan kehamilan terlalu banyak</th>
                            <th class="text-center">K1 Oleh Dokter</th>
                            <th class="text-center">K5 Oleh Dokter</th>
                            <th class="text-center">K1 USG Oleh Dokter</th>
                            <th class="text-center">K5 USG Oleh Dokter</th>
                            <th class="text-center">Ibu hamil mempunyai buku KIA</th>



                            <th class="text-center">Jumlah Sasaran Ibu Bersalin</th>
                            <th class="text-center">Ibu Bersalin</th>
                            <th class="text-center">Ibu Bersalin Nakes</th>
                            <th class="text-center">Ibu bersalin faskes</th>
                            <th class="text-center">KF1</th>
                            <th class="text-center">KF Lengkap</th>
                            <th class="text-center">Vit A Ibu Nifas</th>




                            <th class="text-center">Anemia Trimester I</th>
                            <th class="text-center">Anemia Trimester III</th>
                            <th class="text-center">Pendarahan</th>
                            <th class="text-center">Pre Eklamsia</th>
                            <th class="text-center">Infeksi</th>
                            <th class="text-center">Tuberculosis</th>
                            <th class="text-center">Malaria</th>
                            <th class="text-center">Jantung</th>
                            <th class="text-center">Diabetes Mellitus</th>
                            <th class="text-center">Obesitas</th>
                            <th class="text-center">Covid19</th>
                            <th class="text-center">Abortus</th>
                            <th class="text-center">Lain Lain</th>



                            <th class="text-center">Sasaran Bayi Laki Laki</th>
                            <th class="text-center">Sasaran Bayi Perempuan</th>
                            <th class="text-center">Bayi Lahir Laki Laki</th>
                            <th class="text-center">Bayi Lahir Perempuan</th>
                            <th class="text-center">KN1 Laki Laki</th>
                            <th class="text-center">KN1 Perempuan</th>
                            <th class="text-center">KN3 Laki Laki</th>
                            <th class="text-center">KN3 Perempuan</th>
                            <th class="text-center">BBL laki-laki diperiksa SHK</th>
                            <th class="text-center">BBL perempuan diperiksa SHK</th>



                            <th class="text-center">BBLR</th>
                            <th class="text-center">Asfiksia</th>
                            <th class="text-center">Infeksi</th>
                            <th class="text-center">Tetanus Neonatorum</th>
                            <th class="text-center">Kelainan kongenital</th>
                            <th class="text-center">Covid-19</th>
                            <th class="text-center">Hipotiroid Kongenital</th>
                            <th class="text-center">Lain Lain</th>



                            {{-- <th class="text-center">Sasaran Balita Laki laki</th>
                            <th class="text-center">Sasaran Balita Perempuan</th>
                            <th class="text-center">Balita laki-laki memiliki buku KIA</th>
                            <th class="text-center">Balita perempuan memiliki buku KIA</th>
                            <th class="text-center">Balita laki-laki dipantau tumbuh kembang</th>
                            <th class="text-center">Balita Perempuan dipantau tumbuh kembang</th>
                            <th class="text-center">Balita laki-laki dengan gangguan perkembangan</th>
                            <th class="text-center">Balita Perempuan dengan gangguan perkembangan</th>
                            <th class="text-center">SDIDTK balita laki-laki</th>
                            <th class="text-center">SDIDTK balita perempuan</th>
                            <th class="text-center">Kunjungan balita sakit (laki-laki)</th>
                            <th class="text-center">Kunjungan balita sakit (Perempuan)</th>
                            <th class="text-center">MTBS laki-laki</th>
                            <th class="text-center">MTBS Perempuan</th>



                            <th class="text-center">Jumlah peserta kelas ibu hamil</th>
                            <th class="text-center">Jumlah peserta kelas ibu balita</th>



                            <th class="text-center">Dokter terlatih USG</th>
                            <th class="text-center">Kader terlatih pemantauan tumbuh kembang balita</th>
                            <th class="text-center">Nakes terlatih MTBS</th>
                            <th class="text-center">Nakes terlatih tata laksana gizi buruk</th>
                            <th class="text-center">Nakes terlatih PMBA</th>
                            <th class="text-center">Nakes terlatih SDIDTK</th>
                            <th class="text-center">Nakes terlatih integrasi MTBS-Gizi Buruk</th>
                            <th class="text-center">Nakes terlatih integrasi PMBA-SDIDTK</th> --}}
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <th class="text-center">Total</th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                        </tr>
                    </tfoot> --}}
                </table>
              </div>
            </section>


        </div>
    </div>

 {{--Modal--}}




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
        allowClear: true,
        width: '100%',
        placeholder: 'select puskesmas',
        ajax: {
          url: "{{ route('backend.puskesmas.select2') }}",
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

        let dataTable = $('#Datatable').DataTable({
            footerCallback: function ( row, rowData, start, end, display ) {
            var api = this.api(), rowData;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // for (var i=1; i<=75; i++) {
            //     console.log(i);
            //     var colum = 'col'+ i;
            //     var colum = api
            //         .column( i )
            //         .data()
            //         .reduce( function (a, b) {
            //             return intVal(a) + intVal(b);
            //         }, 0 );
            //     $( api.column(i).footer() ).html(
            //         colum
            //     );
            // }
        },
            scrollX: true,
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            pageLength: 10,
            ajax: {
            url: "{{ route('backend.laporan.index') }}",
            data: function (d) {
                d.updt_puskesmas_id =  select2Puskesmas.val();
                d.tahun = $('#tahun').val();
            }
            },
            columns: [
            //   {data: 'image', name: 'image'},
            {data: 'puskesmas', name: 'puskesmas'},
            {data: 'lb3ibuhamil_sum_jsih', name: 'lb3ibuhamil_sum_jsih'},
            {data: 'lb3ibuhamil_sum_k1_total', name: 'lb3ibuhamil_sum_k1_total'},
            {data: 'lb3ibuhamil_sum_k1_murni', name: 'lb3ibuhamil_sum_k1_murni'},
            {data: 'lb3ibuhamil_sum_k4', name: 'lb3ibuhamil_sum_k4'},
            {data: 'lb3ibuhamil_sum_k6', name: 'lb3ibuhamil_sum_k6'},
            {data: 'lb3ibuhamil_sum_ihttm', name: 'lb3ibuhamil_sum_ihttm'},
            {data: 'lb3ibuhamil_sum_ibdjtd', name: 'lb3ibuhamil_sum_ibdjtd'},
            {data: 'lb3ibuhamil_sum_ihdktb', name: 'lb3ibuhamil_sum_ihdktb'},
            {data: 'lb3ibuhamil_sum_k1_ok', name: 'lb3ibuhamil_sum_k1_ok'},
            {data: 'lb3ibuhamil_sum_k5_ok', name: 'lb3ibuhamil_sum_k5_ok'},
            {data: 'lb3ibuhamil_sum_k1_usg_ok', name: 'lb3ibuhamil_sum_k1_usg_ok'},
            {data: 'lb3ibuhamil_sum_k5_usg_ok', name: 'lb3ibuhamil_sum_k5_usg_ok'},
            {data: 'lb3ibuhamil_sum_ibmb_kia', name: 'lb3ibuhamil_sum_ibmb_kia'},

            // //busalin
            {data: 'lb3ibubersalin_sum_jsib', name: 'lb3ibubersalin_sum_jsib'},
            {data: 'lb3ibubersalin_sum_ibu_bersalin', name: 'lb3ibubersalin_sum_ibu_bersalin'},
            {data: 'lb3ibubersalin_sum_ibu_bersalin_nakes', name: 'lb3ibubersalin_sum_ibu_bersalin_nakes'},
            {data: 'lb3ibubersalin_sum_ibu_bersalin_faskes', name: 'lb3ibubersalin_sum_ibu_bersalin_faskes'},
            {data: 'lb3ibubersalin_sum_kf1', name: 'lb3ibubersalin_sum_kf1'},
            {data: 'lb3ibubersalin_sum_kf_lengkap', name: 'lb3ibubersalin_sum_kf_lengkap'},
            {data: 'lb3ibubersalin_sum_vita_ibu_nifas', name: 'lb3ibubersalin_sum_vita_ibu_nifas'},

            // //rtk
            {data: 'lb3rtk_sum_anemia_trimester1', name: 'lb3rtk_sum_anemia_trimester1'},
            {data: 'lb3rtk_sum_anemia_trimester3', name: 'lb3rtk_sum_anemia_trimester3'},
            {data: 'lb3rtk_sum_anemia_pendarahan', name: 'lb3rtk_sum_anemia_pendarahan'},
            {data: 'lb3rtk_sum_pre_aklamsia', name: 'lb3rtk_sum_pre_eklamsia'},
            {data: 'lb3rtk_sum_infeksi', name: 'lb3rtk_sum_infeksi'},
            {data: 'lb3rtk_sum_tuberculosis', name: 'lb3rtk_sum_tuberculosis'},
            {data: 'lb3rtk_sum_malaria', name: 'lb3rtk_sum_malaria'},
            {data: 'lb3rtk_sum_jantung', name: 'lb3rtk_sum_jantung'},
            {data: 'lb3rtk_sum_diabetes_mellitus', name: 'lb3rtk_sum_diabetes_mellitus'},
            {data: 'lb3rtk_sum_obesitas', name: 'lb3rtk_sum_obesitas'},
            {data: 'lb3rtk_sum_covid19', name: 'lb3rtk_sum_covid19'},
            {data: 'lb3rtk_sum_abortus', name: 'lb3rtk_sum_abortus'},
            {data: 'lb3rtk_sum_lain_lain', name: 'lb3rtk_sum_lain_lain'},

            {data: 'lb3bayi_sum_sasaran_bayi_laki_laki', name: 'lb3bayi_sum_sasaran_bayi_laki_laki'},
            {data: 'lb3bayi_sum_sasaran_bayi_perempuan', name: 'lb3bayi_sum_sasaran_bayi_perempuan'},
            {data: 'lb3bayi_sum_bayi_lahir_laki_laki', name: 'lb3bayi_sum_bayi_lahir_laki_laki'},
            {data: 'lb3bayi_sum_bayi_lahir_perempuan', name: 'lb3bayi_sum_bayi_lahir_perempuan'},
            {data: 'lb3bayi_sum_kn1_laki_laki', name: 'lb3bayi_sum_kn1_laki_laki'},
            {data: 'lb3bayi_sum_kn1_perempuan', name: 'lb3bayi_sum_kn1_perempuan'},
            {data: 'lb3bayi_sum_kn3_laki_laki', name: 'lb3bayi_sum_kn3_laki_laki'},
            {data: 'lb3bayi_sum_kn3_perempuan', name: 'lb3bayi_sum_kn3_perempuan'},
            {data: 'lb3bayi_sum_bbl_lld_shk', name: 'lb3bayi_sum_bbl_lld_shk'},
            {data: 'lb3bayi_sum_bbl_pd_shk', name: 'lb3bayi_sum_bbl_pd_shk'},

            {data: 'lb3brtk_sum_bblr', name: 'lb3brtk_sum_bblr'},
            {data: 'lb3brtk_sum_asfiksia', name: 'lb3brtk_sum_asfiksia'},
            {data: 'lb3brtk_sum_infeksik', name: 'lb3brtk_sum_infeksi'},
            {data: 'lb3brtk_sum_tetanus', name: 'lb3brtk_sum_tetanus'},
            {data: 'lb3brtk_sum_kelainan', name: 'lb3brtk_sum_kelainan'},
            {data: 'lb3brtk_sum_covid19', name: 'lb3brtk_sum_covid19'},
            {data: 'lb3brtk_sum_hipotiroid', name: 'lb3brtk_sum_hipotiroid'},
            {data: 'lb3brtk_sum_lain_lain', name: 'lb3brtk_sum_lain_lain'},

            // {data: 'sasaran_balita_laki_laki', name: 'sasaran_balita_laki_laki'},
            // {data: 'sasaran_balita_perempuan', name: 'sasaran_balita_perempuan'},
            // {data: 'bllmb_kia', name: 'bllmb_kia'},
            // {data: 'bpmb_kia', name: 'bpmb_kia'},
            // {data: 'blldtk', name: 'blldtk'},
            // {data: 'bpdtk', name: 'bpdtk'},
            // {data: 'blldgp', name: 'blldgp'},
            // {data: 'bpdgp', name: 'bpdgp'},
            // {data: 'sdidtk_bll', name: 'sdidtk_bll'},
            // {data: 'sdidtk_bp', name: 'sdidtk_bp'},
            // {data: 'kbs_ll', name: 'kbs_ll'},
            // {data: 'kbs_p', name: 'kbs_p'},
            // {data: 'mtbs_ll', name: 'mtbs_ll'},
            // {data: 'mtbs_p', name: 'mtbs_p'},

            // {data: 'jpkih', name: 'jpkih'},
            // {data: 'jpkib', name: 'jpkib'},

            // {data: 'dokter_terlatih_usg', name: 'dokter_terlatih_usg'},
            // {data: 'kader_terlatih_ptkb', name: 'kader_terlatih_ptkb'},
            // {data: 'nakes_terlatih_mbts', name: 'nakes_terlatih_mbts'},
            // {data: 'nakes_terlatih_tlgb', name: 'nakes_terlatih_tlgb'},
            // {data: 'nakes_terlatih_pmba', name: 'nakes_terlatih_pmba'},
            // {data: 'nakes_terlatih_sdidtk', name: 'nakes_terlatih_sdidtk'},
            // {data: 'nakes_terlatih_imtbsgb', name: 'nakes_terlatih_imtbsgb'},
            // {data: 'nakes_terlatih_pmba_sdidtk', name: 'nakes_terlatih_pmba_sdidtk'},
            // {data: 'action', name: 'action', width:"10px", orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: '_all',
                    defaultContent: 0,

                },
                // {
                //     className: 'text-center',
                //  width:"10px", orderable: false,
                //   searchable: false,
                //     targets: [1, 2, 3 , 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 37, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 43, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75],
                // },
            ],
        });

    $("#terapkan_filter").click(function() {
        dataTable.draw();
        // get_saldo();
      });
    });
  </script>
@endsection
