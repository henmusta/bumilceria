<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lb3Jktpda;
use App\Models\Lb3JktpdaDetail;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class Lb3JktpdaController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {

      $config['page_title'] = "LB3 Jenis Kekerasan Terhadap Peremuan dan Anak";
      $page_breadcrumbs = [
        ['url' => '/', 'title' => "LB3 Jenis Kekerasan Terhadap Peremuan dan Anak"],
      ];

      if ($request->ajax()) {
        $data = Lb3Jktpda::selectRaw('lb3_jktpda.*')->with('puskesmas');
        if ($request->filled('puskesmas_id')) {
            $data->where('puskesmas_id',  $request['puskesmas_id']);
        }
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $show = '<a href="' . route('backend.lb3jktpda.show', $row->id) . '" class="dropdown-item" >Detail</a>';
          return '<div class="dropdown">
                      <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                          Aksi <i class="mdi mdi-chevron-down"></i>
                      </a>
                      <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                          '. $show.'
                          <a class="dropdown-item" href="lb3jktpda/' . $row->id . '/edit">Ubah</a>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                      </div>
                  </div>';

          })
          ->addColumn('tanggal', function ($row) {
            return Carbon::parse($row->tanggal)->isoFormat('MMMM YYYY');
          })
          ->rawColumns(['action', 'tanggal'])
          ->make(true);
      }
      return view('backend.lb3jktpda.index', compact('config', 'page_breadcrumbs'));
    }


    public function create()
    {
      $config['page_title'] = "Tambah Jenis Kekerasan Terhadap Peremuan dan Anak";
      $page_breadcrumbs = [
        ['url' => route('backend.lb3ibuhamil.index'), 'title' => "Daftar Jenis Kekerasan Terhadap Peremuan dan Anak"],
        ['url' => '/', 'title' => "Tambah Jenis Kekerasan Terhadap Peremuan dan Anak"],
      ];
      return view('backend.lb3jktpda.create', compact('page_breadcrumbs', 'config'));
    }


    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'updt_puskesmas_id' => 'required',
            'keterangan'  => 'required',
          ]);

          if ($validator->passes()) {

            DB::beginTransaction();
            try {
                 $cek = ['tanggal'=> $request['tanggal'],  'puskesmas_id' =>  $request['updt_puskesmas_id']];
                 $data = Lb3Jktpda::updateOrCreate($cek,[
                    'tanggal' =>  $request['tanggal'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'keterangan'  => $request['keterangan'],
                 ]);
                //  dd($request['detail']);
            foreach($request['detail'] as $val){
                if(!$data->wasRecentlyCreated && $data->wasChanged()){
                        $datadetail = Lb3JktpdaDetail::where([
                            ['name', $val['name']],
                            ['lb3_jktpda_id', $data['id']]]);
                        $datadetail->update([
                            'tanggal' =>  $data['tanggal'],
                            'puskesmas_id' =>  $data['puskesmas_id'],
                            '0_sampai_15' =>  $val['0_sampai_15'],
                            '16_sampai_45' =>  $val['16_sampai_45'],
                            '46_sampai_60' =>  $val['46_sampai_60'],
                            '60_keatas' =>  $val['60_keatas']
                        ]);
                }

                if($data->wasRecentlyCreated){
                    $datadetail = Lb3JktpdaDetail::create([
                        'tanggal' =>  $data['tanggal'],
                        'puskesmas_id' =>  $data['puskesmas_id'],
                        'lb3_jktpda_id' => $data['id'],
                        'name' => $val['name'],
                        '0_sampai_15' =>  $val['0_sampai_15'],
                        '16_sampai_45' =>  $val['16_sampai_45'],
                        '46_sampai_60' =>  $val['46_sampai_60'],
                        '60_keatas' =>  $val['60_keatas']
                    ]);
                }

            }


              DB::commit();
              $response = response()->json($this->responseStore(true, route('backend.lb3jktpda.index')));
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
        $config['page_title'] = "Detail Jenis Kekerasan Terhadap Peremuan dan Anak";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3jktpda.index'), 'title' => "Daftar Jenis Kekerasan Terhadap Peremuan dan Anak"],
          ['url' => '/', 'title' => "Detail Jenis Kekerasan Terhadap Peremuan dan Anak"],
        ];
        $lb3jktpda = Lb3Jktpda::selectRaw('lb3_jktpda.*')->with('puskesmas')->findOrFail($id);
        $lb3jktpdadetail = Lb3JktpdaDetail::selectRaw('lb3_jktpda_detail.*')->with('jktpda')->where('lb3_jktpda_id', $id)->get();
        $data = [
          'lb3jktpda' =>  $lb3jktpda,
          'lb3jktpdadetail' =>  $lb3jktpdadetail,
        ];

        return view('backend.lb3jktpda.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function edit($id)
    {
        $config['page_title'] = "Update Jenis Kekerasan Terhadap Peremuan dan Anak";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3jktpda.index'), 'title' => "Daftar Jenis Kekerasan Terhadap Peremuan dan Anak"],
          ['url' => '#', 'title' => "Update Jenis Kekerasan Terhadap Peremuan dan Anak"],
        ];
        $lb3jktpda = Lb3Jktpda::selectRaw('lb3_jktpda.*')->with('puskesmas')->findOrFail($id);
        $lb3jktpdadetail = Lb3JktpdaDetail::selectRaw('lb3_jktpda_detail.*')->with('jktpda')->where('lb3_jktpda_id', $id)->get();
        $data = [
          'lb3jktpda' =>  $lb3jktpda,
          'lb3jktpdadetail' =>  $lb3jktpdadetail,
        ];


        return view('backend.lb3jktpda.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'updt_puskesmas_id' => 'required',
            'keterangan'  => 'required',
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                //  $data = Lb3ibuhamil::find($id);
                 $cek_uniqe = Lb3Jktpda::where([
                    ['tanggal' ,  $request['tanggal']],
                    ['puskesmas_id' ,  $request['updt_puskesmas_id']],
                    ['id' , '!=' , $id]
                 ])->first();
                 if(isset($cek_uniqe)){
                    $response = response()->json([
                        'error' => true,
                        'message' => 'Data Tanggal Dan Kecamatan Yang Sama Telah Ada Sebelumnya',
                    ]);
                 }else{
                    $data =  Lb3Jktpda::findOrFail($id);

                    $data->updateOrCreate([
                        'tanggal' =>  $request['tanggal'],
                        'puskesmas_id' =>  $request['updt_puskesmas_id'],
                        'keterangan'  => $request['keterangan'],
                     ]);
                     foreach($request['detail'] as $val){
                        $datadetail = Lb3JktpdaDetail::findOrFail($val['id']);
                        $datadetail->update([
                            'tanggal' =>  $data['tanggal'],
                            'puskesmas_id' =>  $data['puskesmas_id'],
                            '0_sampai_15' =>  $val['0_sampai_15'],
                            '16_sampai_45' =>  $val['16_sampai_45'],
                            '46_sampai_60' =>  $val['46_sampai_60'],
                            '60_keatas' =>  $val['60_keatas']
                        ]);
                    }
                    DB::commit();
                   $response = response()->json($this->responseStore(true, route('backend.lb3jktpda.index')));
                 }



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
            $data = Lb3Jktpda::findOrFail($id);
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
