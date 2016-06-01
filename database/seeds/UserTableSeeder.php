<?php
use App\User;
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

        $user = new User;
        $user->name = "Judison Godinho de Sousa";
        $user->email = "judison@outlook.com";
        $user->password = Crypt::encrypt("123456");
        $user->avatar = "defaut.jpg";
        $user->save();
    }
}
