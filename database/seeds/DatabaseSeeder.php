<?php

use App\EnvData;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // $this->call(UsersTableSeeder::class);

        /*
         * Test envdata values
         */

        $envData = new EnvData();
        $envData->timestamp = '2010-09-11 23:16:00';
        $envData->coord_x = -8.22875976562;
        $envData->coord_y = 41.2399291992;
        $envData->co = 1.21389;
        $envData->no2 = 1.59365;
        $envData->proc_no2 = 4.605;
        $envData->o3 = 367.23;
        $envData->proc_o3 = 4.605;
        $envData->save();

        $envData = new EnvData();
        $envData->timestamp = '2010-09-11 23:18:00';
        $envData->coord_x = -8.22875976562;
        $envData->coord_y = 41.2399291992;
        $envData->co = 1.31389;
        $envData->no2 = 1.49365;
        $envData->proc_no2 = 4.205;
        $envData->o3 = 367.15;
        $envData->proc_o3 = 4.305;
        $envData->save();

    }

}
