### CATEGORIES
## CATEGORIES CRUD
    - Create a Model and Migration
        php artisan make:model Category -m
    - MMake resourcefull controller
            php artisan make:controller Admin/categoryController --resource --model=Category
    - Add logic for CRUD inside the CategoryController
    - Add nnew web route 
        Route::resource('categories', categoryController::class);
    - Open HandleInertiaRequests.php file
    - Add the RolesSeeder 
        database/seeders/RoleSeeder.php
    - Open the Category Model , 
            .add the relationship 
            .add scopes , 
    - Implement the logic in Index()
    - Create a CategoryResource
            php artisan make:resource CategoryResource
            . Add logic
    - Create a UserRequest
            php artisan make:request Admin/CategoriesRequest
            . Add logic
    - Duplicate the Users/Index and rename Categories/Index
        . open Index.vue , 
        . Update the Filters from roles to categories
    - Index.vue should use the <Button>Active</Button> , will make a link to take to the children
    - Add query inn index() for parentId 
    - Fillttering for Active , add selectGroup in Fiters.vue
    - Addd the fieldss in Create.Vue
            const form = useForm({
                name: '',
                slug: '',
                active: true,
                parentId: '',
            });
    - Automatically slug will be generate - Create.vue in kebab

## REFACTOR - HIDE FILTERS BY DEFAULT
    - Add will the Icon to display the Filters , By default will not be visible
    - Open Index of Category - Admin/Categories/Index.vue
        . create a div inside the button
        . Add button
        .svag , create a component isnide the Icons folder

    - Call the svga component into index.vue of Categories
    - add the props to showFiltter = ref(falsee)
    - Use on the component of FilterIcon
    - Create a Component AddNew.vue, so we can use the slots
        . Move the code for filters into AddNew.vue and add component in AddNew.vue
        . Hide the filtters if  there's no filter present with v-if="$slots.filters" in AddNew.vue
        .To Testt comment out the Filters in Index.vue

    - NOTE: REPEAT THE ALL PROCESS FOR OTHER PERMISSSION ROLES USERS
    
