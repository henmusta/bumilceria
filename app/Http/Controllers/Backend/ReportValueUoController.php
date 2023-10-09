<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\UsageOrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;
use Illuminate\Routing\Controller;
use PDF;



class ReportValueUoController extends Controller
{
    use ResponseStatus;

    public function data(Request $request, $type){
        $tgl_awal = date('Y-m-d', strtotime($request['tgl_awal']));
        $tgl_akhir =  date('Y-m-d', strtotime($request['tgl_akhir']));
        $item_id =  ($type == 'create') ?   $request['item_id'] :  explode(',',  $request['item_id']);
        $divisi_id = ($type == 'create') ? $request['divisi_id'] :  explode(',',$request['divisi_id'])  ;
        $category_id =  ($type == 'create') ? $request['category_id'] :  explode(',',$request['category_id']);
        $data = UsageOrderItem::SelectRaw('departements.name as name, sum(usage_order_items.qty) as sum_qty, sum((usage_order_items.qty) * usage_order_items.cost) as total')
        ->join('usage_orders', 'usage_orders.id', '=', 'usage_order_items.usage_order_id')
        ->join('departements', 'departements.id', '=', 'usage_orders.departement_id')
        ->when($tgl_awal, function ($query, $tgl_awal) {
            return $query->whereDate('usage_orders.record_at', '>=',  $tgl_awal);
        })
        ->when($tgl_akhir, function ($query, $tgl_akhir) {
            return $query->whereDate('usage_orders.record_at', '<=', $tgl_akhir);
        })
        ->where('usage_orders.status', '1');
                              if ($request->filled('divisi_id')) {
                                  $data->whereIn('usage_orders.departement_id',  $divisi_id );
                              }
                              $data->groupBy('usage_orders.departement_id');
        return $data;
    }



    public function index(Request $request)
    {

        $config['page_title'] = "Rekapitulasi Nilai Pemakaian";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Rekapitulasi Nilai Pemakaian"],
        ];

        if ($request->ajax()) {
          $data = $this->data($request, 'create');
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
        }

        return view('backend.nilaipemakaian.index', compact('config', 'page_breadcrumbs'));
    }


    public function pdf(Request $request)
    {


        $get_data = $this->data($request, 'pdf');
        $tgl_awal = date('Y-m-d', strtotime($request['tgl_awal']));
        $tgl_akhir =  date('Y-m-d', strtotime($request['tgl_akhir']));
        $data = [
            'tgl_awal' => $request['tgl_awal'],
            'tgl_akhir' => $request['tgl_akhir'],
            'get_data' =>  $get_data->get(),
        ];
        $pdf =  PDF::loadView('backend.nilaipemakaian.pdf.pdf',  compact('data'));
        $fileName = 'Rekapitulasi-Nilai-Pemakaian : '. $tgl_awal . '-SD-' .$tgl_akhir;

        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream("${fileName}.pdf");
    }
}
