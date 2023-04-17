<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Libraries\Wildberries;
use App\Models\WbSales;

class WbSalesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $dateFrom;
    private $wb;

    /**
     * Create a new job instance.
     */
    public function __construct($dateFrom = null) {
        $this->dateFrom = $dateFrom;
        $this->wb = new Wildberries;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = $this->wb->sales($this->dateFrom);

        if($response['result']) {
            $count = 0;
            foreach($response['data'] as $item) { 
                $wb_item = new WbSales();
                if(isset($item['date'])) $wb_item->date = $item['date'];
                if(isset($item['lastChangeDate'])) $wb_item->lastChangeDate = $item['lastChangeDate'];
                if(isset($item['supplierArticle'])) $wb_item->supplierArticle = $item['supplierArticle'];
                if(isset($item['techSize'])) $wb_item->techSize = $item['techSize'];
                if(isset($item['barcode'])) $wb_item->barcode = $item['barcode'];
                if(isset($item['totalPrice'])) $wb_item->totalPrice = $item['totalPrice'];
                if(isset($item['discountPercent'])) $wb_item->discountPercent = $item['discountPercent'];
                if(isset($item['isSupply'])) $wb_item->isSupply = $item['isSupply'];
                if(isset($item['isRealization'])) $wb_item->isRealization = $item['isRealization'];
                if(isset($item['promoCodeDiscount'])) $wb_item->promoCodeDiscount = $item['promoCodeDiscount'];
                if(isset($item['warehouseName'])) $wb_item->warehouseName = $item['warehouseName'];
                if(isset($item['countryName'])) $wb_item->countryName = $item['countryName'];
                if(isset($item['oblastOkrugName'])) $wb_item->oblastOkrugName = $item['oblastOkrugName'];
                if(isset($item['regionName'])) $wb_item->regionName = $item['regionName'];
                if(isset($item['incomeID'])) $wb_item->incomeID = $item['incomeID'];
                if(isset($item['saleID'])) $wb_item->saleID = $item['saleID'];
                if(isset($item['odid'])) $wb_item->odid = $item['odid'];
                if(isset($item['spp'])) $wb_item->spp = $item['spp'];
                if(isset($item['forPay'])) $wb_item->forPay = $item['forPay'];
                if(isset($item['finishedPrice'])) $wb_item->finishedPrice = $item['finishedPrice'];
                if(isset($item['priceWithDisc'])) $wb_item->priceWithDisc = $item['priceWithDisc'];
                if(isset($item['nmId'])) $wb_item->nmId = $item['nmId'];
                if(isset($item['subject'])) $wb_item->subject = $item['subject'];
                if(isset($item['category'])) $wb_item->category = $item['category'];
                if(isset($item['brand'])) $wb_item->brand = $item['brand'];
                if(isset($item['IsStorno'])) $wb_item->IsStorno = $item['IsStorno'];
                if(isset($item['gNumber'])) $wb_item->gNumber = $item['gNumber'];
                if(isset($item['sticker'])) $wb_item->sticker = $item['sticker'];
                if(isset($item['srid'])) $wb_item->srid = $item['srid'];                
                $wb_item->save();
                $count++;
            }

            Log::info("Информация о продажах за " . $response['params']['dateFrom'] . ' успешно загружена! Кол-во записей: ' . $count);
        } elseif($response['many_requests']) {
            //Если вернется tooManyRequests, перезапускаем Job через 1 минуту
            WbSalesJob::dispatch($this->dateFrom)->delay(now()->addMinutes(1));
        }    
    }
}
