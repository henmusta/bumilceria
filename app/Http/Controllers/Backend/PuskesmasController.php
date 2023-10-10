<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Puskesmas;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class PuskesmasController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {

      $config['page_title'] = "UPDT Puskesmas";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "UPDT Puskesmas"],
      ];

      if ($request->ajax()) {
        $data = Puskesmas::selectRaw('puskesmas.*')->with('wilayah');
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
                          <a class="dropdown-item" href="puskesmas/' . $row->id . '/edit">Ubah</a>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                      </div>
                  </div>';

          })
          ->rawColumns(['action'])
          ->make(true);
      }
      return view('backend.puskesmas.index', compact('config', 'page_breadcrumbs'));
    }


    public function create()
    {
      $config['page_title'] = "Tambah UPDT Puskesmas";
      $page_breadcrumbs = [
        ['url' => route('backend.puskesmas.index'), 'title' => "Daftar UPDT Puskesmas"],
        ['url' => '#', 'title' => "Tambah UPDT Puskesmas"],
      ];
      return view('backend.puskesmas.create', compact('page_breadcrumbs', 'config'));
    }

    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'wilayah_id' => 'required',
            'name'  => 'required',
          ]);

          if ($validator->passes()) {

            DB::beginTransaction();
            try {
                 $data = Puskesmas::create([
                    'wilayah_id' => $request['wilayah_id'],
                    'name'  => $request['name'],
                    'keterangan'  => $request['keterangan'],
                  ]);

              DB::commit();
              $response = response()->json($this->responseStore(true, route('backend.puskesmas.index')));
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
        $config['page_title'] = "Update UPDT Puskesmas";

        $page_breadcrumbs = [
          ['url' => route('backend.puskesmas.index'), 'title' => "Daftar UPDT Puskesmas"],
          ['url' => '#', 'title' => "Update UPDT Puskesmas"],
        ];
        $puskesmas = Puskesmas::with('wilayah')->findOrFail($id);
        // /$supplier = $barang->suppliers()->get();
        $data = [
          'puskesmas' => $puskesmas,
        ];

        return view('backend.puskesmas.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'wilayah_id' => 'required',
            'name'  => 'required',
          ]);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $data = Puskesmas::find($id);
                $data->update([
                    'wilayah_id' => $request['wilayah_id'],
                    'name'  => $request['name'],
                    'keterangan'  => $request['keterangan'],
                ]);

                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.puskesmas.index')));
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
            $data = Puskesmas::findOrFail($id);
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
      $id = $request['id'];
      $data = Puskesmas::where('name', 'LIKE', '%' . $request->q . '%')
        ->when($id, function ($query, $id) {
            return $query->where('id', $id);
         })
        ->orderBy('name')
        ->skip($offset)
        ->take($resultCount)
        ->selectRaw('id, name as text')
        ->get();

      $count = Puskesmas::where('name', 'LIKE', '%' . $request->q . '%')
        ->when($id, function ($query, $id) {
            return $query->where('id', $id);
        })
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
