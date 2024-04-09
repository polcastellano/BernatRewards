<template>
    <div class="layout-topbar">
        
        <div class="d-flex align-items-center h-100">
            <div class="divLogo d-flex align-items-start justify-content-end me-4">
                <button class="botonMenu p-link layout-menu-button layout-topbar-button" @click="onMenuToggle(),cambiarFlecha()">
                    <i :class="classFlecha"></i>
                </button>
            </div>

            <router-link to="/" class="layout-topbar-logo">
                <img src="/images/logo/bernatRewards_Titulo.svg" alt="logo" />
                <span></span>
            </router-link>
        </div>
        
        <button class="p-link layout-topbar-menu-button layout-topbar-button" @click="onTopBarMenuButton()">
            <i class="pi pi-ellipsis-v"></i>
        </button>

        <div class="layout-topbar-menu" :class="topbarMenuClasses">

            <button class="p-link layout-topbar-button layout-topbar-button-c nav-item dropdown " role="button"
                data-bs-toggle="dropdown">

                <i class="pi pi-user"></i>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                    <li>
                        <router-link :to="{ name: 'profile.index' }" class="dropdown-item">Perfil</router-link>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Preferencias</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" :class="{ 'opacity-25': processing }" :disabled="processing"
                            href="javascript:void(0)" @click="logout">Cerrar sessión</a>
                    </li>
                </ul>

                <span class="nav-link dropdown-toggle ms-3 me-2" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Hola, {{ user.name }}
                </span>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useLayout } from '../composables/layout';
import { useStore } from 'vuex';
import useAuth from "@/composables/auth";

const { onMenuToggle } = useLayout();
const store = useStore();
const user = computed(() => store.state.auth.user)
const { processing, logout } = useAuth();

const topbarMenuActive = ref(false);

const onTopBarMenuButton = () => {
    topbarMenuActive.value = !topbarMenuActive.value;
};

const topbarMenuClasses = computed(() => {
    return {
        'layout-topbar-menu-mobile-active': topbarMenuActive.value
    };
});

const display = ref(true);

const cambiarFlecha = () => {
  display.value = !display.value; 
};

const classFlecha = computed(() => {
  return display.value ? 'pi pi-angle-left' : 'pi pi-angle-right';
});

</script>

<style lang="scss" scoped>

.layout-topbar-button-c,
    .layout-topbar-button-c:hover {
    width: auto;
    background-color: rgb(255, 255, 255, 0);
    border: 0;
    border-radius: 0%;
    padding: 1em;
}

.layout-topbar-logo{
    width: fit-content;  
}


.layout-topbar{
    padding-left: 0px !important;
}

.divLogo {
    height: 100%;
    border-radius: 10px;
    width: fit-content;
    box-shadow: var(--bs-box-shadow);
}

.botonMenu{
    height: 100%;
    background-color: #d6d5d5;
    margin-left: 0px;
    border-radius: 0px 10px 10px 0px;
    border-style: solid;
    border-width: 1px;
    border-color: #dbdbdb;
    fill: #000; 
    transition: color 0.25s ease 0.25s, background-color 0.25s ease 0.25s; 
}

.botonMenu:hover{
    height: 100%;
    background-color: #145A79;
    margin-left: 0px;
    border-radius: 0px 10px 10px 0px;
    border-style: solid;
    border-width: 1px;
    border-color: #dbdbdb;
    color: #ffffff;
    transition: color 0.2s ease 0.2s, background-color 0.2s ease 0.2s; 
}


</style>
