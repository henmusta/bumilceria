<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lbtt;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class LbttController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {

      $config['page_title'] = "Laporan Bulanan Tenaga Terlatih";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "Laporan Bulanan Tenaga Terlatih"],
      ];

      if ($request->ajax()) {
        $data = Lbtt::selectRaw('lbtt.*')->with('puskesmas');
        if ($request->filled('puskesmas_id')) {
            $data->where('puskesmas_id',  $request['puskesmas_id']);
        }
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $show = '<a href="' . route('backend.lbtt.show', $row->id) . '" class="dropdown-item" >Detail</a>';
          return '<div class="dropdown">
                      <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                          Aksi <i class="mdi mdi-chevron-down"></i>
                      </a>
                      <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                          '. $show.'
                          <a class="dropdown-item" href="lbtt/' . $row->id . '/edit">Ubah</a>
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
      return view('backend.lbtt.index', compact('config', 'page_breadcrumbs'));
    }


    public function create()
    {
      $config['page_title'] = "Tambah Laporan Bulanan Tenaga Terlatih";
      $page_breadcrumbs = [
        ['url' => route('backend.lbtt.index'), 'title' => "Daftar Laporan Bulanan Tenaga Terlatih"],
        ['url' => '#', 'title' => "Tambah Laporan Bulanan Tenaga Terlatih"],
      ];
      return view('backend.lbtt.create', compact('page_breadcrumbs', 'config'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'updt_puskesmas_id' => 'required',
            'dokter_terlatih_usg'=> 'required',
            'kader_terlatih_ptkb'=> 'required',
            'nakes_terlatih_mbts'=> 'required',
            'nakes_terlatih_tlgb'=> 'required',
            'nakes_terlatih_pmba'=> 'required',
            'nakes_terlatih_sdidtk'=> 'required',
            'nakes_terlatih_imtbsgb'=> 'required',
            'nakes_terlatih_pmba_sdidtk' => 'required',
          ]);

          if ($validator->passes()) {

            DB::beginTransaction();
            try {
                $cek = ['tanggal'=> $request['tanggal'],  'puskesmas_id' =>  $request['updt_puskesmas_id']];
                $data = Lbtt::updateOrCreate($cek,[
                    'tanggal' =>  $request['tanggal'],
                    'puskesmas_id' =>  $request['updt_puskesmas_id'],
                    'dokter_terlatih_usg'=>  $request['dokter_terlatih_usg'],
                    'kader_terlatih_ptkb'=>  $request['kader_terlatih_ptkb'],
                    'nakes_terlatih_mbts'=>  $request['nakes_terlatih_mbts'],
                    'nakes_terlatih_tlgb'=>  $request['nakes_terlatih_tlgb'],
                    'nakes_terlatih_pmba'=>  $request['nakes_terlatih_pmba'],
                    'nakes_terlatih_sdidtk'=>  $request['nakes_terlatih_sdidtk'],
                    'nakes_terlatih_imtbsgb'=>  $request['nakes_terlatih_imtbsgb'],
                    'nakes_terlatih_pmba_sdidtk' =>  $request['nakes_terlatih_pmba_sdidtk'],
                  ]);

              DB::commit();
              $response = response()->json($this->responseStore(true, route('backend.lbtt.index')));
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
        $config['page_title'] = "Detail Laporan Bulanan Tenaga Terlatih";

        $page_breadcrumbs = [
          ['url' => route('backend.lbtt.index'), 'title' => "Detail Laporan Bulanan Tenaga Terlatih"],
          ['url' => '#', 'title' => "Detail Laporan Bulanan Tenaga Terlatih"],
        ];
        $lbtt = Lbtt::selectRaw('lbtt.*')->with('puskesmas')->findOrFail($id);
        $data = [
          'lbtt' =>  $lbtt,
        ];

        return view('backend.lbtt.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function edit($id)
    {
        $config['page_title'] = "Update Laporan Bulanan Tenaga Terlatih";

        $page_breadcrumbs = [
          ['url' => route('backend.lbtt.index'), 'title' => "Daftar Laporan Bulanan Tenaga Terlatih"],
          ['url' => '#', 'title' => "Update Laporan Bulanan Tenaga Terlatih"],
        ];
        $lbtt = Lbtt::selectRaw('lbtt.*')->with('puskesmas')->findOrFail($id);
        $data = [
          'lbtt' =>  $lbtt,
        ];

        return view('backend.lbtt.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'updt_puskesmas_id' => 'required',
            'dokter_terlatih_usg'=> 'required',
            'kader_terlatih_ptkb'=> 'required',
            'nakes_terlatih_mbts'=> 'required',
            'nakes_terlatih_tlgb'=> 'required',
            'nakes_terlatih_pmba'=> 'required',
            'nakes_terlatih_sdidtk'=> 'required',
            'nakes_terlatih_imtbsgb'=> 'required',
            'nakes_terlatih_pmba_sdidtk' => 'required',
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                 $cek_uniqe = Lbtt::where([
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
                    $data = Lbtt::findOrFail($id);
                    $data->update([
                        'tanggal' =>  $request['tanggal'],
                        'puskesmas_id' =>  $request['updt_puskesmas_id'],
                        'dokter_terlatih_usg'=>  $request['dokter_terlatih_usg'],
                        'kader_terlatih_ptkb'=>  $request['kader_terlatih_ptkb'],
                        'nakes_terlatih_mbts'=>  $request['nakes_terlatih_mbts'],
                        'nakes_terlatih_tlgb'=>  $request['nakes_terlatih_tlgb'],
                        'nakes_terlatih_pmba'=>  $request['nakes_terlatih_pmba'],
                        'nakes_terlatih_sdidtk'=>  $request['nakes_terlatih_sdidtk'],
                        'nakes_terlatih_imtbsgb'=>  $request['nakes_terlatih_imtbsgb'],
                        'nakes_terlatih_pmba_sdidtk' =>  $request['nakes_terlatih_pmba_sdidtk'],
                    ]);
                    DB::commit();
                    $response = response()->json($this->responseStore(true, route('backend.lbtt.index')));
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
            $data = Lbtt::findOrFail($id);
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
