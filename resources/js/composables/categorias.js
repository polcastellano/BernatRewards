import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function usarCategorias() {
    const categorias = ref([])
    const listaCategorias = ref([])
    const categoria = ref({
        nombre: ''
    })
    const productosCategorias = ref([]);

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
    const getRecompensasCategorias = async () => {
        await axios.get('/api/lista-categorias')
            .then(response => {
                response.data.forEach(categoria => {
                    axios.get('/api/get-recompensa-category/' + categoria.id)
                    .then(response => {
                        productosCategorias.value.push({
                            nombre: categoria.nombre,
                            productos: response.data.data
                        });
                    })
                });
            })
    }

    return {
        listaCategorias,
        categorias,
        categoria,
        productosCategorias,
        getListaCategorias,
        getRecompensasCategorias,
    }
}
