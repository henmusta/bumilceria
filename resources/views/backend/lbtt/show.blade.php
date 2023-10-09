@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid full">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <a onclick="printDiv('printableArea')" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                    <a onclick="window.history.back();" class="btn btn-primary w-md">Kembali</a>
                </div>
            </div>
            <div class="card-body" id="printableArea">


                 <table width="100%">
                    <tr>
                      <td style="width: 50%; font-weight: bold; font-size: 12px; text-align: left"> Data Laporan Bulanan Tenaga Terlatih - {{$data['lbtt']['puskesmas']['name']}} - {{$data['lbtt']['tahun']}}</td>
                      <td style="width: 50%; font-weight: normal; text-align: right">  Tanggal Buat : {{ \Carbon\Carbon::parse($data['lbtt']['created_at'])->isoFormat('dddd, D MMMM Y')}}</td>
                    </tr>
                  </table><br><br>
                <div class="row" style="padding-top:10px;">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="">
                                    <th class="text-left" width="50%">Dokter terlatih USG</th>
                                    <td class="text-left">{{ $data['lbtt']['dokter_terlatih_udg'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Kader terlatih pemantauan tumbuh kembang balit</th>
                                    <td class="text-left">{{ $data['lbtt']['kader_terlatih_ptkb'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Nakes terlatih MTBS</th>
                                    <td class="text-left">{{ $data['lbtt']['nakes_terlatih_mbts'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Nakes terlatih tata laksana gizi buruk</th>
                                    <td class="text-left">{{ $data['lbtt']['nakes_terlatih_tlgb'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Nakes terlatih PMBA</th>
                                    <td class="text-left">{{ $data['lbtt']['nakes_terlatih_pmba'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Nakes terlatih SDIDTK</th>
                                    <td class="text-left">{{ $data['lbtt']['nakes_terlatih_sdidtk'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Nakes terlatih integrasi MTBS-Gizi Buruk</th>
                                    <td class="text-left">{{ $data['lbtt']['nakes_terlatih_imbtsgb'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Nakes terlatih integrasi PMBA-SDIDTK</th>
                                    <td class="text-left">{{ $data['lbtt']['nakes_terlatih_pmba_sdidtk'] }}</td>
                                </tr>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- end row -->




            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
#hideshow {
  display: none;
}
@media print
{
    #hideshow {
     display: block;
    }
    @page {
      size: A4; /* DIN A4 standard, Europe */
      margin: 8mm 8mm 8mm 8mm;
    }
    html, body {
        width: 210mm;
        /* height: 282mm; */
        font-size: 9px;
        color: #000;
        background: #FFF;
        overflow:visible;
    }
    body {
        padding-top:15mm;
    }


    #Datatable {
        border: solid #000 !important;
        border-width: 1px 0 0 1px !important;
    }
}
</style>
@endsection
@section('script')
  <script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}



    $(document).ready(function () {
        // $('#tanggal_lahir').datepicker({ dateFormat: "yy-mm-dd" });








    });
  </script>
@endsection
