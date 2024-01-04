<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $userData = [
        [
            'name'=>'Administrator',
            'email'=>'admin@gmail.com',
            'role'=>'Admin',
            'password'=>bcrypt('123456'),
        ],
        [
            'name'=>'NetAdmin',
            'email'=>'netadmin@gmail.com',
            'role'=>'Network Administrator',
            'password'=>bcrypt('123456'),
        ],
        [
            'name'=>'NetEngineer',
            'email'=>'netengineer@gmail.com',
            'role'=>'Network Technician',
            'password'=>bcrypt('123456'),
        ],
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
