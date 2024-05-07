import { defineStore } from 'pinia'
import axios from 'axios'
import { ref } from 'vue'
import useNiveles from "@/composables/niveles"
import { storeNiveles } from '@/store/niveles'


export const userStore = defineStore ('userStore', () => {
    const user = ref({})
    const authenticated = ref(false)

    async function login() {
        user.value = {}
        await axios.get('/api/user').then(response => {
            
            user.value = response.data.data
            authenticated.value = true

            user.value.nextLevel = useNiveles().hasNextLevel()

        }).catch((error) => {
            console.error("Error, " + error)
            user.value = {}
            authenticated.value = false
        })
    }

    function vistaUser() {
       return user;
    }

    async function getUser() {
        await axios.get('/api/user').then(response => {
            
            user.value = response.data.data
            authenticated.value = true

            user.value.nextLevel = useNiveles().hasNextLevel()


        }).catch((error) => {
            console.error("Error, " + error)
            user.value = {}
            authenticated.value = false

        })
    }

    async function logout(){
        user.value = {}
        authenticated.value = false
        storeNiveles().logout()
    }


    return {
        user,
        authenticated,
        vistaUser,
        login,
        getUser,
        logout,
    }
}, {persist: true})