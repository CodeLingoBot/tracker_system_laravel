<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('PermissionsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('ConnectRelationshipsSeeder');
        $this->call('UsersTableSeeder');

        Model::reguard();
    }
}
