@extends('backend.layouts.master')

@section('title') {{ $config['page_title'] }} @endsection

@section('content')

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-header mb-3">
            {{-- @if(Auth::user()->roles[0]->id != '5') --}}
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
                                    {{-- <button class="btn btn-secondary buttons-pdf buttons-html5"  tabindex="0" aria-controls="Datatable" id="pdf" type="button"><span>PDF</span></button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <input hidden id="user_puskes_id" value="{{Auth::user()->puskesmas->id ?? ''}}">
                    <input hidden id="user_puskes_name" value="{{Auth::user()->puskesmas->name ?? ''}}">
                    <div class="row">
                        <div class="col-12">
                            <div class="multi-collapse collapse show" id="multiCollapseExample2" style="">
                                <div class="card border shadow-none card-body text-muted mb-0">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="select2Puskesmas">UPDT Puskesmas<span class="text-danger"></span></label>
                                                <select id="select2Puskesmas" name="updt_puskesmas_id[]"  style="width: 100% !important;" class="js-example-basic-multiple"  multiple="multiple" style="width: 100% !important;" name="updt_puskesmas_id">

                                                </select>
                                              </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="select2Type">Tipe Tanggal<span class="text-danger"></span></label>
                                                <select style="width: 100% !important;" id="select2Type" class="js-example-basic-multiple" name="type">
                                                    <option value="year" selected>Tahun</option>
                                                    <option value="month">Bulan</option>
                                                    <option value="s1">Semester 1</option>
                                                    <option value="s2">Semester 2</option>
                                                    <option value="t1">Triwulan 1</option>
                                                    <option value="t2">Triwulan 2</option>
                                                    <option value="t3">Triwulan 3</option>
                                                    <option value="t4">Triwulan 4</option>
                                                  </select>
                                            </div>
                                        </div>
                                        <div id="bulan" class="col-md-3">
                                            <div class="mb-3">
                                                <label for="select2Bulan">Bulan<span class="text-danger"></span></label>
                                                <select style="width: 100% !important;" id="select2Bulan" class="js-example-basic-multiple" name="type">
                                                </select>
                                            </div>
                                        </div>
                                        <div id="tahun" class="col-md-3">
                                            <div class="mb-3">
                                                <label for="select2Bulan">Tahun<span class="text-danger"></span></label>
                                                <select style="width: 100% !important;" id="select2Tahun" class="js-example-basic-multiple" name="type">
                                                    <option value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">{{ \Carbon\Carbon::now()->format('Y') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div  {{Auth::user()->roles[0]->id == 5 ? 'hidden' : ''}} class="col-md-2 text-end" style="padding-top:23px; padding-left:0px !important;">
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
            {{-- @endif --}}

        </div>

        <div class="card-body">
            <section class="datatables">
                <div class="table-responsive">
                  <table id="Datatable" class="table table-bordered" style="width:100%">
                      <thead>
                          <tr>
                              <th>Nama Puskesmas</th>
                              {{-- ibu hamil --}}
                              <th class="text-center" width=>Jumlah Sasaran Ibu Hamil</th>
                              <th class="text-center" width=>K1 Total</th>
                              <th class="text-center" width=>K1 Murni</th>
                              <th class="text-center" width=>K4</th>
                              <th class="text-center" width=>K6</th>
                              <th class="text-center" width=>Ibu Hamil Terlalu Tua/Muda</th>
                              <th class="text-center" width=>Ibu hamil dengan jarak terlalu dekat</th>
                              <th class="text-center" width=>Ibu hamil dengan kehamilan terlalu banyak</th>
                              <th class="text-center" width=>K1 Oleh Dokter</th>
                              <th class="text-center" width=>K5 Oleh Dokter</th>
                              <th class="text-center" width=>K1 USG Oleh Dokter</th>
                              <th class="text-center" width=>K5 USG Oleh Dokter</th>
                              <th class="text-center" width=>Ibu hamil mempunyai buku KIA</th>



                              <th class="text-center" width=>Jumlah Sasaran Ibu Bersalin</th>
                              <th class="text-center" width=>Ibu Bersalin</th>
                              <th class="text-center" width=>Ibu Bersalin Nakes</th>
                              <th class="text-center" width=>Ibu bersalin faskes</th>
                              <th class="text-center" width=>KF1</th>
                              <th class="text-center" width=>KF Lengkap</th>
                              <th class="text-center" width=>Vit A Ibu Nifas</th>




                              <th class="text-center" width=>Anemia Trimester I</th>
                              <th class="text-center" width=>Anemia Trimester III</th>
                              <th class="text-center" width=>Pendarahan</th>
                              <th class="text-center" width=>Pre Eklamsia</th>
                              <th class="text-center" width=>Infeksi</th>
                              <th class="text-center" width=>Tuberculosis</th>
                              <th class="text-center" width=>Malaria</th>
                              <th class="text-center" width=>Jantung</th>
                              <th class="text-center" width=>Diabetes Mellitus</th>
                              <th class="text-center" width=>Obesitas</th>
                              <th class="text-center" width=>Covid19</th>
                              <th class="text-center" width=>Abortus</th>
                              <th class="text-center" width=>Lain Lain</th>



                              <th class="text-center" width=>Sasaran Bayi Laki Laki</th>
                              <th class="text-center" width=>Sasaran Bayi Perempuan</th>
                              <th class="text-center" width=>Bayi Lahir Laki Laki</th>
                              <th class="text-center" width=>Bayi Lahir Perempuan</th>
                              <th class="text-center" width=>KN1 Laki Laki</th>
                              <th class="text-center" width=>KN1 Perempuan</th>
                              <th class="text-center" width=>KN3 Laki Laki</th>
                              <th class="text-center" width=>KN3 Perempuan</th>
                              <th class="text-center" width=>BBL laki-laki diperiksa SHK</th>
                              <th class="text-center" width=>BBL perempuan diperiksa SHK</th>



                              <th class="text-center" width=>BBLR</th>
                              <th class="text-center" width=>Asfiksia</th>
                              <th class="text-center" width=>Infeksi</th>
                              <th class="text-center" width=>Tetanus Neonatorum</th>
                              <th class="text-center" width=>Kelainan kongenital</th>
                              <th class="text-center" width=>Covid-19</th>
                              <th class="text-center" width=>Hipotiroid Kongenital</th>
                              <th class="text-center" width=>Lain Lain</th>



                              <th class="text-center" width=>Sasaran Balita Laki laki</th>
                              <th class="text-center" width=>Sasaran Balita Perempuan</th>
                              <th class="text-center" width=>Balita laki-laki memiliki buku KIA</th>
                              <th class="text-center" width=>Balita perempuan memiliki buku KIA</th>
                              <th class="text-center" width=>Balita laki-laki dipantau tumbuh kembang</th>
                              <th class="text-center" width=>Balita Perempuan dipantau tumbuh kembang</th>
                              <th class="text-center" width=>Balita laki-laki dengan gangguan perkembangan</th>
                              <th class="text-center" width=>Balita Perempuan dengan gangguan perkembangan</th>
                              <th class="text-center" width=>SDIDTK balita laki-laki</th>
                              <th class="text-center" width=>SDIDTK balita perempuan</th>
                              <th class="text-center" width=>Kunjungan balita sakit (laki-laki)</th>
                              <th class="text-center" width=>Kunjungan balita sakit (Perempuan)</th>
                              <th class="text-center" width=>MTBS laki-laki</th>
                              <th class="text-center" width=>MTBS Perempuan</th>



                              <th class="text-center" width=>Jumlah peserta kelas ibu hamil</th>
                              <th class="text-center" width=>Jumlah peserta kelas ibu balita</th>



                              <th class="text-center" width=>Dokter terlatih USG</th>
                              <th class="text-center" width=>Kader terlatih pemantauan tumbuh kembang balita</th>
                              <th class="text-center" width=>Nakes terlatih MTBS</th>
                              <th class="text-center" width=>Nakes terlatih tata laksana gizi buruk</th>
                              <th class="text-center" width=>Nakes terlatih PMBA</th>
                              <th class="text-center" width=>Nakes terlatih SDIDTK</th>
                              <th class="text-center" width=>Nakes terlatih integrasi MTBS-Gizi Buruk</th>
                              <th class="text-center" width=>Nakes terlatih integrasi PMBA-SDIDTK</th>


                              <th>(Mental) 0 Sampai 15</th>
                              <th>(Mental) 16 Sampai 45</th>
                              <th>(Mental) 46 Sampai 60</th>
                              <th>(Mental) 60 Keatas</th>

                              <th>(Fisik) 0 Sampai 15</th>
                              <th>(Fisik) 16 Sampai 45</th>
                              <th>(Fisik) 46 Sampai 60</th>
                              <th>(Fisik) 60 Keatas</th>

                              <th>(Emosional) 0 Sampai 15</th>
                              <th>(Emosional) 16 Sampai 45</th>
                              <th>(Emosional) 46 Sampai 60</th>
                              <th>(Emosional) 60 Keatas</th>

                              <th>(Penelantaran) 0 Sampai 15</th>
                              <th>(Penelantaran) 16 Sampai 45</th>
                              <th>(Penelantaran) 46 Sampai 60</th>
                              <th>(Penelantaran) 60 Keatas</th>

                              <th>(Penanganan) 0 Sampai 15</th>
                              <th>(Penanganan) 16 Sampai 45</th>
                              <th>(Penanganan) 46 Sampai 60</th>
                              <th>(Penanganan) 60 Keatas</th>

                              <th>Unmeet Need</th>
                              <th>Kehamilan Diluar Nikah</th>
                              <th>Kegagalan Kb</th>
                          </tr>
                      </thead>
                      <tbody>

                      </tbody>
                      <tfoot>
                        <tr>
                            <td class="text-center" width=>Total</td>
                            @for($i = 1; $i < 99; $i++)
                            <td class="text-center" width=>{{$i}}</td>
                            @endfor
                        </tr>
                      </tfoot>
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
     $("#bulan").css("display", "none");
     let select2Type = $('#select2Type');
     select2Type.select2({
        dropdownParent:select2Type.parent(),
        searchInputPlaceholder: 'Cari',
        width: '100%',
        placeholder: 'select Type'
      }).on('select2:select', function (e) {
            let data = e.params.data;
            cek(data.id);
      });




    let select2Bulan = $('#select2Bulan');
     select2Bulan.select2({
        dropdownParent:select2Bulan.parent(),
        searchInputPlaceholder: 'Cari',
        width: '100%',
        placeholder: 'select bulan',
        ajax: {
          url: "{{ route('datepicker.index') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
              type : 'bulan',
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
            console.log(data.id);
      });

      let select2Tahun = $('#select2Tahun');
     select2Tahun.select2({
        dropdownParent:select2Tahun.parent(),
        searchInputPlaceholder: 'Cari',
        width: '100%',
        placeholder: 'select Tahun',
        ajax: {
          url: "{{ route('datepicker.index') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
              type : 'tahun',
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
            console.log(data.id);
      });

      function cek(res){

        if(res == 'year'){
            console.log(res);
            $("#bulan").css("display", "none");
        }

        if(res == 'month'){
            console.log(res);
            $("#bulan").css("display", "block");
        }

        if(res != 'month' && res != 'year'){
            $("#bulan").css("display", "none");
        }
        select2Bulan.val('').trigger('change');
        select2Tahun.val('').trigger('change');
    }

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
        const numbersArray = [];
        for (let i = 1; i <= 98; i++) {
          numbersArray.push(i);
        }
        console.log( numbersArray);
      let dataTable = $('#Datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [

            { extend: 'excelHtml5', footer: true },
        ],
       footerCallback: function ( row, rowData, start, end, display ) {
       var api = this.api(), rowData;
       var intVal = function ( i ) {
           return typeof i === 'string' ?
               i.replace(/[\$,]/g, '')*1 :
               typeof i === 'number' ?
                   i : 0;
       };

       for (var i=1; i<=98; i++) {
           var colum = 'col'+ i;
           var colum = api
               .column( i )
               .data()
               .reduce( function (a, b) {
                   return intVal(a) + intVal(b);
               }, 0 );
           $( api.column(i).footer() ).html(
               colum
           );
       }
      },
       scrollX: true,
       processing: true,
       serverSide: true,
       order: [[0, 'desc']],
       lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
       pageLength: 10,
       ajax: {
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type: 'POST',
       url: "{{ route('backend.laporan.datatable') }}",
       data: function (d) {
           d.updt_puskesmas_id =  select2Puskesmas.val();
           d.tahun =  select2Tahun.find(':selected').val();
           d.bulan =  select2Bulan.find(':selected').val();
           d.type =   $('#select2Type').find(':selected').val();
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
       {data: 'lb3rtk_sum_pendarahan', name: 'lb3rtk_sum_pendarahan'},
       {data: 'lb3rtk_sum_pre_eklamsia', name: 'lb3rtk_sum_pre_eklamsia'},
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
       {data: 'lb3brtk_sum_infeksi', name: 'lb3brtk_sum_infeksi'},
       {data: 'lb3brtk_sum_tetanus', name: 'lb3brtk_sum_tetanus'},
       {data: 'lb3brtk_sum_kelainan', name: 'lb3brtk_sum_kelainan'},
       {data: 'lb3brtk_sum_covid19', name: 'lb3brtk_sum_covid19'},
       {data: 'lb3brtk_sum_hipotiroid', name: 'lb3brtk_sum_hipotiroid'},
       {data: 'lb3brtk_sum_lain_lain', name: 'lb3brtk_sum_lain_lain'},

       {data: 'lb3balita_sum_sasaran_balita_laki_laki', name: 'lb3balita_sum_sasaran_balita_laki_laki'},
       {data: 'lb3balita_sum_sasaran_balita_perempuan', name: 'lb3balita_sum_sasaran_balita_perempuan'},
       {data: 'lb3balita_sum_bllmb_kia', name: 'lb3balita_sum_bllmb_kia'},
       {data: 'lb3balita_sum_bpmb_kia', name: 'lb3balita_sum_bpmb_kia'},
       {data: 'lb3balita_sum_blldtk', name: 'lb3balita_sum_blldtk'},
       {data: 'lb3balita_sum_bpdtk', name: 'lb3balita_sum_bpdtk'},
       {data: 'lb3balita_sum_blldgp', name: 'lb3balita_sum_blldgp'},
       {data: 'lb3balita_sum_bpdgp', name: 'lb3balita_sum_bpdgp'},
       {data: 'lb3balita_sum_sdidtk_bll', name: 'lb3balita_sum_sdidtk_bll'},
       {data: 'lb3balita_sum_sdidtk_bp', name: 'lb3balita_sum_sdidtk_bp'},
       {data: 'lb3balita_sum_kbs_ll', name: 'lb3balita_sum_kbs_ll'},
       {data: 'lb3balita_sum_kbs_p', name: 'lb3balita_sum_kbs_p'},
       {data: 'lb3balita_sum_mtbs_ll', name: 'lb3balita_sum_mtbs_ll'},
       {data: 'lb3balita_sum_mtbs_p', name: 'lb3balita_sum_mtbs_p'},

       {data: 'lki_sum_jpkih', name: 'lki_sum_jpkih'},
       {data: 'lki_sum_jpkib', name: 'lki_sum_jpkib'},

       {data: 'lbtt_sum_dokter_terlatih_usg', name: 'lbtt_sum_dokter_terlatih_usg'},
       {data: 'lbtt_sum_kader_terlatih_ptkb', name: 'lbtt_sum_kader_terlatih_ptkb'},
       {data: 'lbtt_sum_nakes_terlatih_mbts', name: 'lbtt_sum_nakes_terlatih_mbts'},
       {data: 'lbtt_sum_nakes_terlatih_tlgb', name: 'lbtt_sum_nakes_terlatih_tlgb'},
       {data: 'lbtt_sum_nakes_terlatih_pmba', name: 'lbtt_sum_nakes_terlatih_pmba'},
       {data: 'lbtt_sum_nakes_terlatih_sdidtk', name: 'lbtt_sum_nakes_terlatih_sdidtk'},
       {data: 'lbtt_sum_nakes_terlatih_imtbsgb', name: 'lbtt_sum_nakes_terlatih_imtbsgb'},
       {data: 'lbtt_sum_nakes_terlatih_pmba_sdidtk', name: 'lbtt_sum_nakes_terlatih_pmba_sdidtk'},

       {data: 'Mental_0_15', name: 'Mental_0_15'},
       {data: 'Mental_16_45', name: 'Mental_16_45'},
       {data: 'Mental_46_60', name: 'Mental_46_60'},
       {data: 'Mental_60', name: 'Mental_60'},

       {data: 'Fisik_0_15', name: 'Fisik_0_15'},
       {data: 'Fisik_16_45', name: 'Fisik_16_45'},
       {data: 'Fisik_46_60', name: 'Fisik_46_60'},
       {data: 'Fisik_60', name: 'Fisik_60'},

       {data: 'Emosional_0_15', name: 'Emosional_0_15'},
       {data: 'Emosional_16_45', name: 'Emosional_16_45'},
       {data: 'Emosional_46_60', name: 'Emosional_46_60'},
       {data: 'Emosional_60', name: 'Emosional_60'},

       {data: 'Penelantaran_0_15', name: 'Penelantaran_0_15'},
       {data: 'Penelantaran_16_45', name: 'Penelantaran_16_45'},
       {data: 'Penelantaran_46_60', name: 'Penelantaran_46_60'},
       {data: 'Penelantaran_60', name: 'Penelantaran_60'},

       {data: 'Penanganan_0_15', name: 'Penanganan_0_15'},
       {data: 'Penanganan_16_45', name: 'Penanganan_16_45'},
       {data: 'Penanganan_46_60', name: 'Penanganan_46_60'},
       {data: 'Penanganan_60', name: 'Penanganan_60'},


       {data: 'lb3kytd_sum_unmet_need', name: 'lb3kytd_sum_unmet_need'},
       {data: 'lb3kytd_sum_kehamilan_diluar_nikah', name: 'lb3kytd_sum_kehamilan_diluar_nikah'},
       {data: 'lb3kytd_sum_kegagalan_kb', name: 'lb3kytd_sum_kegagalan_kb'},

       ],
       columnDefs: [
           {
               targets: '_all',
               defaultContent: 0,
           },
           {
             className: 'text-center',
             width:"10px", orderable: false,
             searchable: false,
             targets: numbersArray,
           },
       ],
   });
$("#terapkan_filter").click(function() {
   dataTable.draw();
   // get_saldo();
 });


        var id =$('#user_puskes_id').val();
        var name =$('#user_puskes_name').val();
        if(id != ''){
            loadsupplier(id, name);
        }

        function loadsupplier(id, name){
            var option = new Option(name, id, true, true);
            $('#select2Puskesmas').append(option).trigger('change');
            dataTable.draw();
        }

});
</script>
@endsection
