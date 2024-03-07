import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function usarRecompensas(){
    const recompensas = ref({})
    const recompensa = ref({
        nombre: '',
        descripcion: '',
        precio: '',
        imagen: '',//O poner thumbnail
        nivel_desbloqueo: '',
        categorias: '',
    })

    const router = useRouter()
    const validadorErrores = ref({})
    const cargando = ref(false)
    const swal = inject('$swal')

    const storeRecompensa = async (recompensa) => {
        if (cargando.value) return;

        cargando.value = true
        validadorErrores.value = {}

        let serializedRecompensa = new FormData()
        for (let item in recompensa) {
            if (recompensa.hasOwnProperty(item)) {
                serializedRecompensa.append(item, recompensa[item])
                console.log(recompensa)
            }
        }

        axios.post('/api/recompensas', serializedRecompensa,{
            headers: {
                "content-type": "multipart/form-data"
            }
        })
        .then(response =>{
            router.push({ name: 'recompensas.index' })
                swal({
                    icon: 'success',
                    title: 'Recompensa guardada correctamente'
                })
        })
        .catch(error => {
            if (error.response?.data) {
                validadorErrores.value = error.response.data.errors
            }

        })
        .finally(() => cargando.value = false)
    }

    return {
        recompensas,
        recompensa,
        storeRecompensa,
        validadorErrores,
        cargando,
        router
    }
}