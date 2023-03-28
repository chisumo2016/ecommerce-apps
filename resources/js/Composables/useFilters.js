import {computed, onMounted, ref, watch} from "vue";
import {router} from "@inertiajs/vue3";

export  default  function (params) {
    const { filters : defaultFilters , routeResourceName } = params;

    //const filters = ref({name:""})
    const filters = ref( defaultFilters)

    const isFilled = computed(() =>{
        let {page, ...rest} =  filters.value;
        return Object.values(rest) //filters.value

            .some(v => !["", null, undefined].includes(v))
    });

    const isLoading = ref(false);
    const fetchItemsHandler = ref(null);

    function  fetchItems(){
        router.get(route(`${routeResourceName}.index`), { //filters.value,
            ...filters.value,
            page:1,
        },{
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

    // onMounted( () => {
    //     filters.value = defaultFilters;
    //     //filters.value = props.filters
    // })

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
        isLoading,
        isFilled

    }
}
