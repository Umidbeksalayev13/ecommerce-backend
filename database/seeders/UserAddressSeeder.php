<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{

    public function run(): void
    {
        User::find(2)->addresses()->create([
            "latitude"=> "41.310014",
            "longitude"=> "69.280742" ,
            "region"=> "Xorazm",
            "district"=> "Qo'shko'pir",
            "street"=> "Ittifoq Mahalla",
            "home"=>"10"
        ]);

        User::find(2)->addresses()->create([
            "latitude"=> "41.310014",
            "longitude"=> "69.280742" ,
            "region"=> "Xorazm",
            "district"=> "Urganch",
            "street"=> "Yangilik Mahalla",
            "home"=>"123"
        ]);
    }
}
