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
        
                            










    
        
