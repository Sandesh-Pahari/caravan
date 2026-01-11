<?php

namespace App\Services;

use RuntimeException;

class DistanceService
{
    /**
     * Minimum acceptable ratio of road distance to straight-line distance.
     * Road distance should never realistically be shorter than the aerial distance
     * (small tolerance covers GPS rounding near identical points).
     */
    private const MIN_ROAD_RATIO = 0.9;

    /**
     * Maximum acceptable ratio of road distance to straight-line distance.
     * Nepal's extreme mountain switchback routes can legitimately reach 4–5×.
     * Anything beyond this is almost certainly a tampered value.
     */
    private const MAX_ROAD_RATIO = 5.0;

    /**
     * Fallback road correction factor when no client-side OSRM distance is available.
     * Represents the average Nepal road-to-aerial ratio across mixed terrain.
     */
    private const FALLBACK_ROAD_FACTOR = 1.4;

    /**
     * Validate and return the driving distance (km) between two coordinates.
     *
     * When the browser submits an OSRM-computed distance, it is used directly
     * after a Haversine bounds-check to detect manipulation. This gives real
     * road-routing accuracy (switchbacks, mountain passes) without a server-side
     * API call. If no client distance is provided, the Haversine × road factor
     * fallback is used instead.
     *
     * @throws RuntimeException when locations are too close or the submitted
     *                          distance falls outside plausible bounds
     */
    public function verify(
        float $pickupLat,
        float $pickupLng,
        float $dropLat,
        float $dropLng,
        ?float $clientDistanceKm = null,
    ): float {
        $straightLineKm = $this->haversineKm($pickupLat, $pickupLng, $dropLat, $dropLng);

        if ($straightLineKm < 0.1) {
            throw new RuntimeException(
                'Pickup and drop locations are too close together. Please select different locations.'
            );
        }

        if ($clientDistanceKm !== null && $clientDistanceKm > 0) {
            $ratio = $clientDistanceKm / $straightLineKm;

            if ($ratio < self::MIN_ROAD_RATIO || $ratio > self::MAX_ROAD_RATIO) {
                throw new RuntimeException(
                    'The submitted distance appears invalid. Please reselect your pickup and drop locations and try again.'
                );
            }

            return round($clientDistanceKm, 2);
        }

        return round($straightLineKm * self::FALLBACK_ROAD_FACTOR, 2);
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
