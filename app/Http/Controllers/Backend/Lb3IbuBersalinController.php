<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lb3ibubersalin;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class Lb3IbuBersalinController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {

      $config['page_title'] = "LB3 Ibu Bersalin";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "LB3 Ibu Bersalin"],
      ];

      if ($request->ajax()) {
        $data = Lb3ibubersalin::selectRaw('lb3_ibu_bersalin.*')->with('puskesmas');
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $show = '<a href="' . route('backend.lb3ibubersalin.show', $row->id) . '" class="dropdown-item" >Detail</a>';
          return '<div class="dropdown">
                      <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                          Aksi <i class="mdi mdi-chevron-down"></i>
                      </a>
                      <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                          '. $show.'
                          <a class="dropdown-item" href="lb3ibubersalin/' . $row->id . '/edit">Ubah</a>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                      </div>
                  </div>';

          })
          ->rawColumns(['action'])
          ->make(true);
      }
      return view('backend.lb3ibubersalin.index', compact('config', 'page_breadcrumbs'));
    }


    public function create()
    {
      $config['page_title'] = "Tambah LB3 Ibu Bersalin";
      $page_breadcrumbs = [
        ['url' => route('backend.lb3ibubersalin.index'), 'title' => "Daftar LB3 Ibu Bersalin"],
        ['url' => '#', 'title' => "Tambah LB3 Ibu Bersalin"],
      ];
      return view('backend.lb3ibubersalin.create', compact('page_breadcrumbs', 'config'));
    }


    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'updt_puskesmas_id' => 'required',
            'jsib' => 'required',
            'ibu_bersalin' => 'required',
            'ibu_bersalin_nakes' => 'required',
            'ibu_bersalin_faskes' => 'required',
            'kf1' => 'required',
            'kf_lengkap' => 'required',
            'vita_ibu_nifas' => 'required'
          ]);

          if ($validator->passes()) {

            DB::beginTransaction();
            try {
                 $data = Lb3ibubersalin::create([
                    'tahun' =>  $request['tahun'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'jsib' =>  $request['jsib'],
                    'ibu_bersalin' =>  $request['ibu_bersalin'],
                    'ibu_bersalin_nakes' =>  $request['ibu_bersalin_nakes'],
                    'ibu_bersalin_faskes' =>  $request['ibu_bersalin_faskes'],
                    'kf1' =>  $request['kf1'],
                    'kf_lengkap' =>  $request['kf_lengkap'],
                    'vita_ibu_nifas'=>  $request['vita_ibu_nifas'],
                  ]);

              DB::commit();
              $response = response()->json($this->responseStore(true, route('backend.lb3ibubersalin.index')));
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
        $config['page_title'] = "Detail LB3 Ibu Bersalin";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3ibubersalin.index'), 'title' => "Daftar LB3 Ibu Bersalin"],
          ['url' => '#', 'title' => "Detail LB3 Ibu Bersalin"],
        ];
        $lbkibubersalin = Lb3ibubersalin::selectRaw('lb3_ibu_bersalin.*')->with('puskesmas')->findOrFail($id);
        // /$supplier = $barang->suppliers()->get();
        $data = [
          'lb3ibubersalin' =>  $lbkibubersalin,
        ];

        return view('backend.lb3ibubersalin.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function edit($id)
    {
        $config['page_title'] = "Update LB3 Ibu Bersalin";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3ibubersalin.index'), 'title' => "Daftar LB3 Ibu Bersalin"],
          ['url' => '#', 'title' => "Update LB3 Ibu Bersalin"],
        ];
        $lb3ibubersalin = Lb3ibubersalin::selectRaw('lb3_ibu_bersalin.*')->with('puskesmas')->findOrFail($id);
        // /$supplier = $barang->suppliers()->get();
        $data = [
          'lb3ibubersalin' =>  $lb3ibubersalin,
        ];

        return view('backend.lb3ibubersalin.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'updt_puskesmas_id' => 'required',
            'jsib' => 'required',
            'ibu_bersalin' => 'required',
            'ibu_bersalin_nakes' => 'required',
            'ibu_bersalin_faskes' => 'required',
            'kf1' => 'required',
            'kf_lengkap' => 'required',
            'vita_ibu_nifas' => 'required'
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $data = Lb3ibubersalin::find($id);
                $data->update([
                    'tahun' =>  $request['tahun'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'jsib' =>  $request['jsib'],
                    'ibu_bersalin' =>  $request['ibu_bersalin'],
                    'ibu_bersalin_nakes' =>  $request['ibu_bersalin_nakes'],
                    'ibu_bersalin_faskes' =>  $request['ibu_bersalin_faskes'],
                    'kf1' =>  $request['kf1'],
                    'kf_lengkap' =>  $request['kf_lengkap'],
                    'vita_ibu_nifas'=>  $request['vita_ibu_nifas'],
                ]);

                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.lb3ibubersalin.index')));
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
            $data = Lb3ibubersalin::findOrFail($id);
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
