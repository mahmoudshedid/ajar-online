<?php
/**
 * Created by PhpStorm.
 * User: mshedid
 * Date: 3/27/19
 * Time: 11:28 AM
 */

use \Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use \Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'first_name' => 'Mahmoud',
            'last_name' => 'Shedid',
            'email' => 'mahmoudshedid@gmail.com',
            'type' => '1',
            'user_id' => '0',
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(50),
        ));

        $faker = Faker::create();

        foreach (range(1,4) as $index) {
            User::create(array(
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'type' => '1',
                'user_id' => '0',
                'password' => Hash::make('123456'),
                'remember_token' => Str::random(50),
            ));
        }

        foreach (range(1,5) as $index) {
            User::create(array(
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'type' => '2',
                'user_id' => '0',
                'password' => Hash::make('123456'),
                'remember_token' => Str::random(50),
            ));
        }

        $users = DB::table('users')->where('type', '1')->get();

        foreach ($users as $user) {
            foreach (range(1,3) as $index) {
                User::create(array(
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'email' => $faker->email,
                    'type' => '3',
                    'user_id' => $user->id,
                    'password' => Hash::make('123456'),
                    'remember_token' => Str::random(50),
                ));
            }
        }
    }
}