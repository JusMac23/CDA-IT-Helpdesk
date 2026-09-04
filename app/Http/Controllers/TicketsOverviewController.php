<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Tickets;

use App\PDF\TSARpdf;
use FPDF; 

class TicketsOverviewController extends Controller
{
    public function index()
    {
        // Total ticket counts
        $total = Tickets::count();
        $pending = Tickets::whereIn('status', ['Pending', 'Pending/Re-Assigned'])->count();
        $resolved = Tickets::where('status', 'Resolved')->count();

        // Count overdue (older than 3 days and not resolved)
        $overdue = Tickets::whereIn('status', ['Pending', 'Pending/Re-Assigned'])
            ->whereDate('date_created', '<', now()->subDays(3))
            ->count();

        // Group by IT Area
        $byItArea = DB::table('tickets')
            ->select('it_area', DB::raw('count(*) as total'))
            ->groupBy('it_area')
            ->get();

        // Group by IT Personnel
        $byItPersonnel = DB::table('tickets')
            ->select('it_personnel', DB::raw('COUNT(*) as total'))
            ->groupBy('it_personnel')
            ->get();

        // Group by Service Type
        $byService = Tickets::select('service')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('service')
            ->get();

        // Recently Resolved (latest 5)
        $recentlyResolved = Tickets::where('status', 'Resolved')
            ->orderByDesc('date_resolved')
            ->limit(5)
            ->get();

        // Overdue Tickets per Personnel (grouped)
        $overdueTickets = Tickets::where('status', '!=', 'Resolved')
            ->whereDate('date_created', '<', Carbon::now()->subDays(3))
            ->orderBy('it_personnel')
            ->get()
            ->groupBy('it_personnel');

        return view('tickets.overview_tickets', compact(
            'total',
            'pending',
            'resolved',
            'overdue',
            'byItArea',
            'byItPersonnel',
            'byService',
            'recentlyResolved',
            'overdueTickets'
        ));
    }

    public function exportPdf()
    {
        // 1. Fetch Metrics & Data (Aligned exactly with index() logic)
        $total    = Tickets::count();
        $pending  = Tickets::whereIn('status', ['Pending', 'Pending/Re-Assigned'])->count();
        $resolved = Tickets::where('status', 'Resolved')->count();

        // Count overdue (older than 3 days and not resolved)
        $overdue = Tickets::whereIn('status', ['Pending', 'Pending/Re-Assigned'])
            ->whereDate('date_created', '<', now()->subDays(3))
            ->count();

        // Group by IT Area
        $byItArea = DB::table('tickets')
            ->select('it_area', DB::raw('count(*) as total'))
            ->groupBy('it_area')
            ->get();

        // Group by IT Personnel
        $byItPersonnel = DB::table('tickets')
            ->select('it_personnel', DB::raw('COUNT(*) as total'))
            ->groupBy('it_personnel')
            ->get();

        // Group by Service Type
        $byService = Tickets::select('service')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('service')
            ->get();

        // Overdue Tickets List (Flat list for PDF table iteration)
        $overdueTickets = Tickets::where('status', '!=', 'Resolved')
            ->whereDate('date_created', '<', Carbon::now()->subDays(3))
            ->orderBy('it_personnel')
            ->get();

        // 2. Initialize FPDF Instance
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->AddPage();

        // --- HEADER BANNER ---
        $pdf->SetFillColor(15, 23, 42); // Navy Dark (#0f172a)
        $pdf->Rect(10, 10, 190, 22, 'F');

        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->SetXY(14, 13);
        $pdf->Cell(110, 6, 'Tickets Overview Report Summary', 0, 0, 'L');

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(203, 213, 225);
        $pdf->SetXY(120, 13);
        $pdf->Cell(75, 5, 'Generated: ' . Carbon::now()->format('M d, Y h:i A'), 0, 1, 'R');

        $pdf->SetFont('Arial', '', 8.5);
        $pdf->SetTextColor(148, 163, 184);
        $pdf->SetXY(14, 21);
        $pdf->Cell(110, 5, 'Cooperative Development Authority - ICT Helpdesk', 0, 0, 'L');

        $pdf->SetXY(120, 21);
        $pdf->Cell(75, 5, 'Scope: All CDA Offices', 0, 1, 'R');

        // --- STAT CARDS ROW ---
        $cards = [
            ['lbl' => 'TOTAL TICKETS', 'val' => $total, 'r' => 79, 'g' => 70, 'b' => 229],
            ['lbl' => 'PENDING TICKETS', 'val' => $pending, 'r' => 217, 'g' => 119, 'b' => 6],
            ['lbl' => 'RESOLVED TICKETS', 'val' => $resolved, 'r' => 5, 'g' => 150, 'b' => 105],
            ['lbl' => 'OVERDUE TICKETS', 'val' => $overdue, 'r' => 220, 'g' => 38, 'b' => 38],
        ];

        $startX = 10;
        $cardWidth = 44.5;
        $cardGap = 4;

        foreach ($cards as $i => $card) {
            $x = $startX + ($i * ($cardWidth + $cardGap));
            
            // Box Background & Border
            $pdf->SetFillColor(248, 250, 252);
            $pdf->Rect($x, 37, $cardWidth, 20, 'F');
            $pdf->SetDrawColor(226, 232, 240);
            $pdf->Rect($x, 37, $cardWidth, 20, 'D');

            // Top Color Strip Indicator
            $pdf->SetFillColor($card['r'], $card['g'], $card['b']);
            $pdf->Rect($x, 37, $cardWidth, 2.5, 'F');

            // Label
            $pdf->SetXY($x + 3, 41);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->SetTextColor(100, 116, 139);
            $pdf->Cell($cardWidth - 6, 4, $card['lbl'], 0, 1, 'L');

            // Value
            $pdf->SetXY($x + 3, 46);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetTextColor(15, 23, 42);
            $pdf->Cell($cardWidth - 6, 8, (string)$card['val'], 0, 1, 'L');
        }

        // --- SECTION 1: REGION & TECHNICAL PERSONNEL (SIDE-BY-SIDE) ---
        $startY1 = 64;

        // Header Titles
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(241, 245, 249);
        $pdf->SetDrawColor(226, 232, 240);

        // Left Table Header Title
        $pdf->SetTextColor(55, 48, 163);
        $pdf->SetXY(10, $startY1);
        $pdf->Cell(92, 7, '  Tickets by Region (IT Area)', 1, 0, 'L', true);

        // Right Table Header Title
        $pdf->SetTextColor(6, 95, 70);
        $pdf->SetXY(108, $startY1);
        $pdf->Cell(92, 7, '  Tickets by Technical Personnel', 1, 1, 'L', true);

        // Column Titles
        $pdf->SetFont('Arial', 'B', 7.5);
        $pdf->SetTextColor(71, 85, 105);
        $pdf->SetFillColor(248, 250, 252);

        $pdf->SetXY(10, $startY1 + 7);
        $pdf->Cell(67, 6, ' IT Area', 1, 0, 'L', true);
        $pdf->Cell(25, 6, 'Total ', 1, 0, 'R', true);

        $pdf->SetXY(108, $startY1 + 7);
        $pdf->Cell(67, 6, ' Technical Personnel', 1, 0, 'L', true);
        $pdf->Cell(25, 6, 'Total ', 1, 1, 'R', true);

        // Data Rows Loop
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(51, 65, 85);

        $maxRows1 = max(count($byItArea), count($byItPersonnel));
        $currY1 = $startY1 + 13;

        for ($i = 0; $i < $maxRows1; $i++) {
            $pdf->SetY($currY1);

            // Left Side: Region
            $pdf->SetX(10);
            if (isset($byItArea[$i])) {
                $pdf->Cell(67, 6, ' ' . substr($byItArea[$i]->it_area, 0, 36), 1, 0, 'L');
                $pdf->Cell(25, 6, $byItArea[$i]->total . ' ', 1, 0, 'R');
            } else {
                $pdf->Cell(67, 6, '', 1, 0, 'L');
                $pdf->Cell(25, 6, '', 1, 0, 'R');
            }

            // Right Side: Personnel
            $pdf->SetX(108);
            if (isset($byItPersonnel[$i])) {
                $personnelName = $byItPersonnel[$i]->it_personnel ?? 'Unassigned';
                $pdf->Cell(67, 6, ' ' . substr($personnelName, 0, 36), 1, 0, 'L');
                $pdf->Cell(25, 6, $byItPersonnel[$i]->total . ' ', 1, 1, 'R');
            } else {
                $pdf->Cell(67, 6, '', 1, 0, 'L');
                $pdf->Cell(25, 6, '', 1, 1, 'R');
            }

            $currY1 += 6;
        }

        // --- SECTION 2: SERVICES & OVERDUE TICKETS (SIDE-BY-SIDE) ---
        $startY2 = $currY1 + 8;

        // Header Titles
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(241, 245, 249);

        // Left Table Header Title
        $pdf->SetTextColor(146, 64, 14);
        $pdf->SetXY(10, $startY2);
        $pdf->Cell(92, 7, '  Tickets by Technical Service', 1, 0, 'L', true);

        // Right Table Header Title
        $pdf->SetTextColor(153, 27, 27);
        $pdf->SetXY(108, $startY2);
        $pdf->Cell(92, 7, '  Overdue Tickets Summary', 1, 1, 'L', true);

        // Column Titles
        $pdf->SetFont('Arial', 'B', 7.5);
        $pdf->SetTextColor(71, 85, 105);

        $pdf->SetXY(10, $startY2 + 7);
        $pdf->Cell(67, 6, ' Service Category', 1, 0, 'L', true);
        $pdf->Cell(25, 6, 'Total ', 1, 0, 'R', true);

        $pdf->SetXY(108, $startY2 + 7);
        $pdf->Cell(60, 6, ' Request Details', 1, 0, 'L', true);
        $pdf->Cell(32, 6, 'Assigned To ', 1, 1, 'L', true);

        // Data Rows Loop
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(51, 65, 85);

        $maxRows2 = max(count($byService), count($overdueTickets));
        $currY2 = $startY2 + 13;

        for ($i = 0; $i < $maxRows2; $i++) {
            $pdf->SetY($currY2);

            // Left Side: Services
            $pdf->SetX(10);
            if (isset($byService[$i])) {
                $pdf->Cell(67, 6, ' ' . substr($byService[$i]->service, 0, 36), 1, 0, 'L');
                $pdf->Cell(25, 6, $byService[$i]->total . ' ', 1, 0, 'R');
            } else {
                $pdf->Cell(67, 6, '', 1, 0, 'L');
                $pdf->Cell(25, 6, '', 1, 0, 'R');
            }

            // Right Side: Overdue Tickets
            $pdf->SetX(108);
            if (isset($overdueTickets[$i])) {
                $reqDetail = $overdueTickets[$i]->request ?? $overdueTickets[$i]->subject ?? 'Ticket #' . $overdueTickets[$i]->id;
                $pdf->Cell(60, 6, ' ' . substr($reqDetail, 0, 30), 1, 0, 'L');
                $personnel = $overdueTickets[$i]->it_personnel ?? 'Unassigned';
                $pdf->Cell(32, 6, ' ' . substr($personnel, 0, 17), 1, 1, 'L');
            } else {
                $pdf->Cell(60, 6, '', 1, 0, 'L');
                $pdf->Cell(32, 6, '', 1, 1, 'L');
            }

            $currY2 += 6;
        }

        // --- FOOTER NOTE ---
        $pdf->SetY(-20);
        $pdf->SetFont('Arial', 'I', 7.5);
        $pdf->SetTextColor(148, 163, 184);
        $pdf->Cell(190, 4, 'This document is an automatically generated report from the CDA-ICT Helpdesk System.', 0, 1, 'C');

        // Output to Browser Download
        $fileName = 'CDA_ICT_Tickets_Overview_Report_' . Carbon::now()->format('Y_m_d_His') . '.pdf';

        return response($pdf->Output('S', $fileName), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}