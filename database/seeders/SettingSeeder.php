<?php

namespace Database\Seeders;

use App\Models\Setting;

use Illuminate\Database\Seeder;


class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create admin
        Setting::updateOrCreate([

            'site_name' => 'Dating App',
            'email' => 'admin@mail.com',

        ]);
    }
}
