<template>
    <form @submit.prevent="submitForm">
        <div class="row my-5">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    {{recompensa}}
                    <div class="card-body">
                        <div class="d-flex justify-content-between pb-2 mb-5">
                            <h5 class="card-title">Añade una recompensa nueva</h5>
                        </div>
                        <div class="form-group mb-5">
                            <FloatLabel class="align-items-center">
                                <InputText v-model="recompensa.nombre" type="text" class="form-control"/>
                                <label class="font-bold block">Nombre<span class="text-danger"> *</span></label>
                            </FloatLabel>
                            <div class="text-danger mt-1">
                                {{ errors.nombre }}
                            </div>
                        </div>

                        <div class="form-group mb-5">
                            <FloatLabel>
                                <Textarea v-model="recompensa.descripcion" autoResize rows="1" cols="30"  class="form-control" />
                                <label class="font-bold block">Descripción <span class="text-danger"> *</span></label>
                            </FloatLabel>
                            <div class="text-danger mt-1">
                                {{ errors.descripcion }}
                            </div>
                        </div>


                        <div class="form-group mb-5">
                            <FloatLabel>
                                <InputNumber class="d-flex" v-model="recompensa.precio" :min="0" name="Precio" />
                                <label class="font-bold block">Precio<span class="text-danger">*</span></label>
                            </FloatLabel>
                            <div class="text-danger mt-1">
                                {{ errors.precio }}
                            </div>
                        </div>


                        <div class="form-group mb-5">
                                <FloatLabel>
                                    <InputNumber class="d-flex" v-model="recompensa.nivel_desbloqueo" :min="0" name="Nivel desbloqueo" />   
                                    <label class="font-bold block">Nivel desbloqueo<span class="text-danger">*</span></label>
                                </FloatLabel>
                            <div class="text-danger mt-1">
                                {{ errors.nivel_desbloqueo }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                            </svg> Acción
                        </h6>
                        <div class="mt-3 text-center">
                            <button :disabled="Object.keys(errors).length != 0 || cargando" :loading="cargando" class="btn btn-primary">
                                <span v-if="cargando">Guardando...</span>
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
                            <MultiSelect appendTo="self" v-model="recompensa.categorias" optionValue="id" :options="listaCategorias" filter  dataKey="id" 
                                optionLabel="nombre" placeholder="Seleciona una categoría" display="chip"
                                class="w-full">
                            </MultiSelect>
                        </div>
                        <div class="text-danger mt-1">
                                {{ errors.categorias }}
                        </div>
                        <div class="mb-3">
                            <h6 class="mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                </svg>
                                Imagen
                                <span class="text-danger">*</span>
                            </h6>
                            <DropZone v-model="recompensa.imagen"/>
                            <div class="text-danger mt-1">
                                {{ errors.imagen }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>      
</template>


<script setup>
    import { onMounted, reactive } from "vue";
    import DropZone from "@/components/DropZone.vue";
    import usarCategorias from "@/composables/categorias";
    import usarRecompensas from "@/composables/recompensas";
    import {useForm, useField} from "vee-validate";
    import * as yup from 'yup';
    import { es } from 'yup-locales';
    import { setLocale } from 'yup';

    setLocale(es);

    const schema = yup.object({
        nombre: yup.string().required().label('Nombre'),
        descripcion: yup.string().required().label('Descripcion'),
        precio: yup.number().integer().required().min(0).label('Precio'),
        imagen: yup.mixed().required().label('Imagen').test('fileFormat', 'Solo se permiten PNG y JPG', (value)=> {
            return value.type == 'image/jpeg' || value.type == 'image/png'
        })
        .test('fileSize', 'La imagen no puede superar los 3MB', (value) => {
            if (value) {
           
            const tamano = value.size / 1024 / 1024
            return tamano <= 3;
            }
            return true;
        })
        ,   
        nivel_desbloqueo: yup.number().integer().required().min(0).max(5).label('Nivel'),
        categorias: yup.array().min(1).required().label('Categorias'),
    })
    
    const {validate, errors} = useForm({validationSchema: schema})
    const {value: nombre} = useField('nombre', null);
    const {value: descripcion} = useField('descripcion', null);
    const {value: precio} = useField('precio', null);
    const {value: imagen} = useField('imagen', null);
    const {value: nivel_desbloqueo} = useField('nivel_desbloqueo', null);
    const {value: categorias} = useField('categorias', null);

    const { listaCategorias, getListaCategorias } = usarCategorias()
    const {storeRecompensa, cargando} = usarRecompensas()

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
