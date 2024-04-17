<template>
    <form @submit.prevent="submitForm">
        <div class="row my-5">
            <div class="col-md-8">
                <div class="card  border-0 shadow-sm">
                    
                    <div class="form-group mb-5">
                        <FloatLabel class="align-items-center">
                            <InputText v-model="user.name" type="text" class="form-control" />
                            <label class="font-bold block">Nombre<span class="text-danger"> *</span></label>
                        </FloatLabel>
                        <div class="text-danger mt-1">
                            {{ errors.nombre }}
                        </div>
                    </div>

                    <div class="form-group mb-5">
                        <FloatLabel class="align-items-center">
                            <InputText v-model="user.email" type="text" class="form-control" />
                            <label class="font-bold block">Email<span class="text-danger"> *</span></label>
                        </FloatLabel>
                        <div class="text-danger mt-1">
                            {{ errors.nombre }}
                        </div>
                    </div>

                    <div class="form-group mb-5">
                        <FloatLabel class="align-items-center">
                            <InputText v-model="user.password" type="text" class="form-control" />
                            <label class="font-bold block">Password<span class="text-danger"> *</span></label>
                        </FloatLabel>
                        <div class="text-danger mt-1">
                            {{ errors.password }}
                        </div>
                    </div>

                    <div class="form-group mb-5">
                        <FloatLabel class="align-items-center">
                            <InputText :disabled="usuario.roles[0]?.name == 'user'" v-model="user.experience" type="text" class="form-control" />
                            <label class="font-bold block">Nivel<span class="text-danger"> *</span></label>
                        </FloatLabel>
                        <div class="text-danger mt-1">
                            {{ errors.nivel }}
                        </div>
                    </div>

                    <div class="form-group mb-5">
                        <FloatLabel class="align-items-center">
                            <InputText :disabled="usuario.roles[0]?.name == 'user'" v-model="user.puntos" type="text" class="form-control" />
                            <label class="font-bold block">Puntos<span class="text-danger"> *</span></label>
                        </FloatLabel>
                        <div class="text-danger mt-1">
                            {{ errors.puntos }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <!-- Buttons -->
                        <h6>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                            </svg> Acción
                        </h6>
                        <div class="mt-3 text-center">
                            <button :disabled="Object.keys(errors).length != 0 || cargando" :loading="cargando" class="btn btn-primary">
                                <span v-if="cargando">Guardando...</span>
                                <span v-else>Guardar usuario</span>
                            </button>
                        </div>
                        
                        <!-- Role -->
                        <h6 class="mt-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                            </svg>
                            Role
                            <span class="text-danger">*</span>
                        </h6>
                        <div class="mb-3">
                            <MultiSelect :disabled="usuario.roles[0]?.name == 'user'" v-model="user.roles" :options="roleList" filter dataKey="id"
                                optionLabel="name" placeholder="Seleciona un rol" display="chip" class="w-full">
                            </MultiSelect>
                        </div>
                        <div class="text-danger mt-1">
                            {{ errors.roles }}
                        </div>

                        <!-- Imagen -->
                        <div class="mb-3">
                            <h6 class="mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                                </svg>
                                Imagen
                                <span class="text-danger">*</span>
                            </h6>
                            <DropZone v-model="user.imagen" />
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
    import { onMounted, reactive, watchEffect } from "vue";
    import { useRoute } from "vue-router";
    import useRoles from "@/composables/roles";
    import useUsers from "@/composables/users";
    import * as yup from 'yup';
    import { es } from 'yup-locales';
    import { setLocale } from 'yup';
    import DropZone from "@/components/DropZone.vue";
    import store from "@/store";

    const usuario = store.state.auth.user;

    setLocale(es);

    const { roleList, getRoleList } = useRoles();
    const { updateUser, getUser, user: postData, cargando } = useUsers();

    import { useForm, useField } from "vee-validate";


    const schema = yup.object({
        name: yup.string().required().label('Nombre'),
        email: yup.string().required().label('Email'),
        puntos: yup.number().integer().required().min(0).label('Puntos'),
        experience: yup.number().integer().required().min(0).label('Nivel'),
        imagen: yup.mixed().test('fileFormat', 'Solo se permiten PNG y JPG', (value) => {
            if (!value) {
                // Si el valor está vacío, retornar un mensaje personalizado
                throw new yup.ValidationError('Imagen es un campo requerido', null, 'imagen');
            } else if (typeof value === 'string') {
                // Si es un string, es válido pero no debe estar vacío
                return value.trim() !== ''; // Verificar que no esté vacío
            } else {
                // Si es un objeto de archivo, validar su tipo
                return ['image/jpeg', 'image/png'].includes(value.type);
            }
        }).required().label('Imagen'),
        roles: yup.array().min(1).required().label('Roles'),
        
    })

    // Create a form context with the validation schema
    const { validate, errors } = useForm({ validationSchema: schema })
    // Define actual fields for validation
    const { value: name } = useField('name', null, { initialValue: '' });
    const { value: email } = useField('email', null, { initialValue: '' });
    const { value: password } = useField('password', null, { initialValue: '' });
    const { value: roles } = useField('roles', null, { initialValue: '', label: 'role' });
    const { value: imagen} = useField('imagen', null);
    const { value: puntos } = useField('puntos', null, { initialValue: 0, label: 'puntos' });
    const { value: experience } = useField('experience', null, { initialValue: 0, label: 'experience' });

    const user = reactive({
        name,
        email,
        password,
        roles,
        imagen,
        puntos,
        experience,
    })

    const route = useRoute()

    function submitForm() {
        validate().then(form => { 
            if (form.valid) updateUser(user) 
        })
    }
    
    onMounted(() => {
        getUser(route.params.id)
        getRoleList()
    })

    // https://vuejs.org/api/reactivity-core.html#watcheffect
    watchEffect(() => {
        user.id = postData.value.id
        user.name = postData.value.name
        user.email = postData.value.email
        user.roles = postData.value.roles
        user.imagen = postData.value.original_image
        user.puntos = postData.value.puntos
        user.experience = postData.value.experience



    })
</script>
