<template>
    <section>
        <div v-for="categoria in productosCategorias" class="flex justify-content-center align-items-center">
            <div :class="'bg-' + categoria.nombre.toLowerCase()" class="flex flex-wrap w-full lg:m-5 m-2 lg:p-5 p-3 md:justify-content-start justify-content-start border-round-3xl">
                <div :class="'bg-' + categoria.nombre.toLowerCase() + 'SubTone'" class="tituloCategoria flex align-items-center p-2 px-4 border-round-3xl lg:mb-6 mb-4">
                    <img :src="'/images/iconos/' + categoria.nombre.toLowerCase() + '.svg'" class="h-3rem w-3rem pr-0 md:pr-2" alt="">
                    <h2 class="tituloSeccion hidden md:block p-1 m-0 text-white text-5xl">{{categoria.nombre}}</h2>
                </div>
                <div class="flex flex-wrap w-full md:justify-content-start justify-content-center border-round-3xl">
                    <div v-for="item in categoria.productos" class="lg:w-4 md:w-6 w-11 lg:px-5 md:px-4 px-2 pb-6">
                        <div class="bg-white block flex flex-column p-3 border-round-3xl flex-end">
                     
                            <div class="bg-fondo h-20rem mb-3 border-round-3xl">
                                <div class="h-full w-full bg-center bg-no-repeat flex justify-content-between bg-contain" :style="{ 'background-image': `url('${item.original_image}')` }">
                                    <div v-for="categoria in item.categorias">
                                        <div v-if="categoria.id == 1" class="bg-fondoOscuro mt-2 ms-2 p-1 w-6rem h-2 flex border-round-3xl justify-content-between align-items-center">
                                            <p class="text-black numerosProducto m-0 ps-2 font-normal">00:00</p>
                                            <img src="/images/iconos/watch.svg" class="h-2rem w-2rem justify-self-end" alt="">
                                        </div>
                                    </div>

                                    <div class="bg-principal mt-2 me-2 border-circle flex justify-content-center align-items-center" style="height: 2.5rem; width: 2.5rem;">
                                        <p class="text-white text-center text-xs" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">{{ "Nv." + item.nivel_desbloqueo }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-content-between">
                                <div>
                                    <p class="text-2xl text-black tituloProducto">{{ item.nombre.charAt(0).toUpperCase() + item.nombre.slice(1).toLowerCase() }}</p>
                                    <p class="text-black tituloProducto">{{ item.descripcion }}</p>
                                </div>
                                <div class="flex flex-column ">
                                    <div class="w-8rem h-3rem flex bg-fondo border-round-3xl justify-content-around align-items-center mb-2">
                                        <p class="text-black numerosProducto m-0 font-normal ps-4">{{ item.precio.toString().padStart(5, '0') }}</p>
                                        <img src="/images/iconos/bernatPoints.svg" class="h-2rem w-2rem justify-self-end" alt="">
                                    </div>
                                    <button class="buttonComprar w-8rem h-3rem flex bg-fondo border-round-3xl border-none justify-content-around align-items-center mb-2">
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


        <div class="flex justify-content-center align-items-center">
            <div class="bg-principal flex flex-wrap w-full lg:m-5 m-2 lg:p-5 p-3 md:justify-content-start justify-content-start border-round-3xl">
                <div class="tituloCategoria flex align-items-center p-2 px-4 border-round-3xl lg:mb-6 mb-4"
                    style="background-color: #2E99C9;">
                    <img src="/images/iconos/reward.svg" class="h-3rem w-3rem pr-0 md:pr-2 lg:pr-2" alt="">
                    <h2 class="tituloSeccion hidden md:block p-1 m-0 text-white text-5xl">Todo</h2>
                </div>
                <div class="flex flex-wrap w-full md:justify-content-start justify-content-center border-round-3xl">
                    <div v-for="item in recompensas.data" class="lg:w-4 md:w-6 w-11 lg:px-5 md:px-4 px-2 pb-6">
                        <div class="bg-white block flex flex-column p-3 border-round-3xl flex-end">
                     
                            <div class="bg-fondo h-20rem mb-3 border-round-3xl">
                                <div class="h-full w-full bg-center bg-no-repeat flex justify-content-between bg-contain" :style="{ 'background-image': `url('${item.original_image}')` }">
                                    <div v-for="categoria in item.categorias">
                                        <div v-if="categoria.id == 1" class="bg-fondoOscuro mt-2 ms-2 p-1 w-6rem h-2 flex border-round-3xl justify-content-between align-items-center">
                                            <p class="text-black numerosProducto m-0 ps-2 font-normal">00:00</p>
                                            <img src="/images/iconos/watch.svg" class="h-2rem w-2rem justify-self-end" alt="">
                                        </div>
                                    </div>

                                    <div class="bg-principal mt-2 me-2 border-circle flex justify-content-center align-items-center" style="height: 2.5rem; width: 2.5rem;">
                                        <p class="text-white text-center text-xs" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">{{ "Nv." + item.nivel_desbloqueo }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-content-between">
                                <div>
                                    <p class="text-2xl text-black tituloProducto">{{ item.nombre.charAt(0).toUpperCase() + item.nombre.slice(1).toLowerCase() }}</p>
                                    <p class="text-black tituloProducto">{{ item.descripcion }}</p>
                                </div>
                                <div class="flex flex-column ">
                                    <div class="w-8rem h-3rem flex bg-fondo border-round-3xl justify-content-around align-items-center mb-2">
                                        <p class="text-black numerosProducto m-0 font-normal ps-4">{{ item.precio.toString().padStart(5, '0') }}</p>
                                        <img src="/images/iconos/bernatPoints.svg" class="h-2rem w-2rem justify-self-end" alt="">
                                    </div>
                                    <button class="buttonComprar w-8rem h-3rem flex bg-fondo border-round-3xl border-none justify-content-around align-items-center mb-2">
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
    </section>
    <app-footer></app-footer>
</template>

<script setup>
import AppFooter from '../../layouts/AppFooter.vue';
import { onMounted} from 'vue';
import usarRecompensas from "@/composables/recompensas";
import usarCategorias from "@/composables/categorias";

const {recompensas, getRecompensas} = usarRecompensas()
const { productosCategorias, getRecompensasCategorias } = usarCategorias()


onMounted(() => {
    getRecompensas();
    getRecompensasCategorias();
}); 

</script>

<style scoped>
    .tituloCategoria{
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.25);
    }

    .tituloProducto{
        font-family: Raleway;
    }

    .numerosProducto{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .buttonComprar{
        transition: 0.5s;   
    }

    .buttonComprar:hover{
        background-color: #145A79 !important;
        border: solid;
        color:  white !important; 
        transition: 0.5s;   
    }
</style>../../store../../store/niveles../../store/usuarios
