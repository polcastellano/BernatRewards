import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function usarRecompensas() {
    const recompensas = ref([])
    const listaRecompensas = ref([])
    const recompensa = ref({
        nombre: ''
    })

    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const get = async () => {
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
