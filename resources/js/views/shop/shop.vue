<template>
    <section>
        <Toast appendTo="self" />
        <div v-if="authuser.name != null">
            <div v-for="categoria in productosCategorias" class="flex justify-content-center align-items-center">
                <div :class="'bg-' + categoria.nombre.toLowerCase()"
                    class="flex flex-wrap w-full lg:m-5 m-2 lg:p-5 p-3 md:justify-content-start justify-content-start border-round-3xl">
                    <div :class="'bg-' + categoria.nombre.toLowerCase() + 'SubTone'"
                        class="tituloCategoria flex align-items-center p-1 px-3 border-round-3xl lg:mb-6 mb-4">
                        <img :src="'/images/iconos/' + categoria.nombre.toLowerCase() + '.svg'"
                            class="h-2rem w-2rem pr-0 md:pr-2" alt="icono de la categoria">
                        <h2 class="tituloSeccion hidden md:block p-1 m-0 text-white text-3xl">{{ $t(categoria.nombre) }}
                        </h2>
                    </div>
                    <div class="flex flex-wrap w-full md:justify-content-start justify-content-center border-round-3xl">
                        <div v-for="item in categoria.productos" class="lg:w-4 md:w-6 w-11 lg:px-5 md:px-4 px-2 pb-6">
                            <div :class="{
                                        'bg-restriction': authuser.nivelActual.numero < item.nivel_desbloqueo,
                                        }" 
                                        class="bg-white block flex flex-column p-3 border-round-3xl flex-end">
                                <div class="bg-fondo h-20rem mb-3 border-round-3xl">
                                    <div class="h-full w-full bg-center bg-no-repeat flex justify-content-between bg-contain"
                                        :style="{ 'background-image': `url('${item.original_image}')` }">
                                        <div v-for="categoria in item.categorias">
                                            <div v-if="categoria.id == 1"
                                                class="bg-fondoOscuro mt-2 ms-2 p-1 w-6rem h-2 flex border-round-3xl justify-content-between align-items-center">
                                                <p class="text-black numerosProducto m-0 ps-2 font-normal">00:00</p>
                                                <img src="/images/iconos/watch.svg"
                                                    class="h-2rem w-2rem justify-self-end"
                                                    alt="reloj de tiempo de descuento">
                                            </div>
                                        </div>

                                        <div class="bg-principal mt-2 me-2 border-circle flex justify-content-center align-items-center"
                                            style="height: 2.5rem; width: 2.5rem;">
                                            <p class="text-white text-center text-xs"
                                                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">{{"Nv." + item.nivel_desbloqueo }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-content-between">
                                    <div>
                                        <p class="text-2xl text-black tituloProducto">{{item.nombre.charAt(0).toUpperCase() + item.nombre.slice(1).toLowerCase() }}
                                        </p>
                                        <p class="text-black tituloProducto">{{ item.descripcion }}</p>
                                    </div>
                                    <div class="flex flex-column ">
                                        <div
                                            class="w-8rem h-3rem flex bg-fondo border-round-3xl justify-content-around align-items-center mb-2">
                                            <p class="text-black numerosProducto m-0 font-normal ps-4">{{item.precio.toString().padStart(5, '0') }}</p>
                                            <img src="/images/iconos/bernatPoints.svg"
                                                class="h-2rem w-2rem justify-self-end" alt="">
                                        </div>

                                        <button appendTo="self" @click="canBuy(item?.id, item?.precio)"
                                            class="buttonComprar w-8rem h-3rem flex bg-fondo border-round-3xl border-none justify-content-around align-items-center mb-2">
                                            <div>
                                                <p>{{ $t('buy') }}</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex justify-content-center align-items-center">
                <div
                    class="bg-principal flex flex-wrap w-full lg:m-5 m-2 lg:p-5 p-3 md:justify-content-start justify-content-start border-round-3xl">
                    <div class="tituloCategoria flex align-items-center p-1 px-3 border-round-3xl lg:mb-6 mb-4"
                        style="background-color: #2E99C9;">
                        <img src="/images/iconos/reward.svg" class="h-2rem w-2rem pr-0 md:pr-2 lg:pr-2" alt="">
                        <h2 class="tituloSeccion hidden md:block p-1 m-0 text-white text-3xl">{{ $t('all') }}</h2>
                    </div>
                    <div class="flex flex-wrap w-full md:justify-content-start justify-content-center border-round-3xl">
                        <div v-for="item in recompensas.data" class="lg:w-4 md:w-6 w-11 lg:px-5 md:px-4 px-2 pb-6">
                            <div class="bg-white block flex flex-column p-3 border-round-3xl flex-end">

                                <div class="bg-fondo h-20rem mb-3 border-round-3xl">
                                    <div class="h-full w-full bg-center bg-no-repeat flex justify-content-between bg-contain"
                                        :style="{ 'background-image': `url('${item.original_image}')` }">
                                        <div v-for="categoria in item.categorias">
                                            <div v-if="categoria.id == 1"
                                                class="bg-fondoOscuro mt-2 ms-2 p-1 w-6rem h-2 flex border-round-3xl justify-content-between align-items-center">
                                                <p class="text-black numerosProducto m-0 ps-2 font-normal">00:00</p>
                                                <img src="/images/iconos/watch.svg"
                                                    class="h-2rem w-2rem justify-self-end"
                                                    alt="reloj de tiempo de descuento">
                                            </div>
                                        </div>

                                        <div class="bg-principal mt-2 me-2 border-circle flex justify-content-center align-items-center"
                                            style="height: 2.5rem; width: 2.5rem;">
                                            <p class="text-white text-center text-xs"
                                                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">{{
            "Nv." + item.nivel_desbloqueo }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-content-between">
                                    <div>
                                        <p class="text-2xl text-black tituloProducto">{{
            item.nombre.charAt(0).toUpperCase() + item.nombre.slice(1).toLowerCase() }}
                                        </p>
                                        <p class="text-black tituloProducto">{{ item.descripcion }}</p>
                                    </div>
                                    <div class="flex flex-column ">
                                        <div
                                            class="w-8rem h-3rem flex bg-fondo border-round-3xl justify-content-around align-items-center mb-2">
                                            <p class="text-black numerosProducto m-0 font-normal ps-4">{{
            item.precio.toString().padStart(5, '0') }}</p>
                                            <img src="/images/iconos/bernatPoints.svg"
                                                class="h-2rem w-2rem justify-self-end" alt="precio de la recompensa">
                                        </div>
                                        <button appendTo="self" @click="canBuy(item?.id, item?.precio)"
                                            class="buttonComprar w-8rem h-3rem flex bg-fondo border-round-3xl border-none justify-content-around align-items-center mb-2">
                                            <div>
                                                <p>{{ $t('buy') }}</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div v-for="categoria in productosCategorias" class="flex justify-content-center align-items-center">
                <div :class="'bg-' + categoria.nombre.toLowerCase()"
                    class="flex flex-wrap w-full lg:m-5 m-2 lg:p-5 p-3 md:justify-content-start justify-content-start border-round-3xl">
                    <div :class="'bg-' + categoria.nombre.toLowerCase() + 'SubTone'"
                        class="tituloCategoria flex align-items-center p-1 px-3 border-round-3xl lg:mb-6 mb-4">
                        <img :src="'/images/iconos/' + categoria.nombre.toLowerCase() + '.svg'"
                            class="h-2rem w-2rem pr-0 md:pr-2" alt="icono de la categoria">
                        <h2 class="tituloSeccion hidden md:block p-1 m-0 text-white text-3xl">{{ $t(categoria.nombre) }}
                        </h2>
                    </div>
                    <div class="flex flex-wrap w-full md:justify-content-start justify-content-center border-round-3xl">
                        <div v-for="item in categoria.productos" class="lg:w-4 md:w-6 w-11 lg:px-5 md:px-4 px-2 pb-6">
                            <div class="bg-white block flex flex-column p-3 border-round-3xl flex-end">

                                <div class="bg-fondo h-20rem mb-3 border-round-3xl">
                                    <div class="h-full w-full bg-center bg-no-repeat flex justify-content-between bg-contain"
                                        :style="{ 'background-image': `url('${item.original_image}')` }">
                                        <div v-for="categoria in item.categorias">
                                            <div v-if="categoria.id == 1"
                                                class="bg-fondoOscuro mt-2 ms-2 p-1 w-6rem h-2 flex border-round-3xl justify-content-between align-items-center">
                                                <p class="text-black numerosProducto m-0 ps-2 font-normal">00:00</p>
                                                <img src="/images/iconos/watch.svg"
                                                    class="h-2rem w-2rem justify-self-end"
                                                    alt="reloj de tiempo de descuento">
                                            </div>
                                        </div>

                                        <div class="bg-principal mt-2 me-2 border-circle flex justify-content-center align-items-center"
                                            style="height: 2.5rem; width: 2.5rem;">
                                            <p class="text-white text-center text-xs"
                                                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">{{
            "Nv." + item.nivel_desbloqueo }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-content-between">
                                    <div>
                                        <p class="text-2xl text-black tituloProducto">{{
            item.nombre.charAt(0).toUpperCase() + item.nombre.slice(1).toLowerCase() }}
                                        </p>
                                        <p class="text-black tituloProducto">{{ item.descripcion }}</p>
                                    </div>
                                    <div class="flex flex-column ">
                                        <div
                                            class="w-8rem h-3rem flex bg-fondo border-round-3xl justify-content-around align-items-center mb-2">
                                            <p class="text-black numerosProducto m-0 font-normal ps-4">{{
            item.precio.toString().padStart(5, '0') }}</p>
                                            <img src="/images/iconos/bernatPoints.svg"
                                                class="h-2rem w-2rem justify-self-end" alt="">
                                        </div>

                                        <button appendTo="self" @click="login()"
                                            class="buttonComprar w-8rem h-3rem flex bg-fondo border-round-3xl border-none justify-content-around align-items-center mb-2">
                                            <div>
                                                <p>{{ $t('buy') }}</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex justify-content-center align-items-center">
                <div
                    class="bg-principal flex flex-wrap w-full lg:m-5 m-2 lg:p-5 p-3 md:justify-content-start justify-content-start border-round-3xl">
                    <div class="tituloCategoria flex align-items-center p-1 px-3 border-round-3xl lg:mb-6 mb-4"
                        style="background-color: #2E99C9;">
                        <img src="/images/iconos/reward.svg" class="h-2rem w-2rem pr-0 md:pr-2 lg:pr-2" alt="">
                        <h2 class="tituloSeccion hidden md:block p-1 m-0 text-white text-3xl">{{ $t('all') }}</h2>
                    </div>
                    <div class="flex flex-wrap w-full md:justify-content-start justify-content-center border-round-3xl">
                        <div v-for="item in recompensas.data" class="lg:w-4 md:w-6 w-11 lg:px-5 md:px-4 px-2 pb-6">
                            <div class="bg-white block flex flex-column p-3 border-round-3xl flex-end">

                                <div class="bg-fondo h-20rem mb-3 border-round-3xl">
                                    <div class="h-full w-full bg-center bg-no-repeat flex justify-content-between bg-contain"
                                        :style="{ 'background-image': `url('${item.original_image}')` }">
                                        <div v-for="categoria in item.categorias">
                                            <div v-if="categoria.id == 1"
                                                class="bg-fondoOscuro mt-2 ms-2 p-1 w-6rem h-2 flex border-round-3xl justify-content-between align-items-center">
                                                <p class="text-black numerosProducto m-0 ps-2 font-normal">00:00</p>
                                                <img src="/images/iconos/watch.svg"
                                                    class="h-2rem w-2rem justify-self-end"
                                                    alt="reloj de tiempo de descuento">
                                            </div>
                                        </div>

                                        <div class="bg-principal mt-2 me-2 border-circle flex justify-content-center align-items-center"
                                            style="height: 2.5rem; width: 2.5rem;">
                                            <p class="text-white text-center text-xs"
                                                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">{{
            "Nv." + item.nivel_desbloqueo }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-content-between">
                                    <div>
                                        <p class="text-2xl text-black tituloProducto">{{
                                            item.nombre.charAt(0).toUpperCase() + item.nombre.slice(1).toLowerCase() }}
                                        </p>
                                        <p class="text-black tituloProducto">{{ item.descripcion }}</p>
                                    </div>
                                    <div class="flex flex-column ">
                                        <div
                                            class="w-8rem h-3rem flex bg-fondo border-round-3xl justify-content-around align-items-center mb-2">
                                            <p class="text-black numerosProducto m-0 font-normal ps-4">{{
                                                item.precio.toString().padStart(5, '0') }}</p>
                                            <img src="/images/iconos/bernatPoints.svg"
                                                class="h-2rem w-2rem justify-self-end" alt="precio de la recompensa">
                                        </div>
                                        <button appendTo="self" @click="login()"
                                            class="buttonComprar w-8rem h-3rem flex bg-fondo border-round-3xl border-none justify-content-around align-items-center mb-2">
                                            <div>
                                                <p>{{ $t('buy')}}</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <app-footer></app-footer>
</template>

<script setup>
import AppFooter from '../../layouts/AppFooter.vue';
import { onMounted } from 'vue';
import usarRecompensas from "@/composables/recompensas";
import usarCategorias from "@/composables/categorias";
import usarPedidos from "@/composables/pedidos";
import { userStore } from '@/store/authPinia';
import { useRouter } from 'vue-router';
import { useToast } from "primevue/usetoast";

const authuser = userStore().vistaUser()
const toast = useToast();
const router = useRouter();

const { recompensas, getRecompensas } = usarRecompensas()
const { productosCategorias, getRecompensasCategorias } = usarCategorias()
const { canBuy } = usarPedidos()



onMounted(() => {
    getRecompensas();
    getRecompensasCategorias();
});

const login = (() => {
    toast.add({ severity: 'error', summary: 'Inicia sesion', detail: 'Debes iniciar sesión para comprar', life: 1300, closable: false });
    // Espera un momento antes de redirigir
    setTimeout(() => {
        router.push({ path: '/login', query: { tab: 0 }})
    }, 1300); // 1500 ms para asegurar que el toast desaparezca antes de redirigir
})
</script>

<style scoped>
.tituloCategoria {
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.25);
}

.tituloProducto {
    font-family: Raleway;
}

.numerosProducto {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.buttonComprar {
    transition: 0.5s;
}

.buttonComprar:hover {
    background-color: #145A79 !important;
    border: solid;
    color: white !important;
    transition: 0.5s;
}
.bg-restriction {
    position: relative;
    border-radius: 3rem !important;
}

.bg-restriction::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    border-radius: 3rem !important;
    width: 100%;
    height: 100%;
    background-color: rgba(133, 133, 133, 0.455); /* Color con opacidad */
    z-index: 1; /* Asegura que la capa esté por encima del contenido */
}

.bg-restriction::after {
    content: "";
    position: absolute;
    top: 25%;
    left: 25%;
    width: 50%;
    height: 50%;
    background-image: url('/images/placeholder.jpg'); /* Ruta de la imagen de fondo */
    background-size: contain; /* Ajusta la imagen de fondo para que se ajuste dentro del contenedor */
    background-position: center center; /* Centra la imagen de fondo */
    background-repeat: no-repeat; /* Evita que la imagen se repita */
    z-index: 3; /* Asegura que la capa esté por encima de todas las otras capas */
}


.bg-restriction::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(1px); /* Ajusta el valor para cambiar la intensidad del desenfoque */
    z-index: 2; /* Asegura que la capa esté por encima del contenido */
}

</style>