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
     *   fuelCost   = (chargeableDistance / vehicle.mileage) × vehicle.oil_price
     *   driverCost = days × vehicle.driver_allowance
     *   holdCost   = days > 1 ? (days − 1) × vehicle.fare_per_day : 0
     *   subtotal   = fuelCost + driverCost + holdCost
     *   profit     = subtotal × (vehicle.profit_margin / 100)
     *   total      = round(subtotal + profit, nearest 10), minimum 100 NPR
     *
     * @return array{
     *     actual_distance_km: float,
     *     chargeable_distance_km: float,
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
    ): array {
        $chargeableDistance = $tripType === 'one_way'
            ? $actualDistanceKm * 2
            : $actualDistanceKm;

        $fuelUsed = $chargeableDistance / (float) $vehicle->mileage;
        $fuelCost = $fuelUsed * (float) $vehicle->oil_price;

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
            'fuel_cost' => round($fuelCost, 2),
            'driver_cost' => round($driverCost, 2),
            'hold_cost' => round($holdCost, 2),
            'subtotal' => round($subtotal, 2),
            'profit_amount' => round($profitAmount, 2),
            'total' => $total,
        ];
    }
}
