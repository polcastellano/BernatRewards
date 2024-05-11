<template>
    <ul class="layout-menu"> <a href="javascript:void(0)" @click="perfil(user.id)">

            <div class="infoUsuario">
                <div class="d-flex align-items-center">
                    <div class="imgUsuario bg-white"
                        :style="{ 'background-image': `url('${user?.media[0]?.original_url}')` }" :class="{
        'border-warning': ((user.experience - user.nextLevel.experiencia + 1000) / 10) <= 33,
        'border-info': ((user.experience - user.nextLevel.experiencia + 1000) / 10) > 33 && ((user.experience - user.nextLevel.experiencia + 1000) / 10) <= 66,
        'border-success': ((user.experience - user.nextLevel.experiencia + 1000) / 10) > 66 && ((user.experience - user.nextLevel.experiencia + 1000) / 10) <= 100,
        'border-comodidadesSubTone': user.experience >= 100000,
    }"></div>
                    <p class="ms-2 nombreUsu" style="font-weight: bold;">{{ user.name }}</p>
                </div>
                <div v-if="user.experience < 100000" class="nivelInfo d-flex flex-column">
                    <div class="d-flex justify-content-between">
                        <p>Nv.{{ user.nivelActual.numero }}</p>
                        <p><span style="font-weight: bold;">{{ user.experience }}</span>/{{ user.nextLevel.experiencia
                            }}xp
                        </p>
                        <p>Nv.{{ user.nextLevel.numero }}</p>
                    </div>

                    <div class="barraNivel d-flex align-items-center">

                        <div class="barraNivelReal"
                            :style="{ width: ((user.experience - user.nextLevel.experiencia + 1000) / 10) + '%' }"
                            :class="{
        'bg-warning': ((user.experience - user.nextLevel.experiencia + 1000) / 10) <= 33,
        'bg-info': ((user.experience - user.nextLevel.experiencia + 1000) / 10) > 33 && ((user.experience - user.nextLevel.experiencia + 1000) / 10) <= 66,
        'bg-success': ((user.experience - user.nextLevel.experiencia + 1000) / 10) > 66 && ((user.experience - user.nextLevel.experiencia + 1000) / 10) <= 100,
    }">
                        </div>
                    </div>

                </div>
                <div v-else class="nivelInfo d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Nv.{{ user.nivelActual.numero }}</p>
                        <div class="d-flex align-items-center">
                            <p>Nv.Max</p>
                            <img src="/images/iconos/lvlMax.svg" class="logo d-none d-lg-block"
                                style="height: 1.5rem;" />
                        </div>
                    </div>

                    <div class="barraNivel d-flex align-items-center mt-1">
                        <div class="barraNivelReal bg-comodidadesSubTone" style="width: 100%;">
                        </div>
                    </div>

                </div>
            </div>
        </a>
        <div style="padding: 0.5rem 1rem 1rem 1rem;">
            <template v-for="(item, i) in model" :key="item">
                <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
                <li v-if="item.separator" class="menu-separator"></li>
            </template>
        </div>
    </ul>
</template>

<script setup>
import { ref, watchEffect } from 'vue';
import AppMenuItem from './AppMenuItem.vue';
import { userStore } from '@/store/authPinia';
import { useRouter } from "vue-router";

const user = userStore().vistaUser()
const router = useRouter()

const vela = "pepe";

const model = ref([
    {
        label: 'Panel Usuario',
        permision: 'all',
        items: [
            { label: 'BernatPoints: ' + user.value.puntos, icon: 'pi pi-fw puntosIcon', permision: 'all' },
            { label: 'Recompensas', icon: 'pi pi-fw pi-star-fill', to: '/shop', permision: 'all' },
            { label: 'Historial', icon: 'pi pi-fw pi-history', to: '/admin/pedidos', permision: 'all' },
            { label: 'Campus', icon: 'pi pi-fw pi-book', to: '/moodle', permision: 'all' }
        ]
    },
    {
        label: 'Panel de Administrador',
        permision: 'recompensa-all',
        items: [
            { label: 'Recompensas', icon: 'pi pi-fw pi-star', to: '/admin/recompensas', permision: 'recompensa-list' }
        ],

    },
    {
        label: 'Usuarios',
        permision: 'all',
        items: [
            { label: 'Users', icon: 'pi pi-fw pi-user', to: '/admin/users', permision: 'user-list' },
            { label: 'Alumnos', icon: 'pi pi-fw pi-id-card', to: '/admin/users/students', permision: 'student-list' },
            { label: 'Roles', icon: 'pi pi-fw pi-check-square', to: '/admin/roles', permision: 'role-list' },
            { label: 'Permisos', icon: 'pi pi-fw pi-bookmark', to: '/admin/permissions', permision: 'permission-list' }
        ]
    },

]);

watchEffect(() => {
    model.value[0].items[0].label = 'BernatPoints: ' + user.value.puntos;
})

const perfil = ((id) => {
    router.push({ name: 'perfil.edit', params: { id: id } })
})
</script>


<style lang="scss" scoped>
.infoUsuario {
    margin: 0.5rem 0.5rem 0 0.5rem;
    background-color: #145A79;
    border-radius: 12px;
    padding: 0.5rem;
}

.infoUsuario p {
    color: white;
    margin: 0px;
}

.imgUsuario {
    height: 3.5rem;
    width: 3.5rem;
    border: 3px solid white;
    border-radius: 100%;
    background-position: center;
    background-size: 100% auto;
}

.nivelInfo {
    padding: 0.5rem;
}

.barraNivel {
    height: 1rem;
    width: 100%;
    border-radius: 25px;
    padding-left: 0.2rem;
    padding-right: 0.2rem;
    background-color: white;
}

.barraNivelReal {
    height: 0.5rem;
    border-radius: 25px;
    transition: width 0.5s ease;
}

.separador {
    color: Red !important;
}

.nombreUsu {
    max-width: 14rem;
    max-height: 8rem;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
