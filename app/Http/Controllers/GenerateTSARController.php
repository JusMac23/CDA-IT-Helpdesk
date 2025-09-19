<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

use Carbon\Carbon;

use App\Models\Tickets;
use App\PDF\TSARpdf;

class GenerateTSARController extends Controller
{
    public function generateTSAR($ticket_id)
    {
        $t = Tickets::findOrFail($ticket_id);

        $pdf = new TSARpdf();
        $pdf->AddPage();
        $pdf->SetMargins(25.4, 10, 25.4);
        $pdf->SetFont('Arial', '', 8);

        $pageWidth = $pdf->GetPageWidth();
        $pdf->Image(public_path('images/CDA-logo-RA11364-PNG.png'), 25.4, 25, 25);
        $pdf->Image(public_path('images/codedform.png'), $pageWidth - 25.4 - 30, 10, 30);

        $pdf->SetXY(25.4, 30);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(159.2, 5, 'COOPERATIVE DEVELOPMENT AUTHORITY', 0, 1, 'C');

        $pdf->SetXY(25.4, 35);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(159.2, 5, 'HEAD OFFICE', 0, 1, 'C');

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(25.4, 40);
        $pdf->Cell(159.2, 5, '827 Aurora Blvd., Service Road, Brgy. Immaculate Conception Cubao,', 0, 1, 'C');

        $pdf->SetXY(25.4, 44);
        $pdf->Cell(159.2, 5, '1111 Quezon City, Philippines', 0, 1, 'C');

        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(159.2, 6, 'INFORMATION AND COMMUNICATIONS TECHNOLOGY (ICT) OFFICE', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(159.2, 8, 'TECHNICAL SUPPORT ASSISTANCE REQUEST (TSAR) FORM', 0, 1, 'C');

        $pdf->Ln(8);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(79.6, 7, 'Division/Unit/Section:', 'LTR', 0);
        $pdf->Cell(79.6, 7, 'Date Request:', 'LTR', 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(79.6, 10, $t->division, 'LR', 0);
        $pdf->Cell(79.6, 10, Carbon::parse($t->date_created)->format('M d, Y h:i A'), 'LR', 1);
        $pdf->Cell(159.2, 0, '', 'T', 1);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(159.2, 7, 'Employee Name:', 'LTR', 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(159.2, 10, $t->firstname . ' ' . $t->lastname, 'LRB', 1);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(79.6, 7, 'Email Address:', 'LTR', 0);
        $pdf->Cell(79.6, 7, 'Request Number:', 'LTR', 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(79.6, 10, $t->email, 'LRB', 0);
        $pdf->Cell(79.6, 10, $t->ticket_number, 'LRB', 1);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(79.6, 7, 'Equipment Repairs:', 'LTR', 0);
        $pdf->Cell(79.6, 7, 'Technical Support Services:', 'LTR', 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(79.6, 21, $t->device, 'LRB', 0);
        $pdf->Cell(79.6, 21, $t->service, 'LRB', 1);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(159.2, 7, 'Technical Support Request Description/Definition:', 'LTR', 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(159.2, 21, $t->request, 'LRB');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(159.2, 7, 'Action Taken/Recommendation:', 'LTR', 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(159.2, 21, $t->action_taken ?? 'Pending', 'LRB');
        $pdf->Ln(14);

        $pdf->SetFont('Arial', 'B', 10);

        $pageHeight = $pdf->GetPageHeight();
        $bottomMargin = 62; 

        $signatureHeight = 15; 
        $signatureWidth = 40;  

        $ySignature = $pageHeight - $bottomMargin - $signatureHeight; 

        $xLeft = 25.4;        
        $xRight = $xLeft + 79.6; 

        // Show signature if it exists and file is found
        if ($t->client_signature && file_exists(public_path('storage/' . $t->client_signature))) {
            $pdf->Image(public_path('storage/' . $t->client_signature), $xLeft + 5, $ySignature, $signatureWidth, $signatureHeight);
            $yAfterSignature = $ySignature + $signatureHeight; 
        } else {
            $yAfterSignature = $ySignature + 10;
        }

        if ($t->personnel_signature && file_exists(public_path('storage/' . $t->personnel_signature))) {
            $pdf->Image(public_path('storage/' . $t->personnel_signature), $xRight + 5, $ySignature, $signatureWidth, $signatureHeight);
        }

        $pdf->Cell(79.6, 7, strtoupper($t->firstname . ' ' . $t->lastname . ' ' . Carbon::parse($t->date_created)->format('m/d/Y g:i A')), 0, 0, 'C');
        $pdf->Cell(79.6, 7, strtoupper($t->it_personnel . ' ' . Carbon::parse($t->date_resolved)->format('m/d/Y g:i A')), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(79.6, 7, 'Name/Signature of Responsible Staff/Date', 0, 0, 'C');
        $pdf->Cell(79.6, 7, 'Name/Signature of ICT Personnel/Date', 0, 1, 'C');

        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 8);

        $pdf->SetLineWidth(0.4); 
        $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 160, $pdf->GetY()); 

        $pdf->SetLineWidth(0.4);

        $pdf->Cell(129.6, 7, 'Softcopy ICT coded forms can be downloaded here:', 0, 0, 'R');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(29.6, 7, 'https:bit.ly/3NCfJCV', 0, 1);


        // Output PDF inline
        return response($pdf->Output('TSAR_'.$t->ticket_number.'.pdf', 'S'), 200)
                ->header('Content-Type', 'application/pdf');
    }
}
