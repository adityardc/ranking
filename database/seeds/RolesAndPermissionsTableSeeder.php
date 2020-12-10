<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $arrayPermissions = [
            'permissions-list',
            'permissions-create',
            'permissions-edit',
            'permissions-edit',
            'permissions-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'perusahaan-list',
            'perusahaan-create',
            'perusahaan-edit',
            'perusahaan-delete',
            'divisi-list',
            'divisi-create',
            'divisi-edit',
            'divisi-delete',
            'komoditas-list',
            'komoditas-create',
            'komoditas-edit',
            'komoditas-delete',
            'kpi-list',
            'kpi-create',
            'kpi-edit',
            'kpi-delete',
            'karya-list',
            'karya-create',
            'karya-edit',
            'karya-delete',
            'karya-detail',
            'karyawan-list',
            'karyawan-create',
            'karyawan-edit',
            'karyawan-delete',
            'pengguna-list',
            'pengguna-create',
            'pengguna-edit',
            'pengguna-delete',
            'indikator-list',
            'indikator-create',
            'indikator-edit',
            'indikator-delete',
            'satuan-list',
            'satuan-create',
            'satuan-edit',
            'satuan-delete',
            'distribusi-list',
            'distribusi-create',
            'distribusi-detail',
            'penetapan-list',
            'penetapan-create',
            'penetapan-detail',
            'penetapan-cancel',
            'penetapan-print',
        ];

        $permissions = collect($arrayPermissions)->map(function($permission){
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

        $superRole = Role::create(['name' => 'SUPER ADMINISTRATOR']);
        $superRole->givePermissionTo(Permission::all());

        $role_admin_holding = Role::create(['name' => 'ADMINISTRATOR HOLDING'])->givePermissionTo([
            'perusahaan-list',
            'perusahaan-create',
            'perusahaan-edit',
            'perusahaan-delete',
            'divisi-list',
            'divisi-create',
            'divisi-edit',
            'divisi-delete',
            'komoditas-list',
            'komoditas-create',
            'komoditas-edit',
            'komoditas-delete',
            'kpi-list',
            'kpi-create',
            'kpi-edit',
            'kpi-delete',
            'karya-list',
            'karya-create',
            'karya-edit',
            'karya-delete',
            'karya-detail',
            'pengguna-list',
            'pengguna-create',
            'pengguna-edit',
            'pengguna-delete',
            'indikator-list',
            'indikator-create',
            'indikator-edit',
            'indikator-delete',
            'satuan-list',
            'satuan-create',
            'satuan-edit',
            'satuan-delete',
            'distribusi-list',
            'distribusi-create',
            'distribusi-detail',
            'penetapan-list',
            'penetapan-create',
            'penetapan-detail',
            'penetapan-cancel',
            'penetapan-print',
        ]);

        $role_admin_anper = Role::create(['name' => 'ADMINISTRATOR ANPER'])->givePermissionTo([
            'perusahaan-list',
            'divisi-list',
            'divisi-create',
            'divisi-edit',
            'divisi-delete',
            'komoditas-list',
            'kpi-list',
            'karya-list',
            'karya-detail',
            'karyawan-list',
            'karyawan-create',
            'karyawan-edit',
            'karyawan-delete',
            'pengguna-list',
            'pengguna-create',
            'pengguna-edit',
            'pengguna-delete',
            'indikator-list',
            'indikator-create',
            'indikator-edit',
            'indikator-delete',
            'satuan-list',
            'penetapan-list',
            'penetapan-create',
            'penetapan-detail',
            'penetapan-cancel',
            'penetapan-print',
        ]);     
    }
}
