<template>
<div id="post-card" class="row justify-content-center">
    <div class="card col-12 my-3" style="width: 18rem;" v-for="post in posts" :key="post.id">
        <div class="d-flex justify-content-between align-items-center">

            <div class="card-body">
                <h2 class="card-title">{{ post.title }}</h2>
                <p class="card-text">{{ post.content }}</p>
            </div>

            <div>
                <router-link class="btn btn-primary" :to="{ name: 'single-post', params: { id: post.id } }">Info</router-link>
            </div>

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
</template>

<script>
export default {
name: 'PostCard',
props: ["posts", "getDate"]
}
</script>

<style>

</style>