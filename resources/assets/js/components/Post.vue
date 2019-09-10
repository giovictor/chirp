<template>
    <div class="panel-body">
        <button class="btn btn-link btn-sm deletebutton" v-if="authUser.id===post.user_id" @click="$emit('deletePost', post.id)" title="Delete your post.">x</button>
        <p class="author"><a :href="userProfileLink">{{author}}</a><span class="date"> wrote on {{post.created_at}}</span></p>
        <p class="post">{{post.post}}</p>
    </div>
</template>

<script>
    export default {
        props:['post','authUser'],
        data() {
            return {
                baseURL:window.baseURL
            }
        },
        computed:{
            author() {
                if(this.authUser.name===this.post.user.name) {
                    return 'You'
                } else {
                    return this.post.user.name
                }
            },
            userProfileLink() {
                return `${this.baseURL}/user/${this.post.user_id}`
            }
        }
    }
</script>

<style scoped lang="scss">
    .author {
        font-size:15px;
        font-weight:700;
        color:#000000;
    }

    .post {
        font-size:14px;
        word-wrap:break-word;
    }

    .date {
        font-weight:400;
        color:#636b6f;
    }

    .deletebutton {
        float:right;
        cursor:pointer;
        color:#000000;

        &:hover {
            text-decoration: none;
        }
    }
</style>