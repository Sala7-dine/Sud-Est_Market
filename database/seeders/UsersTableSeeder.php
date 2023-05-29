<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([

            // Admin
            [
                "full_name" => "Super Admin",
                "username" => "admin",
                "email" => "admin@gmail.com",
                "password" =>Hash::make("1111"),
                "role" => "admin",
                "status" => "active",
            ],
            // Vendor 
            [
                "full_name" => "Super vendor",
                "username" => "vendor",
                "email" => "vendor@gmail.com",
                "password" =>Hash::make("1111"),
                "role" => "vendor",
                "status" => "active",
            ],
            // customer 
            [
                "full_name" => "Super customer",
                "username" => "customer",
                "email" => "customer@gmail.com",
                "password" =>Hash::make("1111"),
                "role" => "customer",
                "status" => "active",
            ],
            


        ]);
    }
}
