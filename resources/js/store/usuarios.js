import { defineStore } from 'pinia'
import { ref,watch } from 'vue'


export const storeUsuarios = defineStore('allUsers', () => {
        const usuLogueado = ref({})
        const usuMedia = ref({})
        function getUsuLogueado($id) {
            axios.get('/api/getUserLogeado/' + $id).then(({ data }) => {
                if (data.success) {
                    usuLogueado.value = data.data;
                }
            }).catch(({ res }) => {
                console.error("Error, " + res);
            })
        }
        function getUsuMedia($id) {
            axios.get('/api/getUsuMedia/' + $id).then(({ data }) => {
                if (data.success) {
                    usuMedia.value = data.data;
                }
            }).catch(({ res }) => {
                console.error("Error, " + res);
            })
        }
        
        return {
            usuLogueado,
            usuMedia,
            getUsuLogueado,
            getUsuMedia
        }
    })


