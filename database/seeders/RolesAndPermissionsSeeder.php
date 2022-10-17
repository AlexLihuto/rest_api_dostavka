<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'add order']);
        Permission::create(['name' => 'view order']);
        Permission::create(['name' => 'view list of orders']);
        Permission::create(['name' => 'delete order']);
        Permission::create(['name' => 'update order']);

        // create roles
        Role::create(['name' => 'super-admin'])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => 'buyer'])
            ->givePermissionTo('add order');

        Role::create(['name' => 'seller'])
            ->givePermissionTo(['view order','view list of orders']);

        Role::create(['name' => 'courier'])
            ->givePermissionTo('view order');
    }
}
