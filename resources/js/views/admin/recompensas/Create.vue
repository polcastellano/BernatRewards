<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade una recompensa nueva</h5>
            </div>


            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strSuccess }}</strong>
            </div>


            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strError }}</strong>
            </div>
                   {{ recompensa }}
            <form @submit.prevent="addRecompensa">
                <div class="form-group mb-2">
                    <label>Nombre</label><span class="text-danger"> *</span>
                    <input v-model="recompensa.nombre" type="text" class="form-control" placeholder="Nombre recompensa">
                </div>


                <div class="form-group mb-2">
                    <label>Descripción</label><span class="text-danger"> *</span>
                    <textarea v-model="recompensa.descripcion" class="form-control" rows="3" placeholder="Descripción"></textarea>
                </div>


                <div class="form-gorup mb-2">
                    <label>Precio</label><span class="text-danger">*</span>
                    <input v-model="recompensa.precio" class="form-control" type="number" name="Precio"/>
                </div>


                <div class="form-gorup mb-2">
                    <label>Nivel desbloqueo</label><span class="text-danger">*</span>
                    <input v-model="recompensa.nivel_desbloqueo" class="form-control" type="number" name="Nivel desbloqueo"/>
                </div>

                <div class="form-gorup mb-2">
                    <h6 class="mt-3">Categorías<span class="text-danger">*</span></h6>
                    <MultiSelect v-model="recompensa.categorias"  :options="listaCategorias" filter  dataKey="id" 
                        optionLabel="nombre" placeholder="Seleciona una categoría" display="chip"
                        class="w-full md:w-30rem">
                    </MultiSelect>
                </div>
                

                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Recompensa</button>


            </form>


        </div>
    </div>
</template>


<script setup>
    import axios from "axios";
    import { onMounted, ref } from "vue";
    import usarCategorias from "@/composables/categorias";

    const { listaCategorias, getListaCategorias } = usarCategorias()

    const strError = ref();
    const strSuccess = ref();

    const recompensa = ref({});

    function addRecompensa(){
        console.log(recompensa);
        axios.post('/api/recompensas', recompensa.value)
        .then(response =>{
            console.log(response)
            strSuccess.value = response.data.success;
            strError.value = "";
        })
        .catch(error => {
            console.log(error)
            strSuccess.value = "";
            strError.value = error.response.data.message;

        });
    }

    onMounted(() => {
        getListaCategorias();
        
    });    

</script>


<style>
</style>
