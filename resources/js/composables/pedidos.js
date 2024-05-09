import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import {userStore} from "@/store/authPinia"


export default function usarPedidos(){

    const user = userStore().vistaUser().value;
    const pedidos = ref([])
    const pedidosUser = ref([])
    const recompensasUser = ref([])
    const pedido = ref({
        id: '',
        usuario_id: '',
        recompensa_id: '',      
    })

    const router = useRouter()
    const swal = inject('$swal')

    const getPedidosUser = (id) => {
        axios.get('/api/getPedidosUser/' + id)
            .then(pedidos => {
                pedidosUser.value = pedidos.data;
            })
    }

    const canBuy = async (id_recompensa, puntos_recompensa) => {
        console.log("Recompensa:")
        console.log(puntos_recompensa)
        console.log("puntos:")
        console.log(user.puntos)

        if((user.puntos - puntos_recompensa) >= 0){
            storePedido(id_recompensa);
        }else{
            swal({
                icon: 'error',
                title: 'No tienes puntos suficientes'
            })
        }

    }

    const storePedido = async (id) => {

        var tieneRecompensa = false;

        axios.get('/api/pedidos')
            .then(response => {
            
                pedidos.value = response.data;
                pedidos.value.forEach(pedido => {
                    if (pedido.usuario_id == user.id && pedido.recompensa_id == id) {
                        tieneRecompensa = true;
                    }
                });

                if (tieneRecompensa == true) {
                    swal({
                        title: 'Ya tienes esta recompensa!',
                        text: 'Quieres volver a reclamarla?',
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Reclamar',
                        confirmButtonColor: '#12833f',
                        timer: 20000,
                        timerProgressBar: true,
                        reverseButtons: true
                    })
                        .then(result => {
                            if (result.isConfirmed) {
                                axios.get('/api/recompensas/getRecompensa/' + id)
                                    .then(recompensa => {

                                        const pedido = {
                                            recompensa_id: recompensa.data.data.id
                                        };

                                        axios.post('/api/pedidos', pedido)
                                            .then(response => {
                                                swal({
                                                    icon: 'success',
                                                    title: 'La recompensa ha sido reclamada con exito',
                                                    confirmButtonText: 'Continuar',
                                                    confirmButtonColor: '#12833f',
                                                })
                                            })
                                            .catch(error => {
                                                swal({
                                                    icon: 'error',
                                                    title: 'Error al reclamar la recompensa'
                                                })
                                            })
                                    })
                            }
                        })
                } else {
                    swal({
                        title: 'Confirmar compra',
                        text: 'No puedes revertir esta acción',
                        icon: 'question',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Confirmar',
                        confirmButtonColor: '#12833f',
                        timer: 20000,
                        timerProgressBar: true,
                        reverseButtons: true
                    })
                        .then(result => {
                            if (result.isConfirmed) {
                                axios.get('/api/recompensas/getRecompensa/' + id)
                                    .then(recompensa => {

                                        const pedido = {
                                            recompensa_id: recompensa.data.data.id
                                        };

                                        axios.post('/api/pedidos', pedido)
                                            .then(response => {
                                                swal({
                                                    icon: 'success',
                                                    title: 'La recompensa ha sido reclamada con exito',
                                                    confirmButtonText: 'Continuar',
                                                    confirmButtonColor: '#12833f',
                                                })
                                            })
                                            .catch(error => {
                                                swal({
                                                    icon: 'error',
                                                    title: 'Error al reclamar la recompensa'
                                                })
                                            })
                                    })
                            }
                        })
                }
            })
    }

    return {
        pedidos,
        pedido,
        pedidosUser,
        recompensasUser,
        canBuy,
        storePedido,
        getPedidosUser,
    }
}
