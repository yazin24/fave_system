<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class ViewPurchaseOrderController extends Controller
{
    public function view_purchase_order(PurchaseOrder $purchase)
    {
       //$currentDate = Carbon::now() -> toDateString();

       $totalAmount = $purchase -> purchaseOrderItems -> sum('amount');


        return view('purchasing.view_purchase', ['purchase' => $purchase, 'totalAmount' => $totalAmount]);
    }

    public function generate_po_receipt(PurchaseOrder $purchase)
    {
        $templateReceiptPath = ('receipts/po_template.docx');

        $templateReceipt = new TemplateProcessor($templateReceiptPath);

        $templateReceipt -> setValue('PO', $purchase -> po_number);

        $templateReceipt -> setValue('PO_DATE', $purchase -> created_at);

        $templateReceipt -> setvalue('SUPPLIER', $purchase -> purchaseOrderSupplier -> supplier_name);

        $templateReceipt -> setValue('REQUESTED_BY', $purchase -> purchaseOrderCredentials -> requested_by);

        $templateReceipt -> setValue('PREPARED_BY', $purchase -> purchaseOrderCredentials -> prepared_by);

        $templateReceipt -> setValue('APPROVED_BY', $purchase -> purchaseOrderCredentials -> approved_by);

        // $currentDate = Carbon::now() -> toDateString();

        // $totalAmount = DB::table('purchase_order_items')
        //             -> whereDate('created_at', '=', $currentDate)
        //             ->sum('amount');


        $templateReceipt -> setValue('TOTAL', $purchase -> purchaseOrderItems -> sum('amount'));

        $items = $purchase -> purchaseOrderItems;
        $itemRows = 16;

        $itemIndex = 1;

        foreach($items as $item)
        {

            $templateReceipt -> setValue("ITEM_QUANTITY{$itemIndex}", $item -> quantity);

            $templateReceipt -> setValue("ITEM_NAME{$itemIndex}", $item -> item_name);

            $templateReceipt ->  setValue("UNIT_PRICE{$itemIndex}", $item -> unit_price);

            $templateReceipt -> setValue("AMOUNT{$itemIndex}", $item -> amount);

            $itemIndex++;

        }

         //     //this remove the placeholder for the remaining rows in the table thats empty
         for ($i = $itemIndex; $i <= $itemRows; $i++) {
            $templateReceipt->setValue("ITEM_QUANTITY{$i}", '');
            $templateReceipt->setValue("ITEM_NAME{$i}", '');
            $templateReceipt->setValue("UNIT_PRICE{$i}", '');
            $templateReceipt->setValue("AMOUNT{$i}", '');
        }

        $savePath = public_path('P.O_' . $purchase -> po_number . '_receipt.docx');
        $templateReceipt -> saveAs($savePath);

        return response() -> download($savePath) -> deleteFileAfterSend(true);


    }
}
