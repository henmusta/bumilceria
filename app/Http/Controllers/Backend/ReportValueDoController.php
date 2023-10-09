<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\DeliveryOrders;
use App\Models\DeliveryOrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;
use Illuminate\Routing\Controller;
use PDF;


class ReportValueDoController extends Controller
{
    use ResponseStatus;

    public function data(Request $request, $type){
        $tgl_awal = date('Y-m-d', strtotime($request['tgl_awal']));
        $tgl_akhir =  date('Y-m-d', strtotime($request['tgl_akhir']));
        $store_id = ($type == 'create') ? $request['store_id'] :  explode(',',$request['store_id']) ;
        $data = DeliveryOrderItem::SelectRaw('stores.name as name, sum(delivery_order_items.qty) as sum_qty, sum((delivery_order_items.qty)  * delivery_order_items.cost) as total_modal, sum((delivery_order_items.qty)  * delivery_order_items.price) as total_harga')
        ->join('delivery_orders', 'delivery_orders.id', '=', 'delivery_order_items.delivery_order_id')
        ->join('stores', 'stores.id', '=', 'delivery_orders.store_id')
        ->when($tgl_awal, function ($query, $tgl_awal) {
            return $query->whereDate('delivery_orders.record_at', '>=',  $tgl_awal);
        })
        ->when($tgl_akhir, function ($query, $tgl_akhir) {
            return $query->whereDate('delivery_orders.record_at', '<=', $tgl_akhir);
        })
        ->where('delivery_orders.status', '1');

                              if ($request->filled('store_id')) {
                                  $data->whereIn('delivery_orders.store_id', $store_id );
                              }
                              $data->groupBy('delivery_orders.store_id');
        return $data;
    }


    public function index(Request $request)
    {

        $config['page_title'] = "Rekapitulasi Nilai Pengiriman";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Rekapitulasi Nilai Pengiriman"],
        ];

        if ($request->ajax()) {
          $data = $this->data($request, 'create');
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
        }

        return view('backend.nilaipengiriman.index', compact('config', 'page_breadcrumbs'));
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
        $pdf =  PDF::loadView('backend.jumlahpengiriman.pdf.pdf',  compact('data'));
        $fileName = 'Rekapitulasi-Jumlah-Pengiriman : '. $tgl_awal . '-SD-' .$tgl_akhir;

        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream("${fileName}.pdf");
    }
}
