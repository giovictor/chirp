<template>
    <div class="posts">
        <div class="sharePost">
            <form class="form" @submit.prevent="sharePost">
                <div class="form-group">
                    <label>Hey wanna share something cool?</label>
                    <textarea class="postTextArea form-control" v-model="post" @keyup="decreaseCharacterLimit"></textarea>
                    <div class="sharePostBottomSection">
                        <button type="submit" class="btn btn-primary btn-sm chirpBtn">Chirp</button>
                        <p class="postCharacterLimit">{{limit}}</p>
                    </div>
                </div>
            </form>
        </div>

        <div class="postsList">
            <p class="latestChirpsText">Latest chirps from random cool people</p>
            <div class="panel panel-default" v-for="post in posts">
                <div class="panel-body">
                    <p class="author">{{post.user.name}} wrote {{post.created_at}}</p>
                    <p class="post">{{post.post}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts:[],
                post:'',
                limit:200
            }
        },
        mounted() {
            this.listPosts()
        },
        methods:{
            decreaseCharacterLimit() {
                this.limit = 200 - this.post.length
            },
            sharePost() {
                axios.post('api/posts', {post:this.post})
                .then(response => console.log(response.data))
                .catch(error => console.log(error))
            },
            listPosts() {
                axios.get('api/posts')
                .then(response => this.posts = response.data)
                .catch(error => console.log(error))
            }
        }

    }
</script>

<style lang="scss" scoped>
    .posts {
        display:flex;
        flex-flow:column wrap;
        justify-content: center;
        align-items:center;

        .sharePost {
            label {
                font-size:13px;
            } 

            .postTextArea {
                height:90px;
                width:669px;
            }

            .sharePostBottomSection {
                display:flex;
                justify-content:space-between;

                .chirpBtn {
                    margin-top:10px;
                }
            }
        }

        .postsList {
            .latestChirpsText {
                font-size:18px;
            }

            .panel {
                margin-bottom:0;
                
                // .panel-body {
                //     display:flex;
                //     flex-flow:row;

                //     .profile_image {
                //         width:60px;
                //         height:60px;
                //         border-radius:50%;
                //     }

                //     p {
                //         margin-left:10px;
                //     }
                // }
            }
        }
    }
</style>