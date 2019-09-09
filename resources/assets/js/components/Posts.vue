<template>
    <div class="posts">
        <div class="sharePost">
            <form class="form" @submit.prevent="sharePost">
                <div class="form-group">
                    <label>Hey wanna share something cool?</label>
                    <textarea class="postTextArea form-control" v-model="post" @keyup="decreaseCharacterLimit" ></textarea>
                    <p class="emptyMessage text-danger">{{validationMessage}}</p>
                    <div class="sharePostBottomSection">
                        <button type="submit" class="btn btn-primary btn-sm chirpBtn" :disabled="hasError">Chirp</button>
                        <p class="postCharacterLimit">{{limit}}</p>
                    </div>
                </div>
            </form>
        </div>
        <div class="postsList">
            <p class="latestChirpsText">Latest chirps from random cool people</p>
            <div class="panel panel-default" v-for="post in posts" :key="post.id">
                <post :post="post" :user="user" @deletePost="deletePost"></post>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data() {
            return {
                posts:[],
                post:'',
                limit:200,
                validationMessage:'',
                hasError:false
            }
        },
        mounted() {
            this.listPosts()
        },
        methods:{
            decreaseCharacterLimit() {
                this.limit = 200 - this.post.length
                if(this.limit < 0) {
                    this.validationMessage = 'Reached maximum character limit for posts.'
                    this.hasError = true
                } else {
                    this.validationMessage = ''
                    this.hasError = false
                }
            },
            listPosts() {
                axios.get('api/posts')
                .then(response => this.posts = response.data)
                .catch(error => console.log(error))
            },
            sharePost() {
                if(this.post=='') {
                    this.validationMessage = 'No blank post shall be posted.'
                    this.hasError = true
                } else {
                    axios.post('api/posts', {post:this.post, user_id:this.user.id})
                    .then(response => this.listPosts())
                    .catch(error => console.log(error))
                    this.post = ''
                    this.limit = 200
                }
                
            },
            deletePost(id) {
                swal({
                    text: "Are you sure you want to delete this post?",
                    icon: "warning",
                    button:"Yes, delete it.",
                    dangerMode: true,
                })
                .then(response => {
                    if(response) {
                        axios.delete(`api/posts/${id}`)
                        .then(response => {
                            this.listPosts()
                        })
                        .catch(error => console.log(error))  
                        swal("Deleted!", "Your post was deleted.", "success");
                    }
                });         
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
                font-weight:700;
                color:#000000;
            }

            .panel {
                margin-bottom:0;

                .author {
                    font-size:15px;
                    font-weight:700;
                    color:#000000;
                }

                .post {
                    font-size:14px;
                }
            }
        }
    }
</style>