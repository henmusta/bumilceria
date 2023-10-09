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
                      <td style="width: 50%; font-weight: bold; font-size: 12px; text-align: left"> Data Lb3 Ibu Hamil - {{$data['lb3ibuhamil']['puskesmas']['name']}} - {{$data['lb3ibuhamil']['tahun']}}</td>
                      <td style="width: 50%; font-weight: normal; text-align: right">  Tanggal Buat : {{ \Carbon\Carbon::parse($data['lb3ibuhamil']['created_at'])->isoFormat('dddd, D MMMM Y')}}</td>
                    </tr>
                  </table><br><br>
                <div class="row" style="padding-top:10px;">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="">
                                    <th class="text-left" width="50%">Jumlah Sasaran Ibu Hamil</th>
                                    <td class="text-left">{{ $data['lb3ibuhamil']['jsih'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">K1 Total <p style="font-size:10px;">Jumlah Seluruh K1 (Akses dan Murni)</p></th>
                                    <td class="text-left">{{ $data['lb3ibuhamil']['k1_total'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">K1 Murni<p style="font-size:10px;">Jumlah K1 pada kehamilan trimester 1</p></th>
                                    <td class="text-left">{{ $data['lb3ibuhamil']['k1_murni'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">K4<p style="font-size:10px;">Jumlah ibu hamil telah memenuhi K4</p></th>
                                    <td class="text-left" >{{ $data['lb3ibuhamil']['k4'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">K6<p style="font-size:10px;">Jumlah Ibu hamil memenuhi K6 (K4 ditambah 2 kali pemeriksaan oleh dokter)</p></th>
                                    <td class="text-left">{{ $data['lb3ibuhamil']['k6'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Ibu Hamil Terlalu Tua/Muda<p style="font-size:10px;">Usia kurang dari 20 th atau lebih dari 35 th</p></th>
                                    <td class="text-left">{{ $data['lb3ibuhamil']['ihttm'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Ibu hamil dengan jarak terlalu dekat<p style="font-size:10px;">Spasi antar kehamilan kurang dari 2 tahun</p></th>
                                    <td class="text-left">{{ $data['lb3ibuhamil']['ibdjtd'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Ibu hamil dengan kehamilan terlalu banyak<p style="font-size:10px;">Jumlah Ibu hamil dengan kehamilan ke-5 atau lebih</p></th>
                                    <td class="text-left">{{ $data['lb3ibuhamil']['ihdktb'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">K1 oleh dokter<p style="font-size:10px;">Jumlah Ibu hamil pertama kali pemeriksaan oleh dokter dengan dan tanpa USG</p></th>
                                    <td class="text-left">{{ $data['lb3ibuhamil']['k1_ok'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">K5 oleh dokter<p style="font-size:10px;">Jumlah Ibu hamil memenuhi K4 ditambah 1 kali pemeriksaan oleh dokter dengan dan tanpa USG</p></th>
                                    <td class="text-left">{{ $data['lb3ibuhamil']['k5_ok'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">K1 USG oleh dokter<p style="font-size:10px;">Jumlah Ibu hamil pertama kali pemeriksaan oleh dokter dengan menggunakan USG</p></th>
                                    <td class="text-left">{{ $data['lb3ibuhamil']['k1_usg_ok'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">K5 USG oleh dokter<p style="font-size:10px;">Jumlah Ibu hamil memenuhi K4 ditambah 1 kali pemeriksaan oleh dokter dengan menggunakan USG</p></th>
                                    <td class="text-left">{{ $data['lb3ibuhamil']['k5_usg_ok'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Ibu hamil mempunyai buku KIA<p style="font-size:10px;">Jumlah seluruh Ibu yang sedang hamil dan memiliki buku KIA pada bulan ini</p></th>
                                    <td class="text-left">{{ $data['lb3ibuhamil']['ibmb_kia'] }}</td>
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
