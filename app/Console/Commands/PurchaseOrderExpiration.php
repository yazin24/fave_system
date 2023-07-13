<?php

namespace App\Console\Commands;

use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PurchaseOrderExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purchase-orders:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'all purchase orders that have exceeded the time limit for approval';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredOrders = PurchaseOrder::where('status', 3)
                -> where ('created_at', '<=', Carbon::now() -> subMinutes(5))
                ->get();

        foreach($expiredOrders as $order){
            $order -> status = 4;
            $order -> save();
        }

        $this -> info('Expired Purchase Order has been processed!');
    }
}
