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
