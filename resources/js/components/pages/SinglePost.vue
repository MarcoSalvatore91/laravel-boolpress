<template>
  <section id="single-post" class="container">
    <Loader v-if="isLoading && !post" />
    <PostCard v-else :post="post"/>
  </section>
</template>

<script>
import PostCard from '../posts/PostCard.vue';
import Loader from '../Loader.vue';

export default {
name: "SinglePost",
components: {
  Loader,
  PostCard,
},

data() {
  return {
    isLoading: false,
    posts: '',
  }
},

methods: {
  getPost(){
    this.isLoading = true;
    axios.get('http://localhost:8000/api/posts/' + this.$route.params.id).then(res => {
      this.post = res.data;
    }).catch(err => {
      console.error(err);
    }).then(() => {
      this.isLoading = false;
    })
  }
},

mounted() {
  this.getPost();
}

}
</script>

<style>

</style>