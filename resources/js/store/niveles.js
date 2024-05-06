import { defineStore } from 'pinia'
import axios from 'axios'
import { ref, watch } from 'vue'


export const storeNiveles = defineStore('storeNiveles', () => {
    const niveles = ref([])
    
    const getNiveles = async () => {
        await axios.get('/api/niveles').then(response => {
            niveles.value = response.data
        }).catch(error => {
            console.error("Error, " + error);
        })
    }

    function vistaNiveles() {
        return niveles;
    }

    function logout(){
        niveles.value = []
    }

    return {
        niveles,
        getNiveles,
        vistaNiveles,
        logout,
    }
}, {persist: true})


