<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $cluster = ['1', '2'];
        $srv_node = ['subang01', 'subang02', 'subang03', 'subang04', 'subang05'];
        $operatingSystems = ['Windows Server', 'Ubuntu 22.04', 'Debian 11', 'CentOS 8', 'Fedora 34'];
        $socialMediaServers = ['Facebook Server', 'Twitter Server', 'Instagram Server', 'LinkedIn Server', 'TikTok Server'];

        foreach (range(1, 1000) as $index) {
            DB::table('listvm')->insert([
                'cluster' => $faker->randomElement($cluster),
                'vm' => $faker->randomElement($socialMediaServers),
                'os' => $faker->randomElement($operatingSystems),
                'srv_node' => $faker->randomElement($srv_node),
                'ip_public' => $faker->ipv4,
                'ip_private' => $faker->ipv4,
                'username' => $faker->username,
                'password' => $faker->password
            ]);
        }
    }
}