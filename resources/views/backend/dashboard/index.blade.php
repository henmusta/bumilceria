@extends('backend.layouts.master')

{{-- @section('title') {{ $config['page_title'] }} @endsection --}}

@section('content')
<div class="card position-relative overflow-hidden">
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

                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label for="select2Puskesmas">UPDT Puskesmas<span class="text-danger"></span></label>
                                            <select id="select2Puskesmas" name="updt_puskesmas_id[]"  style="width: 100% !important;" class="js-example-basic-multiple"  multiple="multiple" style="width: 100% !important;" name="updt_puskesmas_id">

                                            </select>
                                          </div>
                                    </div>
                                    <div class="col-md-5">

                                          <label>Filter Bulan Tahun</label>
                                            <div class="row">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <select id="select2Datepicker" style="width: 100% !important;" name="tanggal_awal">
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <span class="input-group-text" id="basic-addon2">S/D</span>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <select id="select2DatepickerAkhir" style="width: 100% !important;" name="tanggal_akhir">
                                                        </select>
                                                    </div>
                                                </div>



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
    </div>

        <div class="card-body">
            <div class="row">

                <div class="col-sm-6 col-xl-6">
                <div class="card bg-light-danger shadow-none">
                    <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="round rounded bg-danger d-flex align-items-center justify-content-center">
                        <i class="cc XRP text-white fs-7" title="XRP"></i>
                        </div>
                        <h6 class="mb-0 ms-3">Total Pengguna</h6>
                        <div class="ms-auto text-danger d-flex align-items-center">
                            <h3 class="mb-0 fw-semibold fs-7" id="pengguna"></h3>

                        </div>
                    </div>

                    </div>
                </div>
                </div>

                <div class="col-sm-6 col-xl-6">
                <div class="card bg-light-warning shadow-none">
                    <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="round rounded bg-warning d-flex align-items-center justify-content-center">
                        <i class="cc XRP text-white fs-7" title="XRP"></i>
                        </div>
                        <h6 class="mb-0 ms-3">Total Updt Puskesmas</h6>
                        <div class="ms-auto text-info d-flex align-items-center">
                            <h3 class="mb-0 fw-semibold fs-7" id="puskesmas"></h3>
                        </div>
                    </div>

                    </div>
                </div>
                </div>
            </div>
            <div class="row" style="padding-top:15px">
                <div class="col-sm-12">
                   <div class="chartjs-wrapper-demo">
                    <canvas id="ChartAreaStatistik"></canvas>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script>


    let myChartStatistik;
    let select2Datepicker = $('#select2Datepicker');
    let select2DatepickerAkhir = $('#select2DatepickerAkhir');
    let select2Puskesmas = $('#select2Puskesmas');
    $(document).ready(function () {
      counttotal();


      select2Datepicker.select2({
        dropdownParent:select2Datepicker.parent(),
        searchInputPlaceholder: 'Cari',
        width: '100%',
        placeholder: 'select bulan Tahun',
        ajax: {
          url: "{{ route('datepicker.index') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
            //   id : $('#user_puskes_id').val(),
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
      });


      select2DatepickerAkhir.select2({
        dropdownParent:select2DatepickerAkhir.parent(),
        searchInputPlaceholder: 'Cari',
        width: '100%',
        placeholder: 'select bulan Tahun',
        ajax: {
          url: "{{ route('datepicker.index') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
            //   id : $('#user_puskes_id').val(),
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
      });


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
      });

      $("#terapkan_filter").click(function() {
        counttotal();
      });


    });

        var id =$('#user_puskes_id').val();
        var name =$('#user_puskes_name').val();
        if(id != ''){
            loadsupplier(id, name);
        }

        function loadsupplier(id, name){
            var option = new Option(name, id, true, true);
            $('#select2Puskesmas').append(option).trigger('change');
            counttotal();
        }


    function counttotal(){
        let params = new URLSearchParams({
            tgl_awal : select2Datepicker.find(":selected").val() || '',
            tgl_akhir : select2DatepickerAkhir.find(":selected").val() || '',
            puskesmas_id : select2Puskesmas.find(":selected").val() || ''
        });

           var url = "dashboard/countadmin?" + params.toString();
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#pengguna').html(data.data.pengguna);
                    $('#puskesmas').html(data.data.puskesmas);
                    let ctxStatistik = document.getElementById("ChartAreaStatistik");
                    ctxStatistik.height = 1000;
                        myChartStatistik =
                        new Chart(ctxStatistik, {
                        type: "line",
                        data: data.data.ChartLineStatistikJson,
                        options: {
                            plugins: {
                                // datalabels: {
                                //     display: false,
                                // }
                              },
                            title: {
                                display: true,
                                text: 'Statistik Penginputan Total'
                            },
                            responsive: true,
                            maintainAspectRatio: false,
                            // tooltips: {
                            // mode: 'index',
                            //   intersect: false
                            // },
                            // hover: {
                            // mode: 'nearest',
                            //   intersect: true
                            // },
                            legend: {
                            labels: {
                                fontColor: "#77778e"
                            },
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        callback: function (value) { if (Number.isInteger(value)) { return value; } },
                                        stepSize: 1,
                                    }
                                }]
                            }
                        }
                    });

                }
            });

    }






 </script>
@endsection
