<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_administrator = User::create([
            'name'       => "ADMINISTRATOR",
            'username'   => "admin",
            'email'      => "admin@mail.com",
            'divisi_id'  => 1,
            'ptpn_id'    => 1,
            'uuid'       => (string) Str::uuid(),
            'password'   => bcrypt("ptpnsukses"),
            'sap_id'     => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $user_admin_holding = User::create([
            'name'       => "ADMINISTRATOR HOLDING",
            'username'   => "admin_holding",
            'email'      => "admin_holding@mail.com",
            'divisi_id'  => 1,
            'ptpn_id'    => 1,
            'uuid'       => (string) Str::uuid(),
            'password'   => bcrypt("ptpnsukses"),
            'sap_id'     => 'admin_holding',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $user_administrator->assignRole('SUPER ADMINISTRATOR');
        $user_admin_holding->assignRole('ADMINISTRATOR HOLDING');
    }
}
