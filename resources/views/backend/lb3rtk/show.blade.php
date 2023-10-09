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
                      <td style="width: 50%; font-weight: bold; font-size: 12px; text-align: left"> Data LB3 Risiko Tinggi Komplikasi - {{$data['lb3rtk']['puskesmas']['name']}} - {{$data['lb3rtk']['tahun']}}</td>
                      <td style="width: 50%; font-weight: normal; text-align: right">  Tanggal Buat : {{ \Carbon\Carbon::parse($data['lb3rtk']['created_at'])->isoFormat('dddd, D MMMM Y')}}</td>
                    </tr>
                  </table><br><br>
                <div class="row" style="padding-top:10px;">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="">
                                    <th class="text-left" width="50%">Anemia Trimester I  <p style="font-size:10px;">Jumlah Ibu hamil dengan Hb < 11gr/dl pada Trimester I</p></th>
                                    <td class="text-left">{{ $data['lb3rtk']['anemia_trimester1'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Anemia Trimester III <p style="font-size:10px;">Jumlah Ibu hamil dengan Hb < 11gr/dl pada Trimester III</p></th>
                                    <td class="text-left">{{ $data['lb3rtk']['anemia_trimester3'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Pendarahan<p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi perdarahan</p></th>
                                    <td class="text-left">{{ $data['lb3rtk']['pendarahan'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Pre Eklamsia<p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi pre eklamsia</p></th>
                                    <td class="text-left" >{{ $data['lb3rtk']['pre_eklamsia'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Infeksi<p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi infeksi</p></th>
                                    <td class="text-left">{{ $data['lb3rtk']['infeksi'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Tuberculosis<p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi tuberculosis</p></th>
                                    <td class="text-left">{{ $data['lb3rtk']['tuberculosis'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Malaria<p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi malaria</p></th>
                                    <td class="text-left">{{ $data['lb3rtk']['malaria'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Jantung<p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi penyakit jantung</p></th>
                                    <td class="text-left">{{ $data['lb3rtk']['jantung'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Diabetes Mellitus<p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi Diabetes Mellitus</p></th>
                                    <td class="text-left">{{ $data['lb3rtk']['diabetes_mellitus'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Obesitas<p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi Obesitas</p></th>
                                    <td class="text-left">{{ $data['lb3rtk']['obesitas'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Covid 19<p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi Covid-19</p></th>
                                    <td class="text-left">{{ $data['lb3rtk']['covid19'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Abortus<p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi abortus</p></th>
                                    <td class="text-left">{{ $data['lb3rtk']['abortus'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Lain-Lain<p style="font-size:10px;">Jumlah Ibu hamil dengan resiko tinggi/komplikasi lainnya yang tidak tersebut di atas</p></th>
                                    <td class="text-left">{{ $data['lb3rtk']['lain-lain'] }}</td>
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
