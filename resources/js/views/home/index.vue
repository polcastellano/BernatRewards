<template>
    <section>
        <div id="caruselPrincipal" class="carousel slide carousel-fade p-0" data-bs-ride="carousel">
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
                        <div class="imgInfo d-lg-block d-none"
                            style="background-image: url('/images/pictures/imagenJuego.png'); "></div>
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
        <div class="flex lg:flex-row flex-column flex-column">
            <router-link to="/login" class="lg:w-4 w-full cuadradoInfo m-0 p-0">
                <div class="bg-principal h-full d-flex flex-column justify-content-center align-items-center p-4">
                    <img src="/images/iconos/login.svg" style="height: 13rem;" alt="">
                    <h2 class="lg:h-5">Iniciar Sesion</h2>
                    <p>Inicia sesion para poder empezar a acumular puntos!</p>
                </div>
            </router-link>

            <router-link to="/shop" class="lg:w-4 w-full cuadradoInfo m-0 p-0">
                <div class="bg-coins h-full d-flex flex-column justify-content-center align-items-center p-4">
                    <img src="/images/iconos/bernatPoints_white.svg" style="height: 13rem;" alt="">
                    <h2 class="lg:h-5">Compra</h2>
                    <p>Gasta tus puntos es ventajas o comodidades!</p>
                </div>
            </router-link>

            <router-link to="/moodle" class="lg:w-4 w-full cuadradoInfo m-0 p-0">
                <div class="bg-mejora h-full d-flex flex-column justify-content-center align-items-center p-4">
                    <img src="/images/iconos/mejora.svg" style="height: 13rem;" alt="">
                    <h2 class="lg:h-5">Mejora</h2>
                    <p>Aprende mientras compites con tus amigos!</p>
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
                <h2 class="text-principal">Como ganar puntos?</h2>
                <p>Participa activamente durante las clases, plantea preguntas que te ayuden a comprender mejor los
                    temas y esfuérzate en tus tareas y actividades. Tus profesores valorarán tu compromiso y dedicación
                    y te recompensarán con Bernat points, una moneda especial que podrás utilizar para obtener
                    recompensas exclusivas y especiales.</p>
                    <router-link to="/register">
                        <button class="bg-principal p-2 px-5 border-round-3xl">Registrate</button>
                    </router-link>
            </div>
        </div>
    </section>

    <section>
        <div class="w-full flex h-auto" style="height: 300px">
            <div class="lg:w-6 w-full lg:p-5 p-4">
                <h2 class="text-principal">Atento a las Subastas</h2>
                <p>
                    Mantente atento a las subastas temporales donde podrás usar tus puntos. Tus profesores te mantendrán
                    informado sobre cuándo se llevarán a cabo estas subastas especiales, dándote la oportunidad de
                    participar. Aprovecha esta oportunidad única para conseguir recompensas exclusivas con tus Bernat
                    points.
                </p>
                <router-link to="/shop">
                    <button class="bg-principal p-2 px-5 border-round-3xl">Subastas</button>
                </router-link>
            </div>
            <div class="lg:flex hidden seccionInfo2 w-6 h-6 border-round-xl border-noround-right d-flex align-items-center justify-content-center">
                <img src="/images/iconos/auction.svg" class="my-5 pt-5 " style="height: 15rem" alt="">
            </div>

        </div>
    </section>
    
    <app-footer></app-footer>
</template>

<script setup>
import AppFooter from '../../layouts/AppFooter.vue';
</script>

<style scoped>
section{
    margin-bottom: 3em;
}

h2{
    color: white;
    font-size: 45px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    text-align: left;
}

p{
    text-align: justify;
}

button{
    color: white; 
    border: none; 
    font-family: Raleway;
    font-weight: bold;
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
  transform: scale(1.1); 
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

</style>
