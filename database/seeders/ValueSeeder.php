<?php

namespace Database\Seeders;

use App\Models\Value;
use Illuminate\Database\Seeder;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Value::create([
            "attribute_id" => 1,
            "name" => json_encode(["uz" => "Qizil", "ru" => "Красный"]),
        ]);

        Value::create([
            "attribute_id" => 1,
            "name" => json_encode(["uz" => "Qora", "ru" => "Черный"]),
        ]);

        Value::create([
            "attribute_id" => 1,
            "name" => json_encode(["uz" => "Jigarrang", "ru" => "Коричневый"]),
        ]);

        Value::create([
            "attribute_id" => 2,
            "name" => json_encode(["uz" => "MDF", "ru" => "МДФ"]),
        ]);

        Value::create([
            "attribute_id" => 2,
            "name" => json_encode(["uz" => "LDSP", "ru" => "ЛДСП"]),
        ]);
    }
}
