<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view-users',
            'show-users',
            'create-users',
            'edit-users',
            'download-users',
            'delete-users',
            'view-roles',
            'show-roles',
            'create-roles',
            'edit-roles',
            'download-roles',
            'delete-roles',
            'view-permissions',
            'show-permissions',
            'create-permissions',
            'edit-permissions',
            'download-permissions',
            'delete-permissions',

            'view-programs',
            'show-programs',
            'create-programs',
            'edit-programs',
            'download-programs',
            'delete-programs',

            'view-kategori-programs',
            'show-kategori-programs',
            'create-kategori-programs',
            'edit-kategori-programs',
            'delete-kategori-programs',

            'view-informasis',
            'show-informasis',
            'create-informasis',
            'edit-informasis',

            'delete-informasis',
            
            'view-donasis',
            'show-donasis',
            'create-donasis',
            'edit-donasis',
            'delete-donasis',
            'download-donasis',

            'view-tripay',
            'edit-tripay',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $ketuaTakmirRole = Role::firstOrCreate(['name' => 'Ketua Takmir']);
        $anggotaRole = Role::firstOrCreate(['name' => 'Anggota']);
        $donaturRole = Role::firstOrCreate(['name' => 'Donatur']);

        $superAdminRole->permissions()->sync(Permission::all());
        $adminRole->permissions()->sync(Permission::all());

        $ketuaTakmirRole->permissions()->sync(
            Permission::whereIn('name', [
                'view-users', 'show-users',
                'view-roles', 'show-roles',
                'view-permissions', 'show-permissions'
            ])->pluck('id')
        );

        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        $superAdmin->roles()->sync([$superAdminRole->id]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        $admin->roles()->sync([$adminRole->id]);

        $ketuaTakmir = User::firstOrCreate(
            ['email' => 'ketuatakmir@example.com'],
            [
                'name' => 'Ketua Takmir User',
                'password' => Hash::make('password'),
            ]
        );

        $ketuaTakmir->roles()->sync([$ketuaTakmirRole->id]);

        $user = User::firstOrCreate(
            ['email' => 'anggotaa@example.com'],
            [
                'name' => 'Anggota User',
                'password' => Hash::make('password'),
            ]
        );

        $user->roles()->sync([$anggotaRole->id]);

        $donatur = User::firstOrCreate(
            ['email' => 'donatur@example.com'],
            [
                'name' => 'Donatur User',
                'password' => Hash::make('password'),
            ]
        );

        $donatur->roles()->sync([$donaturRole->id]);
    }
}
