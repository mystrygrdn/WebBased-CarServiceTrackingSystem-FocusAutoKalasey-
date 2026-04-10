<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoginAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userdata = [
        [
        'name'=>'Darlene',
        'username'=>'ddinb01',
        'password'=>bcrypt('12345')
        ],
        [
        'name'=>'Martin',
        'username'=>'focusauto01',
        'password'=>bcrypt('54321')
        ],
        [
        'name'=>'Tirza',
        'username'=>'dkizmis01',
        'password'=>bcrypt('98765')
        ],
    ];

    foreach($userdata as $key=>$val){
        User::create($val);
    }
    }
}
