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
                    <li class="list-group-item"><strong>Creato il: </strong>{{ getDate(post.created_at) }}</li>
                    <li class="list-group-item"><strong>Modificato il: </strong>{{ getDate(post.updated_at) }}</li>
                </ul>
                <div class="bg-grey d-flex justify-content-between align-items-center">
                    <div>
                        <span v-for="tag in post.tags" :key="tag.id" class="badge m-2" :style="`background-color: ${tag.color}`">{{ tag.label }}</span>
                    </div>
                    <div class="m-3" :class="`badge badge-pill badge-${post.category.color}`">
                        {{ post.category.label }}
                    </div>
                </div>
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
            this.posts = res.data.data;
        }).catch(err => {
             console.error(err)
        }).then(() => {
            this.isLoading = false;
        });
    },

    getDate(date) {
        const postDate = new Date(date);
        const day = postDate.getDate();
        const month = postDate.getMonth() + 1;
        const year = postDate.getFullYear();

        const hours = postDate.getHours();
        const minutes = postDate.getMinutes();
        const seconds = postDate.getSeconds();

        return `${day}/${month}/${year}  ${hours}:${minutes}:${seconds}`;
    }
},
mounted() {
    this.getPosts();
}
};
</script>

<style scoped lang="scss">

.bg-grey {
    background-color: grey;
}

</style>