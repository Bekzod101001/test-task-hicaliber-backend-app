<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Services\CsvParserService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $propertyDataFile = database_path('./seeders/data/property-data.csv');
        $rows = CsvParserService::parse($propertyDataFile);
        // insert current date and time to created_at column
        $rows = array_map(function ($row) {
            $row['created_at'] = now();
            return $row;
        }, $rows);

        Property::upsert($rows, ['name'], ['price', 'bedrooms', 'bathrooms', 'storeys', 'garages', 'created_at']);
    }
}
