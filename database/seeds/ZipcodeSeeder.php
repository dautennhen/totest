<?php

use Illuminate\Database\Seeder;
//use Maatwebsite\Excel\Facades\Excel;
use App\Models\Zipcode;

class ZipcodeSeeder extends Seeder {

    public function run() {
        $faker = \Faker\Factory::create();
        //$zipcodes = Excel::load('storage/app/excels/Serviceable.zip.codes.xlsx');//->get();
        //foreach($zipcodes as $key => $value){
        for ($i = 0; $i < 10; $i++) {
            $zipcode = new Zipcode();
            $zipcode->zipcode = $faker->numerify();
            $zipcode->city = $faker->city;
            $zipcode->save();
        }
        //}
    }

}
