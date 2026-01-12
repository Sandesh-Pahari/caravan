<?php

namespace App\Services;

use App\Models\Vehicle;

class FareCalculationService
{
    /**
     * Calculate the full fare breakdown for a with_driver booking.
     *
     * Formula:
     *   chargeableDistance = one_way  → actualKm × 2 (vehicle must return)
     *                        round_trip → actualKm
     *   avgSpeed        = actualKm ÷ (durationSeconds ÷ 3600)
     *   roadMultiplier  = ≥50 km/h → 1.0 (highway)
     *                     25–50    → 1.25 (hilly roads)
     *                     <25      → 1.5  (mountain roads)
     *   fuelCost        = (chargeableDistance / vehicle.mileage) × vehicle.oil_price × roadMultiplier
     *   driverCost      = days × vehicle.driver_allowance
     *   holdCost        = days > 1 ? (days − 1) × vehicle.fare_per_day : 0
     *   subtotal        = fuelCost + driverCost + holdCost
     *   profit          = subtotal × (vehicle.profit_margin / 100)
     *   total           = round(subtotal + profit, nearest 10), minimum 100 NPR
     *
     * @return array{
     *     actual_distance_km: float,
     *     chargeable_distance_km: float,
     *     avg_speed_kmh: float|null,
     *     road_difficulty: string,
     *     road_multiplier: float,
     *     fuel_cost: float,
     *     driver_cost: float,
     *     hold_cost: float,
     *     subtotal: float,
     *     profit_amount: float,
     *     total: float,
     * }
     */
    public function calculate(
        Vehicle $vehicle,
        float $actualDistanceKm,
        int $days,
        string $tripType,
        ?int $durationSeconds = null,
    ): array {
        $chargeableDistance = $tripType === 'one_way'
            ? $actualDistanceKm * 2
            : $actualDistanceKm;

        // Derive road difficulty from OSRM travel time.
        // Slower average speed = more switchbacks / steeper grades = higher fuel burn per km.
        $roadMultiplier = 1.0;
        $roadDifficulty = 'Highway';
        $avgSpeedKmh = null;

        if ($durationSeconds !== null && $durationSeconds > 0 && $actualDistanceKm > 0) {
            $avgSpeedKmh = round($actualDistanceKm / ($durationSeconds / 3600), 1);

            if ($avgSpeedKmh >= 50) {
                $roadMultiplier = 1.0;
                $roadDifficulty = 'Highway';
            } elseif ($avgSpeedKmh >= 25) {
                $roadMultiplier = 1.25;
                $roadDifficulty = 'Hilly Roads';
            } else {
                $roadMultiplier = 1.5;
                $roadDifficulty = 'Mountain Roads';
            }
        }

        $fuelUsed = $chargeableDistance / (float) $vehicle->mileage;
        $fuelCost = $fuelUsed * (float) $vehicle->oil_price * $roadMultiplier;

        $driverCost = $days * (float) $vehicle->driver_allowance;

        $holdCost = $days > 1
            ? ($days - 1) * (float) $vehicle->fare_per_day
            : 0.0;

        $subtotal = $fuelCost + $driverCost + $holdCost;
        $profitAmount = $subtotal * ((float) $vehicle->profit_margin / 100);
        $rawTotal = $subtotal + $profitAmount;

        // Round to nearest 10, enforce minimum 100 NPR
        $total = (float) max(round($rawTotal / 10) * 10, 100);

        return [
            'actual_distance_km' => round($actualDistanceKm, 2),
            'chargeable_distance_km' => round($chargeableDistance, 2),
            'avg_speed_kmh' => $avgSpeedKmh,
            'road_difficulty' => $roadDifficulty,
            'road_multiplier' => $roadMultiplier,
            'fuel_cost' => round($fuelCost, 2),
            'driver_cost' => round($driverCost, 2),
            'hold_cost' => round($holdCost, 2),
            'subtotal' => round($subtotal, 2),
            'profit_amount' => round($profitAmount, 2),
            'total' => $total,
        ];
    }
}
