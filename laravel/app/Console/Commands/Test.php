<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Libraries\Wildberries;
use App\Libraries\Ozon;
use App\Models\OzonStocks;
use App\Models\WbIncomes;
use App\Models\WbOrders;
use App\Models\WbPrices;
use App\Models\WbReportDetailByPeriod;
use App\Models\WbSales;
use App\Models\WbStocks;
use Illuminate\Support\Carbon;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $wb = new Wildberries;
        $ozon = new Ozon;
        // $response = $wb->reportDetailByPeriod('01.03.2023', '15.03.2023');
        $response = $ozon->fbo_list();
        dd($response);
        if($response['result']) {
            $count = 0;
            foreach($response['data']['items'] as $item) { 
                $ozon_item = new OzonStocks();
                if(isset($item['product_id'])) $ozon_item->product_id = $item['product_id'];                       
                if(isset($item['offer_id'])) $ozon_item->offer_id = $item['offer_id'];   
                if(isset($item['stocks'])) foreach($item['stocks'] as $stock) {
                    if($stock['type'] == 'fbo') {
                        $ozon_item->fbo_present = $stock['present'];   
                        $ozon_item->fbo_reserved = $stock['reserved'];   
                    }

                    if($stock['type'] == 'fbs') {
                        $ozon_item->fbs_present = $stock['present'];   
                        $ozon_item->fbs_reserved = $stock['reserved'];   
                    }
                }               
                $ozon_item->save();
                $count++;
            }
        }
        $this->info('[OZON] Информация о количестве товаров успешна загружена! Кол-во записей: ' . $count);
    }
}