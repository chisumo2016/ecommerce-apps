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
    - Add the card into index and dashboarrd
        
    
        
