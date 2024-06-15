<?php
namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Permission;
use App\Models\GroupPermission;
use App\Models\PermissionCategory;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::withCount('users')->get();
        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        // Fetch categories and their permissions
        $permissions = \DB::table('permission_categories as pc')
            ->leftJoin('permission_categories as ppc', 'pc.id', '=', 'ppc.category_id')
            ->leftJoin('permissions as p', 'ppc.permission_id', '=', 'p.id')
            ->select('pc.name as category_name', 'p.name as permission_name', 'p.description as permission_description')
            ->orderBy('pc.id', 'asc')
            ->orderBy('p.id', 'asc')
            ->get();

        // Initialize the permissions array
        $permissionsArray = [];

        // Loop through the permissions and group them by category
        foreach ($permissions as $permission) {
            $categoryName = $permission->category_name ?: 'Global';
            // Skip adding null permission names
            if (!is_null($permission->permission_name)) {
                $permissionsArray[$categoryName][$permission->permission_name] = $permission->permission_description;
            }
        }

        return view('groups.create', compact('permissionsArray'));

    }

    // public function store(Request $request)
    // {
    //     //dd($request);
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'permissions' => 'nullable|array',
    //         'permissions.*' => 'in:0,1', // each permission should be either '0' (deny) or '1' (grant)
    //     ]);

    //     $group = Group::create([
    //         'name' => $request->input('name'),
    //         // assuming Group model has a 'permissions' attribute that can store JSON
    //         'permissions' => json_encode($request->input('permissions', [])),
    //     ]);

    //     return redirect()->route('groups.index')->with('success', 'Group created successfully.');
    // }
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'in:0,1', // each permission should be either '0' (deny) or '1' (grant)
        ]);

        // Insert the group first
        $group = Group::create([
            'name' => $request->input('name'),
        ]);

        // Fetch categories and their permissions to use in storing
        $permissionsData = \DB::table('permission_categories as pc')
            ->leftJoin('permission_categories as ppc', 'pc.id', '=', 'ppc.category_id')
            ->leftJoin('permissions as p', 'ppc.permission_id', '=', 'p.id')
            ->select('pc.name as category_name', 'pc.id as category_id', 'p.id as permission_id', 'p.name as permission_name')
            ->whereNotNull('pc.name') // Filter out null category names
            ->where('pc.name', '<>', '') // Filter out empty category names
            ->orderBy('pc.id', 'asc')
            ->orderBy('p.id', 'asc')
            ->get();
           // dd($permissionsData);
        // Initialize the permissions array
        $permissionsArray = [];

        // Loop through the permissions data and group them by category
        foreach ($permissionsData as $permission) {
            $categoryName = $permission->category_name ?: 'Global';
            // Skip adding null permission names
            if (!is_null($permission->permission_name)) {
                $permissionsArray[$categoryName][$permission->permission_name] = [
                    'category_id' => $permission->category_id,
                    'permission_id' => $permission->permission_id
                ];
            }
        }

        $permissions = $request->input('permissions', []);

        // Process each permission
        foreach ($permissions as $permissionName => $accessRight) {
            // Iterate over the permissionsArray to find the correct permission details
            foreach ($permissionsArray as $categoryName => $groupPermissions) {
                if (array_key_exists($permissionName, $groupPermissions)) {
                    $permissionDetails = $groupPermissions[$permissionName];
                    // Insert into group_permissions table
                    GroupPermission::create([
                        'group_id' => $group->id,
                        'permission_id' => $permissionDetails['permission_id'],
                        'category_id' => $permissionDetails['category_id'],
                        'accessrights' => $accessRight,
                    ]);
                }
            }
        }

        return redirect()->route('groups.index')->with('success', 'Group created successfully.');
    }

    public function edit(Group $group)
    {
        // Fetch the available permissions
        $permissionsArray = $this->getAvailablePermissions();

        
        // Fetch group permissions from the group_permissions table
        $groupPermissions = GroupPermission::where('group_id', $group->id)->get();

        // Prepare group permissions array
        $groupPermissionsArray = [];
        foreach ($groupPermissions as $groupPermission) {
            $permission = Permission::find($groupPermission->permission_id);
            if ($permission) {
                $groupPermissionsArray[$permission->name] = $groupPermission->accessrights;
            }
        }

        return view('groups.edit', compact('group', 'permissionsArray', 'groupPermissionsArray'));
    }

    private function getAvailablePermissions()
    {
        // Fetch categories and their permissions
        $permissions = \DB::table('permission_categories as pc')
            ->leftJoin('permission_categories as ppc', 'pc.id', '=', 'ppc.category_id')
            ->leftJoin('permissions as p', 'ppc.permission_id', '=', 'p.id')
            ->select('pc.name as category_name', 'p.name as permission_name', 'p.description as permission_description')
            ->whereNotNull('pc.name') // Filter out null category names
            ->where('pc.name', '<>', '') // Filter out empty category names
            ->orderBy('pc.id', 'asc')
            ->orderBy('p.id', 'asc')
            ->get();

        // Initialize the permissions array
        $permissionsArray = [];

        // Loop through the permissions and group them by category
        foreach ($permissions as $permission) {
            $categoryName = $permission->category_name ?: 'Global';
            $permissionsArray[$categoryName][$permission->permission_name] = $permission->permission_description;
        }

        return $permissionsArray;
    }

    public function update(Request $request, Group $group)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'in:0,1', // each permission should be either '0' (deny) or '1' (grant)
        ]);
    
        
        // Update the group name in the permission_groups table
        $group->update([
            'name' => $request->input('name'),
        ]);
    
        // Remove old permissions
        GroupPermission::where('group_id', $group->id)->delete();
    
        // Insert new permissions
        $permissions = $request->input('permissions', []);
      // dd( $permissions);
        foreach ($permissions as $permissionName => $accessRight) {
            // Get the permission and category details
            $permission = \DB::table('permissions')->where('name', $permissionName)->first();
              // Get the category details by joining permission_categories and permissions
        $category = \DB::table('permission_categories')
        ->where('permission_categories.permission_id', $permission->id)
        ->select('permission_categories.category_id')
        ->first();
        
            // Check if the combination of group_id, permission_id, and category_id already exists
            $exists = GroupPermission::where('group_id', $group->id)
            ->where('permission_id', $permission->id)
            ->exists();

                if ($exists) {
                continue;
                }
            // Insert into group_permissions table
            GroupPermission::create([
                'group_id' => $group->id,
                'permission_id' => $permission ? $permission->id : null,
                'category_id' => $category ? $category->category_id : null,
                'accessrights' => $accessRight,
            ]);
           // dd($permission);
        }
    
        return redirect()->route('groups.index')->with('success', 'Group updated successfully.');
    }
    

    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Group deleted successfully.');
    }

    public function showUsers($id)
    {

        $group = Group::with('users')->findOrFail($id);
        $users = $group->users;
        return view('users.index', compact('group', 'users'));
    }

}
