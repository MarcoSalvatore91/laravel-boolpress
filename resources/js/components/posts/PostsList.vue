<template>
<div class="container">
    <h1>Posts</h1>
    <Loader v-if="isLoading"/>


    <div v-else>
        <div v-if="posts.length" class="row justify-content-center">
            <div class="card col-12 my-3" style="width: 18rem;" v-for="post in posts" :key="post.id">
                <div class="card-body">
                    <h2 class="card-title">{{ post.title }}</h2>
                    <p class="card-text">{{ post.content }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Creato il: </strong>{{ post.created_at }}</li>
                    <li class="list-group-item"><strong>Modificato il: </strong>{{ post.updated_at }}</li>
                </ul>
            </div>
        </div>
        <p v-else>Non ci sono post</p>
    </div>

</div>
</template>

<script>
import Loader from '../Loader.vue';

export default {
name: "PostsList",
components: {
    Loader,
},

data() {
    return {
        posts: [],
        isLoading: false,
    };
},

methods: {
    getPosts() {
        this.isLoading = true;
        axios.get('http://localhost:8000/api/posts').then(res => {
            this.posts = res.data;
        }).catch(err => {
             console.error(err)
        }).then(() => {
            this.isLoading = false;
        });
    },
},
mounted() {
    this.getPosts();
}
};
</script>

<style>

</style>