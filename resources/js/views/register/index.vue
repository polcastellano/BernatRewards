<template>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent"><h2>{{ $t('register') }}</h2></div>
                    <div class="card-body">
                        <form @submit.prevent="submitRegister">
                            <div class="">
                                <!-- Email -->
                                <div class="mb-3">
                                    <input v-model="registerForm.name" id="name" type="text" class="form-control inputRegister" autofocus :placeholder="$t('name')">
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.name">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input v-model="registerForm.email" id="email" type="email" class="form-control inputRegister" autocomplete="username" :placeholder="$t('email')">
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.email">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="mb-4">
                                    <input v-model="registerForm.password" id="password" type="password" class="form-control inputRegister" autocomplete="current-password" :placeholder="$t('password')">
                                    <!-- Validation Errors -->
                                    <div class="text-danger-600 mt-1">
                                        <div v-for="message in validationErrors?.password">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input v-model="registerForm.password_confirmation" id="password_confirmation" type="password" class="form-control inputRegister" autocomplete="current-password" :placeholder="$t('confirm_password')">
                                    <!-- Validation Errors -->
                                    <div class="text-danger-600 mt-1">
                                        <div v-for="message in validationErrors?.password_confirmation">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-content-end align-items-center mt-5">
                                    <button class="btn btn-primary" :class="{ 'opacity-25': processing }" :disabled="processing">
                                        {{ $t('register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import useAuth from '@/composables/auth'

const { registerForm, validationErrors, processing, submitRegister } = useAuth();

</script>

<style>

.fondo{
    background-color: red;
}

.inputRegister{
    background-color: #D9D9D9;
    border-radius: 100px;
}

.inputRegister::placeholder{
    font-weight: bold;
    font-size: small;
}

button{
    background-color: #145A79 !important;
    border-radius: 100px !important;

}

</style>