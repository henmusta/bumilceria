<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lb3Kytd;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class Lb3KytdController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {

      $config['page_title'] = "LB3 Kehamilan Tidak Diinginkan";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "LB3 Kehamilan Tidak Diinginkan"],
      ];

      if ($request->ajax()) {
        $data = Lb3Kytd::selectRaw('lb3_kytd.*')->with('puskesmas');
        if ($request->filled('puskesmas_id')) {
            $data->where('puskesmas_id',  $request['puskesmas_id']);
        }
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $show = '<a href="' . route('backend.lb3kytd.show', $row->id) . '" class="dropdown-item" >Detail</a>';
          return '<div class="dropdown">
                      <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                          Aksi <i class="mdi mdi-chevron-down"></i>
                      </a>
                      <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                          '. $show.'
                          <a class="dropdown-item" href="lb3kytd/' . $row->id . '/edit">Ubah</a>
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
      return view('backend.lb3kytd.index', compact('config', 'page_breadcrumbs'));
    }


    public function create()
    {
      $config['page_title'] = "Tambah LB3 Kehamilan Tidak Diinginkan";
      $page_breadcrumbs = [
        ['url' => route('backend.lb3kytd.index'), 'title' => "Daftar LB3 Kehamilan Tidak Diinginkan"],
        ['url' => '#', 'title' => "Tambah LB3 Kehamilan Tidak Diinginkan"],
      ];
      return view('backend.lb3kytd.create', compact('page_breadcrumbs', 'config'));
    }


    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'updt_puskesmas_id' => 'required',
            'unmet_need' => 'required',
            'kehamilan_diluar_nikah' => 'required',
            'kegagalan_kb' => 'required',

          ]);

          if ($validator->passes()) {

            DB::beginTransaction();
            try {
                 $cek = ['tanggal'=> $request['tanggal'],  'puskesmas_id' =>  $request['updt_puskesmas_id']];
                 $data = Lb3Kytd::updateOrCreate($cek,[
                    'tanggal' =>  $request['tanggal'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'unmet_need' => $request['unmet_need'],
                    'kehamilan_diluar_nikah' => $request['kehamilan_diluar_nikah'],
                    'kegagalan_kb' => $request['kegagalan_kb'],
                  ]);

              DB::commit();
              $response = response()->json($this->responseStore(true, route('backend.lb3kytd.index')));
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
        $config['page_title'] = "Detail LB3 Kehamilan Tidak Diinginkan";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3kytd.index'), 'title' => "Daftar LB3 Kehamilan Tidak Diinginkan"],
          ['url' => '#', 'title' => "Detail LB3 Kehamilan Tidak Diinginkan"],
        ];
        $lb3kytd = Lb3Kytd::selectRaw('lb3_kytd.*')->with('puskesmas')->findOrFail($id);
        // /$supplier = $barang->suppliers()->get();
        $data = [
          'lb3kytd' =>  $lb3kytd,
        ];

        return view('backend.lb3kytd.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function edit($id)
    {
        $config['page_title'] = "Update LB3 Kehamilan Tidak Diinginkan";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3kytd.index'), 'title' => "Daftar LB3 Kehamilan Tidak Diinginkan"],
          ['url' => '#', 'title' => "Update LB3 Kehamilan Tidak Diinginkan"],
        ];
        $lb3kytd = Lb3Kytd::selectRaw('lb3_kytd.*')->with('puskesmas')->findOrFail($id);
        $data = [
          'lb3kytd' =>  $lb3kytd,
        ];

        return view('backend.lb3kytd.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'updt_puskesmas_id' => 'required',
            'unmet_need' => 'required',
            'kehamilan_diluar_nikah' => 'required',
            'kegagalan_kb' => 'required',
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                //  $data = lb3kytd::find($id);

                 $cek_uniqe = lb3kytd::where([
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
                    $data = Lb3Kytd::findOrFail($id);
                    $data->update([
                        'tanggal' =>  $request['tanggal'],
                        'puskesmas_id' =>  $request['updt_puskesmas_id'],
                        'unmet_need' => $request['unmet_need'],
                        'kehamilan_diluar_nikah' => $request['kehamilan_diluar_nikah'],
                        'kegagalan_kb' => $request['kegagalan_kb'],
                   ]);
                   $response = response()->json($this->responseStore(true, route('backend.lb3kytd.index')));
                 }

                DB::commit();

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
            $data = lb3kytd::findOrFail($id);
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
