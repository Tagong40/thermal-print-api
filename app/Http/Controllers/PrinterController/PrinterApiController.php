<?php

namespace App\Http\Controllers\PrinterController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ThermalPrinterService;

class PrinterApiController extends Controller
{
    public function printReceipt(ThermalPrinterService $printerService)
    {
        $content = "Your receipt content here";
        $printerService->printReceipt($content);

        return response()->json(['message' => 'Receipt printed successfully']);
    }
}
