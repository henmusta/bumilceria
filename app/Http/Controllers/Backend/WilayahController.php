<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class WilayahController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {

      $config['page_title'] = "Wilayah";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "Daftar wilayah"],
      ];

      if ($request->ajax()) {
        $data = Wilayah::selectRaw('wilayah.*')->with('provinsi', 'kabupaten', 'kecamatan')->where('kabupaten_id', '132');
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $show = '<a href="' . route('backend.wilayah.show', $row->id) . '" class="dropdown-item" >Detail</a>';
          return '<div class="dropdown">
                      <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                          Aksi <i class="mdi mdi-chevron-down"></i>
                      </a>
                      <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                          '. $show.'
                          <a class="dropdown-item" href="wilayah/' . $row->id . '/edit">Ubah</a>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                      </div>
                  </div>';

          })
          ->rawColumns(['action'])
          ->make(true);
      }
      return view('backend.wilayah.index', compact('config', 'page_breadcrumbs'));
    }



    public function create()
    {
      $config['page_title'] = "Tambah Wilayah";
      $page_breadcrumbs = [
        ['url' => route('backend.wilayah.index'), 'title' => "Daftar Wilayah"],
        ['url' => '#', 'title' => "Tambah Wilayah"],
      ];
      return view('backend.wilayah.create', compact('page_breadcrumbs', 'config'));
    }

    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'provinsi_id' => 'required',
            'kabupaten_id' => 'required|integer',
            'kecamatan_id' => 'required|integer',
            'alamat'  => 'required',
          ]);

          if ($validator->passes()) {

            DB::beginTransaction();
            try {
                 $data = Wilayah::create([
                    'provinsi_id' =>  $request['provinsi_id'],
                    'kabupaten_id' => $request['kabupaten_id'],
                    'kecamatan_id' => $request['kecamatan_id'],
                    'alamat'  =>  $request['alamat']
                  ]);

              DB::commit();
              $response = response()->json($this->responseStore(true, route('backend.wilayah.index')));
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


    public function edit($id)
    {
        $config['page_title'] = "Update Wilayah";

        $page_breadcrumbs = [
          ['url' => route('backend.wilayah.index'), 'title' => "Daftar Wilayah"],
          ['url' => '#', 'title' => "Update Wilayah"],
        ];
        $wilayah = Wilayah::with('provinsi', 'kabupaten', 'kecamatan')->findOrFail($id);
        // /$supplier = $barang->suppliers()->get();
        $data = [
          'wilayah' => $wilayah,
        ];

        return view('backend.wilayah.edit', compact('page_breadcrumbs', 'config', 'data'));
    }



    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'provinsi_id' => 'required',
            'kabupaten_id' => 'required|integer',
            'kecamatan_id' => 'required|integer',
            'alamat'  => 'required',
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $data = Wilayah::find($id);
                $data->update([
                    'provinsi_id' =>  $request['provinsi_id'],
                    'kabupaten_id' => $request['kabupaten_id'],
                    'kecamatan_id' => $request['kecamatan_id'],
                    'alamat'  =>  $request['alamat']
                ]);

                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.wilayah.index')));
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
            $data = Wilayah::findOrFail($id);
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


    public function select2(Request $request)
    {
      $page = $request->page;
      $resultCount = 10;
      $offset = ($page - 1) * $resultCount;
      $data = Wilayah::where('alamat', 'LIKE', '%' . $request->q . '%')
        ->orderBy('alamat')
        ->skip($offset)
        ->take($resultCount)
        ->selectRaw('id, alamat as text')
        ->get();

      $count = Wilayah::where('alamat', 'LIKE', '%' . $request->q . '%')
        ->get()
        ->count();

      $endCount = $offset + $resultCount;
      $morePages = $count > $endCount;

      $results = array(
        "results" => $data,
        "pagination" => array(
          "more" => $morePages
        )
      );

      return response()->json($results);
    }

}
