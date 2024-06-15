<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\PermissionCategory;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'Global' => [
                'superuser' => 'Super User',
                'admin' => 'Admin',
                'csv_import' => 'CSV Import',
                'dashboard' => 'Dashboard',
            ],
            'Musics' => [
                'view' => 'View',
                'create' => 'Create',
                'edit' => 'Edit',
                'delete' => 'Delete',
                'view_hymn' => 'View Hymn',
            ],
            'Music Details' => [
                'view' => 'View',
                'download' => 'Download',
                'play' => 'Play',
            ],
            'Categories' => [
                'view' => 'View',
                'create' => 'Create',
                'edit' => 'Edit',
                'delete' => 'Delete',
            ],
            'Instrumentations' => [
                'view' => 'View',
                'create' => 'Create',
                'edit' => 'Edit',
                'delete' => 'Delete',
            ],
            'Ensemble Types' => [
                'view' => 'View',
                'create' => 'Create',
                'edit' => 'Edit',
                'delete' => 'Delete',
            ],
            'Credits' => [
                'view' => 'View',
                'create' => 'Create',
                'edit' => 'Edit',
                'delete' => 'Delete',
            ],
            'Groups' => [
                'view' => 'View',
                'create' => 'Create',
                'edit' => 'Edit',
                'delete' => 'Delete',
            ],
            'Users' => [
                'view' => 'View',
                'create' => 'Create',
                'edit' => 'Edit',
                'delete' => 'Delete',
            ],
        ];

        foreach ($permissions as $categoryName => $perms) {
            $category = PermissionCategory::create(['name' => $categoryName]);

            foreach ($perms as $name => $description) {
                $permission = Permission::create(['name' => $name, 'description' => $description]);
                $category->permissions()->attach($permission);
            }
        }
    }
}
