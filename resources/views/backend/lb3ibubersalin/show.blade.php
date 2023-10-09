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
                      <td style="width: 50%; font-weight: bold; font-size: 12px; text-align: left"> Data Lb3 Ibu Bersalin - {{$data['lb3ibubersalin']['puskesmas']['name']}} - {{$data['lb3ibubersalin']['tahun']}}</td>
                      <td style="width: 50%; font-weight: normal; text-align: right">  Tanggal Buat : {{ \Carbon\Carbon::parse($data['lb3ibubersalin']['created_at'])->isoFormat('dddd, D MMMM Y')}}</td>
                    </tr>
                  </table><br><br>
                <div class="row" style="padding-top:10px;">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="">
                                    <th class="text-left" width="50%">Jumlah Sasaran Ibu Bersalin</th>
                                    <td class="text-left"> {{$data['lb3ibubersalin']['jsib']}}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Ibu Bersalin <p style="font-size:10px;">Jumlah seluruh ibu bersalin</p></th>
                                    <td class="text-left"> {{$data['lb3ibubersalin']['ibu_bersalin']}}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Ibu Bersalin Nakes<p style="font-size:10px;">Jumlah ibu bersalin ditolong oleh tenaga kesehatan baik di faskes atau di rumah</p></th>
                                    <td class="text-left"> {{$data['lb3ibubersalin']['ibu_bersalin_nakes']}}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Ibu bersalin faskes<p style="font-size:10px;">Jumlah ibu bersalin di fasilitas kesehatan</p></th>
                                    <td class="text-left" >{{$data['lb3ibubersalin']['ibu_bersalin_faskes']}} </td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">KF1<p style="font-size:10px;">Jumlah kunjungan nifas KF1</p></th>
                                    <td class="text-left">{{$data['lb3ibubersalin']['kf1']}}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">KF Lengkap<p style="font-size:10px;">Jumlah Ibu nifas yang telah melakukan kunjungan nifas lengkap</p></th>
                                    <td class="text-left">{{$data['lb3ibubersalin']['kf_lengkap']}}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Vit A Ibu Nifas<p style="font-size:10px;">Jumlah Ibu nifas mendapatkan Vit A</p></th>
                                    <td class="text-left">{{$data['lb3ibubersalin']['vita_ibu_nifas']}}</td>
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
