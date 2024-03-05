<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Editar {{ recompensa.nombre }}</h5>
            </div>
            

            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strSuccess }}</strong>
            </div>


            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strError }}</strong>
            </div>


            <form @submit.prevent="saveRecompensa">

                
                <div class="form-group mb-2">
                    <label>Nombre</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="recompensa.nombre" placeholder="Nombre recompensa">
                    <div class="text-danger mt-1">
                        {{ errors.nombre }}
                    </div>
                </div>


                <div class="form-group mb-2">
                    <label>Descripción</label><span class="text-danger"> *</span>
                    <textarea class="form-control" rows="3" v-model="recompensa.descripcion" placeholder="Descripción"></textarea>
                </div>


                <div class="form-gorup mb-2">
                    <label>Precio</label><span class="text-danger">*</span>
                    <input class="form-control" type="number" v-model="recompensa.precio" name="Precio" />
                </div>
       
                <div class="form-gorup mb-2">
                    <label>Nivel desbloqueo</label><span class="text-danger">*</span>
                    <input class="form-control" type="number" v-model="recompensa.nivel_desbloqueo" name="Nivel desbloqueo" />
                </div>

                <div class="mb-3">
                        
                    <h6 class="mt-3">Categorías</h6>

                    {{ recompensa.categorias }}
                    <!-- :options="listaCategorias" -->
                    <MultiSelect v-model="recompensa.categorias" :options="recompensa.categorias.nombre" filter  dataKey="id" 
                        optionLabel="name" placeholder="Seleciona una categoría" display="chip"
                        class="w-full md:w-20rem">
                    </MultiSelect>

                    <div class="text-danger mt-1">
                        {{ errors }}
                    </div>

                    <div class="text-danger mt-1">
                        <div v-for="message in validationErrors?.categorias">
                            {{ message }}
                        </div>
                    </div>

                </div>
                

                <button type="submit" @click="saveRecompensa(recompensa.id)" class="btn btn-primary mt-4 mb-4">Actualizar Recompensa</button>


            </form>


        </div>
    </div>
</template>


<script setup>
import { ref, onMounted, reactive } from "vue";
import { useForm, useField} from "vee-validate";
import { useRoute, useRouter } from "vue-router";
import * as yup from 'yup';
import { es } from 'yup-locales';
import { setLocale } from 'yup';


const schema =  yup.object({
    nombre: yup.string().required().label('Nombre'),
})


const { validate, errors } = useForm({ validationSchema: schema })
const route = useRoute()
const router = useRouter()


setLocale(es);




const { value: nombre } = useField('nombre', null, { initialValue: '' });
const { value: descripcion } = useField('descripcion', null, { initialValue: '' });
const { value: precio } = useField('precio', null, { initialValue: '' });
const { value: nivel_desbloqueo } = useField('nivel_desbloqueo', null, { initialValue: '' });
const { value: categorias } = useField('categorias', null, { initialValue: ''});




const recompensa = reactive({
    nombre,
    descripcion,
    precio,
    nivel_desbloqueo,
    categorias
})


const strSuccess = ref();
const strError = ref();


onMounted(() => {
    axios.get('/api/recompensas/' + route.params.id)
    .then(response => {
        recompensa.nombre = response.data.data.nombre;
        recompensa.descripcion = response.data.data.descripcion;
        recompensa.precio = response.data.data.precio;
        recompensa.nivel_desbloqueo = response.data.data.nivel_desbloqueo;
        recompensa.categorias = response.data.data.categorias;
    })
    .catch(function(error) {
        console.log(error);
    });
})


function saveRecompensa() {
    validate().then(form => {
        console.log('validate');
        if (form.valid){
            axios.put('/api/recompensas/update/'+route.params.id, recompensa)
            .then(response => {
                strError.value = ""
                strSuccess.value = response.data.success
                router.push({ name: 'recompensas.index'})

            })
            .catch(function (error) {
                strSuccess.value = ""
                strError.value = error.response.data.message
            });
        }
    })
   
}


</script>


<style>
</style>