<?php
/**
 * Created by PhpStorm.
 * User: mshedid
 * Date: 3/28/19
 * Time: 12:15 AM
 */

use App\Models\Unit;
use App\Models\User;
use \Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UnitsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('units')->delete();

        $landlords = DB::table('users')->where('type', '1')->get();
        $faker = Faker::create();

        $index = 6;

        foreach ($landlords as $landlord) {
            Unit::create(array(
                'name' => $faker->firstName,
                'tenant_id' => User::where('type', 2)->find($index)->id,
                'landlord_id' => $landlord->id,
            ));
            $index++;
        }
    }
}