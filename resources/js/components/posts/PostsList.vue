<template>
<div class="container">
    <h1>Posts</h1>
    <Loader v-if="isLoading"/>


    <div v-else>
        <div v-if="posts.length">
            <PostCard :posts='posts' :getDate='getDate'/>
        </div>
        <p v-else>Non ci sono post</p>
    </div>

    <NavPage :pagination="pagination" @page-change="getPosts" />


</div>
</template>

<script>
import Loader from '../Loader.vue';
import NavPage from '../NavPage.vue';
import PostCard from './PostCard.vue';

export default {
name: "PostsList",
components: {
    Loader,
    NavPage,
    PostCard,
},

data() {
    return {
        posts: [],
        pagination: {},
        isLoading: false,
    };
},

methods: {
    getPosts(page = 1) {
        this.isLoading = true;
        axios.get('http://localhost:8000/api/posts?page=' + page).then((res) => {
            const {data, current_page, last_page} = res.data;

            this.posts = data;
            this.pagination = {
                currentPage: current_page,
                lastPage: last_page,
            }
        }).catch((err) => {
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