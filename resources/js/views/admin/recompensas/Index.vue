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
                    <DataTable :value="recompensas.data" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" tableStyle="min-width: 50rem">
                        
                        <template #empty> No se ha encontrado ninguna recompensa. </template>

                        <Column field="id" header="ID" sortable>
                            <template #body="{ data }">
                                {{ data.id }}
                            </template>
                        </Column>

                        <Column field="imagen" header="Imagen">
                            <template #body="slotProps">
                                <img :src="`${slotProps.data.original_image}`" :alt="slotProps.data.original_image"
                                    class="shadow-4 image-table" />
                            </template>
                        </Column>

                        <Column field="nombre" header="Nombre" sortable style="width: 25%"></Column>

                        <Column header="Categorías" style="width: 25%" filterField="categorias.nombre"
                            sortField="categorias.nombre">
                            <template #body="slotProps">
                                <span v-for="cat in slotProps.data.categorias" class="ms-2 badge  bg-secondary bg-gradient">
                                    {{ cat.nombre }}
                                </span>
                            </template>
                        </Column>

                        <Column style="width:100px;" class="pe-0 me-0">
                            <template #body="slotProps">

                                <router-link v-if="can('recompensa-edit')"
                                    :to="{ name: 'recompensas.update', params: { id: slotProps.data.id } }" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path fill="#ffffff"
                                            d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z" />
                                    </svg>
                                </router-link>

                                <span v-if="can('recompensa-delete')" @click.prevent="deleteRecompensa(slotProps.data.id)"
                                    class="ms-2 me-0 btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path fill="#ffffff"
                                            d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                    </svg>
                                </span>

                            </template>
                        </Column>

                    </DataTable>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
    import usarRecompensas from "@/composables/recompensas";
    import { useAbility } from '@casl/vue'
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import {onMounted} from "vue";

    const {recompensas, getRecompensas, deleteRecompensa} = usarRecompensas()
    const { can } = useAbility()

    onMounted(() =>{
        getRecompensas()
    });
</script>


<style>
.image-table {
    height: 3rem;
    width: 4rem;
    object-fit: cover;
}

.btn {
    display: inline-block;
    padding: 6px 12px !important;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}

.btn-primary {
    color: #fff !important;
    background: #428bca !important;
    border-color: #357ebd !important;
    box-shadow: none !important;
}

.btn-danger {
    color: #fff !important;
    background: #d9534f !important;
    border-color: #d9534f !important;
    box-shadow: none !important;
}

.btn-secondary {
    color: #fff !important;
    background: #ADB5BD !important;
    border-color: #ADB5BD !important;
    box-shadow: none !important;
}

.btn-success {
    color: #fff !important;
    background: #479F76 !important;
    border-color: #479F76 !important;
    box-shadow: none !important;
}

.btn-warning {
    color: #fff !important;
    background: #FFDA6A !important;
    border-color: #FFDA6A !important;
    box-shadow: none !important;
}

.mymodal {
    position: fixed;
    z-index: 999;
    top: 20%;
    left: 50%;
    width: 300px;
    margin-left: -150px;
}</style>
