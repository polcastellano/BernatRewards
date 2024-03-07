
<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
    </ul>
</template>

<script setup>
import { ref } from 'vue';
import AppMenuItem from './AppMenuItem.vue';
import {useAbility} from '@casl/vue'
import store from "../store";


const {can} = useAbility();

const vela = "pepe";

var usuario = store.state.auth.user;


const model = ref([
    {
        label: 'Panel Usuario',
        items: [
            { label: usuario.puntos, icon: 'pi pi-fw puntosIcon', permision: 'all' },          
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


<style lang="scss" scoped></style>
