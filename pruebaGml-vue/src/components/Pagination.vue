<template>
    <nav aria-label="Page navigation" v-if="last_page!=1">
        <ul class="pagination justify-content-center">
            <li class="page-item" v-for="page in links" v-bind:class="{ 'disabled':  page.url === null , 'active':  current_page == page.label}" v-bind:role="page.url != null ? 'button' : null">
                <a class="page-link" @click="this.funtion_page(page.url)" v-html="page.label"></a>
            </li>
        </ul>
    </nav>
</template>

<script setup>
    const props = defineProps({
        last_page: {
            type: Number,
            required: true
        },
        current_page: {
            type: Number,
            required: true
        },
        links: {
            type: Array,
            required: true
        },
        funtion_page: {
            type: Function,
            required: true
        }

    })

</script>

<style>

</style>