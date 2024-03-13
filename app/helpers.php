<?php

declare(strict_types=1);

if (!function_exists('calculate_average_laptime')) {
    function calculate_average_laptime($laptimes)
    {

        if (empty($laptimes)) {
            return '00:00:000';
        } else {

            $laptimeCount = count($laptimes);
            $laptimeTotal = 0;
            foreach ($laptimes as $laptime) {
                list($minutes, $seconds, $milliseconds) = explode(':', $laptime['time']);
                $laptimeTotal += $minutes * 60 * 1000 + $seconds * 1000 + $milliseconds;
            }
            $laptimeAverage = $laptimeTotal / $laptimeCount;
            $minutes = floor($laptimeAverage / 60000);
            $seconds = floor(($laptimeAverage % 60000) / 1000);
            $milliseconds = $laptimeAverage % 1000;
            return sprintf('%02d:%02d:%03d', $minutes, $seconds, $milliseconds);
        }
    }
}
