<template>
  <section id="home">
      <PostsList />
  </section>
</template>

<script>
import PostsList from '../posts/PostsList.vue'

export default {
name: "Home",
components: {
    PostsList,
}
}
</script>

<style>

</style>