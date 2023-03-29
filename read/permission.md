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
        
## APPLYING PERMISSION
    - The admin will be able to accesss all
    - Restriction
    - We need to access the menu dynamically from backend
        resources/js/Layouts/AuthenticatedLayout.vue
    - To every other pages, for that wee need to pass innto inertia handle
        . Open the HandleInertiaRequests.php
                'menus' =>[
                [
                    'label' => 'Dashboard' ,
                    'url'   => route('dashboard'),
                    
                ],
                [
                    'label' => 'Permissions' ,
                    'url'   => route('permissions.index'),
                     'isActive'=> $request->routeIs('permissions.*'),
                ],
                [
                    'label' => 'Roles' ,
                    'url'   => route('roles.index'),
                     'isActive'=> $request->routeIs('roles.*'),
                ],
            ],
        . Let us accept these menus on authenticated pages
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                   Dashboard
                </NavLink>
        TO

        <NavLink
                v-for="menu in $page.props.menus" :key="menu.label"
                :href="menu.url" :active="route().current('dashboard')">
            {{ menu.label }}
        </NavLink>

    - Active link
            :active="route().current('dashboard')">

    TO
        :active="menu.isActive">

    - NOW WE CAN MAKE PERMISSION
        (USE SUPER ADMIN)
            https://spatie.be/docs/laravel-permission/v5/basic-usage/super-admin
        . We can use the permissions in HandleInertiaRequests.php
                'isVisible'=> $request->user()?->can('view permissions module'),
        . Add the isVisible in AuthenticatedLayout.vue
        . To apply using gate in ServiceProvider
        . add more batch of roles in RolesSeeder

        (USE EDITOR)
    - If the user has a permission will be able to ADD NEW 
        . open Permission Controllers
            'can' => [
                'create' => $request->user()->can('create permission')
            ]
        . can be accepted as props in permissions.index vue
                can: Object
        . in button /PrimaryButton compnents
             <PrimaryButton v-if="can.create" :href="route(`${routeResourceName}.create`)">Add New </PrimaryButton>
    - We can permission via PermissionsResource.php
         'can'=>[
                'edit' => $request->user()?->can('edit permission')
                'delete' => $request->user()?->can('delete permission')
            ]

        . You can access on blade file like this in permissions/Index.vue  and Roles/Innde.vue
                <Actions
                                :edit-link="route(`${routeResourceName}.edit`,{ id: item.id})"
                                :show-edit="item.can.edit"
                                :show-delete="item.can.delete"
                                @deleteClicked="showDeleteModal(item)"/>
    -  You can add on route as well
          ->middleware(['can:delete role'])
    - You can add permissionn on Role/Index.vue
    - You can add  permission in RoleController
            'can' => [
                'create' => $request->user()->can('create role')
            ]
    - Add in permission in  RoleResource
             'can' => [
                        'edit' => $request->user()?->can('edit role'),
                        'delete' => $request->user()?->can('delete role'),
                ]
    - Add the props in Roles/Index.vue
        . add the permission on add new
    - Open the Middleware  Kernel.ph
            'inertia' => \App\Http\Middleware\HandleInertiaRequests::class,
    - To use it RouteServiceProvider
             Route::middleware(['web' , 'inertia'])

## REFACTORING ALERT COMPONENT AND ROUTE RESOURCE
        https://laravel.com/docs/10.x/controllers#controller-middleware
    -Different way of applying the permissionn in Routes file
        ->middleware(['can:delete permission]);
    - Open the RolesController and the constructor
             public function __construct()
                {
                    $this->middleware('auth');
                    $this->middleware('log')->only('index');
                    $this->middleware('subscribed')->except('store');
                }
    - Add the middlware to all controllers 
    - Refactor the alert Compoonents.
                
        
