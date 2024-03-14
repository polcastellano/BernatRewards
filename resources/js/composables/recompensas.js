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

    const getRecompensas = () =>{
        axios.get('/api/recompensas')
        .then(response => {
            recompensas.value = response.data;
        })
    }

    const getRecompensa = async (id) =>{
        axios.get('/api/recompensas' + id)
            .then(response => {
                console.log(response.data)
                recompensas.value = response.data.data;
            })
    }

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
            router.push({ name: 'recompensas.index' })
                swal({
                    icon: 'success',
                    title: 'Recompensa guardada correctamente'
                })
        })
        .catch(error => {
            swal({
                icon: 'error',
                title: 'Recompensa guardada incorrectamente'
            })
        })
        .finally(() => cargando.value = false)
    }

    const updateRecompensa = async (recompensa) => {
        if (cargando.value) return;

        cargando.value = true

        axios.post('/api/recompensas/update/' + recompensa.id, recompensa, {
            headers: {
                "content-type": "multipart/form-data"
            }
        })
        .then(response => {
            router.push({ name: 'recompensa.index' })
            swal({
                icon: 'success',
                title: 'Recompensa guardada correctamente'
            })
        })
        .catch(error => {
            swal({
                icon: 'error',
                title: 'Recompensa guardada incorrectamente'
            })
        })
        .finally(() => cargando.value = false)
    }

    const deleteRecompensa = (id) =>{
        swal({
            title: 'Estas seguro?',
            text: 'No puedes revertir esta acción!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, eliminar!',
            confirmButtonColor: '#ef4444',
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true
        })
        .then(result => {
            if (result.isConfirmed) {
                axios.delete('/api/recompensas/'+id)
                .then(response =>{
                    swal({
                        icon: 'success',
                        title: 'Recompensa Eliminada Correctamente',
                    })
                })
                .catch(error => {
                    swal({
                        icon: 'error',
                        title: 'No se ha podido eliminar la recompensa',
                    })
                })
            }
        })

    }

    return {
        recompensas,
        recompensa,
        getRecompensas,
        getRecompensa,
        storeRecompensa,
        updateRecompensa,
        deleteRecompensa,
        cargando,
        router
    }
}