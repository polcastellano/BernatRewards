<template>
    <form @submit.prevent="submitForm">
        <Toast />
        <div class="row my-5">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between pb-2 mb-5">
                            <h5 class="card-title">Añade un usuario nuevo</h5>
                        </div>
                        <!-- Nombre -->
                        <div class="form-group mb-5">
                            <FloatLabel class="align-items-center">
                                <InputText v-model="user.name" type="text" class="form-control" />
                                <label class="font-bold block">{{ $t('name') }}<span class="text-danger"> *</span></label>
                            </FloatLabel>
                            <div class="text-danger mt-1">
                                {{ errors.nombre }}
                            </div>
                        </div>

                        <div class="form-group mb-5">
                            <FloatLabel class="align-items-center">
                                <InputText v-model="user.email" type="text" class="form-control" />
                                <label class="font-bold block">{{ $t('email') }}<span class="text-danger"> *</span></label>
                            </FloatLabel>
                            <div class="text-danger mt-1">
                                {{ errors.email }}
                            </div>
                        </div>

                        <div class="form-group mb-5">
                            <FloatLabel class="align-items-center">
                                <InputText v-model="user.telephone" type="text" class="form-control" />
                                <label class="font-bold block">{{ $t('telephone') }}<span class="text-danger">
                                        *</span></label>
                            </FloatLabel>
                            <div class="text-danger mt-1">
                                {{ errors.telephone }}
                            </div>
                        </div>

                        <div class="form-group mb-5 border-0">
                            <FloatLabel class="align-items-center">
                                <Calendar v-model="user.birthday" class="p-component2"   id="birthday" showIcon
                                                    iconDisplay="input"  />
                                <label class="font-bold block">{{ $t('birthday') }}<span class="text-danger">
                                        *</span></label>
                            </FloatLabel>
                            <div class="text-danger mt-1">
                                {{ errors.birthday }}
                            </div>
                        </div>

                        <div class="form-group mb-5">
                            <FloatLabel class="align-items-center">
                                <InputText v-model="user.address" type="text" class="form-control" />
                                <label class="font-bold block">{{ $t('address') }}<span class="text-danger">
                                        *</span></label>
                            </FloatLabel>
                            <div class="text-danger mt-1">
                                {{ errors.address }}
                            </div>
                        </div>

                        <div class="form-group mb-5">
                            <FloatLabel class="align-items-center">
                                <InputText v-model="user.password" type="text" class="form-control" />
                                <label class="font-bold block">{{ $t('password') }}<span class="text-danger">
                                        *</span></label>
                            </FloatLabel>
                            <div class="text-danger mt-1">
                                {{ errors.password }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                            </svg> Acción
                        </h6>
                        <!-- Buttons -->
                        <div class="mt-3 text-center">
                            <button :disabled="Object.keys(errors).length != 0 || isLoading" :loading="isLoading"
                                class="btn btn-primary">
                                <span v-if="isLoading">Guardando...</span>
                                <span v-else>Save</span>
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
                            <MultiSelect appendTo="self" :disabled="authuser.roles[0]?.name == 'user'" v-model="user.roles"
                                optionValue="id" :options="roleList" filter dataKey="id" optionLabel="name"
                                placeholder="Seleciona un rol" display="chip" class="w-full">
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
import { onMounted, reactive } from "vue";
import useRoles from "@/composables/roles";
import DropZone from "@/components/DropZone.vue";
import useUsers from "@/composables/users";
import * as yup from 'yup';
import { es } from 'yup-locales';
import { setLocale } from 'yup';
import { userStore } from '@/store/authPinia';

const { user: authuser } = userStore()

setLocale(es);



const { roleList, getRoleList } = useRoles();
const { storeUser, isLoading } = useUsers();

import { useForm, useField } from "vee-validate";

const schema = yup.object({
    name: yup.string().required().label('Nombre'),
    email: yup.string().required().label('Email'),
    puntos: yup.number().integer().required().min(0).label('Puntos'),
    experience: yup.number().integer().required().min(0).label('Experiencia'),
    telephone: yup.string().matches(/^\d{9}$/, 'Número de teléfono debe tener exactamente 9 dígitos').required().label('Número de teléfono'),
    birthday: yup.string().required().label('Fecha de nacimiento'),
    address: yup.string().required().label('Direccion'),
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
const { value: imagen } = useField('imagen', null);
const { value: puntos } = useField('puntos', null, { initialValue: 0, label: 'puntos' });
const { value: experience } = useField('experience', null, { initialValue: 0, label: 'experiencia' });
const { value: telephone } = useField('telephone', null, { initialValue: 666666666, label: 'telephone' });
const { value: birthday } = useField('birthday', null, { initialValue: '', label: 'birthday' });
const { value: address } = useField('address', null, { initialValue: '', label: 'address' });

const user = reactive({
    name,
    email,
    password,
    roles,
    imagen,
    puntos,
    experience,
    telephone,
    birthday,
    address,
})

function submitForm() {
    validate().then(form => {
        if (form.valid) storeUser(user)
    })
}

onMounted(() => {
    getRoleList()
})
</script>
