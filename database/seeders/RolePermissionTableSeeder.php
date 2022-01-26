<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            //admin role permission assign
            array(
                'permission_id' => '1',
                'role_id' => '1'
            ),
            array(
                'permission_id' => '2',
                'role_id' => '1'
            ),
            array(
                'permission_id' => '3',
                'role_id' => '1'
            ),
            array(
                'permission_id' => '4',
                'role_id' => '1'
            ),
            array(
                'permission_id' => '5',
                'role_id' => '1'
            ),
            array(
                'permission_id' => '6',
                'role_id' => '1'
            ),
            array(
                'permission_id' => '7',
                'role_id' => '1'
            ),
            array(
                'permission_id' => '8',
                'role_id' => '1'
            ),
            array(
                'permission_id' => '9',
                'role_id' => '1'
            ),
            array(
                'permission_id' => '10',
                'role_id' => '1'
            ),
            array(
                'permission_id' => '11',
                'role_id' => '1'
            ),
            array(
                'permission_id' => '12',
                'role_id' => '1'
            ),
            array(
                'permission_id' => '13',
                'role_id' => '1'
            ),
            //doctor role permission assign
            
        );

        DB::table('role_has_permissions')->insert($roles);
    }
}
