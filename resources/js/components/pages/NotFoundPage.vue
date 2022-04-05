<template>
    <div id="NotFoundPage" class="text-center mt-5">
        <h1 class="text-muted">404 || PAGINA NON TROVATA</h1>
        <button class="btn btn-primary" @click="$router.back()">Indietro</button>
    </div>
</template>

<script>
export default {
name: 'NotFoundPage'
}
</script>

<style>

</style>