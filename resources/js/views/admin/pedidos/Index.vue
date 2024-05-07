<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">  
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Historial de pedidos </h5>
                    </div>
                    
                    <!-- :rowsPerPageOptions="[5, 10, 20, 50]" -->
                    <DataTable :value="pedidosUser" paginator :rows="5" tableStyle="min-width: 50rem">

                        <template #empty> No tienes ninguna recompensa. </template>

                        <Column field="created_at" header="Fecha" sortable>
                            <template #body="{ data }">
                                {{ new Date(data.created_at).toLocaleString('es-ES', { year: 'numeric', month: '2-digit', day: '2-digit'    }) }}
                            </template>
                        </Column>

                        <Column field="imagen" header="Imagen">
                            <template #body="slotProps">
                                <img :src="slotProps.data.recompensas.media[0].original_url" class="shadow-4 image-table" />
                            </template>
                        </Column>

                        <Column field="recompensa.nombre" header="Recompensa" sortable>
                            <template #body="{ data }">
                                {{ data.recompensas.nombre }}
                            </template>
                        </Column>

                        <Column field="recompensa.precio" header="Puntos" sortable>
                            <template #body="{ data }">
                                {{ data.recompensas.precio }}
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
    import { userStore } from '@/store/authPinia';
    import usarPedidos from "@/composables/pedidos";

    const { user } = userStore()


    const { getPedidosUser, pedidosUser, recompensasUser } = usarPedidos()
    const { can } = useAbility()
    
    onMounted(() =>{
        getPedidosUser(user.id);
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
