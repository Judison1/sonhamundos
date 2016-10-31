<?php
use App\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::insert([
        	['name' => 'Desenvolvedor', 'description' => "O carinha do TI"],
        	['name' => 'Administrador', 'description' => "O carinha que manda"],
        	['name' => 'Supervisor', 'description' => "O carinha que pensa que manda"],
        	['name' => 'Redator', 'description' => "O carinha que trabalha"]
        ]);
    }
}
