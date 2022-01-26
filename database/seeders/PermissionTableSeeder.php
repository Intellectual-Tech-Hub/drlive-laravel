<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
            array(
                'name' => 'role_list',
                'guard_name' => 'web'
            ),
            array(
                'name' => 'role_create',
                'guard_name' => 'web'
            ),
            array(
                'name' => 'role_update',
                'guard_name' => 'web'
            ),
            array(
                'name' => 'role_delete',
                'guard_name' => 'web'
            ),
            array(
                'name' => 'permission_list',
                'guard_name' => 'web'
            ),
            array(
                'name' => 'permission_create',
                'guard_name' => 'web'
            ),
            array(
                'name' => 'permission_update',
                'guard_name' => 'web'
            ),
            array(
                'name' => 'permission_delete',
                'guard_name' => 'web'
            ),
            array(
                'name' => 'permission_assign',
                'guard_name' => 'web'
            ),
            array(
                'name' => 'user_list',
                'guard_name' => 'web'
            ),
            array(
                'name' => 'user_create',
                'guard_name' => 'web'
            ),
            array(
                'name' => 'user_update',
                'guard_name' => 'web'
            ),
            array(
                'name' => 'user_delete',
                'guard_name' => 'web'
            ),
        );

        DB::table('permissions')->insert($permissions);
    }
}
