<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Todas las recompensas</h5>
                        <div>
                            <router-link :to="{name: 'recompensas.create'}" class="btn btn-success">Nueva recompensa</router-link>
                        </div>
                    </div>
                    <table class="table table-hover table-sm">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th width="50" class="text-center">#</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Nivel desbloqueo</th>
                                <th class="text-center" width="200">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(recompensa, index) in recompensas">
                                <td class="text-center">{{recompensa.id}}</td>
                                <td>{{recompensa.nombre}}</td>
                                <td>{{recompensa.descripcion}}</td>
                                <td>{{recompensa.precio}}</td>
                                <th>{{recompensa.nivel_desbloqueo}}</th>
                                <td class="text-center">
                                    <router-link :to="{name: 'recompensas.update' , params: {id: recompensa.id}}" class="btn btn-warning mr-1">Edit</router-link>
                                    <button class="btn btn-danger" @click="deleteRecompensa(recompensa.id, index)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
    import axios from "axios";
    import {ref, inject, onMounted} from "vue";
    const recompensas = ref();
    const swal  = inject('$swal')
    onMounted(() =>{
        // console.log('Mi vista')
        axios.get('/api/recompensas')
        .then(response => {
            recompensas.value = response.data;
        })
    });

    const deleteRecompensa = (id, index) =>{
        axios.delete('/api/recompensas/'+id)
        .then(response =>{
            recompensas.value.splice(index, 1);
            swal({
                icon: 'success',
                title: 'Recompensa Eliminada Correctamente',
            })
        })
        .catch(error => {
            swal({
                icon: 'error',
                title: 'No se ha podido eliminar la recompensa',
            })
        });
    }
</script>


<style>


</style>