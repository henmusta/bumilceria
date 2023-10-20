<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use App\Models\Puskesmas;
use App\Models\Lb3Ibuhamil;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
      $config['page_title'] = "DASHBOARD";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "DASHBOARD"],
      ];
      return view('backend.dashboard.index', compact('config', 'page_breadcrumbs'));
    }

    public function countadmin(Request $request){
        // dd($request);
            $tgl_awal = $request['tgl_awal'];
            $tgl_akhir = $request['tgl_akhir'];
            $puskesmas_id = $request['puskesmas_id'] != null ? explode(',', $request['puskesmas_id']) : $request['puskesmas_id'];


            $totalPengguna = User::query()
            ->when($puskesmas_id, function ($query, $puskesmas_id) {
                return $query->whereIn('puskesmas_id',  $puskesmas_id);
            })->count();

            $totalPuskesmas = Puskesmas::query()->count();


            // $r = 0;
            // $g = 0;
            // $b = 0;


            if(isset($tgl_awal)){
                $startDate = $request['tgl_awal'];
            }else{
                $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
            }
            if(isset($tgl_akhir)){
                $endDate = $request['tgl_akhir'];
            }else{
                $endDate = Carbon::now()->endOfYear()->format('Y-m-d');
            }


            $dateRange = [];
            $dateRangePeriod = CarbonPeriod::create($startDate,  '1 month', $endDate);
            foreach ($dateRangePeriod as $date) {
                $dateRange[] = Carbon::createFromFormat('Y-m-d', $date->toDateString())->format('F Y');
                $table = ['lb3_ibu_hamil','lb3_ibu_bersalin', 'lb3_balita', 'lb3_bayi', 'lb3_brtk', 'lb3_jktpda', 'lb3_kytd', 'lb3_rtk', 'lbtt', 'lki'];
                $grandtotal = 0;
                foreach($table as $val){
                    $total = DB::table($val)
                    ->when($puskesmas_id, function ($query, $puskesmas_id) {
                        return $query->whereIn('puskesmas_id',  $puskesmas_id);
                    })->whereMonth('tanggal', $date->format('m'))->whereYear('tanggal', $date->format('Y'))->count();

                    $grandtotal += $total;
                }

                $dataStatistik[] = [
                    'total' => $grandtotal
                ];

              }


            $ChartLineStatistik = [
                'labels' => $dateRange,
                'datasets' => [
                [
                    'label' => "Total Input",
                    'borderColor' => "rgba(113, 76, 190, 0.9)",
                    'borderWidth' => "1",
                    'data' => collect($dataStatistik)->pluck('total')
                ]
                ]
            ];


            $data = [
                'pengguna' =>  $totalPengguna,
                'puskesmas' =>  $totalPuskesmas,
                'ChartLineStatistikJson' => $ChartLineStatistik
            ];

           $results = array(
             "data" =>  $data
           );

          return response()->json($results);

    }

}
