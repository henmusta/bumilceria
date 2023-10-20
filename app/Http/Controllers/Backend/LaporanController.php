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

class LaporanController extends Controller
{

    public function sub_data($tabel, $value, $data, $tahun, $type, $bulan, $jenis = null){
        $data->withSum([
            $tabel => function ($query) use ( $tahun, $type,  $bulan, $jenis) {
                if($type == 'year'){
                    $query->whereYear('tanggal', '=',  $tahun);
                }
                if($type == 'month'){
                    $query->whereMonth('tanggal', '=',  $bulan);
                    if($tahun > 1980){
                        $query->whereYear('tanggal', '=',  $tahun);
                    }
                }
                if($type != 'year' && $type != 'month' && $type != null){
                    $res = implode(',', $type);
                    $query->whereRaw('MONTH(tanggal) IN ('.$res.')');
                    if($tahun > 1980){
                        $query->whereYear('tanggal', '=',  $tahun);
                    }
                }
                if(isset($jenis)){
                    $query->where('name', $jenis);
                }
        }], $value);

        // if(isset($jenis)){
        //     $get_data = array();
        //     foreach ($data->get() as $key) {
        //         $oldkey = 'jktpdadetail_sum0_sampai_15';
        //         $key['mantap'] = $key[ $oldkey];
        //         unset($key[$oldkey]);

        //         $get_data[] = $key;
        //         // dd($key);
        //     }
        // }
        // dd($get_data);
    }

    public function data(Request $request){
        $tahun = date('Y', strtotime($request['tahun']));
        $bulan = date('m', strtotime($request['bulan']));
        $type = $request['type'];
        $puskesmas_id =$request['updt_puskesmas_id'];

        if (in_array($request['type'], ['s1', 's2', 't1', 't2', 't3', 't4'])) {
            $type = match ($request['type']) {
              's1' => [1, 2, 3, 4, 5, 6],
              's2' => [6, 7, 8, 9, 10, 11, 12],
              't1' => [1, 2, 3],
              't2' => [4, 5, 6],
              't3' => [7, 8, 9],
              't4' => [10, 11, 12],
            };


        }



        $data = Puskesmas::selectRaw('puskesmas.name as puskesmas, puskesmas.id as id');
        $this->sub_data('lb3ibuhamil', 'jsih', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibuhamil', 'k1_total', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibuhamil', 'k1_murni', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibuhamil', 'k4', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibuhamil', 'k6', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibuhamil', 'ihttm', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibuhamil', 'ibdjtd', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibuhamil', 'ihdktb', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibuhamil', 'k1_ok', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibuhamil', 'k5_ok', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibuhamil', 'k1_usg_ok', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibuhamil', 'k5_usg_ok', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibuhamil', 'ibmb_kia', $data, $tahun, $type, $bulan);


        //bersalin

        $this->sub_data('lb3ibubersalin', 'jsib', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibubersalin', 'ibu_bersalin', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibubersalin', 'ibu_bersalin_nakes', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibubersalin', 'ibu_bersalin_faskes', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibubersalin', 'kf1', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibubersalin', 'kf_lengkap', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3ibubersalin', 'vita_ibu_nifas', $data, $tahun, $type, $bulan);

        // Rtk



        $this->sub_data('lb3rtk', 'anemia_trimester1', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3rtk', 'anemia_trimester3', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3rtk', 'pendarahan', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3rtk', 'pre_eklamsia', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3rtk', 'infeksi', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3rtk', 'tuberculosis', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3rtk', 'malaria', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3rtk', 'jantung', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3rtk', 'diabetes_mellitus', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3rtk', 'obesitas', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3rtk', 'covid19', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3rtk', 'abortus', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3rtk', 'lain_lain', $data, $tahun, $type, $bulan);

        //bayi

        $this->sub_data('lb3bayi', 'sasaran_bayi_laki_laki', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3bayi', 'sasaran_bayi_perempuan', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3bayi', 'bayi_lahir_laki_laki', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3bayi', 'bayi_lahir_perempuan', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3bayi', 'kn1_laki_laki', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3bayi', 'kn1_perempuan', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3bayi', 'kn3_laki_laki', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3bayi', 'kn3_perempuan', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3bayi', 'bbl_lld_shk', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3bayi', 'bbl_pd_shk', $data, $tahun, $type, $bulan);

        //brtk

        $this->sub_data('lb3brtk', 'bblr', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3brtk', 'asfiksia', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3brtk', 'infeksi', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3brtk', 'tetanus', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3brtk', 'kelainan', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3brtk', 'covid19', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3brtk', 'hipotiroid', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3brtk', 'lain_lain', $data, $tahun, $type, $bulan);


        //balita


        $this->sub_data('lb3balita', 'sasaran_balita_laki_laki', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'sasaran_balita_perempuan', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'bllmb_kia', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'blldtk', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'bpdtk', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'bpmb_kia', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'blldgp', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'bpdgp', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'sdidtk_bll', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'sdidtk_bp', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'kbs_ll', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'kbs_p', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'mtbs_ll', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3balita', 'mtbs_p', $data, $tahun, $type, $bulan);


        //Lki

        $this->sub_data('lki', 'jpkih', $data, $tahun, $type, $bulan);
        $this->sub_data('lki', 'jpkib', $data, $tahun, $type, $bulan);


        //lbtt
        $this->sub_data('lbtt', 'dokter_terlatih_usg', $data, $tahun, $type, $bulan);
        $this->sub_data('lbtt', 'kader_terlatih_ptkb', $data, $tahun, $type, $bulan);
        $this->sub_data('lbtt', 'nakes_terlatih_mbts', $data, $tahun, $type, $bulan);
        $this->sub_data('lbtt', 'nakes_terlatih_tlgb', $data, $tahun, $type, $bulan);
        $this->sub_data('lbtt', 'nakes_terlatih_pmba', $data, $tahun, $type, $bulan);
        $this->sub_data('lbtt', 'nakes_terlatih_sdidtk', $data, $tahun, $type, $bulan);
        $this->sub_data('lbtt', 'nakes_terlatih_imtbsgb', $data, $tahun, $type, $bulan);
        $this->sub_data('lbtt', 'nakes_terlatih_pmba_sdidtk', $data, $tahun, $type, $bulan);


        //jktpda
        $this->sub_data('lb3jktpdadetail as Mental_0_15', '0_sampai_15', $data, $tahun, $type, $bulan, 'Mental');
        $this->sub_data('lb3jktpdadetail as Mental_16_45', '16_sampai_45', $data, $tahun, $type, $bulan, 'Mental');
        $this->sub_data('lb3jktpdadetail as Mental_46_60', '46_sampai_60', $data, $tahun, $type, $bulan, 'Mental');
        $this->sub_data('lb3jktpdadetail as Mental_60', '60_keatas', $data, $tahun, $type, $bulan, 'Mental');


        $this->sub_data('lb3jktpdadetail as Fisik_0_15', '0_sampai_15', $data, $tahun, $type, $bulan, 'Fisik');
        $this->sub_data('lb3jktpdadetail as Fisik_16_45', '16_sampai_45', $data, $tahun, $type, $bulan, 'Fisik');
        $this->sub_data('lb3jktpdadetail as Fisik_46_60', '46_sampai_60', $data, $tahun, $type, $bulan, 'Fisik');
        $this->sub_data('lb3jktpdadetail as Fisik_60', '60_keatas', $data, $tahun, $type, $bulan, 'Fisik');

        $this->sub_data('lb3jktpdadetail as Emosional_0_15', '0_sampai_15', $data, $tahun, $type, $bulan, 'Emosional');
        $this->sub_data('lb3jktpdadetail as Emosional_16_45', '16_sampai_45', $data, $tahun, $type, $bulan, 'Emosional');
        $this->sub_data('lb3jktpdadetail as Emosional_46_60', '46_sampai_60', $data, $tahun, $type, $bulan, 'Emosional');
        $this->sub_data('lb3jktpdadetail as Emosional_60', '60_keatas', $data, $tahun, $type, $bulan, 'Emosional');

        $this->sub_data('lb3jktpdadetail as Penelantaran_0_15', '0_sampai_15', $data, $tahun, $type, $bulan, 'Penelantaran');
        $this->sub_data('lb3jktpdadetail as Penelantaran_16_45', '16_sampai_45', $data, $tahun, $type, $bulan, 'Penelantaran');
        $this->sub_data('lb3jktpdadetail as Penelantaran_46_60', '46_sampai_60', $data, $tahun, $type, $bulan, 'Penelantaran');
        $this->sub_data('lb3jktpdadetail as Penelantaran_60', '60_keatas', $data, $tahun, $type, $bulan, 'Penelantaran');

        $this->sub_data('lb3jktpdadetail as Penanganan_0_15', '0_sampai_15', $data, $tahun, $type, $bulan, 'Penanganan');
        $this->sub_data('lb3jktpdadetail as Penanganan_16_45', '16_sampai_45', $data, $tahun, $type, $bulan, 'Penanganan');
        $this->sub_data('lb3jktpdadetail as Penanganan_46_60', '46_sampai_60', $data, $tahun, $type, $bulan, 'Penanganan');
        $this->sub_data('lb3jktpdadetail as Penanganan_60', '60_keatas', $data, $tahun, $type, $bulan, 'Penanganan');

        //kytd
        $this->sub_data('lb3kytd', 'unmet_need', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3kytd', 'kehamilan_diluar_nikah', $data, $tahun, $type, $bulan);
        $this->sub_data('lb3kytd', 'kegagalan_kb', $data, $tahun, $type, $bulan);

        $data->when( $puskesmas_id, function ($query,  $puskesmas_id) {
            $query->whereIn('id',  $puskesmas_id);
        });
        return $data;
    }

    public function index(Request $request)
    {

        $config['page_title'] = "Laporan";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Laporan"],
        ];

        if ($request->ajax()) {
          $data = $this->data($request);
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
        }

        return view('backend.laporan.index', compact('config', 'page_breadcrumbs'));
    }

    public function datatable(Request $request)
    {

        // $config['page_title'] = "Laporan";
        // $page_breadcrumbs = [
        //   ['url' => '#', 'title' => "Laporan"],
        // ];

        if ($request->ajax()) {
          $data = $this->data($request);
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
        }

        // return view('backend.laporan.index', compact('config', 'page_breadcrumbs'));
    }

}
