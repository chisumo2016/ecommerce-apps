## SET UP MULTIPLE IMAGES DRAG AND DROP UPLOADING
    - Adding multiple images to our products
    - We gonna use Dropzone and spatie media Libray
        . https://github.com/dropzone/dropzone
        . https://spatie.be/docs/laravel-medialibrary/v10/introduction
    - Install dropzone
        . https://github.com/dropzone/dropzone
                npm install --save dropzone
    - Install spatie
        . https://spatie.be/docs/laravel-medialibrary/v10/installation-setup
                composer require "spatie/laravel-medialibrary:^10.0.0"
                php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
                php artisan migrate
                php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"
    - Open Create.vue file of product
        . We will be adding image on edit secction  
        . To create a component to upload the image  ImageUpload.vue
        . go to drop zone
                https://docs.dropzone.dev/getting-started/installation/npm-or-yarn
                    import Dropzone from "dropzone";
                    import "dropzone/dist/dropzone.css";
        .configuration setup
            https://docs.dropzone.dev/getting-started/setup/imperative
    - Open the Create.vue file and add ImageUplaod component
        . TEST - NOT PASSED 
                Uncaught (in promise) Error: Invalid dropzone element.
        . Put this inside the mounted
            This will be executed created hook
            let dropzone = new Dropzone("#image-upload",{
                /**pass configuration*/
                url: "/admin/upload-images"
            });

            TO
        onMounted(() =>{
                let dropzone = new Dropzone("#image-upload",{
                    /**pass configuration*/
                    url: "/admin/upload-images"
                });
            })

        . We need to make sure the id image-upload before on mounted
        . Define the props  in UploadImage.vue
    - Create the url   in web files
            upload-images
    - create a UploadMediaController
            php artisan make:controller Admin/UploadMediaController
    - Add the method and return the respons
    - TEST
                 419 (unknown status)
        SOLN: pass the crfs token in the app.js   resources/views/app.blade.php
                     <meta name="csrf-token" content="{{ csrf_token() }}">
        Pass the headers in ImageUpload.vue file
                headers:{
            "X-CSRF-TOKEN" : document.querySelector("meta[name='csrf-token']")?.content,
        },
            
                
## UPLOADING MULTIPLE IMAGES USING DRAG AND DROP
    - Objective is to add the images into file system
    - After uupload the file , please check on the network
            file: (binary)
        . We need to change into image instead of file
        .Open the ImageUpload.vue file and add paraName:"image"

    - We want the image to be associated with product
            model_type : store the path of the model App\Models\User
            This is not good , we should use the enforceMorphMap
        . open the AppServiceProovider
            /*Image**/
        Relation::enforceMorphMap([
            'category'          =>  Category::class,
            'category_product'  =>  CategoryProduct::class,
            'product'           =>  Product::class,
            'user'              =>  User::class
        ]);

    NOTE: After adding the above code and refresh u will see 
            403  THIS ACTION IS UNAUTHORIZED.
        GONE
    -  Define two property in the ImageUpload.vue and pass ass props and used it ImageUpload Componentt in Create.vue
            modelType
            modelId
        . Open the Create.vue
             <ImageUpload :max-files="3" :model-type="product" :model-id="item.id"/>
                :model-type="product"  : product -> AppServiceProvider
                ::model-id="item.id"    : item.id -> <div v-if="edit" class="col-span-2">
    - Open the UploadImageController
        . add logic
        .test on tinker
                 Illuminate\Database\Eloquent\Relations\Relation::morphMap()
        . Use the Relation to setup the validation in invoke method
    - Let us use the Spatie Library
            https://spatie.be/docs/laravel-medialibrary/v10/basic-usage/preparing-your-model
            . Open Product Model
                use InteractsWithMedia;
                implements HasMedia
            https://spatie.be/docs/laravel-medialibrary/v10/basic-usage/associating-files
            .Open the UploadImageController  add the code to upload the image
            . Run
                php artisan storage:link
    - Open the ProductResource  and add  'media'

    - Open the ProductController
        . in edit() u cann load the 'media'
    - Open the Create.vue and loop the media
                
### DELETE PRODUCT IMAGE 
    - objective is to delete the images , add the icon , once you click on icon will show the pops
    - Pops window will show the message , should remove in filesystem
    - Searcch Icon - HeroIcon
        . create a components called Cross.vue paste SVGA
        . Open the Create.vue add Cross component
            .add thee functionality to delete the imagess
    - Open the web route add url ad the delete-images
    - Create a Controller
            php artisan make:controller Admin/DeleteMediaController
        . Add the functionality inside the method to delete the images
    - create a const variable MaxUploadImageCount inside Create.vue and user in ImageUpload component
                v-if="item.images.length < 3" TO  v-if="item.images.length < MaxUploadImageCount" 
                :maxFiles="3 - item.images.length" TO  :maxFiles="MaxUploadImageCount - item.images.length"
    - We need to refactor our code 
            https://spatie.be/docs/laravel-medialibrary/v10/basic-usage/retrieving-media
            .Open the ProductResouurce file
                        'images' => $this->whenLoaded(
                            'media',
                         fn() => $this->media->map(
                             fn($media) => [
                                 'id'   => $media->id,
                                 'html' =>$media->toHtml(),
                             ]
                         )
        
                    )
                    'images' => $this->whenLoaded(
                            'media',
                         fn() => $this->getMedia()->map(
                             fn($media) => [
                                 'id'   => $media->id,
                                 'html' =>$media->toHtml(),
                             ]
                         )
        
                    )
            - Also open the resources/js/Components/ImageUpload.vue , We have hard coded the url:
                    url: "/upload-images",
                    url: "/upload-images",


                
                
