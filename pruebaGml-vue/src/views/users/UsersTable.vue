<template>
    <div class="d-flex justify-content-between align-items-center">
        <h1>Usuarios</h1>
        <div>
            <input type="text" class="form-control" placeholder="Buscar" v-model="search" @keyup="getSearchedUsers">
        </div>
        <div>
            <router-link :to="{ name: 'CreateUser' } " class="btn btn-success">Crear</router-link>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Pais</th>
                    <th>Categoria</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in userStore.users.data" :key="user.id">
                    <td>{{ user.nit }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.last_name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.country }}</td>
                    <td>{{ user.category.name }}</td>

                    <td>
                        <router-link class="btn btn-secondary btn-sm me-2" :to="{ name: 'EditUser', params: { id: user.id } }">Editar</router-link>
                        <button @click="userStore.deleteUser(user.id)" class="btn btn-danger btn-sm me-2">Eliminar</button>
                        <router-link class="btn btn-primary btn-sm" :to="{ name: 'DetailUser', params: { id: user.id } }">Ver</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <Pagination :last_page="userStore.users.last_page" :current_page="userStore.users.current_page" :links="userStore.users.links" :funtion_page="userStore.getUserPage" v-if="userStore.users.data"/>
</template>

<script setup>
import { useUserStore } from '@/stores/userStore'
import { onMounted, ref } from 'vue'
import Pagination from '@/components/Pagination.vue'

const userStore = useUserStore()

onMounted(() => {
    userStore.getUsers()
})

const search = ref('')

function getSearchedUsers() {
    if (search.value.length >= 3) {
         userStore.getSearchedUsers(search.value)
    } else {
        userStore.getUsers()
    }
}
</script>
