import {ref} from "vue";
import {router} from "@inertiajs/vue3";

export  default function (params) {
    const { routeResourceName } = params;

    
    /** define prop**/
    const deleteModal = ref(false);
    const itemToDelete = ref({});
    const isDeleting = ref(false)


    /**define method**/
    function  showDeleteModal(item){
    deleteModal.value = true;
    itemToDelete.value = item
}

function  handleDeleteItem() {
    router.delete(route(`${routeResourceName}.destroy`,{ id: itemToDelete.value.id }),{
        onBefore: () => {
            isDeleting.value = true;
        },
        onSuccess:()=>{
            deleteModal.value = false;
            itemToDelete.value = {};
        },
        onFinish: () =>{
            isDeleting.value = false;
        }
     })
    }
    return {
        deleteModal,
        itemToDelete,
        isDeleting,
        showDeleteModal,
        handleDeleteItem
    }
}
