<?php

namespace App\Helpers;
use Carbon\Carbon;
use App\Models\StockBalances;
use App\Models\StockCards;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PenyesuaianStok
{

  public static function stockbalance($child, $parent, $info)
  {

    DB::beginTransaction();
    try {
        $stockbalances =  StockBalances::where(
            [
                ['item_id' , $child['item_id']]
            ]
         )->first();

         $stockcards  =   StockCards::create([
             'item_id'            => $child['item_id'],
             'qty'                => $info['qty'],
             'record_at'          => Carbon::now()->format('Y-m-d'),
             'link'               => $info['link'],
             'reference_type'     => $info[ 'reference_type'],
             'reference_id'       => $parent['id'],
          ]);
       
        DB::commit();
        return true;
    } catch (Throwable $throw) {
        return $throw;
        DB::rollBack();
    }


  }

}
