import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

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

        let serializedPost = new FormData()
        for (let item in user) {
            if (user.hasOwnProperty(item)) {
                serializedPost.append(item, user[item])
            }
        }

        console.log("SERIAL:")
        console.log(serializedPost);
        
        axios.post('/api/users', serializedPost,{
                headers: {
                    "content-type": "multipart/form-data"
                }
            })
            .then(response =>{
                router.push({ name: 'users.index' })
                    swal({
                        icon: 'success',
                        title: 'Usuario creado correctamente'
                    })
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
        })
        .then(response => {
            console.log(response)
            router.push({ name: 'users.index' })
            swal({
                icon: 'success',
                title: 'User editado correctamente'
            })
        })
        .catch(error => {
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
                            router.push({name: 'users.index'})
                            swal({
                                icon: 'success',
                                title: 'User deleted successfully'
                            })
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
        if(pts == 0){
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

                            swal({
                                icon: 'success',
                                title: 'Puntos añadidos correctamente'
                            })
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
                                console.log("Response:")
                                console.log(response.data.id)                                
                                console.log(response.data.experience)
                                console.log(response.data.puntos)

                                students.value.data = students.value.filter(student => {
                                    if (student.id == response.data.id) {
                                        student.experience = Math.round(response.data.experience);
                                        student.puntos = response.data.puntos;
                                    }
                                    return student;
                                });

                                swal({
                                    icon: 'success',
                                    title: 'Puntos añadidos correctamente'
                                })
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

    const substractPts = async (id, nombre) => {;
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
                            console.log("Response:")
                            console.log(response)
                            swal({
                                icon: 'success',
                                title: 'Puntos restados correctamente'
                            })
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
