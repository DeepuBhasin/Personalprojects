<template>
    <!-- @click="toggleModal({status:true, id})" -->
    <a class="btn btn-info btn-sm" v-if="!attached" @click="attach({status:true, id, type:'linkForm'})">Attach Form</a>
    <a class="btn btn-success btn-sm" v-if="attached" >Attached</a>
</template>

<script>
import { api } from "@/store/api";
import { mapActions, mapState } from "vuex";

export default {
    computed:{
        ...mapState('modal',["status", "cat_id"]),
        
    },
    props:{
        id: Number,
        attached: Boolean,
    },
    inject:["show","hide"],
    methods:{
        ...mapActions('modal',["toggleModal"]),
        ...mapActions('helpers',["refreshForm"]),
        attach(){
            api.get(`admin/form/attachForm/${this.cat_id}/${this.id}`).then(data=>data.data).then(response=>{ 
                console.log("data",response); 
                this.show(response.message,response.status, 2000)
                this.refreshForm({data:{message:"", status:false}})
                // let rows = response.data.map(function(obj){
                //     return {...obj, "category_type": catTypesInverted[obj.category_type],"actions":[{EditButton, props:{id:obj.id}},{LinkForm, props:{cat_id:obj.id}},{ViewButton, props:{id:obj.id}},{DeleteButton, props:{id:obj.id}}]}
                // })
                // this.meta = response.meta
                // this.rows = rows;
            })
        }
    }
};
</script>