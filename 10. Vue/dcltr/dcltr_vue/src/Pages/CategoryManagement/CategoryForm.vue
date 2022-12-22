<template>
    
            
            <form @submit.prevent="saveCategory()">
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Type </label>
                    <select class="form-control" multiple v-model="category_type">
                        <option v-for="(catType,index) in categoryTypes" :key="index" :value="catType" :selected="isSelected(catType)">{{index}}</option>
                    </select>                
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    
                    <input type="text" v-model="title" class="form-control"  id="exampleInputEmail1" placeholder="Enter Title">
                </div>
                <div class="form-group" v-if="catDetails.image_path!=''">
                    
                    <img v-if="typeof catDetails.image_path !=='undefined'" :src="baseURL+catDetails.image_path" height="100" width="100"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Image</label>
                    <input
                        type="file"
                        :class="'form-control '"
                        accept="image/png, image/gif, image/jpeg"
                        @change="(e,k)=>{this.image = e.target.files[0]; this.imageName = key; }"
                      />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>


    
</template>
<script>
import { api,baseURL } from '@/store/api';
import { mapActions, mapState } from 'vuex';
    export default{
        mounted(){
            if(this.parent_id && typeof this.parent_id!="undefined"){
                this.isExistingCat = true;
            }
            api.get('admin/category/getCategoryDetails?id='+this.id).then(data=>data.data).then(response=>{ 
                        console.log("data",(response.data)); 

                        this.title = response.data['title'];
                        this.catDetails = response.data;
                    })
        },
        computed:{
            ...mapState('modal',['type','parent_id', "status"]),
            ...mapState('helpers',["categoryTypes"]),
            baseURL(){
                return baseURL+'storage/'
            }
        },
        props:{
            id: Number,
            // title: String,
            formType:Boolean,
            openSelect:Boolean,
            
            modalStatus: Boolean
        },
        data(){
            return {
                title: '',
                category_type: 1,
                isExistingCat: false,
                image:null,
                imageName:"",
                catDetails:{},
                selectedCats:{}
                //categoryTypes:[],
                //parentid: this.$route.params,
                
            }
        },
        watch:{
            status(to, from){
                console.log('modalStatus--->', to, from);
                this.title='';
                //this.modalStatus = to;
            },
            categoryTypes(to, from){
                console.log('categoryTypes--->', to, from);
                
                //this.modalStatus = to;
            },
            id: function(idNew, idOld){
                console.log('id amn',idNew, idOld);
                this.isExistingCat = typeof idNew=='undefined'?idNew:idOld;
                if(idNew && typeof idNew != "undefined"){
                   
                   console.log('id isExistingCat',this.isExistingCat)
                   api.get('admin/category/getCategoryDetails?id='+idNew).then(data=>data.data).then(response=>{ 
                        // this.catDetails = response.data;
                        this.selectedCats = response.data.category_type;
                        
                        if(response.data.parent_id==null){
                            api.get('admin/category/getTypes').then(_data=>_data.data).then(_response=>{ 
                                
                                this.categoryTypes = _response.data;
                                
                                // this.updateCatTypes({categoryTypes:_categoryTypes})
                                // this.refresh(1);
                            })
                            //this.categoryTypes = response.data.category_type;        
                        }
                        else{
                            this.categoryTypes = response.data.category_type;
                        }
                        console.log("selected",(this.selectedCats)); 
                        
                        this.title = response.data['title'];
                        this.catDetails = response.data;
                    })
                }
                else{
                    this.isExistingCat = false
                    this.title = "";
                }
                
            },
            parent_id: function(idNew, idOld){
                console.log("parentId",idNew, idOld)
                this.isExistingCat = false;
                if(idNew && typeof idNew != "undefined" && idNew !=0){
                    this.isExistingCat = true
                    this.title = "";
                }
            }
        },
        inject:["show","hide"],
        methods:{
            isSelected(cat){
                console.log("am cat for selection",cat, Object.values(this.selectedCats),Object.values(this.selectedCats).includes(cat));
                return Object.values(this.selectedCats).includes(cat);
            },
            saveCategory(){
                console.log("this.isExistingCat",this.id,this.isExistingCat)
                // console.log('SaveCategory Hit',this.title,this.category_type)
                // console.log('this.parent_id',this.parent_id, this.id)
                let fd = new FormData();
                fd.append("title",this.title)
                fd.append("category_type",this.category_type)
                fd.append("image",this.image)
                
                
                if(this.id){
                /**
                 * EDIT REQUEST GOES HERE
                 */
                    fd.append("category_id",this.id)
                    let dataToPass = {title:this.title, category_type:this.category_type};
                    this.id?dataToPass['category_id']=this.id:"";
                    
                    api.post('admin/category/editCategory',fd, {headers: {
                        "Content-Type": "multipart/form-data",
                    }})
                    //.then(data=>data.json())
                    .then(response=>{ 
                        //this.show(response.data.message, "success", 2000)
                        this.refresh({data:{message:response.data.message, status:true}})
                        
                        //this.tmpTitle = (response.data[0])['title'];
                    })
                    .catch(($e)=>{
                        console.log('Err=>', $e)
                        this.show($e.response.data.message, "error", 2000)
                        
                    })

                }
                else{
                    let dataToPass = {title:this.title,'category_type':this.category_type};
                    this.isExistingCat?dataToPass['parent_id']=this.parent_id:'';
                    this.isExistingCat?fd.append('parent_id',this.parent_id):'';
                    console.log("dataToPass..",dataToPass);
                    api.post('admin/category/create',fd, {headers: {
                        "Content-Type": "multipart/form-data",
                    }})
                    //.then(data=>{ console.log("mid-data=>",response); return {data:data.data, status: data.status} })
                    .then(response=>{ 
                        console.log("data=>",response); 
                        this.refresh({data:{message:response.data.message, status:true}})
                        //this.tmpTitle = (response.data[0])['title'];
                    })
                    .catch(($e)=>{
                        this.show($e.response.data.message, "error", 2000)
                        console.log('Err=>', $e.response.data.message)
                    })
                }
                
                
            },
            ...mapActions('helpers',[
                'refresh',
            ])

        }
        // data(){
        //     return {
        //         id:0
        //     }
        // }
    }
</script>