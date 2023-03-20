## PERMISSIONS CRUD
    - Note we dont ssent tthe ajax request on Inertia .
    - Open UseFilter.js  and comment this
            onMounted( () => {
                filters.value = defaultFilters;
                //filters.value = props.filters
            })
    - Change this const filters = ref({name:""})
             const filters = ref( defaultFilters)

    - Let started with permission
    - create are permission controller 
        php artisan make:controller Admin/PermissionController --resource
    - Make the route url for permissions
        Route::resource('permissions', Permission::class);
    - Add the logic into the PermissionController
    - Create PermissionsRequest
        php artisan make:request Admin/PermissionsRequest
    - Create  Permission Resource
        php artisan make:resource PermissionResource
    - Copy the Roles Folder , paste rename Permissions


## REFACTORING THE FILTERS MODULE TO ITS OWN COMPONENT
    - Refactoring the filter to it's own components .
    - Let us create a Filters components inside Role folder
    - Cut the code from index.vue and paste into Filters.vue
    - Attach Filters.vue component in inde.vue file
    - DefineProps in Filters.vue and emit as well
        CHILD -> PARENTS
    - REPEAT  THE SAME PROCESS FOR OUR PERMISSION

## ATTACH PERMISSION TO ROLE  - ROLES CRUD
    - Attach the permission to roles .
    - Click the  Edit button the ,List of permmission will be displayed 
    - After that u can attach / dettach the permission on role
    - Open the Database seeder
            . Add another  user called Editor
    - Open the Roles Seeder
    - Open the RolesController in edit()
         .$role->load(['permissions:permissions.id,permissions.name']);
         . There's permissions relationship to this role, coming from spatie
         . add this into edit () 'permissions' => PermissionResource::collection(Permission::get(['id' , 'name'])),
    - Opeen the RoleResource
        . add the 'permissions' => PermissionResource::collection($this->whenLoaded('permissions'))

    - open role/create.vue file  , to pass the permissions as props
        . add the Permissions Component
    - Add the route in web route
        .attach-permission
        .detach-permission
    - Create two controllers and add the logic
        . AttachPermissionToRoleController
        . DetachPermissionFromRoleController
        
        
        
