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
                      <td style="width: 50%; font-weight: bold; font-size: 12px; text-align: left"> Data LB3 Balita - {{$data['lb3balita']['puskesmas']['name']}} - {{$data['lb3balita']['tahun']}}</td>
                      <td style="width: 50%; font-weight: normal; text-align: right">  Tanggal Buat : {{ \Carbon\Carbon::parse($data['lb3balita']['created_at'])->isoFormat('dddd, D MMMM Y')}}</td>
                    </tr>
                  </table><br><br>
                <div class="row" style="padding-top:10px;">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="">
                                    <th class="text-left" width="50%">Sasaran Balita Laki laki <p style="font-size:10px;">Jumlah sasaran balita laki-laki</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['sasaran_balita_laki-laki'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Sasaran Balita Perempuan <p style="font-size:10px;">Jumlah Sasaran Balita Perempuan</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['sasaran_balita_perempuan'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Balita laki-laki memiliki buku KIA<p style="font-size:10px;">Jumlah seluruh balita laki-laki memiliki buku KIA pada bulan ini</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['bllmb_kia'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Balita perempuan memiliki buku KIA<p style="font-size:10px;">JJumlah seluruh balita perempuan memiliki buku KIA pada bulan ini</p></th>
                                    <td class="text-left" >{{ $data['lb3balita']['bpmb_kia'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Balita laki-laki dipantau tumbuh kembang<p style="font-size:10px;">Jumlah seluruh laki-laki laki-laki dipantau pertumbuhan dan perkembangan</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['blldtk'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Balita perempuan dipantau tumbuh kembang<p style="font-size:10px;">Jumlah seluruh balita perempuan dipantau pertumbuhan dan perkembangan</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['bpdtk'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Balita laki-laki dengan gangguan perkembangan<p style="font-size:10px;">Jumlah seluruh balita laki-laki dgn gangguan perkembangan setelah diagnosa dokter</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['blldgp'] }}</td>
                                </tr>
                                <tr class="">
                                    <th class="text-left" width="50%">Balita perempuan dengan gangguan perkembangan<p style="font-size:10px;">Jumlah seluruh balita perempuan dgn gangguan perkembangan setelah diagnosa dokter</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['bpdgp'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">SDIDTK balita laki-laki<p style="font-size:10px;">Jumlah seluruh balita laki-laki mendapat pelayanan SDIDTK</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['sdidtk_bll'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">SDIDTK balita perempuan<p style="font-size:10px;">Jumlah seluruh balita perempuan mendapat pelayanan SDIDTK</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['sdidtk_bp'] }}</td>
                                </tr>



                                <tr class="">
                                    <th class="text-left" width="50%">Kunjungan balita sakit (laki-laki)<p style="font-size:10px;">Jumlah seluruh kunjungan balita laki-laki yang sakit</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['kbs_ll'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">Kunjungan balita sakit (perempuan)<p style="font-size:10px;">Jumlah seluruh kunjungan balita perempuan yang sakit</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['kbs_p'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">MTBS laki-laki<p style="font-size:10px;">Jumlah seluruh balita laki-laki mendapat pelayanan MTBS</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['mtbs_ll'] }}</td>
                                </tr>

                                <tr class="">
                                    <th class="text-left" width="50%">MTBS Perempuan<p style="font-size:10px;">Jumlah seluruh balita perempuan mendapat pelayanan MTBS</p></th>
                                    <td class="text-left">{{ $data['lb3balita']['mtbs_p'] }}</td>
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
