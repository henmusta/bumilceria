<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Supplier;
use App\Models\ReceiveOrder;
use App\Models\ReceiveOrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;
use Illuminate\Routing\Controller;
use PDF;

class ReportValueRoController extends Controller
{

    use ResponseStatus;

    public function data(Request $request, $type){
        $tgl_awal = date('Y-m-d', strtotime($request['tgl_awal']));
        $tgl_akhir =  date('Y-m-d', strtotime($request['tgl_akhir']));
        $supplier_id = ($type == 'create') ? $request['supplier_id'] :  explode(',',$request['supplier_id']);
        $item_id =  ($type == 'create') ?   $request['item_id'] :  explode(',',  $request['item_id']);
        $category_id =  ($type == 'create') ? $request['category_id'] :  explode(',',$request['category_id']);
        $data = ReceiveOrderItem::SelectRaw('suppliers.name as name, sum(receive_order_items.qty * receive_order_items.cost) as total')
                ->join('receive_orders', 'receive_orders.id', '=', 'receive_order_items.receive_order_id')
                ->join('suppliers', 'suppliers.id', '=', 'receive_orders.supplier_id')

                ->when($tgl_awal, function ($query, $tgl_awal) {
                    return $query->whereDate('receive_orders.record_at', '>=',  $tgl_awal);
                })
                ->when($tgl_akhir, function ($query, $tgl_akhir) {
                    return $query->whereDate('receive_orders.record_at', '<=', $tgl_akhir);
                })  ->where('receive_orders.status', '1');


                              if ($request->filled('supplier_id')) {
                                  $data->whereIn('receive_orders.supplier_id', $supplier_id );
                              }
                              $data->groupBy('receive_orders.supplier_id');
        return $data;
    }


    public function index(Request $request)
    {

        $config['page_title'] = "Rekapitulasi Nilai Penerimaan";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Rekapitulasi Nilai Penerimaan"],
        ];

        if ($request->ajax()) {
          $data = $this->data($request, 'create');
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
        }

        return view('backend.nilaipenerimaan.index', compact('config', 'page_breadcrumbs'));
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
        $pdf =  PDF::loadView('backend.nilaipenerimaan.pdf.pdf',  compact('data'));
        $fileName = 'Rekapitulasi-Nilai-Penerimaan : '. $tgl_awal . '-SD-' .$tgl_akhir;

        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream("${fileName}.pdf");
    }
}
