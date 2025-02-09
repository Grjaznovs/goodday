<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::findOrCreate('blog.view');
        Permission::findOrCreate('blog.manage');
        Permission::findOrCreate('news.view');
        Permission::findOrCreate('news.manage');
        Permission::findOrCreate('role.view');
        Permission::findOrCreate('role.manage');
        Permission::findOrCreate('user.view');
        Permission::findOrCreate('user.manage');

        // create roles and assign created permissions
        Role::findOrCreate('User')->givePermissionTo('blog.view', 'news.view');
        Role::findOrCreate('Admin')->givePermissionTo(Permission::all());

        $admin = User::firstOrCreate(
            ['name' => 'Admin'],
            [
                'email' => 'admin@gmail.com',
                'name' => 'Admin',
                'password' => Hash::make('qwerty'),
            ]
        );
        $admin->assignRole('Admin');

        $sections = Section::query()->get();
        foreach ($sections as $section) {
            if ($section->code == Section::BLOG) {
                $section->givePermissionTo('blog.view', 'blog.manage');
            } else if ($section->code == Section::NEWS) {
                $section->givePermissionTo('news.view', 'news.manage');
            } else if ($section->code == Section::ROLE) {
                $section->givePermissionTo('role.view', 'role.manage');
            } else if ($section->code == Section::USER) {
                $section->givePermissionTo('user.view', 'user.manage');
            }
        }
    }
}
