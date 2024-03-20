<template>
    <form @submit.prevent="submitForm">      
            <div class="row my-5">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        {{ post }}    
                        <div class="card-body">
                            <div class="d-flex justify-content-between pb-2 mb-5">
                                <h5 class="card-title">Añade un usuario nuevo</h5>
                            </div>
                            <!-- Nombre -->
                            <div class="form-group mb-5">
                                <FloatLabel class="align-items-center">
                                    <InputText v-model="post.name" type="text" class="form-control"/>
                                    <label class="font-bold block">Nombre<span class="text-danger"> *</span></label>
                                </FloatLabel>
                                <div class="text-danger mt-1">
                                    {{ errors.name }}
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-5">
                                <FloatLabel class="align-items-center">
                                    <InputText v-model="post.email" type="text" class="form-control"/>
                                    <label class="font-bold block">Email<span class="text-danger"> *</span></label>
                                </FloatLabel>
                                <div class="text-danger mt-1">
                                    {{ errors.email }}
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-5">
                                <FloatLabel class="align-items-center">
                                    <InputText v-model="post.password" type="text" class="form-control"/>
                                    <label class="font-bold block">Password<span class="text-danger"> *</span></label>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                </svg> Acción
                            </h6>
                            <!-- Buttons -->
                            <div class="mt-3 text-center">
                                <button :disabled="Object.keys(errors).length != 0 || isLoading" :loading="isLoading" class="btn btn-primary">
                                    <span v-if="isLoading">Guardando...</span>
                                    <span v-else>Save</span>
                                </button>
                            </div>

                            <!-- Role -->
                            <h6 class="mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                </svg> 
                                Roles
                                <span class="text-danger">*</span>
                            </h6>
                            <div class="mb-3">
                                <MultiSelect v-model="post.role_id" optionValue="id" :options="roleList" filter  dataKey="id" 
                                    optionLabel="name" placeholder="Seleciona los roles" display="chip"
                                    class="w-full">
                                </MultiSelect>
                            </div>

                            <!-- Imagen -->
                            <div class="mb-3">
                                <h6 class="mt-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                    </svg>
                                    Imagen
                                    <span class="text-danger">*</span>
                                </h6>
                                <DropZone v-model="post.imagen"/>
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

    setLocale(es);

    

    const { roleList, getRoleList } = useRoles();
    const { storeUser, isLoading } = useUsers();

    import { useForm, useField, defineRule } from "vee-validate";
    import { required, min } from "@/validation/rules";
    defineRule('required', required);
    defineRule('min', min);

    // Define a validation schema
    const schema = {
        name: 'required',
        email: 'required',
        password: 'required|min:8',
    }
    // Create a form context with the validation schema
    const { validate, errors } = useForm({ validationSchema: schema })
    // Define actual fields for validation
    const { value: name } = useField('name', null, { initialValue: '' });
    const { value: email } = useField('email', null, { initialValue: '' });
    const { value: password } = useField('password', null, { initialValue: '' });
    const { value: role_id } = useField('role_id', null, { initialValue: '', label: 'role' });
    const { value: imagen } = useField('imagen', null);


    const post = reactive({
        name,
        email,
        password,
        role_id,
        imagen,
    })

    function submitForm(){
        validate().then(form => {
            if (form.valid) storeUser(post)
        })
    }

    onMounted(() => {
        getRoleList()
    })
</script>
