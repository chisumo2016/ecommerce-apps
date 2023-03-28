## POLICIES FOR AUTHORIZATION
    - Looking at some of the authorizations stops
    - Only the USERS that have created the PRODUCTS can actually Edit / Delete the Products
    - Other wise they cannot 
    - BUT Super admin can edit and delete  all the products
    - We have not added the creator id on the products table
    - Add the additional fields into the products creator_id
            php artisan make:migration add_creator_id_column_on_products_table --table=products
    - Show the creator on Products/index.vue
    - Create the relationship on product model & user model
    - Open Product Controller on index(){}
    - Open Product Controller on index(){}
    - Open Product/Index.vue and show the name
    - Open ProductResource 
    - LET US IMPLEMENT THE POLICY
        https://laravel.com/docs/10.x/authorization#writing-policies
        . Make a Product Policy
            php artisan make:policy ProductPolicy --model=Product
        . We neeed update/delete method, remove everything
        . public function update(User $user, Product $product): bool
        . public function update(Authenticated , Model): bool
    - Open the Product Policy and add the logic 
    - Open the ProductController in the constructor
            $this->middleware('can:update product')->only(['edit', 'update']);
            $this->middleware('can:update,product')->only(['edit', 'update']);

            $this->middleware('can:delete product')->only('destroy');
            $this->middleware('can:delete, product')->only(['edit', 'update']);

    - To hide the button if urnot authorized , open the ProductResource
             'can' => [
                'edit' => $request->user()?->can('edit product'),
                'delete' => $request->user()?->can('delete product'),
            ],

            TO 

            'can' => [
                'edit' => $request->user()?->can('update', $this->resource), //edit product & $this is model
                'delete' => $request->user()?->can('delete', $this->resource), //delete product
            ],
    - We need to ssend the creator id when we're creating the product 
        . Add into the ProductsRequests
                if (!$this->route('product')){
            $data['creator_id'] = $this->user()->id;
        }
    - Open ProductFactory
        
