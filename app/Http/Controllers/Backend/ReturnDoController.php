<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Traits\NoUrutTrait;
use App\Helpers\PenyesuaianStok;
use App\Models\ReturnDeliveryOrder;
use App\Models\ReturnDeliveryOrderItem;
use Carbon\Carbon;
use App\Models\StockBalances;
use App\Models\StockCards;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;
use Illuminate\Routing\Controller;


class ReturnDoController extends Controller
{
    use ResponseStatus,NoUrutTrait;
    public function index(Request $request)
    {

      $config['page_title'] = "Retur Pengiriman";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "Retur Pengiriman"],
      ];

      if ($request->ajax()) {

        $data = ReturnDeliveryOrder::with('store');
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $show = '<a href="' . route('backend.returpengiriman.show', $row->id) . '" class="dropdown-item" >Detail</a>';
            $edit = ($row->status == 0) ? ' <a class="dropdown-item" href="returpengiriman/' . $row->id . '/edit">Ubah</a>' : '';
            $hapus = ($row->status == 0) ? ' <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>' : '';
          return '<div class="dropdown">
                      <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                          Aksi <i class="mdi mdi-chevron-down"></i>
                      </a>
                      <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                            '.$show.'
                            '.$edit.'
                            '.$hapus.'
                      </div>
                  </div>';

          })
          ->rawColumns(['action'])
          ->make(true);
      }
      return view('backend.returpengiriman.index', compact('config', 'page_breadcrumbs'));
    }



    public function create()
    {
      $config['page_title'] = "Tambah Retur Pengiriman";
      $page_breadcrumbs = [
        ['url' => route('backend.returpengiriman.index'), 'title' => "Daftar Pengiriman"],
        ['url' => '#', 'title' => "Tambah Pengiriman"],
      ];
      return view('backend.returpengiriman.create', compact('page_breadcrumbs', 'config'));
    }

    public function store(Request $request)
    {
        // dd($request);

          $validator = Validator::make($request->all(), [
            'store_id' =>  'required',
            'record_at'=>  'required',
            // 'sum_total_cost'=>  'required',
            'sum_total_price'=>  'required',
            'status'=>  'required',
          ]);

        //   dd($request);

          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                  $kode =  $this->KodeRDo(Carbon::parse($request['record_at'])->format('d M Y'));
                  $rdo =  ReturnDeliveryOrder::create([
                    'code' =>$kode,
                    'store_id' =>   $request['store_id'],
                    'record_at'=>   $request['record_at'],
                    'status'=>   $request['status'],
                    'description' => $request['description']
                  ]);

                    $modaltotal = 0;
                    $hargatotal = 0;
                    if(isset($request['rincian'])){
                        foreach($request['rincian'] as $val){
                            $barang = Item::findOrFail($val['item_id']);
                            $subcost = $val['qty'] * $barang['current_cost'];

                            $modaltotal += $subcost;
                            $hargatotal += $val['total_price'];
                            $percent_markup = (($val['total_price'] -  $subcost) / $val['total_price']) * 100;
                            $rdo_item = ReturnDeliveryOrderItem::create([
                                    'return_delivery_order_id' => $rdo['id'],
                                    'code'=> $rdo['code'],
                                    'item_id'  => $val['item_id'],
                                    'qty'  => $val['qty'],
                                    'cost'  =>  $barang['current_cost'],
                                    'price'  => $val['price'],
                                    'percent_price_markup'   =>  $percent_markup,
                                    'total_cost' => $subcost,
                                    'total_price' => $val['total_price']
                            ]);
                            if( $request['status'] == '1'){
                                 $info = [
                                    'qty' => $val['qty'],
                                    'reference_type' => 'ReturnDeliveryOrder',
                                    'link' => strval(route('backend.returpengiriman.show', $rdo['id'])),
                                 ];
                                 $ps = PenyesuaianStok::stockbalance($val, $rdo, $info);
                            }
                        }


                    }
                    $total_percent_markup = (( $hargatotal -  $modaltotal) / $hargatotal) * 100;
                    $rdo->update([
                        'sum_total_cost'=>  $modaltotal,
                        'sum_total_price'=>  $hargatotal,
                        'sum_percent_price_markup' => $total_percent_markup
                    ]);


                    DB::commit();
                    $response = response()->json($this->responseStore(true, route('backend.returpengiriman.index')));
            } catch (Throwable $throw) {
              dd($throw);
              DB::rollBack();
              $response = response()->json($this->responseStore(false));
            }
          } else {
            $response = response()->json(['error' => $validator->errors()->all()]);
          }
          return $response;
    }



    public function show($id)
    {
        $config['page_title'] = "Detail Retur Pengiriman";

        $page_breadcrumbs = [
          ['url' => route('backend.returpengiriman.index'), 'title' => "Daftar Retur Pengiriman"],
          ['url' => '#', 'title' => "Detail Retur Pengiriman"],
        ];

        $rdo =  ReturnDeliveryOrder::with('store')->findOrFail($id);

        $rdo_item =  ReturnDeliveryOrderItem::with('item')->where('return_delivery_order_id',  $rdo['id'])->get();

        $data = [
          'rdo' => $rdo,
          'rdo_item' => $rdo_item,
        ];

        return view('backend.returpengiriman.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function edit($id)
    {
        $config['page_title'] = "Ubah Retur Pengiriman";

        $page_breadcrumbs = [
          ['url' => route('backend.returpengiriman.index'), 'title' => "Daftar Pengiriman"],
          ['url' => '#', 'title' => "Ubah Retur Pengiriman"],
        ];

        $rdo =  ReturnDeliveryOrder::with('store')->findOrFail($id);

        $rdo_item =  ReturnDeliveryOrderItem::with('item')->where('return_delivery_order_id',  $rdo['id'])->get();

        $data = [
          'rdo' => $rdo,
          'rdo_item' => $rdo_item,
        ];

        return view('backend.returpengiriman.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'store_id' =>  'required',
            'record_at'=>  'required',
            // 'sum_total_cost'=>  'required',
            'sum_total_price'=>  'required',
            'status'=>  'required',
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $rdo = ReturnDeliveryOrder::find($id);
                $rdo->update([
                    'store_id' =>   $request['store_id'],
                    'record_at'=>   $request['record_at'],
                    'status'=>   $request['status'],
                    'description' => $request['description']
                ]);
                $modaltotal = 0;
                $hargatotal = 0;
                if(isset($request['rincian'])){
                    $rdo_item_id = array();
                    foreach($request['rincian'] as $val){
                        $barang = Item::findOrFail($val['item_id']);
                        $subcost = $val['qty'] * $barang['current_cost'];
                        $modaltotal += $subcost;
                        $hargatotal += $val['total_price'];
                        $percent_markup = (($val['total_price'] -  $subcost) / $val['total_price']) * 100;
                        $rdo_item = ReturnDeliveryOrderItem::updateOrCreate([
                            'id' => $val['id']
                        ],[
                            'return_delivery_order_id' => $rdo['id'],
                            'code'=> $rdo['code'],
                            'item_id'  => $val['item_id'],
                            'qty'  => $val['qty'],
                            'cost'  =>  $barang['current_cost'],
                            'price'  => $val['price'],
                            'percent_price_markup'   =>  $percent_markup,
                            'total_cost' => $subcost,
                            'total_price' => $val['total_price']
                        ]);
                        $rdo_item_id[] = $rdo_item['id'];

                        if( $request['status'] == '1'){
                            $info = [
                                'qty' => $val['qty'],
                                'reference_type' => 'ReturnDeliveryOrder',
                                'link' => strval(route('backend.returpengiriman.show', $rdo['id'])),
                             ];
                             $ps = PenyesuaianStok::stockbalance($val, $rdo, $info);
                       }
                    }
                    $cek_rdo_item = ReturnDeliveryOrderItem::where([
                        ['return_delivery_order_id' , $rdo['id']],
                    ])->whereNotIn('id', $rdo_item_id);
                    if(isset($cek_rdo_item)){
                        $cek_rdo_item->delete();
                    }

                    // if(isset($cek_ro_item)){
                    //    dd($cek_stockcard_ro);
                    // }


                }
                $total_percent_markup = (( $hargatotal -  $modaltotal) / $hargatotal) * 100;
                $rdo->update([
                    'sum_total_cost'=>  $modaltotal,
                    'sum_total_price'=>  $hargatotal,
                    'sum_percent_price_markup' => $total_percent_markup
                ]);
                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.returpengiriman.index')));
            } catch (Throwable $throw) {
                dd($throw);
                DB::rollBack();
                $response = response()->json($this->responseStore(false));
            }
          } else {
            $response = response()->json(['error' => $validator->errors()->all()]);
          }
          return $response;
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data = DeliveryOrder::findOrFail($id);
            if ($data->delete()) {
              DB::commit();
              $response = response()->json($this->responseDelete(true));
            }
        } catch (Throwable $throw) {
            dd($throw);
            DB::rollBack();
            $response = response()->json($this->responseStore(false));
        }
        return $response;
    }
}
