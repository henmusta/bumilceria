<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lb3Balita;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class Lb3BalitaController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {

      $config['page_title'] = "LB3 Balita";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "LB3 Balita"],
      ];

      if ($request->ajax()) {
        $data = Lb3balita::selectRaw('lb3_balita.*')->with('puskesmas');
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $show = '<a href="' . route('backend.lb3balita.show', $row->id) . '" class="dropdown-item" >Detail</a>';
          return '<div class="dropdown">
                      <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                          Aksi <i class="mdi mdi-chevron-down"></i>
                      </a>
                      <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                          '. $show.'
                          <a class="dropdown-item" href="lb3balita/' . $row->id . '/edit">Ubah</a>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                      </div>
                  </div>';

          })
          ->rawColumns(['action'])
          ->make(true);
      }
      return view('backend.lb3balita.index', compact('config', 'page_breadcrumbs'));
    }


    public function create()
    {
      $config['page_title'] = "Tambah LB3 Balita";
      $page_breadcrumbs = [
        ['url' => route('backend.lb3balita.index'), 'title' => "Daftar LB3 Balita"],
        ['url' => '#', 'title' => "Tambah LB3 Balita"],
      ];
      return view('backend.lb3balita.create', compact('page_breadcrumbs', 'config'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'updt_puskesmas_id' => 'required',
            'sasaran_balita_laki-laki' => 'required',
            'sasaran_balita_perempuan' => 'required',
            'bllmb_kia' => 'required',
            'bpmb_kia' => 'required',
            'blldtk' => 'required',
            'bpdtk' => 'required',
            'blldgp' => 'required',
            'bpdgp' => 'required',
            'sdidtk_bll' => 'required',
            'sdidtk_bp' => 'required',
            'kbs_ll' => 'required',
            'kbs_p' => 'required',
            'mtbs_ll' => 'required',
            'mtbs_p' => 'required',
          ]);

          if ($validator->passes()) {

            DB::beginTransaction();
            try {
                 $data = Lb3Balita::create([
                    'tahun' =>  $request['tahun'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'sasaran_balita_laki_laki' =>  $request['sasaran_balita_laki-laki'],
                    'sasaran_balita_perempuan' =>  $request['sasaran_balita_perempuan'],
                    'bllmb_kia' =>  $request['bllmb_kia'],
                    'bpmb_kia' =>  $request['bpmb_kia'],
                    'blldtk' =>  $request['blldtk'],
                    'bpdtk' =>  $request['bpdtk'],
                    'blldgp' =>  $request['blldgp'],
                    'bpdgp' =>  $request['bpdgp'],
                    'sdidtk_bll' =>  $request['sdidtk_bll'],
                    'sdidtk_bp' =>  $request['sdidtk_bp'],
                    'kbs_ll' =>  $request['kbs_ll'],
                    'kbs_p' =>  $request['kbs_p'],
                    'mtbs_ll' =>  $request['mtbs_ll'],
                    'mtbs_p' =>  $request['mtbs_p'],
                  ]);

              DB::commit();
              $response = response()->json($this->responseStore(true, route('backend.lb3balita.index')));
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
        $config['page_title'] = "Detail LB3 Balita";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3balita.index'), 'title' => "Detail LB3 Balita"],
          ['url' => '#', 'title' => "Detail LB3 Balita"],
        ];
        $lb3balita = Lb3balita::selectRaw('lb3_balita.*')->with('puskesmas')->findOrFail($id);
        $data = [
          'lb3balita' =>  $lb3balita,
        ];

        return view('backend.lb3balita.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function edit($id)
    {
        $config['page_title'] = "Update LB3 Balita";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3balita.index'), 'title' => "Daftar LB3 Balita"],
          ['url' => '#', 'title' => "Update LB3 Balita"],
        ];
        $lb3balita = Lb3balita::selectRaw('lb3_balita.*')->with('puskesmas')->findOrFail($id);
        $data = [
          'lb3balita' =>  $lb3balita,
        ];

        return view('backend.lb3balita.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'updt_puskesmas_id' => 'required',
            'sasaran_balita_laki-laki' => 'required',
            'sasaran_balita_perempuan' => 'required',
            'bllmb_kia' => 'required',
            'bpmb_kia' => 'required',
            'blldtk' => 'required',
            'bpdtk' => 'required',
            'blldgp' => 'required',
            'bpdgp' => 'required',
            'sdidtk_bll' => 'required',
            'sdidtk_bp' => 'required',
            'kbs_ll' => 'required',
            'kbs_p' => 'required',
            'mtbs_ll' => 'required',
            'mtbs_p' => 'required',
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $data = Lb3Balita::find($id);
                $data->update([
                    'tahun' =>  $request['tahun'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'sasaran_balita_laki_laki' =>  $request['sasaran_balita_laki-laki'],
                    'sasaran_balita_perempuan' =>  $request['sasaran_balita_perempuan'],
                    'bllmb_kia' =>  $request['bllmb_kia'],
                    'bpmb_kia' =>  $request['bpmb_kia'],
                    'blldtk' =>  $request['blldtk'],
                    'bpdtk' =>  $request['bpdtk'],
                    'blldgp' =>  $request['blldgp'],
                    'bpdgp' =>  $request['bpdgp'],
                    'sdidtk_bll' =>  $request['sdidtk_bll'],
                    'sdidtk_bp' =>  $request['sdidtk_bp'],
                    'kbs_ll' =>  $request['kbs_ll'],
                    'kbs_p' =>  $request['kbs_p'],
                    'mtbs_ll' =>  $request['mtbs_ll'],
                    'mtbs_p' =>  $request['mtbs_p'],
                ]);

                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.lb3balita.index')));
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
            $data = Lb3Balita::findOrFail($id);
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
