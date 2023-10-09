<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lki;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class LkiController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {

      $config['page_title'] = "LB3 Laporan Kelas Ibu";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "LB3 Laporan Kelas Ibu"],
      ];

      if ($request->ajax()) {
        $data = Lki::selectRaw('lki.*')->with('puskesmas');
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $show = '<a href="' . route('backend.lki.show', $row->id) . '" class="dropdown-item" >Detail</a>';
          return '<div class="dropdown">
                      <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                          Aksi <i class="mdi mdi-chevron-down"></i>
                      </a>
                      <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                          '. $show.'
                          <a class="dropdown-item" href="lki/' . $row->id . '/edit">Ubah</a>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                      </div>
                  </div>';

          })
          ->rawColumns(['action'])
          ->make(true);
      }
      return view('backend.lki.index', compact('config', 'page_breadcrumbs'));
    }


    public function create()
    {
      $config['page_title'] = "Tambah Laporan Kelas Ibu";
      $page_breadcrumbs = [
        ['url' => route('backend.lki.index'), 'title' => "Daftar Laporan Kelas Ibu"],
        ['url' => '#', 'title' => "Tambah Laporan Kelas Ibu"],
      ];
      return view('backend.lki.create', compact('page_breadcrumbs', 'config'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'updt_puskesmas_id' => 'required',
            'jpkih' => 'required',
            'jpkib' => 'required',

          ]);

          if ($validator->passes()) {

            DB::beginTransaction();
            try {
                 $data = Lki::create([
                    'tahun' =>  $request['tahun'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'jpkih' =>  $request['jpkih'],
                    'jpkib' =>  $request['jpkib'],
                  ]);

              DB::commit();
              $response = response()->json($this->responseStore(true, route('backend.lki.index')));
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
        $config['page_title'] = "Detail Laporan Kelas Ibu";

        $page_breadcrumbs = [
          ['url' => route('backend.lki.index'), 'title' => "Detail Laporan Kelas Ibu"],
          ['url' => '#', 'title' => "Detail Laporan Kelas Ibu"],
        ];
        $lki = Lki::selectRaw('lki.*')->with('puskesmas')->findOrFail($id);
        $data = [
          'lki' =>  $lki,
        ];

        return view('backend.lki.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function edit($id)
    {
        $config['page_title'] = "Update Laporan Kelas Ibu";

        $page_breadcrumbs = [
          ['url' => route('backend.lki.index'), 'title' => "Daftar Laporan Kelas Ibu"],
          ['url' => '#', 'title' => "Update Laporan Kelas Ibu"],
        ];
        $lki = Lki::selectRaw('lki.*')->with('puskesmas')->findOrFail($id);
        $data = [
          'lki' =>  $lki,
        ];

        return view('backend.lki.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'updt_puskesmas_id' => 'required',
            'jpkih' => 'required',
            'jpkib' => 'required',
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $data = Lki::find($id);
                $data->update([
                    'tahun' =>  $request['tahun'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'jpkih' =>  $request['jpkih'],
                    'jpkib' =>  $request['jpkib'],
                ]);

                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.lki.index')));
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
            $data = Lki::findOrFail($id);
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
