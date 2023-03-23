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
            
                
        
