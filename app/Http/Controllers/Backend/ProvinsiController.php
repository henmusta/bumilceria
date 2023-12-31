<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class ProvinsiController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Provinsi";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Provinsi"],
        ];

        if ($request->ajax()) {
          $data = Provinsi::query();
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
              $actionBtn = '<div class="dropdown">
                              <button type="button"  class="btn btn-secondary dropdown-toggle" data-bs-boundary="viewport" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi <i class="mdi mdi-chevron-down"></i>
                              </button>
                              <ul class="dropdown-menu">
                                <li> <a href="#" data-bs-toggle="modal" data-bs-target="#modalEdit" data-bs-id="' . $row->id . '" data-bs-name="' . $row->name . '" class="edit dropdown-item">Ubah</a></li>
                                <li> <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a></li>
                              </ul>
                            </div> ';
              return $actionBtn;

            })
            ->make(true);
        }

        return view('backend.provinsi.index', compact('config', 'page_breadcrumbs'));
    }



    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'name' => 'required|unique:provinsi,name',
          ]);

          if ($validator->passes()) {
            Provinsi::create([
              'name' => ucwords($request['name']),
            ]);

            $response = response()->json([
              'status' => 'success',
              'message' => 'Data berhasil disimpan'
            ]);
          } else {
            $response = response()->json(['error' => $validator->errors()->all()]);
          }
          return $response;
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:provinsi,name,' . $id,
          ]);

          if ($validator->passes()) {
            $data = Provinsi::find($id);
            $data->update([
              'name' => ucwords($request['name']),
            ]);
            // if($data->slug != 'super-admin'){
            //   $data->update([
            //     'name' => ucwords($request['name']),
            //   ]);
            // }
            $response = response()->json([
              'status' => 'success',
              'message' => 'Data berhasil diubah',
            ]);
          } else {
            $response = response()->json(['error' => $validator->errors()->all()]);
          }
          return $response;
    }

    public function destroy($id)
    {
        $data = Provinsi::findOrFail($id);
        if ($data->delete()) {
          $response = response()->json($this->responseDelete(true));

        }
        return $response;
    }

    public function select2(Request $request)
    {
      $page = $request->page;
      $resultCount = 10;
      $offset = ($page - 1) * $resultCount;
      $data = Provinsi::where('name', 'LIKE', '%' . $request->q . '%')
        ->orderBy('name')
        ->skip($offset)
        ->take($resultCount)
        ->selectRaw('id, name as text')
        ->get();

      $count = Provinsi::where('name', 'LIKE', '%' . $request->q . '%')
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
