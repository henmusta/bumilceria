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
                      <td style="width: 50%; font-weight: bold; font-size: 12px; text-align: left"> Data Laporan Kelas Ibu - {{$data['lki']['puskesmas']['name']}} - {{$data['lki']['tahun']}}</td>
                      <td style="width: 50%; font-weight: normal; text-align: right">  Tanggal Buat : {{ \Carbon\Carbon::parse($data['lki']['created_at'])->isoFormat('dddd, D MMMM Y')}}</td>
                    </tr>
                  </table><br><br>
                <div class="row" style="padding-top:10px;">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="">
                                    <th class="text-left" width="50%">Jumlah peserta kelas ibu hamil</th>
                                    <td class="text-left">{{ $data['lki']['jpkih'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Jumlah peserta kelas ibu balita<p style="font-size:10px;">Jumlah Sasaran Bayi Perempuan</p></th>
                                    <td class="text-left">{{ $data['lki']['jpkib'] }}</td>
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
