<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lb3ibuhamil;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;


class Lb3IbuHamilController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {

      $config['page_title'] = "LB3 Ibu Hamil";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "LB3 Ibu Hamil"],
      ];

      if ($request->ajax()) {
        $data = Lb3ibuhamil::selectRaw('lb3_ibu_hamil.*')->with('puskesmas');
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $show = '<a href="' . route('backend.lb3ibuhamil.show', $row->id) . '" class="dropdown-item" >Detail</a>';
          return '<div class="dropdown">
                      <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                          Aksi <i class="mdi mdi-chevron-down"></i>
                      </a>
                      <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                          '. $show.'
                          <a class="dropdown-item" href="lb3ibuhamil/' . $row->id . '/edit">Ubah</a>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                      </div>
                  </div>';

          })
          ->rawColumns(['action'])
          ->make(true);
      }
      return view('backend.lb3ibuhamil.index', compact('config', 'page_breadcrumbs'));
    }


    public function create()
    {
      $config['page_title'] = "Tambah LB3 Ibu Hamil";
      $page_breadcrumbs = [
        ['url' => route('backend.lb3ibuhamil.index'), 'title' => "Daftar LB3 Ibu Hamil"],
        ['url' => '#', 'title' => "Tambah LB3 Ibu Hamil"],
      ];
      return view('backend.lb3ibuhamil.create', compact('page_breadcrumbs', 'config'));
    }


    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'updt_puskesmas_id' => 'required',
            'jsih' => 'required',
            'k1_total' => 'required',
            'k1_murni' => 'required',
            'k4' => 'required',
            'k6' => 'required',
            'ihttm' => 'required',
            'ibdjtd' => 'required',
            'ihdktb' => 'required',
            'k1_ok' => 'required',
            'k5_ok' => 'required',
            'k1_usg_ok' => 'required',
            'k5_usg_ok' => 'required',
            'ibmb_kia' => 'required',
          ]);

          if ($validator->passes()) {

            DB::beginTransaction();
            try {
                 $data = Lb3ibuhamil::create([
                    'tahun' =>  $request['tahun'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'jsih' =>  $request['jsih'],
                    'k1_total' =>  $request['k1_total'],
                    'k1_murni' =>  $request['k1_murni'],
                    'k4' =>  $request['k4'],
                    'k6' =>  $request['k6'],
                    'ihttm' =>  $request['ihttm'],
                    'ibdjtd' =>  $request['ibdjtd'],
                    'ihdktb' =>  $request['ihdktb'],
                    'k1_ok' =>  $request['k1_ok'],
                    'k5_ok' =>  $request['k5_ok'],
                    'k1_usg_ok' =>  $request['k1_usg_ok'],
                    'k5_usg_ok' =>  $request['k5_usg_ok'],
                    'ibmb_kia' =>  $request['ibmb_kia']
                  ]);

              DB::commit();
              $response = response()->json($this->responseStore(true, route('backend.lb3ibuhamil.index')));
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
        $config['page_title'] = "Detail LB3 Ibu Hamil";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3ibuhamil.index'), 'title' => "Daftar LB3 Ibu Hamil"],
          ['url' => '#', 'title' => "Detail LB3 Ibu Hamil"],
        ];
        $lb3ibuhamil = Lb3ibuhamil::selectRaw('lb3_ibu_hamil.*')->with('puskesmas')->findOrFail($id);
        // /$supplier = $barang->suppliers()->get();
        $data = [
          'lb3ibuhamil' =>  $lb3ibuhamil,
        ];

        return view('backend.lb3ibuhamil.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function edit($id)
    {
        $config['page_title'] = "Update LB3 Ibu Hamil";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3ibuhamil.index'), 'title' => "Daftar LB3 Ibu Hamil"],
          ['url' => '#', 'title' => "Update LB3 Ibu Hamil"],
        ];
        $lb3ibuhamil = Lb3ibuhamil::selectRaw('lb3_ibu_hamil.*')->with('puskesmas')->findOrFail($id);
        // /$supplier = $barang->suppliers()->get();
        $data = [
          'lb3ibuhamil' =>  $lb3ibuhamil,
        ];

        return view('backend.lb3ibuhamil.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'updt_puskesmas_id' => 'required',
            'jsih' => 'required',
            'k1_total' => 'required',
            'k1_murni' => 'required',
            'k4' => 'required',
            'k6' => 'required',
            'ihttm' => 'required',
            'ibdjtd' => 'required',
            'ihdktb' => 'required',
            'k1_ok' => 'required',
            'k5_ok' => 'required',
            'k1_usg_ok' => 'required',
            'k5_usg_ok' => 'required',
            'ibmb_kia' => 'required',
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $data = Lb3ibuhamil::find($id);
                $data->update([
                    'tahun' =>  $request['tahun'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'jsih' =>  $request['jsih'],
                    'k1_total' =>  $request['k1_total'],
                    'k1_murni' =>  $request['k1_murni'],
                    'k4' =>  $request['k4'],
                    'k6' =>  $request['k6'],
                    'ihttm' =>  $request['ihttm'],
                    'ibdjtd' =>  $request['ibdjtd'],
                    'ihdktb' =>  $request['ihdktb'],
                    'k1_ok' =>  $request['k1_ok'],
                    'k5_ok' =>  $request['k5_ok'],
                    'k1_usg_ok' =>  $request['k1_usg_ok'],
                    'k5_usg_ok' =>  $request['k5_usg_ok'],
                    'ibmb_kia' =>  $request['ibmb_kia']
                ]);

                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.lb3ibuhamil.index')));
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
            $data = Lb3ibuhamil::findOrFail($id);
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
