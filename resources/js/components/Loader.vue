<template>
    <div id="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>

<script>
export default {
name: 'Loader',
}
</script>

<style scoped lang="scss">

#loader {

    position: fixed;    

    top: 0;
    left: 0;
    right: 0;
    bottom: 0;

    background-color:rgba(0,0,0,0.5);

    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1;

    }

.spinner-border {
    height: 100px;
    width: 100px;
}

</style>