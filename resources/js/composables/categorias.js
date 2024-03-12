import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function usarCategorias() {
    const categorias = ref([])
    const listaCategorias = ref([])
    const categoria = ref({
        nombre: ''
    })

    // const router = useRouter()
    // const validationErrors = ref({})
    // const isLoading = ref(false)
    // const swal = inject('$swal')

    const getListaCategorias = async () => {
        axios.get('/api/lista-categorias')
            .then(response => {
                
                listaCategorias.value = response.data;
            })
    }

    return {
        listaCategorias,
        categorias,
        categoria,
        getListaCategorias,
    }
}
