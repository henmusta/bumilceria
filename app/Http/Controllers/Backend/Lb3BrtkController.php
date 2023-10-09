<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lb3Brtk;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class Lb3BrtkController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {

      $config['page_title'] = "LB3 Bayi Resiko Tinggi Komplikasi";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "LB3 Bayi Resiko Tinggi Komplikasi"],
      ];

      if ($request->ajax()) {
        $data = Lb3Brtk::selectRaw('lb3_brtk.*')->with('puskesmas');
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $show = '<a href="' . route('backend.lb3brtk.show', $row->id) . '" class="dropdown-item" >Detail</a>';
          return '<div class="dropdown">
                      <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                          Aksi <i class="mdi mdi-chevron-down"></i>
                      </a>
                      <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                          '. $show.'
                          <a class="dropdown-item" href="lb3brtk/' . $row->id . '/edit">Ubah</a>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                      </div>
                  </div>';

          })
          ->rawColumns(['action'])
          ->make(true);
      }
      return view('backend.lb3brtk.index', compact('config', 'page_breadcrumbs'));
    }


    public function create()
    {
      $config['page_title'] = "Tambah Bayi LB3 Resiko Tinggi Komplikasi";
      $page_breadcrumbs = [
        ['url' => route('backend.lb3brtk.index'), 'title' => "Daftar LB3 Bayi Resiko Tinggi Komplikasi"],
        ['url' => '#', 'title' => "Tambah LB3 Bayi Resiko Tinggi Komplikasi"],
      ];
      return view('backend.lb3brtk.create', compact('page_breadcrumbs', 'config'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'updt_puskesmas_id' => 'required',
            'bblr' => 'required',
            'asfiksia' => 'required',
            'infeksi' => 'required',
            'tetanus' => 'required',
            'kelainan' => 'required',
            'covid19' => 'required',
            'hipotiroid' => 'required',
            'lain-lain'  => 'required',
          ]);

          if ($validator->passes()) {

            DB::beginTransaction();
            try {
                 $data = Lb3Brtk::create([
                    'tahun' =>  $request['tahun'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'bblr' =>  $request['bblr'],
                    'asfiksia' =>  $request['asfiksia'],
                    'infeksi' =>  $request['infeksi'],
                    'tetanus' =>  $request['tetanus'],
                    'kelainan' =>  $request['kelainan'],
                    'covid19' =>  $request['covid19'],
                    'hipotiroid' =>  $request['hipotiroid'],
                    'lain_lain'  =>  $request['lain-lain'],
                  ]);

              DB::commit();
              $response = response()->json($this->responseStore(true, route('backend.lb3brtk.index')));
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
        $config['page_title'] = "Detail LB3 Bayi Resiko Tinggi Komplikasi";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3brtk.index'), 'title' => "Daftar LB3 Bayi Resiko Tinggi Komplikasi"],
          ['url' => '#', 'title' => "Detail LB3 Bayi Resiko Tinggi Komplikasi"],
        ];
        $lb3brtk = Lb3Brtk::selectRaw('lb3_brtk.*')->with('puskesmas')->findOrFail($id);
        $data = [
          'lb3brtk' =>  $lb3brtk,
        ];

        return view('backend.lb3brtk.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function edit($id)
    {
        $config['page_title'] = "Update LB3 Bayi Resiko Tinggi Komplikasi";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3brtk.index'), 'title' => "Daftar LB3 Bayi Resiko Tinggi Komplikasi"],
          ['url' => '#', 'title' => "Update LB3 Bayi Resiko Tinggi Komplikasi"],
        ];
        $lb3brtk = Lb3Brtk::selectRaw('lb3_brtk.*')->with('puskesmas')->findOrFail($id);
        $data = [
          'lb3brtk' =>  $lb3brtk,
        ];

        return view('backend.lb3brtk.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'updt_puskesmas_id' => 'required',
            'bblr' => 'required',
            'asfiksia' => 'required',
            'infeksi' => 'required',
            'tetanus' => 'required',
            'kelainan' => 'required',
            'covid19' => 'required',
            'hipotiroid' => 'required',
            'lain-lain'  => 'required',
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $data = Lb3Brtk::find($id);
                $data->update([
                    'tahun' =>  $request['tahun'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'bblr' =>  $request['bblr'],
                    'asfiksia' =>  $request['asfiksia'],
                    'infeksi' =>  $request['infeksi'],
                    'tetanus' =>  $request['tetanus'],
                    'kelainan' =>  $request['kelainan'],
                    'covid19' =>  $request['covid19'],
                    'hipotiroid' =>  $request['hipotiroid'],
                    'lain_lain'  =>  $request['lain-lain'],
                ]);

                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.lb3brtk.index')));
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
            $data = Lb3Brtk::findOrFail($id);
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
