<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesMkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert(array(
            array('zip_code' => '2330', 'city_name' => 'Берово', 'city_name_en' => 'Berovo'),
			array('zip_code' => '7000', 'city_name' => 'Битола', 'city_name_en' => 'Bitola'),
			array('zip_code' => '1484', 'city_name' => 'Богданци', 'city_name_en' => 'Bogdanci'),
			array('zip_code' => '1250', 'city_name' => 'Дебар', 'city_name_en' => 'Debar'),
			array('zip_code' => '2320', 'city_name' => 'Делчево', 'city_name_en' => 'Delčevo'),
			array('zip_code' => '1442', 'city_name' => 'Демир Капија', 'city_name_en' => 'Demir Kapija'),
			array('zip_code' => '7240', 'city_name' => 'Демир Хисар', 'city_name_en' => 'Demir Hisar'),
			array('zip_code' => '1480', 'city_name' => 'Гевгелија', 'city_name_en' => 'Gevgelija'),
			array('zip_code' => '1230', 'city_name' => 'Гостивар', 'city_name_en' => 'Gostivar'),
			array('zip_code' => '1430', 'city_name' => 'Кавадарци', 'city_name_en' => 'Kavadarci'),
			array('zip_code' => '6250', 'city_name' => 'Кичево', 'city_name_en' => 'Kičevo'),
			array('zip_code' => '2300', 'city_name' => 'Кочани', 'city_name_en' => 'Kočani'),
			array('zip_code' => '1360', 'city_name' => 'Кратово', 'city_name_en' => 'Kratovo'),
			array('zip_code' => '1330', 'city_name' => 'Крива Паланка', 'city_name_en' => 'Kriva Palanka'),
			array('zip_code' => '7550', 'city_name' => 'Крушево', 'city_name_en' => 'Kruševo'),
			array('zip_code' => '1300', 'city_name' => 'Куманово', 'city_name_en' => 'Kumanovo'),
			array('zip_code' => '6530', 'city_name' => 'Македонски Брод', 'city_name_en' => 'Makedonski Brod'),
			array('zip_code' => '2304', 'city_name' => 'Македонска Каменица', 'city_name_en' => 'Makedonska Kamenica'),
			array('zip_code' => '1440', 'city_name' => 'Неготино', 'city_name_en' => 'Negotino'),
			array('zip_code' => '6000', 'city_name' => 'Охрид', 'city_name_en' => 'Ohrid'),
			array('zip_code' => '2326', 'city_name' => 'Пехчево', 'city_name_en' => 'Pehčevo'),
			array('zip_code' => '7500', 'city_name' => 'Прилеп', 'city_name_en' => 'Prilep'),
			array('zip_code' => '2210', 'city_name' => 'Пробиштип', 'city_name_en' => 'Probištip'),
			array('zip_code' => '2420', 'city_name' => 'Радовиш', 'city_name_en' => 'Radoviš'),
			array('zip_code' => '7310', 'city_name' => 'Ресен', 'city_name_en' => 'Resen'),
			array('zip_code' => '2220', 'city_name' => 'Свети Николе', 'city_name_en' => 'Sveti Nikole'),
			array('zip_code' => '1000', 'city_name' => 'Скопје', 'city_name_en' => 'Skopje'),
			array('zip_code' => '6330', 'city_name' => 'Струга', 'city_name_en' => 'Struga'),
			array('zip_code' => '2400', 'city_name' => 'Струмица', 'city_name_en' => 'Strumica'),
			array('zip_code' => '2000', 'city_name' => 'Штип', 'city_name_en' => 'Štip'),
			array('zip_code' => '1200', 'city_name' => 'Тетово', 'city_name_en' => 'Tetovo'),
			array('zip_code' => '2460', 'city_name' => 'Валандово', 'city_name_en' => 'Valandovo'),
			array('zip_code' => '1400', 'city_name' => 'Велес', 'city_name_en' => 'Veles'),
			array('zip_code' => '2310', 'city_name' => 'Виница', 'city_name_en' => 'Vinica'),
			array('zip_code' => '', 'city_name' => 'Друго', 'city_name_en' => 'Other'),
			array('zip_code' => '1487', 'city_name' => 'Дојран', 'city_name_en' => 'Dojran')
        ));
    }
}
