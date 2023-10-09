<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Traits\NoUrutTrait;
use App\Helpers\PenyesuaianStok;
use App\Models\ReturnReceiveOrder;
use App\Models\ReturnReceiveOrderItem;
use Carbon\Carbon;
use App\Models\StockBalances;
use App\Models\StockCards;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;
use Illuminate\Routing\Controller;


class ReturnRoController extends Controller
{
    use ResponseStatus,NoUrutTrait;
    public function index(Request $request)
    {

      $config['page_title'] = "Retur Penerimaan";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "Retur Penerimaan"],
      ];

      if ($request->ajax()) {
        $data = ReturnReceiveOrder::with('supplier');
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $show = '<a href="' . route('backend.returpenerimaan.show', $row->id) . '" class="dropdown-item" >Detail</a>';
            $edit = ($row->status == 0) ? ' <a class="dropdown-item" href="returpenerimaan/' . $row->id . '/edit">Ubah</a>' : '';
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
      return view('backend.returpenerimaan.index', compact('config', 'page_breadcrumbs'));
    }

    public function create()
    {
      $config['page_title'] = "Tambah Retur Penerimaan";
      $page_breadcrumbs = [
        ['url' => route('backend.penerimaan.index'), 'title' => "Daftar Retur Penerimaan"],
        ['url' => '#', 'title' => "Tambah Retur Penerimaan"],
      ];
      return view('backend.returpenerimaan.create', compact('page_breadcrumbs', 'config'));
    }



    public function store(Request $request)
    {
        // dd($request);

          $validator = Validator::make($request->all(), [
            'supplier_id' =>  'required',
            'record_at'=>  'required',
            'sum_total_cost'=>  'required',
            'status'=>  'required',
          ]);

        //   dd($request);

          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                  $kode =  $this->KodeRRo(Carbon::parse($request['record_at'])->format('d M Y'));
                  $rro =  ReturnReceiveOrder::create([
                    'code' =>$kode,
                    'supplier_id' =>   $request['supplier_id'],
                    'record_at'=>   $request['record_at'],
                    'status'=>   $request['status'],
                    'description' => $request['description']
                  ]);

                    $grandtotal = 0;
                    if(isset($request['rincian'])){
                        foreach($request['rincian'] as $val){
                            $grandtotal += $val['total_cost'];
                            $rro_item = ReturnReceiveOrderItem::create([
                                    'return_receive_order_id'=> $rro['id'],
                                    'code'=> $rro['code'],
                                    'item_id'=> $val['item_id'],
                                    'qty'=> $val['qty'],
                                    'cost'=> $val['cost'],
                                    'total_cost'=> $val['total_cost']
                            ]);
                            if( $request['status'] == '1'){
                                 $info = [
                                    'qty' => $val['qty'] * -1,
                                    'reference_type' => 'ReturnReceiveOrder',
                                    'link' => strval(route('backend.returpenerimaan.show', $rro['id'])),
                                 ];
                                 $ps = PenyesuaianStok::stockbalance($val, $rro, $info);
                            }
                        }


                    }
                    $rro->update([
                        'sum_total_cost'=>  $grandtotal
                    ]);


                    DB::commit();
                    $response = response()->json($this->responseStore(true, route('backend.returpenerimaan.index')));
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
        $config['page_title'] = "Detail Retur Penerimaan";

        $page_breadcrumbs = [
          ['url' => route('backend.returpenerimaan.index'), 'title' => "Daftar Retur Penerimaan"],
          ['url' => '#', 'title' => "Detail Retur Penerimaan"],
        ];

        $rro =  ReturnReceiveOrder::with('supplier')->findOrFail($id);
        $rro_item =  ReturnReceiveOrderItem::with('item')->where('return_receive_order_id',  $rro['id'])->get();

        $data = [
          'rro' => $rro,
          'rro_item' => $rro_item,
        ];

        return view('backend.returpenerimaan.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function edit($id)
    {
        $config['page_title'] = "Ubah Retur Penerimaan";

        $page_breadcrumbs = [
          ['url' => route('backend.returpenerimaan.index'), 'title' => "Daftar Retur Penerimaan"],
          ['url' => '#', 'title' => "Ubah Retur Pennerimaan"],
        ];
        $rro =  ReturnReceiveOrder::with('supplier')->findOrFail($id);
        $rro_item =  ReturnReceiveOrderItem::with('item')->where('return_receive_order_id',  $rro['id'])->get();

        $data = [
          'rro' => $rro,
          'rro_item' => $rro_item,
        ];

        return view('backend.returpenerimaan.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' =>  'required',
            'record_at'=>  'required',
            'sum_total_cost'=>  'required',
            'status'=>  'required',
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $rro = ReturnReceiveOrder::find($id);
                $rro->update([
                    'supplier_id' =>   $request['supplier_id'],
                    'record_at'=>   $request['record_at'],
                    'status'=>   $request['status'],
                    'description' => $request['description']
                ]);
                $grandtotal = 0;
                if(isset($request['rincian'])){
                    $rro_item_id = array();
                    foreach($request['rincian'] as $val){
                        $grandtotal += $val['total_cost'];
                        $rro_item = ReturnReceiveOrderItem::updateOrCreate([
                            'id' => $val['id']
                        ],[
                            'return_receive_order_id'=> $rro['id'],
                            'code'=> $rro['code'],
                            'item_id'=> $val['item_id'],
                            'qty'=> $val['qty'],
                            'cost'=> $val['cost'],
                            'total_cost'=> $val['total_cost']
                        ]);
                        $rro_item_id[] = $rro_item['id'];

                        if( $request['status'] == '1'){
                            $info = [
                               'qty' => $val['qty'] * -1,
                               'reference_type' => 'ReturnReceiveOrder',
                               'link' => strval(route('backend.returpenerimaan.show', $rro['id'])),
                            ];
                            $ps = PenyesuaianStok::stockbalance($val, $rro, $info);
                       }
                    }
                    $cek_rro_item = ReturnReceiveOrderItem::where([
                        ['return_receive_order_id' , $rro['id']],
                    ])->whereNotIn('id', $rro_item_id);
                    if(isset($cek_rro_item)){
                        $cek_rro_item->delete();
                    }

                }
                $rro->update([
                    'sum_total_cost'=>  $grandtotal
                ]);
                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.returpenerimaan.index')));
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
            $data = ReturnReceiveOrder::findOrFail($id);
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
