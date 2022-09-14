<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
class InvoiceController extends Controller
{
    function download_invoice($order_id){
        //  return view('invoice.invoice',[
        //      'order_id'=>$order_id,
        //  ]);
        $pdf = PDF::loadView('invoice.invoice',[
            'order_id'=>$order_id,
        ]);

    

        return $pdf->stream('Invoice.pdf');
    }
}
