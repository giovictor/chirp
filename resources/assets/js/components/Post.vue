<template>
    <div class="panel-body">
        <p class="author">{{post.user.name}}</p>
        <p class="post">{{post.post}}</p>
        <button class="btn btn-danger btn-sm" v-if="user.id===post.user_id" @click="$emit('deletePost', post.id)">Delete</button>
    </div>
</template>

<script>
    export default {
        props:['post','user']
    }
</script>

<style>

</style>