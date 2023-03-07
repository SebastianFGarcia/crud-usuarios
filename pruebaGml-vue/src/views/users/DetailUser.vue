<template>

    <div class="row" v-if="userStore.user">
        <h2>{{ userStore.user.name}} {{ userStore.user.last_name }}</h2>
        <div class="col-md-6 col-lg-4">
            <p>Cédula: {{ userStore.user.nit }}</p>
        </div>
        <div class="col-md-6 col-lg-4">
            <p>Correo: {{ userStore.user.email }}</p>
        </div>
        <div class="col-md-6 col-lg-4">
            <p>Teléfono: {{ userStore.user.phone }}</p>
        </div>
        <div class="col-md-6 col-lg-4">
            <p>Dirección: {{ userStore.user.address }}</p>
        </div>
        <div class="col-md-6 col-lg-4">
            <p>País: {{ userStore.user.country }}</p>
        </div>
        <div class="col-md-6 col-lg-4">
            <p>Categoría: {{ userStore.user.category.name }}</p>
        </div>

        <div class="col-md-6 col-lg-4">
            <p>Es administrador: <span v-if="userStore.user.is_admin">Si</span><span v-else>No</span> </p>
        </div>



    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useUserStore } from '@/stores/userStore'
import { useRoute } from 'vue-router'

const userStore = useUserStore()
const route = useRoute()

onMounted(() => {
    userStore.getUser(route.params.id);
})
</script>

<style>

</style>