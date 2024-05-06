<template>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6"><!-- {{ $t('login') }} -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <TabView class="">
                            
                            <TabPanel header="login">

                                <form @submit.prevent="submitLogin">
                                    <h2>{{ $t('login') }}</h2>
                                    <div class="">
                                        <!-- Email -->
                                        <div class="mb-3">
                                            <input v-model="loginForm.email" id="email" type="email"
                                                class="form-control inputLogin" required autofocus
                                                autocomplete="username" :placeholder="$t('email')">
                                            <!-- Validation Errors -->
                                            <div class="text-danger mt-1">
                                                <div v-for="message in validationErrors?.email">
                                                    {{ message }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Password -->
                                        <div class="mb-3">
                                            <input v-model="loginForm.password" id="password" type="password"
                                                class="form-control inputLogin" required autocomplete="current-password"
                                                :placeholder="$t('password')">
                                            <!-- Validation Errors -->
                                            <div class="text-danger-600 mt-2">
                                                <div v-for="message in validationErrors?.password">
                                                    {{ message }}
                                                </div>
                                            </div>
                                            <router-link :to="{ name: 'auth.forgot-password' }" class="forgotPass">{{
                            $t('forgot_password') }}</router-link>

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
                            <TabPanel header="registro">
                                <form @submit.prevent="submitRegister">
                                    <h2>{{ $t('register') }}</h2>
                                    <div class="">
                                        <!-- Email -->
                                        <div class="mb-3">
                                            <input v-model="registerForm.name" id="name" type="text"
                                                class="form-control inputRegister" autofocus :placeholder="$t('name')">
                                            <!-- Validation Errors -->
                                            <div class="text-danger mt-1">
                                                <div v-for="message in validationErrors?.name">
                                                    {{ message }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <input v-model="registerForm.email" id="email" type="email"
                                                class="form-control inputRegister" autocomplete="username"
                                                :placeholder="$t('email')">
                                            <!-- Validation Errors -->
                                            <div class="text-danger mt-1">
                                                <div v-for="message in validationErrors?.email">
                                                    {{ message }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Password -->
                                        <div class="mb-3">
                                            <input v-model="registerForm.password" id="password" type="password"
                                                class="form-control inputRegister" autocomplete="current-password"
                                                :placeholder="$t('password')">
                                            <!-- Validation Errors -->
                                            <div class="text-danger-600 mt-1">
                                                <div v-for="message in validationErrors?.password">
                                                    {{ message }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <input v-model="registerForm.password_confirmation"
                                                id="password_confirmation" type="password"
                                                class="form-control inputRegister" autocomplete="current-password"
                                                :placeholder="$t('confirm_password')">
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

const { loginForm, registerForm, validationErrors, processing, submitLogin } = useAuth();

</script>

<style>

.inputLogin, .inputRegister{
    background-color: #D9D9D9;
    border-radius: 100px;
}

.inputLogin::placeholder, , .inputRegister::placeholder{
    font-weight: bold;
    font-size: small;
}

.forgotPass{
    color: #145A79;
}

.buttonLogin, .buttonRegister{
    background-color: #145A79 !important;
    border-radius: 100px !important;

}

</style>