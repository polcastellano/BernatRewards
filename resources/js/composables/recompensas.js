import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function usarRecompensas(){
    const recompensas = ref({})
    const recompensa = ref({
        nombre: '',
        descripcion: '',
        precio: '',
        imagen: '',
        nivel_desbloqueo: '',
        categorias: '',
    })

    const router = useRouter()
    const cargando = ref(false)
    const swal = inject('$swal')

    const storeRecompensa = async (recompensa) => {
        if (cargando.value) return;

        cargando.value = true

        let serializedRecompensa = new FormData()
        for (let item in recompensa) {
            if (recompensa.hasOwnProperty(item)) {
                serializedRecompensa.append(item, recompensa[item])
            }
        }

        axios.post('/api/recompensas', serializedRecompensa,{
            headers: {
                "content-type": "multipart/form-data"
            }
        })
        .then(response =>{
            console.log(response)
            router.push({ name: 'recompensas.index' })
                swal({
                    icon: 'success',
                    title: 'Recompensa guardada correctamente'
                })
        })
        .catch(error => {
            if (error.response?.data) {
                return error.response.data.errors
            }

        })
        .finally(() => cargando.value = false)
    }

    return {
        recompensas,
        recompensa,
        storeRecompensa,
        cargando,
        router
    }
}