<template>
    <!-- @click="toggleModal({status:true, id})" -->
    <a class="btn btn-success btn-xs" @click="edit()" v-if="pagePermission">Edit</a>
</template>

<script>
import { api } from "@/store/api";
import { mapActions, mapState } from "vuex";

export default {
    computed:{
        ...mapState('modal',["status"]),
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.category_management.includes('edit')  ? true : false;
              }
        })
    },
    props:{
        id: Number,
    },
    methods:{
        ...mapActions('modal',["toggleModal"]),
        ...mapActions('helpers',["updateCatTypes"]),
        edit(){
            api.get('admin/category/getCategoryDetails?id='+this.id).then(_data=>_data.data).then(_response=>{ 
                
                        
                    
                    
                    if(_response.data.parent_id){
                        this.toggleModal({status:true, type:'editForm', id:this.id})
                    }
                    else{
                        api.get('admin/category/getTypes').then(data=>data.data).then(response=>{ 
                            let _categoryTypes = response.data;
                            this.updateCatTypes({categoryTypes:_categoryTypes, selectedCatTypes:_response.data.category_type})
                            this.toggleModal({status:true, type:'editForm', id:this.id})
                        });
                    }
                    console.log("Updating types", _response.data);
                    
                
            })
        }
    }
};
</script>