<?php
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::insert([
            'name' => 'Judison Godinho de Sousa',
            'email' => 'judison@outlook.com',
            'permission_id' => 1,
            'password' => bcrypt('123456'),
        ]);

        factory(App\User::class, 10)->create();
    }
}
