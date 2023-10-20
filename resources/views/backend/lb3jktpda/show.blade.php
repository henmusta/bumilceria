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
              <td style="width: 50%; font-weight: bold; font-size: 12px; text-align: left"> Data LB3 Jenis Kekerasan Pada Anak Dan Perempuan - {{$data['lb3jktpda']['puskesmas']['name']}} - {{$data['lb3jktpda']['tanggal']}}</td>
              <td style="width: 50%; font-weight: normal; text-align: right">  Tanggal Buat : {{ \Carbon\Carbon::parse($data['lb3jktpda']['created_at'])->isoFormat('dddd, D MMMM Y')}}</td>
            </tr>
          </table><br><br>
        <div class="row" style="padding-top:10px;">
            <div class="col-12">
                <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>0 sampai 15</th>
                            <th>16 sampai 45</th>
                            <th>46 sampai 60</th>
                            <th>60 Keatas</th>
                          </tr>
                    </thead>
                    <tbody>

                        @foreach ($data['lb3jktpdadetail'] as $val)
                            <tr>
                                <td>{{$val->name}}</td>
                                <td class="text-center">{{$val['0_sampai_15']}}</td>
                                <td class="text-center">{{$val['16_sampai_45']}}</td>
                                <td class="text-center">{{$val['46_sampai_60']}}</td>
                                <td class="text-center">{{$val['60_keatas']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="mb-3">
                <label for="Nama">Ketarangan<span class="text-danger">*</span></label>
                <textarea class="form-control" value="{{$data['lb3jktpda']['keterangan']}}"  name="keterangan"></textarea>
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
