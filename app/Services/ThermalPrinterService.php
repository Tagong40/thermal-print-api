<?php

// app/Services/ThermalPrinterService.php

namespace App\Services;

use Mike42\Escpos\PrintConnectors\UsbPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Endroid\QrCode\QrCode;



class ThermalPrinterService
{

    public function printReceipt($content)
    {

        // Enter the share name for your USB printer here
        // $connector = null;
        //$connector = new WindowsPrintConnector("Receipt Printer");

        /* Print a "Hello world" receipt" */
        $connector = new WindowsPrintConnector("POS-80");
        $printer = new Printer($connector);

        // $printer->setJustification(Printer::JUSTIFY_CENTER);
        // $printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
        $printer->setFont(Printer::FONT_B);
        $printer->setTextSize(2, 2);
        $printer->setJustification(Printer::JUSTIFY_CENTER);

        // Print store name and address
        $printer->text("233Lne Store\n");
        $printer->text("East Legon Hills\n");
        $printer->text("Accra Ghana\n");
        $printer->feed(1);

        // Set font back to normal
        $printer->selectPrintMode();

        $printer->text("Wed, May 27, 2010 . 9:28:53 AM\n");
        $printer->feed(1);
        $printer->setDoubleStrike(true);


        // Print receipt header
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Sales Receipt\n");
        $printer->feed(1);


        $printer->selectPrintMode();

        // Demo data
        $customerName = "John Doe";
        $items = [
            ['name' => 'Acer 31.5" 165Hz VGA Scr', 'price' => 2000.00],
            ['name' => 'Apple MacBook Air Laptop', 'price' => 1500.00],
            ['name' => 'Cobratype Elevate Gaming', 'price' => 2900.00],
            ['name' => 'STGAubron Gaming PC Diam', 'price' => 504.00],

        ];
        $totalAmount = 6000.00;

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("................................\n");
        $printer->feed(1);

        // Print customer name
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->setDoubleStrike(true);
        $printer->text("Customer:\n");
        $printer->selectPrintMode();
        $printer->text("$customerName\n");
        $printer->text("customer@example.com\n");
        $printer->text("02030039303\n");


        // Print customer name
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->setDoubleStrike(true);
        $printer->text("Employee:\n");
        $printer->selectPrintMode();
        $printer->text("$customerName\n");

        $printer->feed(1);


        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("................................\n");
        $printer->feed(1);


        // Print itemized list
        foreach ($items as $item) {
            $printer->text($item['name'] . " - $" . $item['price'] . "\n");
        }
        $printer->feed(1);

        $printer->selectPrintMode();

        // Print total amount
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text("Amount: $" . $totalAmount . "\n");
        $printer->text("Tax: $" . 0 . "\n");
        $printer->text("Total: $" . $totalAmount . "\n");
        $printer->feed(1);

        $printer->selectPrintMode();

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->qrCode("https://app.kartelsell.com", Printer::QR_ECLEVEL_L, 8);
        $printer->feed(2);

        // Print thank you message
        $printer->text("Thank you for shopping with us!\n");
        $printer->feed(5);
        // $printer->barcode("Thank you for shopping with us!\n");

        // Cut the receipt
        $printer->cut();

        // Close the printer
        $printer->close();
    }
}
