import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import { userStore } from '@/store/authPinia';

export default function useProfile() {
    const profile = ref({})

    const router = useRouter()
    const validationErrors = ref({})
    const cargando = ref(false)
    const swal = inject('$swal')

    const getProfile = async (id) => {
        axios.get('/api/perfil/' + id)
        .then(response => {
            
            profile.value = response.data.data;
        })
    }

    // const updateProfile = async (profile) => {
    //     if (cargando.value) return;

    //     cargando.value = true
    //     validationErrors.value = {}

    //     axios.put('/api/user', profile)
    //         .then(({data}) => {
    //             if (data.success) {
    //                 store.commit('auth/SET_USER', data.data)
    //                 // router.push({name: 'profile.index'})
    //                 swal({
    //                     icon: 'success',
    //                     title: 'Profile updated successfully'
    //                 })
    //             }
    //         })
    //         .catch(error => {
    //             if (error.response?.data) {
    //                 validationErrors.value = error.response.data.errors
    //             }
    //         })
    //         .finally(() => cargando.value = false)
    // }

    const updateProfile = async (user) => {
        if (cargando.value) return;

        cargando.value = true

        axios.post('/api/perfil/update/' + user.id, user, {
            headers: {
                "content-type": "multipart/form-data"
            }
        })
        .then(response => {
            swal({
                icon: 'success',
                title: 'Perfil editado correctamente'
            })
        })
        .catch(error => {
            console.log(error)
            swal({
                icon: 'error',
                title: 'Perfil editado incorrectamente'
            })
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
