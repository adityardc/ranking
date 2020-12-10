<?php

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
        $this->call(PtpnSeeder::class);
        $this->call(DivisiSeeder::class);
        $this->call(RolesAndPermissionsTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KomoditasTableSeeder::class);
        $this->call(SatuanTableSeeder::class);
        $this->call(GolonganTableSeeder::class);
        $this->call(MkgTableSeeder::class);
        $this->call(KpiTableSeeder::class);
    }
}
