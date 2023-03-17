import {onMounted, ref, watch} from "vue";
import {router} from "@inertiajs/vue3";

export  default  function (params) {
    const { filters : defaultFilters , routeResourceName } = params;

    const filters = ref({
        name: ""
    })

    const isLoading = ref(false);
    const fetchItemsHandler = ref(null);

    function  fetchItems(){
        router.get(route(`${routeResourceName}.index`), filters.value,{
            preserveState: true,
            preserveScroll:true,
            replace: true,
            onBefore: () => {
                isLoading.value = true
            },
            onFinish: () => {
                isLoading.value = false
            },
        });
    }

    onMounted( () => {
        filters.value = defaultFilters;
        //filters.value = props.filters
    })

    watch(filters, () => {

        clearTimeout(fetchItemsHandler.value);

        fetchItemsHandler.value = setTimeout(() =>{ //debouncer
            fetchItems();
        },300)

    },{
        deep:true
    });

    return{
        filters,
        isLoading

    }
}
