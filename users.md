### USER CRUD - PART 1 
    - This sectiion will focus the CRUD operation for users
    - Create a UserController
        php artisan make:controller Admin/UserController --resource --model=User
        . Add all logic in controller
    - Create a UsersResource
            php artisan make:resource UserResource
        . Add the logic
        
    - Create a UsersRequest 
            php artisan make:request Admin/UsersRequest
        .add logic
        . add logic in AppServiceProvider.php
    - Create web route for users
    - Add the Menu into HandleInertiaRequests.php
    - Open the UserControllers and pass the headers in index
            [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                [
                    'label' => 'Email',
                    'name' => 'headers',
                ],
                 [
                    'label' => 'Role',
                    'name' => 'role',
                ],
    - Create a directort in js/pages/Users
        . Add the Button compoonent
        . add small in Button component
