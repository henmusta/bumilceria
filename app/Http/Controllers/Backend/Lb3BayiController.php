<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lb3Bayi;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class Lb3BayiController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {

      $config['page_title'] = "LB3 Bayi";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "LB3 Bayi"],
      ];

      if ($request->ajax()) {
        $data = Lb3bayi::selectRaw('lb3_bayi.*')->with('puskesmas');
        if ($request->filled('puskesmas_id')) {
            $data->where('puskesmas_id',  $request['puskesmas_id']);
        }
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $show = '<a href="' . route('backend.lb3bayi.show', $row->id) . '" class="dropdown-item" >Detail</a>';
          return '<div class="dropdown">
                      <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                          Aksi <i class="mdi mdi-chevron-down"></i>
                      </a>
                      <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                          '. $show.'
                          <a class="dropdown-item" href="lb3bayi/' . $row->id . '/edit">Ubah</a>
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
      return view('backend.lb3bayi.index', compact('config', 'page_breadcrumbs'));
    }


    public function create()
    {
      $config['page_title'] = "Tambah LB3 Bayi";
      $page_breadcrumbs = [
        ['url' => route('backend.lb3bayi.index'), 'title' => "Daftar LB3 Bayi"],
        ['url' => '#', 'title' => "Tambah LB3 Bayi"],
      ];
      return view('backend.lb3bayi.create', compact('page_breadcrumbs', 'config'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'updt_puskesmas_id' => 'required',
            'sasaran_bayi_laki-laki' => 'required',
            'sasaran_bayi_perempuan' => 'required',
            'bayi_lahir_laki-laki' => 'required',
            'bayi_lahir_perempuan' => 'required',
            'kn1_laki-laki' => 'required',
            'kn1_perempuan' => 'required',
            'kn3_laki-laki' => 'required',
            'kn3_perempuan' => 'required',
            'bbl_lld_shk' => 'required',
            'bbl_pd_shk' => 'required'
          ]);

          if ($validator->passes()) {

            DB::beginTransaction();
            try {
                $cek = ['tanggal'=> $request['tanggal'],  'puskesmas_id' =>  $request['updt_puskesmas_id']];
                $data = Lb3Bayi::updateOrCreate($cek,[
                    'tanggal' =>  $request['tanggal'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'sasaran_bayi_laki_laki' => $request['sasaran_bayi_laki-laki'],
                    'sasaran_bayi_perempuan' => $request['sasaran_bayi_perempuan'],
                    'bayi_lahir_laki_laki' => $request['bayi_lahir_laki-laki'],
                    'bayi_lahir_perempuan' => $request['bayi_lahir_perempuan'],
                    'kn1_laki_laki' => $request['kn1_laki-laki'],
                    'kn1_perempuan' => $request['kn1_perempuan'],
                    'kn3_laki_laki' => $request['kn3_laki-laki'],
                    'kn3_perempuan' => $request['kn3_perempuan'],
                    'bbl_lld_shk' => $request['bbl_lld_shk'],
                    'bbl_pd_shk' => $request['bbl_pd_shk'],
                  ]);

              DB::commit();
              $response = response()->json($this->responseStore(true, route('backend.lb3bayi.index')));
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
        $config['page_title'] = "Detail LB3 Bayi";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3bayi.index'), 'title' => "Detail LB3 Bayi"],
          ['url' => '#', 'title' => "Detail LB3 Bayi"],
        ];
        $lb3bayi = Lb3bayi::selectRaw('lb3_bayi.*')->with('puskesmas')->findOrFail($id);
        $data = [
          'lb3bayi' =>  $lb3bayi,
        ];

        return view('backend.lb3bayi.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function edit($id)
    {
        $config['page_title'] = "Update LB3 Bayi";

        $page_breadcrumbs = [
          ['url' => route('backend.lb3bayi.index'), 'title' => "Daftar LB3 Bayi"],
          ['url' => '#', 'title' => "Update LB3 Bayi"],
        ];
        $lb3bayi = Lb3bayi::selectRaw('lb3_bayi.*')->with('puskesmas')->findOrFail($id);
        $data = [
          'lb3bayi' =>  $lb3bayi,
        ];

        return view('backend.lb3bayi.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'updt_puskesmas_id' => 'required',
            'sasaran_bayi_laki-laki' => 'required',
            'sasaran_bayi_perempuan' => 'required',
            'bayi_lahir_laki-laki' => 'required',
            'bayi_lahir_perempuan' => 'required',
            'kn1_laki-laki' => 'required',
            'kn1_perempuan' => 'required',
            'kn3_laki-laki' => 'required',
            'kn3_perempuan' => 'required',
            'bbl_lld_shk' => 'required',
            'bbl_pd_shk' => 'required'
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {

                $cek_uniqe = Lb3Bayi::where([
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
                    $data = Lb3Bayi::findOrFail($id);
                    $data->update([
                        'tanggal' =>  $request['tanggal'],
                        'puskesmas_id' =>  $request['updt_puskesmas_id'],
                        'sasaran_bayi_laki_laki' => $request['sasaran_bayi_laki-laki'],
                        'sasaran_bayi_perempuan' => $request['sasaran_bayi_perempuan'],
                        'bayi_lahir_laki_laki' => $request['bayi_lahir_laki-laki'],
                        'bayi_lahir_perempuan' => $request['bayi_lahir_perempuan'],
                        'kn1_laki_laki' => $request['kn1_laki-laki'],
                        'kn1_perempuan' => $request['kn1_perempuan'],
                        'kn3_laki_laki' => $request['kn3_laki-laki'],
                        'kn3_perempuan' => $request['kn3_perempuan'],
                        'bbl_lld_shk' => $request['bbl_lld_shk'],
                        'bbl_pd_shk' => $request['bbl_pd_shk'],
                    ]);

                    DB::commit();
                    $response = response()->json($this->responseStore(true, route('backend.lb3bayi.index')));
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
            $data = Lb3Bayi::findOrFail($id);
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
