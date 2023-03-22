### PRODUCT CRUD - LISTING
    - To Listing the Products
    - Let create a Model , Migration , Factory and Seeder
        php artisan make:model Product -mcfs
    - Add data modelling into migration
    - Create a pivot table category and product
        php artisan make:model CategoryProduct -m --pivot
    - Php artisan migrate
    - Create a ProductController
    - Add the route for products
    - Add the MENU in HandleInertiiaRequest middleware
    - Add Product Roles Seeder
    - Create ProductResource
        php artisan make:resource ProductResource
    - Add the relationship in Product Model
    - Create a ProductRequest class
        php artisan make:request Admin/ProductsRequest
    - Duplicate Categories folder and call Products
        . open index , make some changes  rootCategories->categories
    - Create a Component called YesNoLabel.vue inside component
    - Add logic into Product Seeder
    - Add logic into Product Factory add the defination
    - Add the ProductSeeder into Database seeder

        NOTE
            php artisan make:seeder CategorySeeder
            php artisan make:Factory CategoryFactory

    - Run on ProductsSeeder
            php artisan make:seed --class=ProductsSeeder

    - TEST ok
    - WORK ON FILTERS
        . Open the filters in resources/js/Pages/Admin/Products/Filters.vue
        .add the query fileter for featured and showOnSlider in the index method 
        .Create the computed property inn Filters.vue
        .Add anoothe selectGroup for subCategory
        .Remove the value when we select Category,watch() method
    
