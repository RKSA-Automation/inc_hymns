<?php

namespace Database\Seeders;

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
                'musics.view' => 'View',
                'musics.create' => 'Create',
                'musics.edit' => 'Edit',
                'musics.delete' => 'Delete',
                'musics.view_hymn' => 'View Hymn',
            ],
            'Music Details' => [
                'music_details.view' => 'View',
                'music_details.download' => 'Download',
                'music_details.play' => 'Play',
            ],
            'Categories' => [
                'categories.view' => 'View',
                'categories.create' => 'Create',
                'categories.edit' => 'Edit',
                'categories.delete' => 'Delete',
            ],
            'Instrumentations' => [
                'instrumentations.view' => 'View',
                'instrumentations.create' => 'Create',
                'instrumentations.edit' => 'Edit',
                'instrumentations.delete' => 'Delete',
            ],
            'Ensemble Types' => [
                'ensemble_types.view' => 'View',
                'ensemble_types.create' => 'Create',
                'ensemble_types.edit' => 'Edit',
                'ensemble_types.delete' => 'Delete',
            ],
            'Credits' => [
                'credits.view' => 'View',
                'credits.create' => 'Create',
                'credits.edit' => 'Edit',
                'credits.delete' => 'Delete',
            ],
            'Groups' => [
                'groups.view' => 'View',
                'groups.create' => 'Create',
                'groups.edit' => 'Edit',
                'groups.delete' => 'Delete',
            ],
            'Users' => [
                'users.view' => 'View',
                'users.create' => 'Create',
                'users.edit' => 'Edit',
                'users.delete' => 'Delete',
            ],
        ];
        foreach ($permissions as $categoryName => $perms) {
            $category = PermissionCategory::create(['name' => $categoryName]);

            foreach ($perms as $name => $description) {
                $existingPermission = Permission::where('name', $name)->first();

                if (!$existingPermission) {
                    $permission = Permission::create(['name' => $name, 'description' => $description]);
                    $category->permissions()->attach($permission);
                }
            }
        }
    }
}
