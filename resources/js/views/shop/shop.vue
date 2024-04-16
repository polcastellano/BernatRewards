<template>
    <div class="min-h-screen bg-white dark:bg-gray-900">
        <div class="col-12 bg-principal">
            <h1>Shop</h1>
            {{ recompensas.data }}
        </div>
    </div>
    <app-footer></app-footer>
</template>

<script setup>
import AppFooter from '../../layouts/AppFooter.vue';
import { onMounted,} from 'vue';
import store from "../../../js/store/";
import {storeNiveles} from "../../../js/store/niveles";
import {storeUsuarios} from "../../../js/store/usuarios";

import usarRecompensas from "@/composables/recompensas";

const {recompensas, getRecompensas, deleteRecompensa} = usarRecompensas()

onMounted(() => {
    getRecompensas()

    if (store.state.auth.user.id != null) {
        let usuario = store.state.auth.user;
        storeNiveles().getNivelSiguiente(usuario.niveles.id);
        storeUsuarios().getUsuMedia(usuario.id);
        storeUsuarios().getUsuLogueado(usuario.id);
    }    
});

</script>

<style scoped>
h2{
    color: white;
    font-size: 50px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    text-align: left;
}

section{
    margin-bottom: 3em;
}
.txtInfo{
    height: 25rem;
    width: 40rem;
}

.txtInfo p{
    color: white;
    font-size: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.imgInfo{
    height: 25rem;
    width: 35.8rem;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;

}

.caruselI1{
    height: 35.721rem;
    background-image: linear-gradient(to bottom right, #9B52E0, #0793E3);

}

.caruselI2{
    height: 35.721rem;
    background-image: linear-gradient(to bottom right, #108CD2, #51E0B9);

}

.caruselI3{
    height: 35.721rem;
    background-image: linear-gradient(to bottom right, #10d24d, #b3e051);

}

.cuadradoInfo{
    padding: 50px;
    transition: transform .5s;
    margin: 0 auto;
}

.cuadradoInfo:hover {
  transform: scale(1.2); 
  cursor: pointer;
  z-index: 2;
  box-shadow: 0px 0px 10px black;
} 

.cuadradoInfo p{
    color: white;
}

</style>../../store../../store/niveles../../store/usuarios
