<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Libraries\Ozon;
use App\Models\OzonFboList;
use App\Models\OzonStocks;
use Illuminate\Support\Facades\Log;

class OzonFboListJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $date_from;
    private $ozon;
    
    /**
     * Create a new job instance.
     */
    public function __construct($date_from = null) {
        $this->date_from = $date_from;
        $this->ozon = new Ozon;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = $this->ozon->fbo_list();
        if($response['result']) {
            $count = 0;
            foreach($response['data']['result'] as $item) { 
                $ozon_item = new OzonFboList();
                if(isset($item['order_id'])) $ozon_item->order_id = $item['order_id'];                                   
                if(isset($item['order_number'])) $ozon_item->order_number = $item['order_number'];                                   
                if(isset($item['posting_number'])) $ozon_item->posting_number = $item['posting_number'];                                   
                if(isset($item['status'])) $ozon_item->status = $item['status'];                                   
                if(isset($item['cancel_reason_id'])) $ozon_item->cancel_reason_id = $item['cancel_reason_id'];                                   
                if(isset($item['created_at'])) $ozon_item->ozon_created_at = $item['created_at'];                                   
                if(isset($item['in_process_at'])) $ozon_item->ozon_in_process_at = $item['in_process_at'];                                   
                if(isset($item['products'])) $ozon_item->products = $item['products'];                                   
                if(isset($item['analytics_data'])) $ozon_item->analytics_data = $item['analytics_data'];                                   
                if(isset($item['financial_data'])) $ozon_item->financial_data = $item['financial_data'];                                   
                if(isset($item['additional_data'])) $ozon_item->additional_data = $item['additional_data'];                                   
                $ozon_item->save();
                $count++;
            }

            Log::info('[OZON] Информация о количестве товаров успешна загружена! Кол-во записей: ' . $count);
        }
    }
}
