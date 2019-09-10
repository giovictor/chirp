export default {
    data() {
        return {
            posts:[],
            post:'',
            limit:200,
            validationMessage:'',
            hasError:false,
            isLoading:true,
            loaderColor:'#3097D1',
            loaderSize:'200px',
        }
    },
    methods:{
        listPosts() {
            axios.get('api/posts')
            .then(response => this.posts = response.data)
            .catch(error => console.log(error))
        },
        listPostsByUser(id) {
            axios.get(`api/user/${id}/posts`)
            .then(response => this.posts = response.data)
            .catch(error => console.log(error))
        },
        showPosts() {
            if(this.user==null) {
                this.listPosts()
            } else {
                this.listPostsByUser(this.user.id)
            }
        },
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
        sharePost() {
            if(this.post=='') {
                this.validationMessage = 'No blank post shall be posted.'
                this.hasError = true
            } else {
                axios.post('api/createpost', {post:this.post, user_id:this.authUser.id})
                .then(response => this.showPosts())
                .catch(error => console.log(error))
                swal("Nice one", "Your chirp was posted!", "success");
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
                    .then(response => this.showPosts())
                    .catch(error => console.log(error))  
                    swal("Deleted!", "Your post was deleted.", "success");
                }
            });         
        }
    }
}