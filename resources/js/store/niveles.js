import { defineStore } from 'pinia'
import { ref } from 'vue'


export const storeNiveles = defineStore('allniveles', () => {
        const niveles = ref({})
        const nivelUsu = ref({})
        function getNiveles() {
            axios.get('/api/allniveles').then(({ data }) => {
                if (data.success) {
                    niveles.value = data.data;
                } else {
                    console.log("VACIO");
                }

            }).catch(({ res }) => {
                console.error("Error, " + res);
            })
        }
        function getNivelSiguiente($id) {
            axios.get('/api/siguintenivel/' + $id).then(({ data }) => {
                if (data.success) {
                    nivelUsu.value = data.data;
                } else {
                    console.log("VACIO");
                }

            }).catch(({ res }) => {
                console.error("Error, " + res);
            })
        }
        return {
            niveles,
            nivelUsu,
            getNiveles,
            getNivelSiguiente
        }
    })


