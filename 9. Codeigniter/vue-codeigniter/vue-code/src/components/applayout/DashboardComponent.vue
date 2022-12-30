<template>
    <h2>News Feed</h2>
    <h4>{{firstName}} {{lastName}}</h4>
    <alert-message :color="color" :message="message" v-if="alertStatus"/>
    <form @submit.prevent="submitPost">
        <div class="form-group bg-info p-3">
            <br/>
            <label for="reate_post">Create Post</label>
            <textarea name="posttext" id="post" cols="20" rows="5" placeholder="What's in your in mind..... " class="form-control" v-model="comment"></textarea>
            <br/>
                <h2 class="text-center">OR</h2>
            <br/>
            <input type="file" ref="fileupload" name="postImage" id="postImage" class="form-control" @change="uploadImage($event)" accept="image/*">

            <br/>
            <button type="submit" class="btn btn-success btn-block">Upload</button>
            &nbsp;
            <button type="reset" class="btn btn-danger btn-block">Clear</button>
        </div>
    </form><br/>

    <div v-if="commentArray.length">
        <template v-for="item in commentArray" :key="item.id">
            <div v-if="item.comment">
                <div class="alert alert-warning">
                    <router-link :to="{name : 'viewuser', params : {id : item.user_id}}"> {{ item.first_name}} {{ item.last_name}} </router-link>  <br/> <br/> 
                    <p class="p-3" style="background-color:#fff;">{{item.comment}}</p>

                    <button class="btn btn-info btn-sm" @click.prevent="likeCommentPost(item.id)">
                        <span v-if="likeUnlikeArray.filter( a => a == item.id ).length"> Unlike </span>
                        <span v-else>Like</span>
                    </button>
                    <br/><br/>
                    <form @submit.prevent="postComment()">
                    <div class="form-group">
                        <label for="">comment</label>
                        <input type="text" class="form-control" :id="`comment_${item.id}`" placeholder="Enter Comment" @input="postCommentCommentInput($event,item.id)" value="">
                        <br/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm" @click.prevent="comment_comment(item.id)">Submit</button>  
                    </div>
                        <br/>
                        <div>
                            <p v-for="lal in comemntComputed(item.id)" :key="lal.id">
                               {{lal.first_name}} {{lal.last_name}} : {{lal.comment}}
                            </p>
                        </div>


                    </form>
                </div>
            </div>
            <div v-else>
                <div class="alert alert-warning">
                    <router-link :to="{name : 'viewuser', params : {id : item.user_id}}"> {{ item.first_name}} {{ item.last_name}} </router-link>  <br/> <br/> 
                    <p class="p-3" style="background-color:#fff;">
                        <img :src="getImagePath()  + item.image" alt="" width="500" class="img-thumbnail">
                        
                    </p>

                    <button class="btn btn-info btn-sm" @click.prevent="likeCommentPost(item.id)">
                        <span v-if="likeUnlikeArray.filter( a => a == item.id ).length"> Unlike </span>
                        <span v-else>Like</span>
                    </button>
                    <br/><br/>
                    <form @submit.prevent="postComment()">
                    <div class="form-group">
                        <label for="">comment</label>
                        <input type="text" class="form-control" :id="`comment_${item.id}`" placeholder="Enter Comment" @input="postCommentCommentInput($event,item.id)" value="">
                        <br/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm" @click.prevent="comment_comment(item.id)">Submit</button>   
                    </div>
                    <br/>
                        <div>
                            <p v-for="lal in comemntComputed(item.id)" :key="lal.id">
                               {{lal.first_name}} {{lal.last_name}} : {{lal.comment}}
                            </p>
                        </div>
                    
                    </form>
                </div>
            </div>
        </template>
    </div>
    
</template>
<script>
import { getRequest, getTokenStorage, postRequest, postRequestForImage } from '@/api/api-functions';
import {baseImageUrl} from '@/api/api-functions';
export default {
    name : 'DashboardComponent',
    computed: {

    },  
    data() {
        return {
            firstName : '',
            lastName : '',
            id : '',
            alertStatus : false, 
            color : '',
            message : '',
            loading : false,
            comment: '',
            commentArray : [],
            likeUnlikeArray : [],
            imageStatus: null,
            postImage : '',
            imagePath : '',

            comment_comment_object : {},
            commentCommentArray : []
        }
    },
    methods:{

        getImagePath() {
            return baseImageUrl;
        },

        comemntComputed(id) {
            return this.commentCommentArray.filter( a => a.post_table_id == id )
        },

        postCommentCommentInput(e,post_id){
            this.comment_comment_object = {
                comment_comment : e.target.value,
                post_id_comment : post_id,
                created_by_comment : this.id
            };
        },

        async comment_comment(id) {
            
            if(id === this.comment_comment_object.post_id_comment) {
                await postRequest('post_comment_comment', this.comment_comment_object);  
                this. getAllPostData();
                this.comment_comment_object = {};
                document.getElementById(`comment_${id}`).value='';
            }
            
        },

        async myProfileDetails() {
            this.id = getTokenStorage();
            let responseData = await getRequest(`my_profile/${this.id}`);
            let userData = responseData.data;
            this.loading = true;
            this.firstName = userData.first_name;
            this.lastName = userData.last_name;
            
        },
        uploadImage(e) {
            this.postImage = e.target.files[0];
            this.imageStatus = true;
        },
        async submitPost() {
            if(this.imageStatus == true) {

                let fd = new FormData();
                fd.append('postImage', this.postImage, this.postImage.name);
                fd.append('created_by', this.id);

                let responseData = await postRequestForImage('create_post',fd);
                
                if(responseData.data.error === false) {
                    this.message = responseData.data.data;
                    this.color = 'success';
                    this.alertStatus = true;

                    this.$refs.fileupload.value = null;
                    this.getAllPostData();

                    this.imageStatus = false;
                    this.impostImage = '';

                }
                
            } else {
                let userData = {
                    comment : this.comment,
                    created_by : this.id
                };

                let responseData = await postRequest('create_post',userData);
                
                if(responseData.data.error === false) {
                    this.message = responseData.data.data;
                    this.color = 'success';
                    this.alertStatus = true;

                    this.comment = '';
                    this.getAllPostData();
                }
            }

            setTimeout(()=>{
                    this.alertStatus = false;
            },3000);

        },
        async getAllPostData() {
            let responseData = await getRequest(`get_all_post_data/${this.id}`);
            this.commentArray = responseData.data.allPosts;
            this.likeUnlikeArray = responseData.data.allLikeUnlike; 

            if(responseData.data.allLikeUnlike.length) {
                this.likeUnlikeArray = responseData.data.allLikeUnlike.map(a => a.post_table_id);
            }

            if(responseData.data.allComment.length) {
                this.commentCommentArray = responseData.data.allComment
            }
            
        },
        
        async likeCommentPost(id) {

            let userObject = {
                post_id : id, 
                user_id : this.id
            }
            await postRequest('like_comment_post',userObject);
            this.getAllPostData();
        }
        
    }, 
    async mounted() {
        await this.myProfileDetails();
        await this.getAllPostData();
    }
    
}
</script>