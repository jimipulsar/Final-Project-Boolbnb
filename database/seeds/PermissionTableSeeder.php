<?php


use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()

    {

       $permissions = [
          'user-list',
          'user-edit',
          'user-create',
          'user-delete',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'rooms-list',
           'rooms-create',
           'rooms-edit',
           'rooms-delete',
           'rooms-search',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }

    }

}
