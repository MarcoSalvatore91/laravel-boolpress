<template>
  <nav>
        <ul class="pagination">
            <li @click="$emit('page-change', pagination.currentPage - 1)" role="button" class="page-item" v-if="pagination.currentPage > 1">
                <span class="page-link">Previous</span>
            </li>
            <li @click="$emit('page-change', page)" :class="{ active:page === pagination.currentPage }" role="button" v-for="page in pagination.lastPage" :key="page" class="page-item">
                <span class="page-link">{{ page }}</span>
            </li>
            <li @click="$emit('page-change', pagination.currentPage + 1)" role="button" class="page-item" v-if="pagination.lastPage > pagination.currentPage">
                <span class="page-link">Next</span>
            </li>
        </ul>
  </nav>
</template>

<script>
export default {
name: 'NavPage',
props: ["pagination"]
}
</script>

<style>

</style>