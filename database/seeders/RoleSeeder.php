<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::firstOrCreate(['name'=>'admin']);
        $pengguna = Role::firstOrCreate(['name' => 'pengguna']);
        $editor = Role::firstOrCreate(['name' => 'editor']);

        Permission::firstOrCreate(['name' =>  'lihatdashboardadmin']);
        Permission::firstOrCreate(['name' =>  'ubahpenggunaadmin']);
        Permission::firstOrCreate(['name' =>  'registrasipengguna']);
        Permission::firstOrCreate(['name' =>  'lihatpinjaman']);
        Permission::firstOrCreate(['name' =>  'lihatriwayatpinjaman']);
        Permission::firstOrCreate(['name' =>  'lihatdashboard']);
        Permission::firstOrCreate(['name' =>  'ubahpengguna']);
        Permission::firstOrCreate(['name'=> 'ubahbuku']);

        $admin->givePermissionTo(['lihatdashboardadmin','ubahpenggunaadmin','registrasipengguna','ubahbuku']);
        $editor->givePermissionTo(['ubahbuku','lihatdashboardadmin']);
        $pengguna->givePermissionTo(['lihatriwayatpinjaman','ubahpengguna','lihatpinjaman',]);

        $adminUser = User::find(4);
        $adminUser->assignRole('admin');

        $editorUser = User::find(1);
        $editorUser->assignRole('editor');
    }
}
