<template>
    <form @submit.prevent="submitForm">
        <div class="row my-5">
            <div class="col-md-8">
                <div class="card  border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between pb-2 mb-2">
                            <h5 class="card-title">Añade una recompensa nueva</h5>
                        </div>
                {{recompensa}}
                        <div class="form-group mb-2">
                            <label>Nombre</label><span class="text-danger"> *</span>
                            <input v-model="recompensa.nombre" type="text" class="form-control" placeholder="Nombre recompensa">
                            <div class="text-danger mt-1">
                                {{ errors.nombre }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validadorErrores?.nombre">
                                    {{ message }}
                                </div>
                            </div>
                        </div>


                        <div class="form-group mb-2">
                            <label>Descripción</label><span class="text-danger"> *</span>
                            <Textarea v-model="recompensa.descripcion" autoResize rows="1" cols="30"  class="form-control" placeholder="Descripción" />
                            
                            <div class="text-danger mt-1">
                                {{ errors.descripcion }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validadorErrores?.descripcion">
                                    {{ message }}
                                </div>
                            </div>
                        </div>


                        <div class="form-gorup mb-2">
                            <label>Precio</label><span class="text-danger">*</span>
                            <input v-model="recompensa.precio" class="form-control" type="number" name="Precio"/>
                            <div class="text-danger mt-1">
                                {{ errors.precio }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validadorErrores?.precio">
                                    {{ message }}
                                </div>
                            </div>
                        </div>


                        <div class="form-gorup mb-2">
                            <label>Nivel desbloqueo</label><span class="text-danger">*</span>
                            <input v-model="recompensa.nivel_desbloqueo" class="form-control" type="number" name="Nivel desbloqueo"/>
                            <div class="text-danger mt-1">
                                {{ errors.nivel_desbloqueo }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validadorErrores?.nivel_desbloqueo">
                                    {{ message }}
                                </div>
                            </div>
                        </div>

                        <!-- <div class="flex flex-wrap gap-3">
                            <div class="flex align-items-center">
                                <RadioButton v-model="recompensa.nivel_desbloqueo" inputId="1" name="nivel1" value="Nivel 1" />
                                <label for="ingredient1" class="ml-2">Nivel 1</label>
                            </div>
                            <div class="flex align-items-center">
                                <RadioButton v-model="recompensa.nivel_desbloqueo" inputId="ingredient2" name="nivel2" value="Nivel 2" />
                                <label for="ingredient2" class="ml-2">Nivel 2</label>
                            </div>
                            <div class="flex align-items-center">
                                <RadioButton v-model="recompensa.nivel_desbloqueo" inputId="ingredient3" name="nivel3" value="Nivel 3" />
                                <label for="ingredient3" class="ml-2">Nivel 3</label>
                            </div>
                            <div class="flex align-items-center">
                                <RadioButton v-model="recompensa.nivel_desbloqueo" inputId="ingredient4" name="nivel4" value="Nivel 4" />
                                <label for="ingredient4" class="ml-2">Nivel 4</label>
                            </div>
                            <div class="flex align-items-center">
                                <RadioButton v-model="recompensa.nivel_desbloqueo" inputId="ingredient4" name="nivel4" value="Nivel 5" />
                                <label for="ingredient4" class="ml-2">Nivel 5</label>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                            </svg> Action
                        </h6>
                        <div class="mt-3 text-center">
                            <!-- <button :disabled="isLoading" class="btn btn btn-outline-primary me-2">
                                <div v-show="isLoading" class=""></div>
                                <span v-if="isLoading">Processing...</span>
                                <span v-else>Save Draft</span>
                            </button> -->
                            <button :disabled="cargando" class="btn btn-primary">
                                <div v-show="cargando" class=""></div>
                                <span v-if="cargando">Processing...</span>
                                <span v-else>Añadir recompensa</span>
                            </button>
                        </div>
                        <h6 class="mt-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                            </svg> 
                            Categorías
                            <span class="text-danger">*</span>
                        </h6>

                        <div class="mb-3">
                            <MultiSelect v-model="recompensa.categorias"  :options="listaCategorias" filter  dataKey="id" 
                                optionLabel="nombre" placeholder="Seleciona una categoría" display="chip"
                                class="w-full">
                            </MultiSelect>
                        </div>
                        <div class="text-danger mt-1">
                                {{ errors.categorias }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validadorErrores?.categorias">
                                    {{ message }}
                                </div>
                            </div>

                        <div class="mb-3">
                            <h6 class="mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                </svg> Thumbnail
                            </h6>
                            <DropZone v-model="recompensa.imagen"/>
                            <div class="text-danger mt-1">
                                <div v-for="message in validadorErrores?.imagen">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>      
</template>


<script setup>
    import { onMounted, ref, reactive } from "vue";
    import DropZone from "@/components/DropZone.vue";
    import usarCategorias from "@/composables/categorias";
    import usarRecompensas from "@/composables/recompensas";
    import {useForm, useField, defineRule} from "vee-validate";
    import * as yup from 'yup';
    import { es } from 'yup-locales';
    import { setLocale } from 'yup';

    const schema = yup.object({
        nombre: yup.string().required().label('Nombre'),
        descripcion: yup.string().required().label('Descripcion'),
        precio: yup.number().integer().required().label('Precio'),
        imagen: yup.mixed().required().label('Imagen'),
        nivel_desbloqueo: yup.number().integer().required().max(5).min(0).label('Nivel'),
        categorias: yup.array().required(), //Como validar un array y con minimo 1 fila
    })
    
    const {validate, errors} = useForm({validationSchema: schema})
    const {value: nombre} = useField('nombre', null, {initialValue: ''});
    const {value: descripcion} = useField('descripcion', null, {initialValue: ''});
    const {value: precio} = useField('precio', null, {initialValue: ''});
    const {value: imagen} = useField('imagen', null, {initialValue: ''});
    const {value: nivel_desbloqueo} = useField('nivel_desbloqueo', null, {initialValue: ''});
    const {value: categorias} = useField('categorias', null, {initialValue: ''});

    const { listaCategorias, getListaCategorias } = usarCategorias()
    const {storeRecompensa, validadorErrores, cargando} = usarRecompensas()

    setLocale(es);

    const recompensa = reactive({
    nombre,
    descripcion,
    precio,
    imagen,
    nivel_desbloqueo,
    categorias,
})


    function submitForm(){
        validate().then(form => {
            if (form.valid) storeRecompensa(recompensa)
        })
    }

    onMounted(() => {
        getListaCategorias();
        
    });    

</script>


<style>
</style>
