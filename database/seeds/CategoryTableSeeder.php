<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->delete();

        factory(\App\Category::class, 10)->create();

    }
}
