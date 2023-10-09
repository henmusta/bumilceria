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
    public function data(Request $request){
        $tahun = date('Y', strtotime($request['tahun']));
        $puskesmas_id =$request['updt_puskesmas_id'];
        // $data = Puskesmas::selectRaw('
        //     updt_puskesmas.id as id,
        //     updt_puskesmas.name as puskesmas,
        //     sum(lb3_ibu_hamil.jsih) as jsih,
        //     sum(lb3_ibu_hamil.k1_total) as k1_total,
        //     sum(lb3_ibu_hamil.k1_murni) as k1_murni,
        //     sum(lb3_ibu_hamil.k4) as k4,
        //     sum(lb3_ibu_hamil.k6) as k6,
        //     sum(lb3_ibu_hamil.ihttm) as ihttm,
        //     sum(lb3_ibu_hamil.ibdjtd) as ibdjtd,
        //     sum(lb3_ibu_hamil.ihdktb) as ihdktb,
        //     sum(lb3_ibu_hamil.k1_ok) as k1_ok,
        //     sum(lb3_ibu_hamil.k5_ok) as k5_ok,
        //     sum(lb3_ibu_hamil.k1_usg_ok) as k1_usg_ok,
        //     sum(lb3_ibu_hamil.k5_usg_ok) as k5_usg_ok,
        //     sum(lb3_ibu_hamil.ibmb_kia) as ibmb_kia,


        //     sum(lb3_ibu_bersalin.jsib) as jsib,
        //     sum(lb3_ibu_bersalin.ibu_bersalin) as ibu_bersalin,
        //     sum(lb3_ibu_bersalin.ibu_bersalin_nakes) as ibu_bersalin_nakes,
        //     sum(lb3_ibu_bersalin.ibu_bersalin_faskes) as ibu_bersalin_faskes,
        //     sum(lb3_ibu_bersalin.kf1) as kf1,
        //     sum(lb3_ibu_bersalin.kf_lengkap) as kf_lengkap,
        //     sum(lb3_ibu_bersalin.vita_ibu_nifas) as vita_ibu_nifas,

        //     sum(lb3_rtk.anemia_trimester1) as anemia_trimester1,
        //     sum(lb3_rtk.anemia_trimester3) as anemia_trimester3,
        //     sum(lb3_rtk.pendarahan) as pendarahan,
        //     sum(lb3_rtk.pre_eklamsia) as pre_eklamsia,
        //     sum(lb3_rtk.infeksi) as infeksi,
        //     sum(lb3_rtk.tuberculosis) as tuberculosis,
        //     sum(lb3_rtk.malaria) as malaria,
        //     sum(lb3_rtk.jantung) as jantung,
        //     sum(lb3_rtk.diabetes_mellitus) as diabetes_mellitus,
        //     sum(lb3_rtk.obesitas) as obesitas,
        //     sum(lb3_rtk.covid19) as covid19,
        //     sum(lb3_rtk.abortus) as abortus,
        //     sum(lb3_rtk.lain_lain) as lain_lain,

        //     sum(lb3_bayi.sasaran_bayi_laki_laki) as sasaran_bayi_laki_laki,
        //     sum(lb3_bayi.sasaran_bayi_perempuan) as sasaran_bayi_perempuan,
        //     sum(lb3_bayi.bayi_lahir_laki_laki) as bayi_lahir_laki_laki,
        //     sum(lb3_bayi.bayi_lahir_perempuan) as bayi_lahir_perempuan,
        //     sum(lb3_bayi.kn1_laki_laki) as kn1_laki_laki,
        //     sum(lb3_bayi.kn1_perempuan) as kn1_perempuan,
        //     sum(lb3_bayi.kn3_laki_laki) as kn3_laki_laki,
        //     sum(lb3_bayi.kn3_perempuan) as kn3_perempuan,
        //     sum(lb3_bayi.bbl_lld_shk) as bbl_lld_shk,
        //     sum(lb3_bayi.bbl_pd_shk) as bbl_pd_shk,

        //     sum(lb3_brtk.bblr) as bblr,
        //     sum(lb3_brtk.asfiksia) as asfiksia,
        //     sum(lb3_brtk.infeksi) as infeksi_brtk,
        //     sum(lb3_brtk.tetanus) as tetanus,
        //     sum(lb3_brtk.kelainan) as kelainan,
        //     sum(lb3_brtk.covid19) as covid19_brtk,
        //     sum(lb3_brtk.hipotiroid) as hipotiroid,
        //     sum(lb3_brtk.lain_lain) as lain_lain_brtk,


        //     sum(lb3_balita.sasaran_balita_laki_laki) as sasaran_balita_laki_laki,
        //     sum(lb3_balita.sasaran_balita_perempuan) as sasaran_balita_perempuan,
        //     sum(lb3_balita.bllmb_kia) as bllmb_kia,
        //     sum(lb3_balita.bpmb_kia) as bpmb_kia,
        //     sum(lb3_balita.blldtk) as blldtk,
        //     sum(lb3_balita.bpdtk) as bpdtk,
        //     sum(lb3_balita.blldgp) as blldgp,
        //     sum(lb3_balita.bpdgp) as bpdgp,
        //     sum(lb3_balita.sdidtk_bll) as sdidtk_bll,
        //     sum(lb3_balita.sdidtk_bp) as sdidtk_bp,
        //     sum(lb3_balita.kbs_ll) as kbs_ll,
        //     sum(lb3_balita.kbs_p) as kbs_p,
        //     sum(lb3_balita.mtbs_ll) as mtbs_ll,
        //     sum(lb3_balita.mtbs_p) as mtbs_p,

        //     sum(lki.jpkih) as jpkih,
        //     sum(lki.jpkib) as jpkib,


        //     sum(lbtt.dokter_terlatih_usg) as dokter_terlatih_usg,
        //     sum(lbtt.kader_terlatih_ptkb) as kader_terlatih_ptkb,
        //     sum(lbtt.nakes_terlatih_mbts) as nakes_terlatih_mbts,
        //     sum(lbtt.nakes_terlatih_tlgb) as nakes_terlatih_tlgb,
        //     sum(lbtt.nakes_terlatih_pmba) as nakes_terlatih_pmba,
        //     sum(lbtt.nakes_terlatih_sdidtk) as nakes_terlatih_sdidtk,
        //     sum(lbtt.nakes_terlatih_imtbsgb) as nakes_terlatih_imtbsgb,
        //     sum(lbtt.nakes_terlatih_pmba_sdidtk) as nakes_terlatih_pmba_sdidtk

        // ')
        // ->leftJoin('lb3_bayi', 'lb3_bayi.updt_puskesmas_id', '=', 'updt_puskesmas.id')
        // ->when($tahun, function ($query, $tahun) {
        //     return $query->whereYear('lb3_bayi.tahun1', $tahun);
        //  })
        // ->leftJoin('lb3_balita', 'lb3_balita.updt_puskesmas_id', '=', 'updt_puskesmas.id')
        // ->leftJoin('lb3_brtk', 'lb3_brtk.updt_puskesmas_id', '=', 'updt_puskesmas.id')
        // ->leftJoin('lb3_rtk', 'lb3_rtk.updt_puskesmas_id', '=', 'updt_puskesmas.id')
        // ->leftJoin('lb3_ibu_bersalin', 'lb3_ibu_bersalin.updt_puskesmas_id', '=', 'updt_puskesmas.id')
        // ->leftJoin('lb3_ibu_hamil', 'lb3_ibu_hamil.updt_puskesmas_id', '=', 'updt_puskesmas.id')
        // ->leftJoin('lbtt', 'lbtt.updt_puskesmas_id', '=', 'updt_puskesmas.id')
        // ->leftJoin('lki', 'lki.updt_puskesmas_id', '=', 'updt_puskesmas.id')

        // $data


        // // ->when($tgl_akhir, function ($query, $tgl_akhir) {
        // //     return $query->whereDate('stock_cards.record_at', '<=', $tgl_akhir);
        // // })
        // ->groupBy('updt_puskesmas.id');
        $data = Puskesmas::selectRaw('puskesmas.name as puskesmas, puskesmas.id as id')
           ->withSum([
            'lb3ibuhamil' => function ($query) use ($tahun) {
                $query->whereYear('tahun', '=', $tahun);
            }], 'jsih')
            ->withSum([
                'lb3ibuhamil' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'k1_total')
            ->withSum([
                'lb3ibuhamil' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'k1_murni')
            ->withSum([
                'lb3ibuhamil' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'k4')
            ->withSum([
                'lb3ibuhamil' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'k6')
            ->withSum([
                'lb3ibuhamil' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'ihttm')
            ->withSum([
                'lb3ibuhamil' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'ibdjtd')
            ->withSum([
                'lb3ibuhamil' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'ihdktb')
            ->withSum([
                'lb3ibuhamil' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'k1_ok')
            ->withSum([
                'lb3ibuhamil' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'k5_ok')
            ->withSum([
                'lb3ibuhamil' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'k1_usg_ok')
            ->withSum([
                'lb3ibuhamil' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'k5_usg_ok')
            ->withSum([
                'lb3ibuhamil' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'ibmb_kia')

            //bersalin

            ->withSum([
                'lb3ibubersalin' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'jsib')
            ->withSum([
                'lb3ibubersalin' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'ibu_bersalin')
            ->withSum([
                'lb3ibubersalin' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'ibu_bersalin_nakes')
            ->withSum([
                'lb3ibubersalin' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'ibu_bersalin_faskes')
            ->withSum([
                'lb3ibubersalin' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'kf1')
            ->withSum([
                'lb3ibubersalin' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'kf_lengkap')
            ->withSum([
                'lb3ibubersalin' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'vita_ibu_nifas')




            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'anemia_trimester1')
            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'anemia_trimester3')
            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'pendarahan')
            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'pre_eklamsia')
            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'infeksi')
            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'tuberculosis')
            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'malaria')
            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'jantung')
            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'diabetes_mellitus')

            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'obesitas')
            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'covid19')
            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'abortus')

            ->withSum([
                'lb3rtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'lain_lain')

                    //     sum(lb3_bayi.sasaran_bayi_laki_laki) as sasaran_bayi_laki_laki,
        //     sum(lb3_bayi.sasaran_bayi_perempuan) as sasaran_bayi_perempuan,
        //     sum(lb3_bayi.bayi_lahir_laki_laki) as bayi_lahir_laki_laki,
        //     sum(lb3_bayi.bayi_lahir_perempuan) as bayi_lahir_perempuan,
        //     sum(lb3_bayi.kn1_laki_laki) as kn1_laki_laki,
        //     sum(lb3_bayi.kn1_perempuan) as kn1_perempuan,
        //     sum(lb3_bayi.kn3_laki_laki) as kn3_laki_laki,
        //     sum(lb3_bayi.kn3_perempuan) as kn3_perempuan,
        //     sum(lb3_bayi.bbl_lld_shk) as bbl_lld_shk,
        //     sum(lb3_bayi.bbl_pd_shk) as bbl_pd_shk,

            ->withSum([
                'lb3bayi' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'sasaran_bayi_laki_laki')

            ->withSum([
                'lb3bayi' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'sasaran_bayi_perempuan')

            ->withSum([
                'lb3bayi' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'bayi_lahir_laki_laki')
            ->withSum([
                'lb3bayi' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'bayi_lahir_perempuan')
            ->withSum([
                'lb3bayi' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'kn1_laki_laki')
            ->withSum([
                'lb3bayi' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'kn1_perempuan')

            ->withSum([
                'lb3bayi' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'kn3_laki_laki')
            ->withSum([
                'lb3bayi' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'kn3_perempuan')
            ->withSum([
                'lb3bayi' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'bbl_lld_shk')
            ->withSum([
                'lb3bayi' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'bbl_pd_shk')

                    //     sum(lb3_brtk.bblr) as bblr,
        //     sum(lb3_brtk.asfiksia) as asfiksia,
        //     sum(lb3_brtk.infeksi) as infeksi_brtk,
        //     sum(lb3_brtk.tetanus) as tetanus,
        //     sum(lb3_brtk.kelainan) as kelainan,
        //     sum(lb3_brtk.covid19) as covid19_brtk,
        //     sum(lb3_brtk.hipotiroid) as hipotiroid,
        //     sum(lb3_brtk.lain_lain) as lain_lain_brtk,

            ->withSum([
                'lb3brtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'bblr')
            ->withSum([
                'lb3brtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'asfiksia')

            ->withSum([
                'lb3brtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'infeksi')

            ->withSum([
                'lb3brtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'tetanus')

            ->withSum([
                'lb3brtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'kelainan')

            ->withSum([
                'lb3brtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'covid19')

            ->withSum([
                'lb3brtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'hipotiroid')


            ->withSum([
                'lb3brtk' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'lain_lain')

        //     sum(lb3_balita.sasaran_balita_laki_laki) as sasaran_balita_laki_laki,
        //     sum(lb3_balita.sasaran_balita_perempuan) as sasaran_balita_perempuan,
        //     sum(lb3_balita.bllmb_kia) as bllmb_kia,
        //     sum(lb3_balita.bpmb_kia) as bpmb_kia,
        //     sum(lb3_balita.blldtk) as blldtk,
        //     sum(lb3_balita.bpdtk) as bpdtk,
        //     sum(lb3_balita.blldgp) as blldgp,
        //     sum(lb3_balita.bpdgp) as bpdgp,
        //     sum(lb3_balita.sdidtk_bll) as sdidtk_bll,
        //     sum(lb3_balita.sdidtk_bp) as sdidtk_bp,
        //     sum(lb3_balita.kbs_ll) as kbs_ll,
        //     sum(lb3_balita.kbs_p) as kbs_p,
        //     sum(lb3_balita.mtbs_ll) as mtbs_ll,
        //     sum(lb3_balita.mtbs_p) as mtbs_p,


            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'sasaran_balita_laki_laki')

            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'sasaran_balita_perempuan')

            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'bllmb_kia')


            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'blldtk')

            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'bpdtk')

            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'bpmb_kia')

            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'blldgp')
            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'bpdgp')

            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'sdidtk_bll')

            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'sdidtk_bp')

            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'kbs_ll')

            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'kbs_p')

            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'mtbs_ll')
            ->withSum([
                'lb3balita' => function ($query) use ($tahun) {
                    $query->whereYear('tahun', '=', $tahun);
            }], 'mtbs_p')

                   //     sum(lki.jpkih) as jpkih,
        //     sum(lki.jpkib) as jpkib,

        ->withSum([
            'lki' => function ($query) use ($tahun) {
                $query->whereYear('tahun', '=', $tahun);
        }], 'jpkih')

        ->withSum([
            'lki' => function ($query) use ($tahun) {
                $query->whereYear('tahun', '=', $tahun);
        }], 'jpkib')


             //     sum(lbtt.dokter_terlatih_usg) as dokter_terlatih_usg,
        //     sum(lbtt.kader_terlatih_ptkb) as kader_terlatih_ptkb,
        //     sum(lbtt.nakes_terlatih_mbts) as nakes_terlatih_mbts,
        //     sum(lbtt.nakes_terlatih_tlgb) as nakes_terlatih_tlgb,
        //     sum(lbtt.nakes_terlatih_pmba) as nakes_terlatih_pmba,
        //     sum(lbtt.nakes_terlatih_sdidtk) as nakes_terlatih_sdidtk,
        //     sum(lbtt.nakes_terlatih_imtbsgb) as nakes_terlatih_imtbsgb,
        //     sum(lbtt.nakes_terlatih_pmba_sdidtk) as nakes_terlatih_pmba_sdidtk

        ->withSum([
            'lbtt' => function ($query) use ($tahun) {
                $query->whereYear('tahun', '=', $tahun);
        }], 'dokter_terlatih_usg')
        ->withSum([
            'lbtt' => function ($query) use ($tahun) {
                $query->whereYear('tahun', '=', $tahun);
        }], 'kader_terlatih_ptkb')
        ->withSum([
            'lbtt' => function ($query) use ($tahun) {
                $query->whereYear('tahun', '=', $tahun);
        }], 'nakes_terlatih_mbts')
        ->withSum([
            'lbtt' => function ($query) use ($tahun) {
                $query->whereYear('tahun', '=', $tahun);
        }], 'nakes_terlatih_tlgb')
        ->withSum([
            'lbtt' => function ($query) use ($tahun) {
                $query->whereYear('tahun', '=', $tahun);
        }], 'nakes_terlatih_pmba')
        ->withSum([
            'lbtt' => function ($query) use ($tahun) {
                $query->whereYear('tahun', '=', $tahun);
        }], 'nakes_terlatih_sdidtk')
        ->withSum([
            'lbtt' => function ($query) use ($tahun) {
                $query->whereYear('tahun', '=', $tahun);
        }], 'nakes_terlatih_imtbsgb')

        ->withSum([
            'lbtt' => function ($query) use ($tahun) {
                $query->whereYear('tahun', '=', $tahun);
        }], 'nakes_terlatih_pmba_sdidtk')
        ->when( $puskesmas_id, function ($query,  $puskesmas_id) {
            $query->whereIn('id',  $puskesmas_id);
        })


            ;


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

}
