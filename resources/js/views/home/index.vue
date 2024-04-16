<template>
    <section class="carusel ">
        <div id="caruselPrincipal" class="w-100 carousel slide carousel-fade p-0" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="caruselI1 d-flex justify-content-around align-items-center">
                        <div class="txtInfo ms-4 d-flex flex-column align-items-left">
                            <h2>Que es Bernat Rewards?</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit cras donec enim vulputate tempor
                                nascetur, magna mus interdum netus blandit bibendum nunc curae porta auctor himenaeos
                                mauris. Justo fusce habitasse massa nisi purus libero et, aenean suspe ndisse fringilla
                                faucibus tempus fermentum.</p>
                        </div>
                        <div class="imgInfo d-lg-block d-none" style="background-image: url('/images/pictures/imagenJuego.png'); "></div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="caruselI2 d-flex justify-content-around align-items-center">
                        <div class="txtInfo ms-4 d-flex flex-column align-items-left">
                            <h2>Empieza a ganar ya!</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit cras donec enim vulputate tempor
                                nascetur, magna mus interdum netus blandit bibendum nunc curae porta auctor himenaeos
                                mauris. Justo fusce habitasse massa nisi purus libero et, aenean suspe ndisse fringilla
                                faucibus tempus fermentum.</p>
                        </div>
                        <div class="imgInfo d-lg-block d-none"
                            style="background-image: url('/images/pictures/imagenLogin.png'); "></div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="caruselI3 d-flex justify-content-around align-items-center">
                        <div class="txtInfo ms-4 d-flex flex-column align-items-left">
                            <h2>Aprendizaje competitivo</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit cras donec enim vulputate tempor
                                nascetur, magna mus interdum netus blandit bibendum nunc curae porta auctor himenaeos
                                mauris. Justo fusce habitasse massa nisi purus libero et, aenean suspe ndisse fringilla
                                faucibus tempus fermentum.</p>
                        </div>
                        <div class="imgInfo d-lg-block d-none"
                            style="background-image: url('/images/pictures/imagenCompeticion.png'); "></div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#caruselPrincipal" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#caruselPrincipal" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section>
        <div class="w-100 d-flex">
            <router-link to="/login" class="cuadradoInfo p-0">
            <div class="bg-principal d-flex flex-column justify-content-center align-items-center p-4">
                <img src="/images/iconos/login.svg" style="height: 13rem;" alt="">
                <h2>Iniciar Sesion</h2>
                <p>Inicia sesion para poder empezar a acumular puntos!</p>
            </div>
        </router-link>
        
        <router-link to="/shop" class="cuadradoInfo p-0">
            <div class="bg-coins d-flex flex-column justify-content-center align-items-center p-4">
                <img src="/images/iconos/bernatPoints_white.svg" style="height: 13rem;" alt="">
                <h2>Compra</h2>
                <p>Gasta tus puntos es ventajas o comodidades!</p>
            </div>
        </router-link>

        <router-link to="/moodle" class="cuadradoInfo p-0">
            <div class="bg-mejora d-flex flex-column justify-content-center align-items-center p-4">
                <img src="/images/iconos/mejora.svg" style="height: 13rem;" alt="">
                <h2>Mejora</h2>
                <p>Aprende mientras compites con tus amigos!</p>
            </div>
        </router-link>
        </div>
        
    </section>


    <div class="min-h-screen bg-white dark:bg-gray-900">
        <div class="col-12 bg-principal">
            <h1>{{ $t('welcome_starter_title') }}</h1>
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

onMounted(() => {
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
    width: 33.33%;
    padding: 50px;
    transition: transform .5s;
    margin: 0 auto;
}

.cuadradoInfo:hover {
  transform: scale(1.1); 
  cursor: pointer;
  z-index: 2;
  box-shadow: 0px 0px 10px black !important;
} 

.cuadradoInfo p{
    color: white;
}

</style>
