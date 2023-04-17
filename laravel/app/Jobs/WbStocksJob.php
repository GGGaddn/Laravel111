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
use App\Models\WbStocks;

class WbStocksJob implements ShouldQueue
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
                $wb_item = new WbStocks();
                if(isset($item['lastChangeDate'])) $wb_item->lastChangeDate = $item['lastChangeDate'];
                if(isset($item['supplierArticle'])) $wb_item->supplierArticle = $item['supplierArticle'];
                if(isset($item['techSize'])) $wb_item->techSize = $item['techSize'];
                if(isset($item['barcode'])) $wb_item->barcode = $item['barcode'];
                if(isset($item['quantity'])) $wb_item->quantity = $item['quantity'];
                if(isset($item['isSupply'])) $wb_item->isSupply = $item['isSupply'];
                if(isset($item['isRealization'])) $wb_item->isRealization = $item['isRealization'];
                if(isset($item['quantityFull'])) $wb_item->quantityFull = $item['quantityFull'];
                if(isset($item['warehouseName'])) $wb_item->warehouseName = $item['warehouseName'];
                if(isset($item['nmId'])) $wb_item->nmId = $item['nmId'];
                if(isset($item['subject'])) $wb_item->subject = $item['subject'];
                if(isset($item['category'])) $wb_item->category = $item['category'];
                if(isset($item['daysOnSite'])) $wb_item->daysOnSite = $item['daysOnSite'];
                if(isset($item['brand'])) $wb_item->brand = $item['brand'];
                if(isset($item['SCCode'])) $wb_item->SCCode = $item['SCCode'];
                if(isset($item['Price'])) $wb_item->Price = $item['Price'];
                if(isset($item['Discount'])) $wb_item->Discount = $item['Discount'];                  
                $wb_item->save();
                $count++;
            }

            Log::info("Информация о продажах за " . $response['params']['dateFrom'] . ' успешно загружена! Кол-во записей: ' . $count);
        } elseif($response['many_requests']) {
            //Если вернется tooManyRequests, перезапускаем Job через 1 минуту
            WbStocksJob::dispatch($this->dateFrom)->delay(now()->addMinutes(1));
        }    
    }
}
