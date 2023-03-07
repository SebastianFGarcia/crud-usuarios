<template>
    <main>
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <RouterLink :to="{ name: 'Users' }" class="nav-link active">Usuarios</RouterLink>
                    </li>
                </ul>
                </div>
            </div>
            </nav>
        <div class="container mt-3">
            <slot></slot>
        </div>
    </main>
</template>

<script setup>

</script>