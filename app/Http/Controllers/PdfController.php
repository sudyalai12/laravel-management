<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function quotePdf(Quote $quote): \Illuminate\Http\Response
    {
        $customPaper = array(0, 0, 1012.507086613695, 809.9999999996175);
        $quote->generateReference();
        $file = "Q-" . date('mdY') . (date('y') + 1) . date('His') . ".pdf";
        return Pdf::loadView('pdf.quote', compact('quote'))->setPaper($customPaper, 'landscape')->save(public_path($file))->stream($file);
    }
}
