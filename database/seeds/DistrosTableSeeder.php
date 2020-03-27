<?php

use App\Distro;
use Illuminate\Database\Seeder;

class DistrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $distro = factory(Distro::class, 10)->create();
    }
}
