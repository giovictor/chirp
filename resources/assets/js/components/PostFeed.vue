<template>
    <div class="posts">
        <div class="sharePost" v-show="canSharePost">
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
            <p class="latestChirpsText" v-if="user==null">Latest chirps from random cool people</p>
            <p class="username" v-else>{{posts.length==0 ? 'You have no chirps yet. Try chirping now!' : `${user.name}'s posts`}}</p>
            <div class="panel panel-default" v-for="post in posts" :key="post.id">
                <post :post="post" :auth-user="authUser" @deletePost="deletePost"></post>
            </div>
        </div>
    </div>
</template>

<script>
    import postMixin from '../mixins/postMixin' 
    export default {
        props:['authUser','user'],
        mixins:[postMixin],
        mounted() {
            this.showPosts()
        },
        computed:{
            canSharePost() {
                if(this.user==null || this.authUser.id===this.user.id) {
                    return true
                } else {
                    return false
                }
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
    }

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
        .latestChirpsText, .username {
            font-size:18px;
            font-weight:700;
            color:#000000;
        }

        .panel {
            margin-bottom:0;
            width:1140px;
            max-width:1140px;

        }
    }

    @media screen and (max-width:1200px) {
        .postsList {
            .panel {
                width:100%;
                max-width: 100%;
            }
        }
    }

    @media screen and (max-width:767px) {
        .sharePost {
            .postTextArea {
                width:calc(100vw - 10vw);
            }
        }
    }
</style>