import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import { userStore } from '@/store/authPinia';

export default function useProfile() {
    const profile = ref({})

    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getProfile = async (id) => {
        axios.get('/api/perfil/' + id)
        .then(response => {
            console.log(response.data)
            profile.value = response.data.data;
        })
    }

    // const updateProfile = async (profile) => {
    //     if (isLoading.value) return;

    //     isLoading.value = true
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
    //         .finally(() => isLoading.value = false)
    // }

    const updateProfile = async (user) => {
        if (cargando.value) return;

        cargando.value = true


        axios.post('/api/profile/update/' + user, {
            headers: {
                "content-type": "multipart/form-data"
            }
        })
        .then(response => {
            console.log(response)
            router.push({ name: 'perfil.edit' })
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
        isLoading
    }
}
