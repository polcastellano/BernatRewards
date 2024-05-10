<template>
    <div class="layout-wrapper" :class="containerClass">
        <app-topbar></app-topbar>

        <div class="layout-sidebar">
            <app-sidebar></app-sidebar>
        </div>
        <Toast />
        <Dialog appendTo="self" v-model:visible="visible" modal header="Editar perfil" :style="{ width: '70vw' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
            :pt="{ root: 'border-none', mask: { style: 'backdrop-filter: blur(2px)' } }">
            <form @submit.prevent="submitForm">
                <div class="row my-5 mx-0">
                    <div class="col-md-8">
                        <div class="card border-0">

                            <div class="form-group mb-5">
                                <FloatLabel class="align-items-center">
                                    <InputText v-model="user.name" type="text" class="form-control" />
                                    <label class="font-bold block">{{ $t('name') }}<span class="text-danger">
                                            *</span></label>
                                </FloatLabel>
                                <div class="text-danger mt-1">
                                    {{ errors.name }}
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <FloatLabel class="align-items-center">
                                    <InputText v-model="user.email" type="text" class="form-control" />
                                    <label class="font-bold block">{{ $t('email') }}<span class="text-danger">
                                            *</span></label>
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
                                    <Calendar v-model="user.birthday" class="form-control" />
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
                                    <label class="font-bold block">Password<span class="text-danger">
                                            *</span></label>
                                </FloatLabel>
                                <div class="text-danger mt-1">
                                    {{ errors.password }}
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <FloatLabel class="align-items-center">
                                    <InputText :disabled="authuser.roles[0]?.name != 'admin'" v-model="user.experience"
                                        type="text" class="form-control" />
                                    <label class="font-bold block">Experiencia<span class="text-danger">
                                            *</span></label>
                                </FloatLabel>
                                <div class="text-danger mt-1">
                                    {{ errors.experience }}
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <FloatLabel class="align-items-center">
                                    <InputText :disabled="authuser.roles[0]?.name != 'admin'" v-model="user.puntos"
                                        type="text" class="form-control" />
                                    <label class="font-bold block">Puntos<span class="text-danger">
                                            *</span></label>
                                </FloatLabel>
                                <div class="text-danger mt-1">
                                    {{ errors.puntos }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0">
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
                                    <button :disabled="Object.keys(errors).length != 0 || cargando" :loading="cargando"
                                        class="btn btn-primary buttons" @click="visible = false">
                                        <span v-if="cargando">Guardando...</span>
                                        <span v-else>Guardar cambios</span>
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
                                    <MultiSelect appendTo="self" :disabled="authuser.roles[0]?.name != 'admin'"
                                        v-model="user.roles" :options="roleList" filter dataKey="id" optionLabel="name"
                                        placeholder="Seleciona un rol" display="chip" class="w-full">
                                    </MultiSelect>
                                </div>
                                <div class="text-danger mt-1">
                                    {{ errors.roles }}
                                </div>

                                <!-- Imagen -->
                                <div class="mb-3">
                                    <h6 class="mt-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
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
        </Dialog>

        <section>
            <div class="layout-main-container p-0">
                <div class="container text-center mt-5">
                    <div class="row">
                        <div class="col">
                            <div class="mb-4">
                                <h2 class="card-title">Bienvenido {{ authuser.name }}</h2>
                            </div>
                            <div class="mb-4">
                                <p class="my-3">Correo electronico: {{ authuser.email }}</p>
                                <p class="my-3">Fecha nacimiento: {{ authuser.birthday }}</p>
                                <p class="my-3">Numero de telefono: {{ authuser.telephone }}</p>
                                <p class="my-3">Direccion: {{ authuser.address }}</p>
                                <h3 class="card-title my-3">Editar perfil</h3>
                                <Button class="buttons standardButton bg-principal p-2 px-5 border-round-3xl" icon="pi pi-user-edit" @click="visible = true"></Button>
                            </div>
                        </div>

                    </div>
                </div>
                <app-footer></app-footer>
            </div>
        </section>

    </div>
</template>

<script setup>
import { computed, watch, ref, reactive, watchEffect, onMounted } from 'vue';
import { useRoute } from "vue-router";
import * as yup from 'yup';
import { es } from 'yup-locales';
import { setLocale } from 'yup';
import { useForm, useField } from "vee-validate";
import AppTopbar from '@/layouts/AppTopbar.vue';
import AppFooter from '@/layouts/AppFooter.vue';
import AppSidebar from '@/layouts/AppSidebar.vue';
import { useLayout } from '@/composables/layout';
import useProfile from '@/composables/profile';
import useRoles from "@/composables/roles";
import { userStore } from '@/store/authPinia';
import DropZone from "@/components/DropZone.vue";

const authuser = userStore().vistaUser()


const visible = ref(false);
setLocale(es);
const { roleList, getRoleList } = useRoles();

const { onMenuToggle, layoutConfig, layoutState, isSidebarActive } = useLayout();

const { getProfile, profile: postData, updateProfile, cargando } = useProfile()

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

            } else if (typeof value?.name === 'string') {

                // Si es un string, es válido pero no debe estar vacío
                // Verificar que no esté vacío
                if(value?.name.trim() !== ''){
                    return value?.type == 'image/jpeg' || value?.type == 'image/png';
                } 

            } else if(typeof value[0]?.file_name === 'string') {

                // Si es un string, es válido pero no debe estar vacío
                // Verificar que no esté vacío
                if(value[0]?.file_name.trim() !== ''){
                    return value[0]?.mime_type == 'image/jpeg' || value[0]?.mime_type == 'image/png';
                } 
            }
    }).required().label('Imagen'),
    roles: yup.array().min(1).required().label('Roles'),

})

const { validate, errors } = useForm({ validationSchema: schema })


// Define actual fields for validation
const { value: name } = useField('name', null, { initialValue: '' });
const { value: email } = useField('email', null, { initialValue: '' });
const { value: password } = useField('password', null, { initialValue: '' });
const { value: roles } = useField('roles', null, { initialValue: '', label: 'role' });
const { value: imagen } = useField('imagen', null);
const { value: puntos } = useField('puntos', null, { initialValue: 0, label: 'puntos' });
const { value: experience } = useField('experience', null, { initialValue: 0, label: 'experiencia' });
const { value: telephone } = useField('telephone', null, { initialValue: 0, label: 'telephone' });
const { value: birthday } = useField('birthday', null, { initialValue: 0, label: 'birthday' });
const { value: address } = useField('address', null, { initialValue: 0, label: 'address' });

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

const route = useRoute();

function submitForm() {
    validate().then(form => {
        if (form.valid) updateProfile(user)
    })
}

onMounted(() => {
    getProfile(route.params.id)
    getRoleList()
})

const outsideClickListener = ref(null);

watchEffect(() => {
    user.id = postData.value.id
    user.name = postData.value.name
    user.email = postData.value.email
    user.roles = postData.value.roles
    user.imagen = postData.value.media
    user.puntos = postData.value.puntos
    user.experience = postData.value.experience
    user.telephone = postData.value.telephone
    user.birthday = postData.value.birthday
    user.address = postData.value.address
})

watch(isSidebarActive, (newVal) => {
    if (newVal) {
        bindOutsideClickListener();
    } else {
        unbindOutsideClickListener();
    }
});

const containerClass = computed(() => {
    return {
        'layout-overlay': layoutConfig.menuMode.value === 'overlay',
        'layout-static': layoutConfig.menuMode.value === 'static',
        'layout-static-inactive': layoutState.staticMenuDesktopInactive.value && layoutConfig.menuMode.value === 'static',
        'layout-overlay-active': layoutState.overlayMenuActive.value,
        'layout-mobile-active': layoutState.staticMenuMobileActive.value,
    };
});
const bindOutsideClickListener = () => {
    if (!outsideClickListener.value) {
        outsideClickListener.value = (event) => {
            if (isOutsideClicked(event)) {
                layoutState.overlayMenuActive.value = false;
                layoutState.staticMenuMobileActive.value = false;
                layoutState.menuHoverActive.value = false;
            }
        };
        document.addEventListener('click', outsideClickListener.value);
    }
};
const unbindOutsideClickListener = () => {
    if (outsideClickListener.value) {
        document.removeEventListener('click', outsideClickListener);
        outsideClickListener.value = null;
    }
};
const isOutsideClicked = (event) => {
    const sidebarEl = document.querySelector('.layout-sidebar');
    const topbarEl = document.querySelector('.layout-menu-button');

    return !(sidebarEl.isSameNode(event.target) || sidebarEl.contains(event.target) || topbarEl.isSameNode(event.target) || topbarEl.contains(event.target));
};

</script>

<style lang="scss" scoped>
ol {
    margin: 0 !important;
    padding: 0;
    list-style-type: none;
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
}

.buttons {
    background-color: #145A79 !important;
    border-radius: 100px !important;
    border: 0px;

}

.standardButton{
    color: white; 
    border: solid;
    border-color: transparent; 
    font-family: Raleway;
    font-weight: bold;
    transition: 0.5s;

}

.standardButton:hover{
    background-color: white !important;
    border: solid;
    color: #145A79 !important; 
    transition: 0.5s;
    
}
</style>
