<?php

namespace App\Services;

use RuntimeException;

class DistanceService
{
    /**
     * Road distance correction factor for Nepal.
     *
     * Nepal's terrain (hills, mountains, switchback roads) makes actual road
     * distances roughly 1.4× the straight-line (Haversine) distance on average.
     */
    private const ROAD_FACTOR = 1.4;

    /**
     * Verify and return the estimated driving distance (km) between two coordinates.
     *
     * Calculated server-side from the submitted coordinates using the Haversine
     * formula plus a Nepal road correction factor. This prevents any frontend
     * manipulation of distance values while requiring no external API.
     *
     * @throws RuntimeException when the locations are identical or too close to route
     */
    public function verify(
        float $pickupLat,
        float $pickupLng,
        float $dropLat,
        float $dropLng,
    ): float {
        $straightLineKm = $this->haversineKm($pickupLat, $pickupLng, $dropLat, $dropLng);

        if ($straightLineKm < 0.1) {
            throw new RuntimeException(
                'Pickup and drop locations are too close together. Please select different locations.'
            );
        }

        return round($straightLineKm * self::ROAD_FACTOR, 2);
    }

    /**
     * Calculate the great-circle distance between two coordinates in kilometres.
     */
    private function haversineKm(
        float $lat1,
        float $lng1,
        float $lat2,
        float $lng2,
    ): float {
        $earthRadius = 6371.0;

        $latDelta = deg2rad($lat2 - $lat1);
        $lngDelta = deg2rad($lng2 - $lng1);

        $a = sin($latDelta / 2) ** 2
            + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($lngDelta / 2) ** 2;

        return $earthRadius * 2 * asin(sqrt($a));
    }
}
