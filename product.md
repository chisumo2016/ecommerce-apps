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
        .Remove the value in subCategory input  when we select Category,watch() method
    TEST OK

## REFACTOR - SHOW FILTERS IF IT HAS A VALUE
    - I want the filtter to be open if i refresh the page
    - Open index of Categories
    - The open the useFilters.js
        . add a const property isFilled as computted
        .return at the bottom of tthe useFilters.js
    - Appy the isFilled in Categories/Index.vue add on Filters module 
        .Also add in AddNew.vue component    v-show="isFilled"
    - Open AddNew component and defineProps and use it 


## CREATE  EDIT AND DELETE PRODUCT - PRODUCT CRUD
    - Open the product controller and pass the categories in create() method
    - Open the Create.vue file 
        . replace rootCategories with categories 

    - Insttall edito https://www.tiny.cloud/blog/tinymce-vue-3-support/
            npm install --save "@tinymce/tinymce-vue@^4"
            . config the package in EditorGroup.vue
    - Add the logic in store to create a product
    - Add more fields in the Create.vue page
    - Import EditorGroup Component in create.vue
    - Add the logic to Edit the page in edit() of product controller
    - TEST-OK but the category not selected .To fix this issue
        - We can't see the sub categories id in the vue devtool
        - Go to product resource and pass
                'category_id' => $this->whenLoaded(
                'categories',
                fn () => $this->categories->firstWhere('parent_id', null)?->id,
            ),
             'sub_category_id' => $this->whenLoaded(
                'categories',
                fn () => $this->categories->firstWhere('parent_id', '!=', null)?->id,
            ),
        .load the relationship in product controller in edit method
            $product->load(['categories:id,parent_id']);
    - Work on the logic of update() method in product controller
    - Install this package to clean the user input on html
            https://github.com/stevebauman/purify
        . create the Purify cast
            php artisan make:cast PurifyHtml
        . add the logic inside the PurifyHttml cast
        . To use this ,open Product Model and add into cast
                'description'=>PurifyHtml::class
    - Work on delete functionality ,
        . open the ProductController in destroy method and add functionality.
        .Any related data will be deleted.

    NOTE : Uncaught (in promise) TypeError: Cannot read properties of undefined (reading 'getOrCreateInstance')
        
            
        
    
