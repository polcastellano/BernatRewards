import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import { useToast } from "primevue/usetoast";

export default function useUsers() {
    const users = ref([])
    const students = ref([])
    const user = ref({
        name: '',
        email: '',
        password: '',
        roles: '',
        imagen: '',
        puntos: '',
        experience: ''
    })
    const toast = useToast();


    const router = useRouter()
    const validationErrors = ref({})
    const cargando = ref(false)
    const swal = inject('$swal')

    const getUsers = async (
        page = 1,
        search_id = '',
        search_title = '',
        search_global = '',
        order_column = 'created_at',
        order_direction = 'desc'
    ) => {
        axios.get('/api/users?page=' + page +
            '&search_id=' + search_id +
            '&search_title=' + search_title +
            '&search_global=' + search_global +
            '&order_column=' + order_column +
            '&order_direction=' + order_direction)
            .then(response => {
                users.value = response.data;
            })
    }

    const getUser = async (id) => {
        axios.get('/api/users/' + id)
            .then(response => {
                user.value = response.data.data;
            })
    }

    const getStudents = async () => {
        axios.get('/api/getStudents')
            .then(response => {
                students.value = response.data;
            })
    }

    const storeUser = async (user) => {
        console.log("USER:");
        console.log(user);

        if (cargando.value) return;

        cargando.value = true
        validationErrors.value = {}

        let serializedUser = new FormData()
        for (let item in user) {
            if (user.hasOwnProperty(item)) {
                serializedUser.append(item, user[item])
            }
        }

        console.log("SERIAL:")
        console.log(serializedUser);

        axios.post('/api/users', serializedUser, {
            headers: {
                "content-type": "multipart/form-data"
            }
        })
            .then(response => {
                toast.add({ severity: 'success', summary: 'Usuario creado', detail: 'Usuario creado correctamente', life: 1500, closable: false });
                // Espera un momento antes de redirigir
                setTimeout(() => {
                    // router.push({ name: 'users.index' });
                }, 1500); // 1500 ms para asegurar que el toast desaparezca antes de redirigir
            })
            .catch(error => {
                swal({
                    icon: 'error',
                    title: 'Error al crear el usuario'
                })
            })
            .finally(() => cargando.value = false)


    }

    const updateUser = async (user) => {
        if (cargando.value) return;

        cargando.value = true


        axios.post('/api/users/update/' + user.id, user, {
            headers: {
                "content-type": "multipart/form-data"
            }
            }).then(response => {
                toast.add({ severity: 'info', summary: 'User editado', detail: 'User editado correctamente', life: 1500, closable: false });
                // Espera un momento antes de redirigir
                setTimeout(() => {
                    router.push({ name: 'users.index' });
                }, 1500); // 1500 ms para asegurar que el toast desaparezca antes de redirigir

            }).catch(error => {
                console.log(error)
                swal({
                    icon: 'error',
                    title: 'User editado incorrectamente'
                })
            })
            .finally(() => cargando.value = false)
    }

    const deleteUser = async (id) => {
        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this action!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#ef4444',
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true
        })
            .then(result => {
                if (result.isConfirmed) {
                    axios.delete('/api/users/' + id)
                        .then(response => {
                            getUsers()
                            toast.add({ severity: 'info', summary: 'User borrado', detail: 'User borrado correctamente', life: 1500, closable: false });
                            // Espera un momento antes de redirigir
                            setTimeout(() => {
                                router.push({ name: 'users.index' });
                            }, 1500); // 1500 ms para asegurar que el toast desaparezca antes de redirigir
                        })
                        .catch(error => {
                            swal({
                                icon: 'error',
                                title: 'Something went wrong'
                            })
                        })
                }
            })
    }


    const addPts = async (id, nombre, pts) => {
        if (pts == 0) {
            swal({
                title: "Cuantos puntos quieres sumar a " + nombre + "?",
                input: "number",
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confirmar',
                confirmButtonColor: '#428BCA',
                timer: 20000,
                timerProgressBar: true,
                reverseButtons: true,
                inputAttributes: {
                    min: 0
                },
            }).then(result => {
                if (result.isConfirmed) {

                    pts = result.value;

                    axios.post('/api/users/updatePts/' + id, {
                        puntos: pts,
                    })
                        .then(response => {
                            console.log("Response:")
                            console.log(response.data.id)
                            console.log(response.data.experience)
                            console.log(response.data.puntos)

                            toast.add({ severity: 'success', summary: 'Puntos añadidos', detail: 'Puntos añadidos correctamente', life: 3050, closable: false });

                        })
                        .catch(error => {
                            console.log(error)
                            swal({
                                icon: 'error',
                                title: 'Error al añadir puntos'
                            })
                        })
                }
            })
        } else {
            swal({
                title: 'Confirmar accion',
                text: 'Seguro que quieres sumarle ' + pts + 'pts al usuario: ' + nombre + '?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confirmar',
                confirmButtonColor: '#428BCA',
                timer: 20000,
                timerProgressBar: true,
                reverseButtons: true
            })
                .then(result => {
                    if (result.isConfirmed) {

                        axios.post('/api/users/updatePts/' + id, {
                            puntos: pts,
                        })
                            .then(response => {

                                students.value.data = students.value.filter(student => {
                                    if (student.id == response.data.id) {
                                        student.experience = Math.round(response.data.experience);
                                        student.puntos = response.data.puntos;
                                    }
                                    return student;
                                });

                                toast.add({ severity: 'success', summary: 'Puntos añadidos', detail: 'Puntos añadidos correctamente', life: 3050, closable: false });

                            })
                            .catch(error => {
                                console.log(error)
                                swal({
                                    icon: 'error',
                                    title: 'Error al añadir puntos'
                                })
                            })
                    }
                })
        }


    }

    const substractPts = async (id, nombre) => {
        ;
        swal({
            title: "Cuantos puntos quieres restarle a " + nombre + "?",
            input: "number",
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar',
            confirmButtonColor: '#428BCA',
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true,
            inputAttributes: {
                min: 0
            },
        }).then(result => {
            if (result.isConfirmed) {
                const pts = (result.value * -1);

                axios.post('/api/users/removePts/' + id, {
                    puntos: pts,
                })
                    .then(response => {
                        toast.add({ severity: 'info', summary: 'Puntos restados', detail: 'Puntos restados correctamente', life: 3050, closable: false });

                    })
                    .catch(error => {
                        console.log(error)
                        swal({
                            icon: 'error',
                            title: 'Error al restar puntos'
                        })
                    })
            }
        })
    }



    return {
        users,
        user,
        students,
        getUsers,
        getUser,
        getStudents,
        storeUser,
        updateUser,
        deleteUser,
        addPts,
        substractPts,
        validationErrors,
        cargando
    }
}
