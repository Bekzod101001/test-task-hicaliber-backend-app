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

        Property::upsert($rows, ['name'], ['price', 'bedrooms', 'bathrooms', 'storeys', 'garages']);
    }
}
