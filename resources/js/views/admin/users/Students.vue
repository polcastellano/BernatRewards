<template>
    <div class="row justify-content-center my-2">
        <div class="col-md-12">
            <div class="card border-0">
                <div class="card-header bg-transparent">
                    <h5 class="float-start">{{ $t('students') }}</h5>
                </div>
                <div class="card-body shadow-sm">
                    <div class="mb-4">
                        <input v-model="search_global" type="text" placeholder="Search..."
                               class="form-control w-25">
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <input v-model="search_id" type="text"
                                           class="inline-block mt-1 form-control"
                                           placeholder="Filter by ID">
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <input v-model="search_title" type="text"
                                           class="inline-block mt-1 form-control"
                                           placeholder="Filter by Title">
                                </th>
                                <th class="px-6 py-3 text-start"></th>
                                <th class="px-6 py-3 text-start"></th>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 text-start">
                                    <div class="flex flex-row w-7rem"
                                         @click="updateOrdering('id')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'id' }">
                                            ID
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'id',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'id',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'id',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'id',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row w-10rem"
                                         @click="updateOrdering('title')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'title' }">
                                             {{$t('name')}}
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'title',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'title',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'title',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'title',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th> 
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    {{$t('experience')}}
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    {{$t('points')}}
                                </th>                               
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    {{$t('quick_actions')}}
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    {{$t('actions')}}
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="student in students" :key="student.id">
                                <td class="px-6 py-4 text-sm">
                                    {{ student.id }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ student.name }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ student.experience }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ student.puntos }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="d-flex">     
                                        <a href="#"  @click.prevent="addPts(student.id, student.name, 25)" class="ms-2 me-0 btn btn-primary">
                                            <p>+25Pts</p>
                                        </a>
                                        <a href="#"  @click.prevent="addPts(student.id,student.name, 50)" class="ms-2 me-0 btn btn-primary">
                                            <p>+50Pts</p>
                                        </a>
                                        <a href="#"  @click.prevent="addPts(student.id, student.name, 100)" class="ms-2 me-0 btn btn-primary">
                                            <p>+100Pts</p>
                                        </a>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="d-flex">
                                        <a href="#"  @click.prevent="addPts(student.id, student.name, 0)" class="ms-2 me-0 btn btn-primary">
                                            <p>{{$t('addPts')}}</p>
                                        </a>
                                        <a href="#"  @click.prevent="substractPts(student.id, student.name)"
                                            class="ms-2 me-0 btn btn-danger">
                                            <p>{{$t('remPts')}}</p>
                                        </a>
                                    </div>
                                    
                                </td>
                                
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted, watch} from "vue";
import useUsers from "../../../composables/users";
import {useAbility} from '@casl/vue'
import * as yup from 'yup';
import { es } from 'yup-locales';
import { setLocale } from 'yup';
import { userStore } from '@/store/authPinia';

const { user } = userStore()

    setLocale(es);

const search_id = ref('')
const search_title = ref('')
const search_global = ref('')
const orderColumn = ref('created_at')
const orderDirection = ref('desc')
const {students, getStudents, addPts, substractPts} = useUsers()
const {can} = useAbility()

onMounted(() => {
    getStudents()
})



const updateOrdering = (column) => {
    orderColumn.value = column;
    orderDirection.value = (orderDirection.value === 'asc') ? 'desc' : 'asc';
}

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
}
</style>

