<?php

namespace App\Traits;

use App\Models\Tickets;
use App\Models\ITPersonnel;

trait RoundRobinAssignable
{
    // Safely formats the IT personnel's full name, handling NULL middle initials.
    private function formatFullName($personnel): string
    {
        if (!$personnel) {
            return '';
        }

        $parts = array_filter([
            $personnel->firstname ?? null,
            $personnel->middle_initial ?? null,
            $personnel->lastname ?? null
        ], fn($val) => !is_null($val) && trim($val) !== '');

        return implode(' ', $parts);
    }

    // Calculates the next IT personnel in line using Round-Robin logic for a given area & technical service.
    // Automatically loops back to index 0 when the end of the pool is reached.
    private function getNextAssignedPersonnel(string $area, ?string $service = null)
    {
        if (empty($area)) {
            return null;
        }

        // 1. Fetch all personnel in this area ordered by ID sequence
        $allAreaPersonnel = ITPersonnel::where('it_area', $area)
            ->orderBy('id', 'asc')
            ->get();

        if ($allAreaPersonnel->isEmpty()) {
            return null;
        }

        $cleanService = $service ? trim($service) : null;
        $usedServiceFilter = false;

        // 2. Filter personnel matching the technical service category
        $pool = collect();
        if ($cleanService) {
            $pool = $allAreaPersonnel->filter(function ($p) use ($cleanService) {
                $p_services = array_map('trim', explode(',', $p->tech_services_category ?? ''));
                return in_array($cleanService, $p_services, true);
            })->values();

            if ($pool->isNotEmpty()) {
                $usedServiceFilter = true;
            }
        }

        // Fallback to all area personnel if no exact service match exists
        if ($pool->isEmpty()) {
            $pool = $allAreaPersonnel->values();
        }

        $totalCount = $pool->count();
        if ($totalCount === 0) {
            return null;
        }

        // 3. Find last submitted ticket for this area and service
        $ticketPk = (new Tickets)->getKeyName();
        $lastTicketQuery = Tickets::where('it_area', $area)->orderBy($ticketPk, 'desc');

        if ($cleanService && $usedServiceFilter) {
            $lastTicketQuery->where('service', $cleanService);
        }

        $lastTicket = $lastTicketQuery->first();

        // 4. Calculate next index (Modulo ensures loop back to index 0 when last person is reached)
        $nextIndex = 0;

        if ($lastTicket && $lastTicket->it_email) {
            $lastEmail = trim($lastTicket->it_email);
            $lastIndex = $pool->search(function ($p) use ($lastEmail) {
                return strtolower(trim($p->it_email)) === strtolower($lastEmail);
            });

            if ($lastIndex !== false) {
                // Example: Pool size 3. Last assigned index = 2 (3rd person).
                // (2 + 1) % 3 = 0 -> Loops back to the 1st person!
                $nextIndex = ($lastIndex + 1) % $totalCount;
            }
        }

        return $pool->get($nextIndex);
    }
}