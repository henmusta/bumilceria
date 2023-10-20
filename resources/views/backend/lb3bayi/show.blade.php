@extends('backend.layouts.master')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-header">
        <div class="float-end">
            <a onclick="printDiv('printableArea')" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
            <a onclick="window.history.back();" class="btn btn-primary w-md">Kembali</a>
        </div>
    </div>
    <div class="card-body" id="printableArea">


         <table width="100%">
            <tr>
              <td style="width: 50%; font-weight: bold; font-size: 12px; text-align: left"> Data LB3 Bayi - {{$data['lb3bayi']['puskesmas']['name']}} - {{$data['lb3bayi']['tanggal']->isoFormat('MMMM YYYY')}}</td>
              <td style="width: 50%; font-weight: normal; text-align: right">  Tanggal Buat : {{ \Carbon\Carbon::parse($data['lb3bayi']['created_at'])->isoFormat('dddd, D MMMM Y')}}</td>
            </tr>
          </table><br><br>
        <div class="row" style="padding-top:10px;">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr class="">
                            <th class="text-left" width="50%">Sasaran Bayi Laki laki <p style="font-size:10px;">Jumlah sasaran bayi laki-laki</p></th>
                            <td class="text-left">{{ $data['lb3bayi']['sasaran_bayi_laki-laki'] }}</td>
                        </tr>
                        <tr class="">
                            <th class="text-left" width="50%">Sasaran Bayi Perempuan <p style="font-size:10px;">Jumlah Sasaran Bayi Perempuan</p></th>
                            <td class="text-left">{{ $data['lb3bayi']['sasaran_bayi_perempuan'] }}</td>
                        </tr>
                        <tr class="">
                            <th class="text-left" width="50%">>Bayi Lahir Laki-Laki<p style="font-size:10px;">Jumlah bayi lahir hidup laki-laki</p></th>
                            <td class="text-left">{{ $data['lb3bayi']['bayi_lahir_laki-laki'] }}</td>
                        </tr>
                        <tr class="">
                            <th class="text-left" width="50%">Bayi lahir perempuan<p style="font-size:10px;">Jumlah bayi lahir hidup perempuan</p></th>
                            <td class="text-left" >{{ $data['lb3bayi']['bayi_lahir_perempuan'] }}</td>
                        </tr>
                        <tr class="">
                            <th class="text-left" width="50%">KN1 Laki-laki<p style="font-size:10px;">Jumlah bayi laki-laki telah mendapatkan pelayanan KN1</p></th>
                            <td class="text-left">{{ $data['lb3bayi']['kn1_laki-laki'] }}</td>
                        </tr>
                        <tr class="">
                            <th class="text-left" width="50%">KN1 Perempuan<p style="font-size:10px;">Jumlah bayi perempuan telah mendapatkan pelayanan KN1</p></th>
                            <td class="text-left">{{ $data['lb3bayi']['kn1_perempuan'] }}</td>
                        </tr>

                        <tr class="">
                            <th class="text-left" width="50%">KN3 Laki-laki<p style="font-size:10px;">Jumlah bayi laki-laki telah mendapatkan pelayanan KN3</p></th>
                            <td class="text-left">{{ $data['lb3bayi']['kn3_laki-laki'] }}</td>
                        </tr>
                        <tr class="">
                            <th class="text-left" width="50%">KN3 Perempuan<p style="font-size:10px;">Jumlah bayi perempuan telah mendapatkan pelayanan KN3</p></th>
                            <td class="text-left">{{ $data['lb3bayi']['kn3_perempuan'] }}</td>
                        </tr>

                        <tr class="">
                            <th class="text-left" width="50%">BBL laki-laki diperiksa SHK<p style="font-size:10px;">Bayi laki-laki diperiksa Skrining Hipotiroid Kongenital (SHK)</p></th>
                            <td class="text-left">{{ $data['lb3bayi']['bbl_lld_shk'] }}</td>
                        </tr>

                        <tr class="">
                            <th class="text-left" width="50%">BBL Perempuan diperiksa SHK<p style="font-size:10px;">Bayi perempuan diperiksa Skrining Hipotiroid Kongenital (SHK)</p></th>
                            <td class="text-left">{{ $data['lb3bayi']['bbl_pd_shk'] }}</td>
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
