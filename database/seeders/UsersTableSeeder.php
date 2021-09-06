<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $username = array('muhtarom', 'zain', 'test');
        $email = array('muhtarom@gmail.com', 'zain@gmail.com', 'test@gmail.com');
        $time = Carbon::now();
        
        for ($x = 0; $x < count($username); $x++) {

            $users = [
                "username" => $username[$x],
                "email" => $email[$x],
                "password" => Hash::make(123456789),
                "created_at" => $time->toDateTimeString(),
                "updated_at" => $time->toDateTimeString(),
            ];

            User::insert($users);
        }
    }
}
