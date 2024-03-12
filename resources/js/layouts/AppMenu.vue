
<template>
    <ul class="layout-menu">
        <div class="infoUsuario">
            <div class="d-flex align-items-center">
                <div class="imgUsuario">
                    <img style="height: 3rem; width: 3rem;" src="/images/bernatPoints.svg" alt="Imagen de usuario">
                </div>
                <p class="ms-2" style="font-weight: bold;">{{ usuario.name }}</p>
            </div>
            <div class="nivelInfo d-flex flex-column">
                
                <div class="d-flex justify-content-between">
                    <p>Nv.{{ usuario.nivel_id - 1 }}</p>
                    <p>{{ usuario.experience }}/{{ usuario.experience }}</p>
                    <p>Nv.{{ usuario.nivel_id }}</p>
                </div>

                <div class="barraNivel d-flex align-items-center">
                    <div class="barraNivelReal" style="width: 75%;"></div>
                </div>
            </div> 
        </div>
        <div style="padding: 0.5rem 1rem 1rem 1rem;">
            <template v-for="(item, i) in model" :key="item">
                <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
                <li v-if="item.separator" class="menu-separator"></li>
            </template>
        </div>
    </ul>
</template>

<script setup>
import { ref, watch } from 'vue';
import AppMenuItem from './AppMenuItem.vue';
import {useAbility} from '@casl/vue'
import store from "../store";


const {can} = useAbility();

const vela = "pepe";

var usuario = store.state.auth.user;
var niveles = store.state.auth.nivel;

// console.log('--->');
// console.log(niveles);
// watch( store.state, (state) => console.table(state));



const model = ref([
    {
        label: 'Panel Usuario',
        items: [
            { label: 'BernatPoints: ' + usuario.puntos, icon: 'pi pi-fw puntosIcon', permision: 'all' },          
            { label: 'Recompensas', icon: 'pi pi-fw pi-star-fill', to: '/', permision: 'all' },  
            { label: 'Positivos', icon: 'pi pi-fw pi-plus-circle', permision: 'all' },
            { label: 'Historial', icon: 'pi pi-fw pi-history', permision: 'all' },
            { label: 'Campus', icon: 'pi pi-fw pi-book', to: '/campus', permision: 'all' }
        ]
    },
    {
        label: 'Panel de Administrador',
        items: [
            { label: 'Recompensas', icon: 'pi pi-fw pi-star', to: '/admin/recompensas', permision: 'all' }
        ]
    },
    {
        label: 'Home',
        items: [{ label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/admin', permision: 'all'}]
    },
    {
        label: 'Usuarios',
        items: [
            { label: 'Users', icon: 'pi pi-fw pi-id-card', to: '/admin/users', permision: 'user-list' },
            { label: 'Roles', icon: 'pi pi-fw pi-check-square', to: '/admin/roles', permision:'role-list' },
            { label: 'Permisos', icon: 'pi pi-fw pi-bookmark', to: '/admin/permissions', permision:'permission-list' }
        ]
    },
    {
        label: 'Ejercicios',
        items: [
            { label: 'Ejercicios', icon: 'pi pi-fw pi-id-card', to: '/admin/exercises', permision: 'exercise-list' },
            { label: 'Categorias', icon: 'pi pi-fw pi-id-card', to: '/admin/categories', permision: 'category-list' }
        ]
    },
    {
        label: 'Posts',
        items: [
            { label: 'Posts', icon: 'pi pi-fw pi-id-card', to: '/admin/posts', permision: 'post-list' }
        ]
    }
]);
</script>


<style lang="scss" scoped>

.infoUsuario{
    margin: 0.5rem 0.5rem 0 0.5rem;
    background-color: #145A79;
    border-radius: 12px;
    padding: 0.5rem;
}

.infoUsuario p{
    color: white;
    margin: 0px;
}

.imgUsuario{
    border-radius: 100%;
    padding: 0.2rem;
    background-color: white;
}

.nivelInfo{
    padding: 0.5rem;
}

.barraNivel{
    height: 1rem;
    width: 100%;
    border-radius: 25px;
    padding-left: 0.2rem;
    padding-right: 0.2rem;
    background-color: white;
}

.barraNivelReal{
    height: 0.5rem;
    border-radius: 25px;
    background-color: #34a6d6;
}

</style>
