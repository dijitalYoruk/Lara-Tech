<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //////////////////////////////////////////////////
        $id1 = DB::table('main_categories')->insertGetId([
            'name' => "Smart Phone",
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Apple",
            'main_category_id' => $id1,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Huawei",
            'main_category_id' => $id1,
        ]);


        DB::table('sub_categories')->insert([
            'name' => "Samsung",
            'main_category_id' => $id1,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Xioami",
            'main_category_id' => $id1,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "LG",
            'main_category_id' => $id1,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "HTC",
            'main_category_id' => $id1,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Nokia",
            'main_category_id' => $id1,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Blackberry",
            'main_category_id' => $id1,
        ]);
        //////////////////////////////////////////////////

        //////////////////////////////////////////////////
        $id2 = DB::table('main_categories')->insertGetId([
            'name' => "Television",
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Samsung",
            'main_category_id' => $id2,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "LG",
            'main_category_id' => $id2,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Sony",
            'main_category_id' => $id2,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Philips",
            'main_category_id' => $id2,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Telefunken",
            'main_category_id' => $id2,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Grundig",
            'main_category_id' => $id2,
        ]);
        //////////////////////////////////////////////////

        //////////////////////////////////////////////////
        $id3 = DB::table('main_categories')->insertGetId([
            'name' => "Camera",
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Canon",
            'main_category_id' => $id3,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Nikon",
            'main_category_id' => $id3,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Sony",
            'main_category_id' => $id3,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "GoPro",
            'main_category_id' => $id3,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Leica",
            'main_category_id' => $id3,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Panasonic",
            'main_category_id' => $id3,
        ]);
        //////////////////////////////////////////////////

        //////////////////////////////////////////////////
        $id4 = DB::table('main_categories')->insertGetId([
            'name' => "Console & Components",
        ]);

        DB::table('sub_categories')->insert([
            'name' => "PlayStation 4",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "PlayStation 3",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Xbox One",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Xbox 360",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Nintendo Switch",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Nintendo 3DS",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Wii U",
            'main_category_id' => $id4,
        ]);
        //////////////////////////////////////////////////

        //////////////////////////////////////////////////
        $id5 = DB::table('main_categories')->insertGetId([
            'name' => "PC & Components",
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Ram",
            'main_category_id' => $id5,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Graphic Card",
            'main_category_id' => $id5,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "CPU",
            'main_category_id' => $id5,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "PC Case",
            'main_category_id' => $id5,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "SSD",
            'main_category_id' => $id5,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "HDD",
            'main_category_id' => $id5,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Monitor",
            'main_category_id' => $id5,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Mouse & Keyboard",
            'main_category_id' => $id5,
        ]);
        //////////////////////////////////////////////////

        //////////////////////////////////////////////////
        $id6 = DB::table('main_categories')->insertGetId([
            'name' => "Tablet",
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Apple",
            'main_category_id' => $id6,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Samsung",
            'main_category_id' => $id6,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Huawei",
            'main_category_id' => $id6,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Lenovo",
            'main_category_id' => $id6,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Acepad",
            'main_category_id' => $id6,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Microsoft",
            'main_category_id' => $id6,
        ]);
        //////////////////////////////////////////////////

        //////////////////////////////////////////////////
        $id7 = DB::table('main_categories')->insertGetId([
            'name' => "Printer",
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Canon",
            'main_category_id' => $id7,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "HP",
            'main_category_id' => $id7,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Samsung",
            'main_category_id' => $id7,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Brother",
            'main_category_id' => $id7,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Epson",
            'main_category_id' => $id7,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Lexmark",
            'main_category_id' => $id7,
        ]);
        //////////////////////////////////////////////////

        //////////////////////////////////////////////////
        DB::table('main_categories')->insert([
            'name' => "Games",
        ]);
        
        DB::table('sub_categories')->insert([
            'name' => "PC",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "PlayStation 4",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "PlayStation 3",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Xbox One",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Xbox 360",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Nintendo Switch",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Nintendo 3DS",
            'main_category_id' => $id4,
        ]);

        DB::table('sub_categories')->insert([
            'name' => "Wii U",
            'main_category_id' => $id4,
        ]);
        //////////////////////////////////////////////////
    }
}
