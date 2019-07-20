<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //    public function run()
        $role_admin_root = Role::create(['name' => 'Admin Root']);
        $role_UP = Role::create(['name' => 'Utente Proprietario']);
        $role_UPR = Role::create(['name' => 'Utente Proprietario Registrato']);
        $role_UPRA = Role::create(['name' => 'Utente Proprietario Registrato con Appartamento']);
        $role_UI = Role::create(['name' => 'Utente Interessato']);

        $permissions_root = [

          'role-list',

          'role-create',

          'role-edit',

          'role-delete',

          'rooms-list',

          'rooms-create',

          'rooms-edit',

          'rooms-delete',

          'rooms-search',

           'user-list',

           'user-create',

           'user-edit',

           'user-delete',


         ];

         $permissions_UPRA = [

            'rooms-list',

            'rooms-create',

            'rooms-edit',

            'rooms-delete',


         ];

         $permissions_UPR = [

            'rooms-list',

            'rooms-create',

            'rooms-edit',

            'rooms-delete',

         ];
        foreach ($permissions_root as $permission) {
            $role_admin_root->givePermissionTo($permission);
       }
       foreach ($permissions_UPRA as $permission) {
            $role_UPRA->givePermissionTo($permission);
       }
       foreach ($permissions_UPR as $permission) {
            $role_UPR->givePermissionTo($permission);
       }
    }
}
