<template>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6"><!-- {{ $t('login') }} -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <TabView class="flex flex-column justify-content-around" v-model:activeIndex="active">
                            <TabPanel :header="$t('login')">
                                <Toast />
                                    <form @submit.prevent="submitLogin">
                                        <div class="">
                                            <!-- Email -->
                                            <div class="mb-3">
                                                <InputText v-model="loginForm.email" id="email" type="text"
                                                    required autofocus
                                                    autocomplete="username" :placeholder="$t('email')" />
                                                <!-- Validation Errors -->
                                                <div class="text-danger mt-1">
                                                    <div v-for="message in validationErrors?.email">
                                                        {{ message }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Password -->
                                            <div class="mb-3">
                                                <Password class="p-component2" v-model="loginForm.password" id="password" type="password"
                                                    required  :feedback="false"
                                                    autocomplete="current-password" :placeholder="$t('password')" />
                                                <!-- Validation Errors -->
                                                <div class="text-danger-600 mt-2">
                                                    <div v-for="message in validationErrors?.password">
                                                        {{ message }}
                                                    </div>
                                                </div>
                                                <router-link :to="{ name: 'auth.forgot-password' }"
                                                    class="forgotPass">{{$t('forgot_password') }}
                                                </router-link>

                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <!-- Remember me -->
                                                <div class="form-check p-0 align-items-center pl-4">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        v-model="loginForm.remember" id="flexCheckIndeterminate">
                                                    <label class="form-check-label" for="flexCheckIndeterminate">
                                                        {{ $t('remember_me') }}
                                                    </label>
                                                </div>

                                                <!-- Buttons -->
                                                <div class="flex align-items-center">
                                                    <button class="btn btn-primary buttonLogin"
                                                        :class="{ 'opacity-25': processing }" :disabled="processing">
                                                        {{ $t('login') }}
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                            </TabPanel>


                            <TabPanel :header="$t('register')">
                                    <form @submit.prevent="submitRegister">
                                        <div class="">
                                            <!-- Name -->
                                            <div class="mb-3">
                                                <InputText v-model="registerForm.name" id="name" type="text" autofocus
                                                    :placeholder="$t('name')" />
                                                <!-- Validation Errors -->
                                                <div class="text-danger mt-1">
                                                    <div v-for="message in validationErrors?.name">
                                                        {{ message }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Email -->
                                            <div class="mb-3">
                                                <InputText v-model="registerForm.email" id="email" type="email"
                                                    class="flex" autocomplete="username" :placeholder="$t('email')" />
                                                <!-- Validation Errors -->
                                                <div class="text-danger mt-1">
                                                    <div v-for="message in validationErrors?.email">
                                                        {{ message }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Telephone -->
                                            <div class="mb-3">
                                                <InputText v-model="registerForm.telephone" id="telephone"
                                                    :useGrouping="false" class="flex" :placeholder="$t('telephone')" />
                                                <!-- Validation Errors -->
                                                <div class="text-danger mt-1">
                                                    <div v-for="message in validationErrors?.telephone">
                                                        {{ message }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Address -->
                                            <div class="mb-3">
                                                <InputText v-model="registerForm.address" id="address" type="text"
                                                    :placeholder="$t('address')" />
                                                <!-- Validation Errors -->
                                                <div class="text-danger mt-1">
                                                    <div v-for="message in validationErrors?.address">
                                                        {{ message }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Birthday -->
                                            <div class="mb-3">
                                                <Calendar class="p-component2" v-model="registerForm.birthday" id="birthday" showIcon
                                                    iconDisplay="input" :placeholder="$t('birthday')" />
                                                <!-- Validation Errors -->
                                                <div class="text-danger mt-1">
                                                    <div v-for="message in validationErrors?.birthday">
                                                        {{ message }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Password -->
                                            <div class="mb-3">
                                                <Password class="p-component2" v-model="registerForm.password" id="password" type="password"
                                                    autocomplete="current-password" 
                                                    :placeholder="$t('password')"  :feedback="false" />
                                                <!-- Validation Errors -->
                                                <div class="text-danger-600 mt-1">
                                                    <div v-for="message in validationErrors?.password">
                                                        {{ message }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Confirm Password -->
                                            <div class="mb-3">
                                                <Password class="p-component2" v-model="registerForm.password_confirmation"
                                                    id="password_confirmation" type="password"
                                                    autocomplete="current-password"  :feedback="false"
                                                    :placeholder="$t('confirm_password')" />
                                                <!-- Validation Errors -->
                                                <div class="text-danger-600 mt-1">
                                                    <div v-for="message in validationErrors?.password_confirmation">
                                                        {{ message }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Buttons -->
                                            <div class="flex justify-content-end align-items-center mt-5">
                                                <button class="btn btn-primary buttonRegister"
                                                    :class="{ 'opacity-25': processing }" :disabled="processing">
                                                    {{ $t('register') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                            </TabPanel>

                        </TabView>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import useAuth from '@/composables/auth'
import { ref, watch } from 'vue';
import { useRoute } from 'vue-router';

const { loginForm, registerForm, validationErrors, processing, submitLogin, submitRegister } = useAuth();

const route = useRoute();

const active = ref(parseInt(route.query.tab) || 0);

watch(() => route.query.tab, (newTab) => {
    // Actualizar el valor de active cuando cambie el parámetro 'tab' en la URL
    active.value = parseInt(newTab) || 0;
});

</script>

<style>
.inputLogin,
.inputRegister {
    background-color: #D9D9D9;
    border-radius: 100px;
}

.inputLogin::placeholder,
.inputRegister::placeholder {
    font-weight: bold;
    font-size: small;
}

.forgotPass {
    color: #145A79;
}

.buttonLogin,
.buttonRegister {
    background-color: #145A79 !important;
    border-radius: 100px !important;
    border-color: transparent !important;
}

.aria-controls{
    width: 100px !important;
}
</style>