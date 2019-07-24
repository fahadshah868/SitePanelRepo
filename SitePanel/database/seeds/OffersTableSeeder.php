<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // DB::table('offers')->truncate();
        $offers = [];
        $faker = Factory::create();
        // define arrays with values
        $stores = [1,2,4,5,6,7,8,9];
        $categories = [1,2,3,4,5,6,7,8];
        $anchors = ['20% off','25% off','5$ off','5% off','10$ off'];
        $locations = ['Online','In-Store','Online & In-Store'];
        $types = ['Code','Sale'];
        $codes = ['LOVE','FREEZE','23HHBIRD','FREEJOY'];
        $freeshipping = ['y','n'];
        $is_popular = ['y','n'];
        $display_at_home = ['y','n'];
        $is_verified = ['y','n'];
        // create array to inserting in db
        for($i=0; $i< 5000; $i++){
            // get random index values from above define arrays
            $store_index = array_rand($stores,1);
            $category_index = array_rand($categories,1);
            $anchor_index = array_rand($anchors,1);
            $location_index = array_rand($locations,1);
            $type_index = array_rand($types,1);
            $code_index = array_rand($codes,1);
            $freeshipping_index = array_rand($freeshipping,1);
            $is_popular_index = array_rand($is_popular,1);
            $display_at_home_index = array_rand($display_at_home,1);
            $is_verified_index = array_rand($is_verified,1);

            $code = null;
            if(strcasecmp($types[$type_index], 'Code')){
                $code = $types[$type_index];
            }
            $offers[] = [
                'store_id' => $stores[$store_index],
                'category_id' => $categories{$category_index},
                'title' => $faker->sentence(rand(8,10)),
                'anchor' => $anchors[$anchor_index],
                'location' => $locations[$location_index],
                'type' => $types[$type_index],
                'free_shipping' => $freeshipping[$freeshipping_index],
                'code' => $code,
                'details' => $faker->sentence(rand(12,20)),
                'starting_date' => new DateTime,
                'expiry_date' => '2020-07-05 16:02:51',
                'is_popular' => $is_popular[$is_popular_index],
                'display_at_home' => $display_at_home[$display_at_home_index],
                'is_verified' => $is_verified[$is_verified_index],
                'is_active' => 'y',
                'user_id' => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ];
        }

        DB::table('offers')->insert($offers);
    }
}
