<?php


use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\PermissionTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(PermissionTableSeeder::class);

  $this->call(CreateAdminUserSeeder::class);
    }
}
