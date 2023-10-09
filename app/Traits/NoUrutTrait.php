<?php

namespace App\Traits;
use App\Models\ReceiveOrder;
use App\Models\ReturnReceiveOrder;
use App\Models\DeliveryOrder;
use App\Models\ReturnDeliveryOrder;
use App\Models\UsageOrder;
use App\Models\StockAdjustment;
use Carbon\Carbon;

trait NoUrutTrait
{

  public function KodeRo($date)
  {

    $tgl = date('Y-m-d', strtotime($date));
    $noUrut = ReceiveOrder::selectRaw("MAX(SUBSTRING(`code`, 11, 3)) AS max")
        ->whereDate('record_at', $tgl)
        ->first()->max ?? 0;
    $noUrut ++ ;
    $noUrutNext ='RO-' .Carbon::createFromFormat('Y-m-d', $tgl)->format('ymd') . '-'.str_pad($noUrut, 3, "0", STR_PAD_LEFT);
    return $noUrutNext;
  }

  public function KodeRRo($date)
  {

    $tgl = date('Y-m-d', strtotime($date));
    $noUrut = ReturnReceiveOrder::selectRaw("MAX(SUBSTRING(`code`, 12, 3)) AS max")
        ->whereDate('record_at', $tgl)
        ->first()->max ?? 0;
    $noUrut ++ ;
    $noUrutNext ='RRO-' .Carbon::createFromFormat('Y-m-d', $tgl)->format('ymd') . '-'.str_pad($noUrut, 3, "0", STR_PAD_LEFT);
    return $noUrutNext;
  }

  public function KodeDo($date)
  {

    $tgl = date('Y-m-d', strtotime($date));
    $noUrut = DeliveryOrder::selectRaw("MAX(SUBSTRING(`code`, 11, 3)) AS max")
        ->whereDate('record_at', $tgl)
        ->first()->max ?? 0;
    $noUrut ++ ;
    $noUrutNext ='DO-' .Carbon::createFromFormat('Y-m-d', $tgl)->format('ymd') . '-'.str_pad($noUrut, 3, "0", STR_PAD_LEFT);
    return $noUrutNext;
  }


  public function KodeRDo($date)
  {

    $tgl = date('Y-m-d', strtotime($date));
    $noUrut = ReturnDeliveryOrder::selectRaw("MAX(SUBSTRING(`code`, 12, 3)) AS max")
        ->whereDate('record_at', $tgl)
        ->first()->max ?? 0;
    $noUrut ++ ;
    $noUrutNext ='RDO-' .Carbon::createFromFormat('Y-m-d', $tgl)->format('ymd') . '-'.str_pad($noUrut, 3, "0", STR_PAD_LEFT);
    return $noUrutNext;
  }


  public function KodeUo($date)
  {

    $tgl = date('Y-m-d', strtotime($date));
    $noUrut = UsageOrder::selectRaw("MAX(SUBSTRING(`code`, 11, 3)) AS max")
        ->whereDate('record_at', $tgl)
        ->first()->max ?? 0;
    $noUrut ++ ;
    $noUrutNext ='UO-' .Carbon::createFromFormat('Y-m-d', $tgl)->format('ymd') . '-'.str_pad($noUrut, 3, "0", STR_PAD_LEFT);
    return $noUrutNext;
  }

  public function KodeSo($date)
  {

    $tgl = date('Y-m-d', strtotime($date));
    $noUrut = StockAdjustment::selectRaw("MAX(SUBSTRING(`code`, 11, 3)) AS max")
        ->whereDate('record_at', $tgl)
        ->first()->max ?? 0;
    $noUrut ++ ;
    $noUrutNext ='SO-' .Carbon::createFromFormat('Y-m-d', $tgl)->format('ymd') . '-'.str_pad($noUrut, 3, "0", STR_PAD_LEFT);
    return $noUrutNext;
  }



}
