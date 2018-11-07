<?php

use Illuminate\Database\Seeder;

class SentinelDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Users
        DB::table('users')->truncate();

        $admin = Sentinel::getUserRepository()->create(array(
            'email'    => 'admin@admin.com',
            'password' => '123456789'
        ));

        $user = Sentinel::getUserRepository()->create(array(
            'email'    => 'user@user.com',
            'password' => '123456789'
        ));

        // Create Activations
        DB::table('activations')->truncate();
        $code = Activation::create($admin)->code;
        Activation::complete($admin, $code);
        $code = Activation::create($user)->code;
        Activation::complete($user, $code);

        // Create Roles
        $administratorRole = Sentinel::getRoleRepository()->create(array(
            'name' => 'Administrator',
            'slug' => 'administrator',
            'permissions' => array(
                'users.create' => true,
                'users.update' => true,
                'users.view' => true,
                'users.destroy' => true,
                'roles.create' => true,
                'roles.update' => true,
                'roles.view' => true,
                'roles.delete' => true
            )
        ));
        $basicRole = Sentinel::getRoleRepository()->create(array(
            'name' => 'Basic',
            'slug' => 'basic',
            'permissions' => array(

            )
        ));

        // Assign Roles to Users
        $administratorRole->users()->attach($admin);
        $basicRole->users()->attach($user);
    }
}
