### ECOMMERCE  APPLICATION

# PROJECT INSTALLATION
    laravel new ecommerce-applications

## BREEZE  AND VUE  INSTALLATION
    - Install the Breeze Packages
        composer require laravel/breeze --dev
        php artisan breeze:install vue
        npm install && npm run dev
        php artisan migrate
    - Create a database via cmd
        mysql -u root p
        create database test;

## NEW THINGS ADDED AFTER INSTALLING LARAVEL BREEZE WITH INERTIA JA
    - app/Http/Middleware/HandleInertiaRequests.php
    - resources/js/app.js
    - Ziggy - routing

## CRUD ROLE
    - Install the spaties permission
        php8 $(which composer)  require spatie/laravel-permission
        php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
        php artisan config:clear
        php artisan migrate
    - Create  Dashboard Controller
        php artisan make:controller Admin/DashboardController
    - Create  Role Controller
        php artisan make:controller Admin/RoleController
    - Create a folder called Roles/Index.vue
    - Open Authentiocated 
              <div class="py-12">
                    <slot />
                </div>
    - Add resource route
    - Create the SEEDR inside the Database Seeder (Admin)
        php artisan migrate:fresh --seed
    - create a component calleed Container.vue
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                 <slot></slot>
            </div>
    - Replate with Container in dashboard and inn Role/Index.vue
    - Create another Card/Card.vue file . ttake the code 
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
           </slot>
        </slot>
    - Add the card Component into index and dashboard

## ROLES LISTING - ROLES CRUD
    - Objectives to display roles
    - Create a Roles Seeder
        php artisan make:seeder RoleSeeder
    - Add the logic inside tthe RoleSeeder
    - Call the RoleSeeder inside the Database seeder
    - Run seeder
            php artisan migrate:fresh --seed
    - Pass the roles inside the RoleController
    - Create a Role Resource to be able to pass the data.
        php artisan make:resource RoleResource
    - Access within the UI we need to define props in index
            https://tailwind-elements.com/docs/standard/data/tables/
    - Create a Table Components  Tabl/Table.vue and paste the table
        . Remove the flex flex-col overflow-x-auto  inside the table
        . Remove all the th and td except leave one each.
        . Gonna make dynamic
            .create Th.vue file
        . Pass the headers define props and loop through inside the th
        . Create Td.vue file
    - To use the table component inn index.vue
        import the Table component and pass the headers into table component
        Inside the Table component we accpting the heeader as well as an array .Then
            we loop for headers.
    - TEST APPLICATTION: ok
    - Name and Created AT on table are comming from the server
    - We need to show the Table body contents 
             <tbody>
                        <tr class="border-b dark:border-neutral-500">
                            <Td>
                                Test Column
                            </Td>
                        </tr>
             </tbody>
    - Remove the above code and use <slot></slott>
    - Open index.vue and paste the above code
    - Pass the actions in RoleController
    - Go to RoleResource , to format the created at column
    - Change the latest() to select([])
    - We need to optizime this code 
            <tr
                        v-for="role in roles.data" :key="role.id"
                        class="border-b dark:border-neutral-500">
    - We gonna use Scope Slot to Access Table Data
        . We need to pass the items inside the index.vue
            <Table :headers="headers" :items="roles"></Table>
        . defineProps items:
        .Cut the code from Index and paste into table
                <tr
                        v-for="role in roles.data" :key="role.id">
                </tr>
                 <tr
                            v-for="role in roles.data" :key="role.id">
                            <slot></slot>
                        </tr>
        . Instead of role we gona pass item w/c can be used for role and permission
        .We're passinng the props into slot, we can be able to use outt of this table. in index component
        .DefineProps items
        . To access the scoped sslot we should use template  in index.vue
                <template v-slot="{ item }"></template>
        . You wont able to see the roles in the index.vue accept item
    - Now we need to work on Edit actions  (Make Actions Components) 
        .create Actions.vue file inside Table
        .create a Icons/Edit.vue
    - Let us import the Action inside the index
    - In edit icon we need the link but in the trash we will show the pops 
    - We need to accept the editLink as props
              <Link :href="editLink">
    - Go to index.vue file into Actions component and pass the show delete props

## ROLES CREATE AND EDIIT  - ROLES CRUD
    - Object is to create / edit the roles with vue
    - Start the to create a Role 
        . Add Create Button on Index.vuee file 
        . Adjust the resources/js/Components/SecondaryButton.vue
        .Pass into SecondaryButtton into index.vue file
    - Open RoleController
        . Add the create() method
        . create a Admin/Create.vue file
    - Open the Create.vue file 
        .copy the code from login.vue file and page one input
        .write the logic inside the Create.vue file.
        .write the RolesRequest   to validate our data
                php artisan make:request Admin/RolesRequest
        .add the logic inside the RolesRequest
    - Call the RolesRequest inside the STORE method of RoleController, add the logic .
    - READ THE INERTIA DOC ABOUT SUBMITTING THE FORM
    - Add the flush the message 
        https://inertiajs.com/shared-data
        . open the HandleInertiaRequests
        . create a component called Alert.vue 
                resources/js/Components/Alert/Alert.vue
        . Add the component Alert.vue  into Authenticated.Layout 

    NB: NOT WORKING

    - Let us work on Edit functionality
    - Open the index page 
            <Td> <Actions :show-delete="false"/> </Td>

            TO 
            <Td> <Actions :edit-link="route('roles.edit',{ id: item.id})" /> </Td>
    - open the RoleController  , edit()  method
    - Open the Create.vue file  and defineProps
            . assign the const to defineProps
            . add data wraping
                https://laravel.com/docs/10.x/eloquent-resources#data-wrapping
                JsonResource::withoutWrapping();
            . pass the title from the rolecontroller in create() and edit()
                    'title' => 'Edit Role',  
                    'title' => 'Create Role'
            . accept as props in Create.vue file
            . pass the {{ title }} in the blade
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Role</h2>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Role</h2>

            . pass on the Head
                title="Add Role" />
                :title="title" />
            . In the RoleRequest login we need to update
                    'name' => ['required' , 'string', 'max:255', Rule::unique("roles")]
                    'name' => ['required' , 'string', 'max:255', Rule::unique("roles")->ignoreModel($this->route('role'))]
    
## DELETE ROLE - ROLES CRUD
    - objective is to delete the roles , when u click on delete button will show the popup
    - Gonna use  https://tailwind-elements.com/docs/standard/components/modal/
            https://tailwindui.com/components/application-ui/overlays/notifications
            https://tailwindcomponents.com/component/notification-3
    - Copy the code and paste on Modal/Modal.vue component
        . Run npm install tw-elements
        .add Tailwind.config.js
            "./node_modules/tw-elements/dist/js/**/*.js"
        .import it in the following way  
            import * as te from 'tw-elements';
    - pass the emit into action 
        @click="$emit('deleteClicked',$event)
    - Att index.vue in Actions component 
            @deleteClicker="showDeleteModal"
    - define the method  showDeleteModal


## ROLES FILTERS
    - apply filter
    - Open index.vue page and add the filter card 
    - Add card component in index 
    - Open tthe Card  add the div and pass the slot
            <div v-if="$slots.header" class="px-6 py-2 font-bold">
            <slot name="header"></slot>
        </div>
    - Add the form inside the card componentt in index.vue
    - define the filters 
    -  define the watch whenever wee type anytthing
    - Define filter in the backend in index() method

##  REFACTOR TO COMPOSABLES - DELETE AND FILTER
    - We will be rectoring our code into composables , delete and filter modules
    -We will start with delete module 
    - Composables is js file
        . copy the delete code from index.vue file
        . paste into useDeleteItems.js  and make sure u return att the end
    - import  composables/useDeleteItems.js  into index.vue file
        .const {} = useDeleteItems(); pass the object 
    - Let do for the Filtters 
        . copy everything related to the filters from index and paste into useFilters.js
        . make sure u return
        . bacause we're using props . should use params
            const { filters : defaultFilters } = params;
        . import into index.vue file
        . const {} = useFilters(); pass the object 

    - We dont to hard coded the "roles" all the times
        . open useFilter.js and destruct   routeResourceName
                const { filters : defaultFilters , routeResourceName } = params;
        . pass the routeResourceName into index.vue file
                const { filters } = useFilters({
                    filters : props.filters,
                    routeResourceName : "roles"
                });
        . similary we need to pass into  useDeleteItems
                const  {
                        deleteModal,
                        itemToDelete,
                        isDeleting,
                        showDeleteModal,
                        handleDeleteItem
                    } = useDeleteItems({
                    routeResourceName : "roles"
                    });

    - whenever we're using  roles in useFilters
            function  fetchItems(){
        router.get(route('roles.index'), filters.value,{
            preserveState: true,
            preserveScroll:true,
            replace: true,
        });
    }
            router.get(route('roles.${routeResourceName: "roles"}')

    - Add the same functionality in useDeleteItems.js
        router.delete(route(`${routeResourceName}.destroy`,{ id: itemToDelete.value.id }),{}

    - To pass in the controller ass well RoleController
        . Make it private  $routeResourceName = "roles";
        . Call inside the index method.
        . Define the props index.vue and use it

             routeResourceName:{
                type: String,
                required: true
            }
            
    - Make dynamically the role index head 
        . pass the variable in index method of controller
                'title' => 'Roles',
        . Use it in index.vue on head
             <Head title="Roles" />
             <Head :title="title" />
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{title}}</h2>
        . In order to function , we need to pass the props 
    - Make some changes in controller
            roles' => RoleResource::collection($roles)  TO
            'items' => RoleResource::collection($roles),
        .Change the roles to items in props of inndex.vue
                  roles: {
                        type: Object,
                        default: () => ({}),
                    },
                      items: {
                        type: Object,
                        default: () => ({}),
                    },
        . in the table components  in index.vue
                :items="roles">  TO
                :items="items">
        .  
                 <Td>
                        <Actions 
                        :edit-link="route('roles.edit',{ id: item.id})"
                        @deleteClicked="showDeleteModal(item)"/>
                </Td>
                 <Td>
                        <Actions 
                        :edit-link="route('roles.edit',{ id: item.id})"
                        @deleteClicked="showDeleteModal(item)"/>
                </Td>

                 <PrimaryButton :href="route('roles.create')">Add New </PrimaryButton>
                 <PrimaryButton :href="route(`${routeResourceName.create}`)">Add New </PrimaryButton>

## SHOW LOADING INDICATOR
    - Search 






    
        
