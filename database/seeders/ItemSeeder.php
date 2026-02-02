<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $laptop = Category::where('name', 'Laptop')->first();
        $iot = Category::where('name', 'IoT')->first();
        $network = Category::where('name', 'Network')->first();
        $multimedia = Category::where('name', 'Multimedia')->first();

        $items = [
            // Laptop
            ['category_id' => $laptop->id, 'name' => 'MacBook Pro 14"', 'brand' => 'Apple', 'stock' => 5, 'image_url' => null],
            ['category_id' => $laptop->id, 'name' => 'ThinkPad T14', 'brand' => 'Lenovo', 'stock' => 8, 'image_url' => null],
            ['category_id' => $laptop->id, 'name' => 'Laptop Gaming ROG', 'brand' => 'ASUS', 'stock' => 3, 'image_url' => null],
            
            // IoT
            ['category_id' => $iot->id, 'name' => 'Arduino Uno R3', 'brand' => 'Arduino', 'stock' => 15, 'image_url' => null],
            ['category_id' => $iot->id, 'name' => 'Raspberry Pi 4', 'brand' => 'Raspberry Pi', 'stock' => 10, 'image_url' => null],
            ['category_id' => $iot->id, 'name' => 'ESP32 DevKit', 'brand' => 'Espressif', 'stock' => 20, 'image_url' => null],
            ['category_id' => $iot->id, 'name' => 'Sensor Kit Ultimate', 'brand' => 'Generic', 'stock' => 12, 'image_url' => null],
            
            // Network
            ['category_id' => $network->id, 'name' => 'Cisco Router 2901', 'brand' => 'Cisco', 'stock' => 4, 'image_url' => null],
            ['category_id' => $network->id, 'name' => 'Managed Switch 24 Port', 'brand' => 'TP-Link', 'stock' => 6, 'image_url' => null],
            ['category_id' => $network->id, 'name' => 'Access Point AC1200', 'brand' => 'Ubiquiti', 'stock' => 8, 'image_url' => null],
            ['category_id' => $network->id, 'name' => 'Kabel UTP Cat6 (Box)', 'brand' => 'Belden', 'stock' => 10, 'image_url' => null],
            
            // Multimedia
            ['category_id' => $multimedia->id, 'name' => 'Kamera DSLR D7500', 'brand' => 'Nikon', 'stock' => 3, 'image_url' => null],
            ['category_id' => $multimedia->id, 'name' => 'Tripod Professional', 'brand' => 'Manfrotto', 'stock' => 5, 'image_url' => null],
            ['category_id' => $multimedia->id, 'name' => 'Ring Light 18"', 'brand' => 'Godox', 'stock' => 7, 'image_url' => null],
            ['category_id' => $multimedia->id, 'name' => 'Microphone Condenser', 'brand' => 'Audio-Technica', 'stock' => 6, 'image_url' => null],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
