<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Item::class, 50)->create()->each(function ($item) {
	        $item->units()->saveMany(factory(App\ItemUnits::class, rand(2, 5))->make());
	    });
    }
}
