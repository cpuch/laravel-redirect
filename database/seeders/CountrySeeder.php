<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get json file.
        $json = file_get_contents('https://datahub.io/core/country-list/r/data.json');

        // Read json file.
        $data = json_decode($json);

        // Seed the table.
        foreach ($data as $country) {
            Country::create([
                'code' => $country->Code,
                'name' => $country->Name,
            ]);
        }
    }
}
