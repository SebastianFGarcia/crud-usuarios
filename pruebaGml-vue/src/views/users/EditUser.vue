<template>
  <h1>Editar usuario</h1>
    <form class="row g-3" @submit.prevent="userStore.updateUser(form)">
        <div class="col-md-4">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" v-model="form.name" v-bind:class="{'is-invalid': userStore.errors.name}">
            <div class="invalid-feedback" v-if="userStore.errors.name">
                {{userStore.errors.name[0]}}
            </div>
        </div>
        <div class="col-md-4">
            <label for="last_name" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="last_name" v-model="form.last_name" v-bind:class="{'is-invalid': userStore.errors.last_name}">
            <div class="invalid-feedback" v-if="userStore.errors.last_name">
                {{userStore.errors.last_name[0]}}
            </div>
        </div>
        <div class="col-md-4">
            <label for="nit" class="form-label">Cedula</label>
            <input type="text" class="form-control" id="nit" v-model="form.nit" v-bind:class="{'is-invalid': userStore.errors.nit}">
            <div class="invalid-feedback" v-if="userStore.errors.nit">
                {{userStore.errors.nit[0]}}
            </div>
        </div>
        <div class="col-md-4">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" v-model="form.email" v-bind:class="{'is-invalid': userStore.errors.email}">
            <div class="invalid-feedback" v-if="userStore.errors.email">
                {{userStore.errors.email[0]}}
            </div>
        </div>
        <div class="col-md-4">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="phone" v-model="form.phone" v-bind:class="{'is-invalid': userStore.errors.phone}">
            <div class="invalid-feedback" v-if="userStore.errors.phone">
                {{userStore.errors.phone[0]}}
            </div>
        </div>
        <div class="col-md-4">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="address" v-model="form.address" v-bind:class="{'is-invalid': userStore.errors.address}">
            <div class="invalid-feedback" v-if="userStore.errors.address">
                {{userStore.errors.address[0]}}
            </div>
        </div>
        <div class="col-md-4">
            <label for="country" class="form-label">País</label>
            <select class="form-select" id="country" v-model="form.country" v-bind:class="{'is-invalid': userStore.errors.country}">
                <option value="">Seleccione un país</option>
                <option v-for="country in userStore.countries">{{country}}</option>
            </select>
            <div class="invalid-feedback" v-if="userStore.errors.country">
                {{userStore.errors.country[0]}}
            </div>
        </div>
        <div class="col-md-4">
            <label for="category_id" class="form-label">Categoría</label>
            <select class="form-select" id="category_id" v-model="form.category_id" v-bind:class="{'is-invalid': userStore.errors.category_id}">
                <option value="">Seleccione una categoría</option>
                <option v-for="category in userStore.categories" :value="category.id">{{category.name}}</option>
            </select>
            <div class="invalid-feedback" v-if="userStore.errors.category_id">
                {{userStore.errors.category_id[0]}}
            </div>
        </div>

        <div class="col-md-4">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" v-model="form.password" v-bind:class="{'is-invalid': userStore.errors.password}">
            <div class="invalid-feedback" v-if="userStore.errors.password">
                {{userStore.errors.password[0]}}
            </div>
        </div>
        <div class="col-md-4">
            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" v-model="form.password_confirmation" v-bind:class="{'is-invalid': userStore.errors.password_confirmation}">
            <div class="invalid-feedback" v-if="userStore.errors.password_confirmation">
                {{userStore.errors.password_confirmation[0]}}
            </div>
        </div>

        <div class="col-md-4 d-flex align-items-center g-md-5">
            <input type="checkbox" class="form-check-input" id="is_admin" v-model="form.is_admin">
            <label for="is_admin" class="form-check-label">Es Administrador</label>
        </div>

        
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Enviar</button>
        </div>
    </form>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useUserStore } from '@/stores/userStore'
import { useRoute } from 'vue-router'

const userStore = useUserStore()
const route = useRoute()

onMounted(() => {
    userStore.getCountries();
    userStore.getCategories();
    getUser(route.params.id);
    
})

async function  getUser(id) {
    await userStore.getUser(route.params.id);
    form.value = {
        'id': userStore.user.id,
        'name': userStore.user.name,
        'last_name': userStore.user.last_name,
        'email': userStore.user.email,
        'phone': userStore.user.phone,
        'address': userStore.user.address,
        'country': userStore.user.country,
        'nit': userStore.user.nit,
        'category_id': userStore.user.category_id,
    }

    if (userStore.user.is_admin) {
        form.value.is_admin = true;
    } else {
        form.value.is_admin = false;
    }
}

const form = ref({
    'name': '',
    'last_name': '',
    'email': '',
    'phone': '',
    'address': '',
    'country': '',
    'nit': '',
    'category_id': '',
    'password': '',
    'password_confirmation': '',
    'is_admin': false,
})
</script>
