<template>
    <section>
        <div id="caruselPrincipal" class="carousel slide carousel-fade p-0" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="caruselI1 p-5 d-flex justify-content-around align-items-center" style="height: 35rem;">
                        <div class="txtInfo m-4 flex flex-column align-items-left">
                            <h2>{{ $t('what_is_BernatRewards_title')}}</h2>
                            <p>{{ $t('what_is_BernatRewards')}}</p>
                        </div>
                        <div class="imgInfo d-lg-block d-none"
                            style="background-image: url('/images/pictures/imagenJuego.png'); "></div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="caruselI2 p-5 d-flex justify-content-around align-items-center" style="height: 35rem;">
                        <div class="txtInfo m-4 flex flex-column align-items-left">
                            <h2>{{ $t('start_wining_now_title')}}</h2>
                            <p>{{ $t('start_wining_now')}}</p>
                        </div>
                        <div class="imgInfo d-lg-block d-none"
                            style="background-image: url('/images/pictures/imagenLogin.png'); "></div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="caruselI3 p-5 d-flex justify-content-around align-items-center" style="height: 35rem;">
                        <div class="txtInfo m-4 flex flex-column align-items-left">
                            <h2>{{ $t('competitive_learning_title')}}</h2>
                            <p>{{ $t('competitive_learning')}}</p>
                        </div>
                        <div class="imgInfo d-lg-block d-none"
                            style="background-image: url('/images/pictures/imagenCompeticion.png'); "></div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev lg:w-10rem" type="button" data-bs-target="#caruselPrincipal" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next lg:w-10rem" type="button" data-bs-target="#caruselPrincipal" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section>
        <div class="flex lg:flex-row flex-column seccionCuadradoInfo">
            <router-link to="/login" class="lg:w-4 w-full cuadradoInfo cuadradoInfoInicio m-0 p-0">
                <div class="bg-principal h-full d-flex flex lg:flex-column flex-row align-items-center justify-content-center p-4">
                    <div class="lg:h-13rem h-5rem lg:w-full flex justify-content-center">
                        <img src="/images/iconos/login.svg" class="h-full" alt="">
                    </div>
                    <div class="lg:w-full lg:py-4 lg:ps-0 ps-4">
                        <h2 class="lg:h-5 lg:mb-3 mb-0">{{ $t('login')}}</h2>
                        <p class="lg:block hidden">{{ $t('login_text')}}</p>
                    </div>
                </div>
            </router-link>

            <router-link to="/shop" class="lg:w-4 w-full cuadradoInfo m-0 p-0">
                <div class="bg-coins h-full d-flex flex lg:flex-column flex-row align-items-center justify-content-center p-4">
                    <div class="lg:h-13rem h-5rem lg:w-full flex justify-content-center">
                        <img src="/images/iconos/bernatPoints_white.svg" class="h-full" alt="">
                    </div>
                    <div class="lg:w-full lg:py-4 lg:ps-0 ps-4">
                        <h2 class="lg:h-5 lg:mb-3 mb-0">{{ $t('buy')}}</h2>
                        <p class="lg:block hidden">{{ $t('buy_text')}}</p>
                    </div>
                    
                </div>
            </router-link>

            <router-link to="/moodle" class="lg:w-4 w-full cuadradoInfo cuadradoInfoFinal m-0 p-0">
                <div class="bg-mejora h-full d-flex flex lg:flex-column flex-row align-items-center justify-content-center p-4">
                    <div class="lg:h-13rem h-5rem lg:w-full flex justify-content-center">
                        <img src="/images/iconos/mejora.svg" class="h-full" alt="">
                    </div>
                    <div class="lg:w-full lg:py-4 lg:ps-0 ps-4">
                        <h2 class="lg:h-5 lg:mb-3 mb-0">{{ $t('upgrade')}}</h2>
                        <p class="lg:block hidden">{{ $t('upgrade_text')}}</p>
                    </div>
                </div>
            </router-link>
        </div>
    </section>

    <section>
        <div class="w-full flex h-auto" style="height: 300px">
            <div
                class="lg:flex hidden seccionInfo1 w-6 h-6 border-round-xl border-noround-left d-flex align-items-center justify-content-center">
                <img src="/images/iconos/points.svg" class="my-5" style="height: 17rem" alt="">
            </div>
            <div class="lg:w-6 w-full lg:p-5 p-4">
                <h2 class="text-principal">{{ $t('how_to_earn_points')}}</h2>
                <p>{{ $t('how_to_earn_points_text')}}</p>
                <router-link to="/register">
                    <button class="standardButton bg-principal p-2 px-5 border-round-3xl">{{ $t('register')}}</button>
                </router-link>
            </div>
        </div>
    </section>

    <section>
        <div class="w-full flex h-auto" style="height: 300px">
            <div class="lg:w-6 w-full lg:p-5 p-4">
                <h2 class="text-principal">{{ $t('cauition_for_the_auctions')}}</h2>
                <p>{{  $t('cauition_for_the_auctions_text') }}</p>
                <router-link to="/shop">
                    <button class="standardButton bg-principal p-2 px-5 border-round-3xl">{{ $t('auction')}}</button>
                </router-link>
            </div>
            <div
                class="lg:flex hidden seccionInfo2 w-6 h-6 border-round-xl border-noround-right d-flex align-items-center justify-content-center">
                <img src="/images/iconos/auction.svg" class="my-5 py-3 " style="height: 15rem" alt="">
            </div>

        </div>
    </section>

    <app-footer></app-footer>
</template>

<script setup>
import AppFooter from '../../layouts/AppFooter.vue';
import { onMounted,} from 'vue';
import store from "../../../js/store/";
import {storeNiveles} from "../../../js/store/niveles";
import {storeUsuarios} from "../../../js/store/usuarios";
    
onMounted(() => {
    console.log(store.state.auth.user.id);
    if (store.state.auth.user.id != null) {
        let usuario = store.state.auth.user;
        storeNiveles().getNivelSiguiente(usuario.niveles.id);
        storeUsuarios().getUsuMedia(usuario.id);
        storeUsuarios().getUsuLogueado(usuario.id);
    }
});

</script>

<style scoped>
section{
    margin-bottom: 3em;
}

h2{
    color: white;
    font-size: 40px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    text-align: left;
}

p{
    text-align: justify;
}

.standardButton{
    color: white; 
    border: solid;
    border-color: transparent; 
    font-family: Raleway;
    font-weight: bold;
    transition: 0.5s;

}

.standardButton:hover{
    background-color: white !important;
    border: solid;
    color: #145A79 !important; 
    transition: 0.5s;
    
}

.txtInfo{
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
    background-image: linear-gradient(to bottom right, #9B52E0, #0793E3);
}

.caruselI2{
    background-image: linear-gradient(to bottom right, #108CD2, #51E0B9);
}

.caruselI3{
    background-image: linear-gradient(to bottom right, #10d24d, #b3e051);

}

.cuadradoInfo{
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

.cuadradoInfoInicio:hover {
    transform: scale(1.1) translateX(23px);
    cursor: pointer;
    z-index: 2;
    box-shadow: 0px 0px 10px black !important;
} 

.cuadradoInfoFinal:hover {
    transform: scale(1.1) translateX(-23px) ;
    cursor: pointer;
    z-index: 2;
    box-shadow: 0px 0px 10px black !important;
} 

.cuadradoInfo p{
    color: white;
}

.seccionInfo1{
    background-image: linear-gradient(to top right, #228213, #31BA1B);
}

.seccionInfo2{
    background-image: linear-gradient(to top left, #AA361D, #E19325);
}

@media (max-width: 991px) {
    .seccionCuadradoInfo{
        overflow: hidden;
    }

    .cuadradoInfo:hover {
        transform: scale(1.1);
        cursor: pointer;
        z-index: 2;
        box-shadow: 0px 0px 10px black !important;
    }

    .cuadradoInfoInicio:hover {
        transform: scale(1.1);
        cursor: pointer;
        z-index: 2;
        box-shadow: 0px 0px 10px black !important;
    }

    .cuadradoInfoFinal:hover {
        transform: scale(1.1);
        cursor: pointer;
        z-index: 2;
        box-shadow: 0px 0px 10px black !important;
    }
}
</style>
