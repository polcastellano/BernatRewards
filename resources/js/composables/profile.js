import { ref } from 'vue'
import { userStore } from '@/store/authPinia';
import useNiveles from "@/composables/niveles"
import { useToast } from "primevue/usetoast";


export default function useProfile() {
    const profile = ref({})

    const toast = useToast();

    const validationErrors = ref({})
    const cargando = ref(false)

    const getProfile = async (id) => {
        axios.get('/api/perfil/' + id)
        .then(response => {
            profile.value = response.data.data;
        })
    }

    const updateProfile = async (user) => {
        if (cargando.value) return;

        cargando.value = true

        axios.post('/api/perfil/update/' + user.id, user, {
            headers: {
                "content-type": "multipart/form-data"
            }
        })
        .then(response => {
            userStore().user = response.data

            userStore().user.nextLevel = useNiveles().hasNextLevel()
            userStore().user.nivelActual = useNiveles().nivelActual()

            toast.add({ severity: 'info', summary: 'Perfil editado', detail: 'El perfil se ha editado correctamente', life: 3050, closable: false });
        })
        .catch(error => {
            console.log(error)
            toast.add({ severity: 'error', summary: 'Error al editar', detail: 'El perfil no se ha editado', life: 3050, closable: false });

        })
        .finally(() => cargando.value = false)
    }

    return {
        profile,
        getProfile,
        updateProfile,
        validationErrors,
        cargando
    }
}
