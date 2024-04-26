import { defineStore } from 'pinia'
import axios from 'axios'
import { ref, reactive } from 'vue'

export const userStore = defineStore ('userStore', () => {
    
    const user = ref({})
    const nxtLvl = ref({})
    const authenticated = ref(false)

    function login() {
        axios.get('/api/user').then(response => {
            user.value = response.data.data
            authenticated.value = true

            axios.get('/api/siguintenivel/' + user.value.niveles.id).then(({ data }) => {
                nxtLvl.value = data.data;

            }).catch((error) => {
                console.error("Error, " + error)
            })
            
        }).catch((error) => {
            console.error("Error, " + error)
            user.value = {}
            authenticated.value = false
        })
    }

    function vistaUser() {
       return user;
    }

    function vistaNxtLvl() {
       return nxtLvl;
    }

    async function getUser() {
        await axios.get('/api/user').then(response => {
            user.value = response.data.data
            authenticated.value = true

            axios.get('/api/siguintenivel/' + user.value.niveles.id).then(({ data }) => {
                nxtLvl.value = data.data;

            }).catch((error) => {
                console.error("Error, " + error)
            })


        }).catch((error) => {
            console.error("Error, " + error)
            user.value = {}
            authenticated.value = false

        })
    }

    function logout(){
        user.value = {}
        nxtLvl.value = {}
        authenticated.value = false

    }


    return {
        user,
        nxtLvl,
        authenticated,
        vistaUser,
        vistaNxtLvl,
        login,
        getUser,
        logout,
    }
}, {persist: true})