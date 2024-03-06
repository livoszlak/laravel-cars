<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tracks = [
            ["track_name" => "Nurburgring Nordschleife", "track_length" => 20.8],
            ["track_name" => "Spa-Francorchamps", "track_length" => 7],
            ["track_name" => "Suzuka", "track_length" => 5.8],
            ["track_name" => "Circuit de la Sarthe", "track_length" => 13.6],
            ["track_name" => "Mount Panorama", "track_length" => 6.2],
            ["track_name" => "Laguna Seca", "track_length" => 3.6],
            ["track_name" => "Circuit de Monaco", "track_length" => 3.3],
            ["track_name" => "Monza", "track_length" => 5.7],
            ["track_name" => "Silverstone", "track_length" => 5.8],
            ["track_name" => "Interlagos", "track_length" => 4.3]
        ];

        foreach ($tracks as $trackData) {
            Track::create($trackData);
        }
    }
}
