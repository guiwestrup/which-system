<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('DistrosTableSeeder');
        $this->call('ImagesTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('TagsTableSeeder');
    }
}
