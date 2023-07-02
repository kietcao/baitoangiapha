<?php

namespace Database\Seeders;

use App\Models\ConfigTemp;
use Illuminate\Database\Seeder;

class ConfigTempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfigTemp::create([
            'title' => 'Trần Nguyễn Lê',
            'template_id' => 1,
        ]);
    }
}
