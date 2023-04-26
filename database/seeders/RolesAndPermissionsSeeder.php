<?php

namespace Database\Seeders;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //*Creamos los permisos */
        $crearUsuario = Permission::create(["name" => "create user"]);
        $verUsuario = Permission::create(["name" => "view user"]);
        $modificarUsuario = Permission::create(["name" => "edit user"]);
        $eliminarUsuario = Permission::create(["name" => "delete user"]);

        $verCosa = Permission::create(["name" => "ver boton"]);

        //*Creamos roles y asignamos permisos */
        $admin = Role::create(["name" => "administrador"]);
        $admin->givePermissionTo($crearUsuario);
        $admin->givePermissionTo($verUsuario);
        $admin->givePermissionTo($modificarUsuario);
        $admin->givePermissionTo($eliminarUsuario);
        $admin->givePermissionTo($verCosa);

        $escritor = Role::create(["name" => "funcionario"]);
        // $escritor->givePermissionTo($verCosa);

        //*Asingamos rol a user 1 */
        // $user = User::find(1);
        // $user->assignRole($admin);
    }
}
