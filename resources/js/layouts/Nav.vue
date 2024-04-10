<template>

    <nav class="cabezera navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <router-link to="/" class="d-flex align-items-center contenedorLogo navbar-brand">
            <img src="/images/logo/bernatRewards_Titulo.svg" class="logo" alt="logo" />
        </router-link>  
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{ usuLogueado }}
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-0 ps-4 d-lg-none">
                <template v-if="!user?.name">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/login"
                        >{{ $t('login') }}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/register">{{ $t('register') }}</router-link>
                    </li>
                </template>
            </ul>

            <ul class="navbar-nav m-0 ps-4">
                <li class="nav-item">
                    <router-link to="/" class="nav-link" aria-current="page">{{ $t('home') }}</router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name : 'recompensas.index'}" class="nav-link">  </router-link>
                </li>
            </ul> 


            
            <ul class="navbar-nav ps-lg-0 ps-4 prueba">
                <LocaleSwitcher />
            </ul>


        </div>
        
        <div class=" d-lg-block d-none d-flex flex-row ">
            <ul class="navbar-nav m-0 ps-4">
                <template v-if="!user?.name">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/login">{{ $t('login') }}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/register">{{ $t('register') }}</router-link>
                    </li>
                </template>
            </ul>
        </div>

        
            <div v-if="user?.name" class="infoUsuario p-0 m-0 d-flex flex-column d-lg-block d-none">
                <div class="d-flex align-items-center justify-content-between">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <div class="imgUsuario" :style="{ 'background-image': `url('${storeUsuarios().usuMedia.original_image}')` }"></div>
                                    <p class="ms-2 nombreUsu" style="font-weight: bold;">{{ storeUsuarios().usuMedia.name }}</p>
                                </div>                        
                            </a>
                            <ul class="menuDesp dropdown-menu dropdown-menu-end">
                                <li><router-link class="dropdown-item" to="/admin">Admin</router-link></li>
                                <li><router-link to="/admin/recompensas" class="dropdown-item">Recompensas</router-link></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="puntosUsuario d-flex px-1 justify-content-between align-items-center">
                        <p></p>
                        <p v-if="storeUsuarios().usuLogueado.puntos <= 9999" class="pe-1 puntos">{{storeUsuarios().usuLogueado.puntos }}</p> 
                        <p v-else class="pe-1 puntos"><img src="/images/iconos/plus.svg" style="height: 15px;" alt="logo" />9999</p> 
                        <img src="/images/iconos/bernatPoints.svg" class="bernatCoin" alt="logo" />       
                    </div>
                </div>
                <div class="nivelInfo d-flex flex-column">
                    <div class="d-flex justify-content-between">
                        <p>Nv.<!--{{ storeUsuarios().usuLogueado.niveles }}--></p>
                        <!-- <p>Nv.{{ storeUsuarios().usuLogueado.niveles.numero }}</p> -->
                        <p><span style="font-weight: bold;">{{ storeUsuarios().usuLogueado.experience }}</span>/{{ storeNiveles().nivelUsu.experiencia }}xp</p>                            <p>Nv.{{ storeNiveles().nivelUsu.numero }}</p> 
                    </div>

                    <div class="barraNivel d-flex align-items-center">
                        <div class="barraNivelReal"
                            :style="{ width: ((storeUsuarios().usuLogueado.experience - storeNiveles().nivelUsu.experiencia + 1000) / 10) + '%' }"
                            :class="{
                                'bg-warning': ((storeUsuarios().usuLogueado.experience - storeNiveles().nivelUsu.experiencia + 1000) / 10) <= 33,
                                'bg-info': ((storeUsuarios().usuLogueado.experience - storeNiveles().nivelUsu.experiencia + 1000) / 10) > 33 && ((storeUsuarios().usuLogueado.experience - storeNiveles().nivelUsu.experiencia + 1000) / 10) <= 66,
                                'bg-success': ((storeUsuarios().usuLogueado.experience - storeNiveles().nivelUsu.experiencia + 1000) / 10) > 66 && ((storeUsuarios().usuLogueado.experience - storeNiveles().nivelUsu.experiencia + 1000) / 10) <= 100,
                            }"
                        ></div>
                    </div>
                </div> 
            </div>
        
        

            









    </div>
    </nav>
</template>

<script setup>
import { useStore} from "vuex";
import useAuth from "@/composables/auth";
import {computed} from "vue";
import LocaleSwitcher from "../components/LocaleSwitcher.vue";
import { onMounted, ref } from 'vue';
import storePinia from "../store";
import {storeNiveles} from "../store/niveles";
import {storeUsuarios} from "../store/usuarios";

    const store = useStore();
    const user = computed(() => store.getters["auth/user"])
    const { processing, logout } = useAuth();
</script>

<style>
.cabezera {
    background-color: white !important;
    box-shadow: 0px 0px 6px black !important;
    margin-bottom: 5px;
}

.logo{
    height: 3.6rem;
}

.navbar-toggler{
    height: fit-content;
}

.menuPrincipal {
    width: fit-content;
}

.tarjetaUsu{
    width: fit-content !important;
}

.infoUsuario{
    width: 245px;
    margin: 0.5rem 0.5rem 0 0.5rem;
    border-radius: 12px;
    padding: 0.5rem;
}

.infoUsuario p{
    color: black;
    font-size: 15px;
    font-family: Raleway;
    font-weight: bold;
    margin: 0px;
}

.nombreUsu{
    max-width: 6.563rem;
    overflow: hidden;
}

.imgUsuario{
    height: 2.5rem; 
    width: 2.5rem; 
    border: 3px solid #D0D0D0; 
    border-radius: 100%; 
    background-position: center; 
    background-size: 100% auto;
}

.puntosUsuario{
    background-color: #D0D0D0;
    width: 6rem;
    border-radius: 25px; 
}

.menuDesp{
    position: absolute !important;
    z-index: 99;
}

.puntosUsuario p{
    font-size: 15px;
    font-family: Raleway;
    font-weight: bold;
    max-width: 230px;
    overflow:hidden;
}

.bernatCoin{
    height: 1.4rem;
}

.nivelInfo{
    padding: 0 0.5rem 0 0.5rem;
}

.nivelInfo p{
    color: black;
    font-size: 10px;
    font-family: Raleway;
    font-weight: bold;
    margin: 0px;
}

.barraNivel{
    width: 100%;
    border-radius: 25px;
    padding: 0.15rem;
    background-color: #D0D0D0;
}

.barraNivelReal{
    height: 0.5rem;
    border-radius: 25px;
}

.separador{
    color: Red !important;
}


</style>