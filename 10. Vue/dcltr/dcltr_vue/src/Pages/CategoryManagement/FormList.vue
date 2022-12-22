<template>

<Card>
        <template v-slot:title>
            <h3 class="card-title">Link Form</h3>
            <!-- <router-link :to="{name:'AddFormBuilder'}"><a class="btn btn-primary btn-sm pull-right" >Create Form </a></router-link>
            
             -->
        </template>
        <template v-slot:body>
            <div class="col-md-12">
                <div class="form-group">
                    <!-- <h1>Category Management</h1> -->
                    <ITable  :classes="classes" :columns="columns" :rows="rows" :meta="meta" section="form"></ITable>
                </div>
            </div>
        </template>
    </Card>

</template>

<script>
import Card from '@/components/Card/Card.vue'
import ITable from '../../components/ITable/ITable.vue'

import DeleteButton from '@/Pages/FormBuilder/DeleteButton';
import EditButton from '@/Pages/FormBuilder/EditButton';
import AttachButton from '@/Pages/CategoryManagement/AttachButton';
import ViewButton from '@/Pages/CategoryManagement/ViewButton'
import Modal from '@/components/Modal/Modal.vue'
import { mapActions, mapState } from 'vuex'
import {api} from '@/store/api'

import lodash from 'lodash'
export default {
        components: {
        Card,
        ITable,
        Modal
    },
    computed:{
        ...mapState('modal',["status","id", "cat_id"]),
        ...mapState('helpers',["formCurrentPage", "actionTaken", "refreshForm", "statusToken"])
    },
    watch: {
        cat_id(to, from){
                console.log(to, from);
                //this.isChild = 'id' in this.$route.params
                this.refresh(to)
        },
        statusToken(to, from){
                console.log("statusToken",to, from);
                //this.isChild = 'id' in this.$route.params
                this.refresh(this.cat_id, this.formCurrentPage)
        },
        formCurrentPage: function (formCurrentPageNew, catCurrentPageOld) {
            if(typeof formCurrentPageNew != "undefined")
            console.log("formCurrentPageNew",formCurrentPageNew);
            this.refresh(this.cat_id, formCurrentPageNew)
        // this watcher will be called once address changed
        // you can have access to previous and new values.
        },

        actionTaken: function(newState, oldState){
            if(newState.status){
                this.show(newState.msg, "success", 2000)
                this.refresh(this.cat_id, this.formCurrentPage);
                // api.get('admin/category/getScrapCategories?page=1').then(data=>data.data).then(response=>{ 
                //     console.log("data",response); 
                //     let rows = response.data.map(function(obj){
                //         return {...obj,"actions":[{EditButton, props:{id:obj.id}},{DeleteButton, props:{id:obj.id}}]}
                //     })
                //     this.meta = response.meta
                //     this.rows = rows;
                // })
            }
        }
    },
    methods:{
        ...mapActions('modal',{"closeModal":"toggleModal"}),
        addEditCat(){
            let _id = this.isChild?this.$route.params.id:0;
            this.closeModal({status:true, parent_id: _id});
        },
    },
    mounted:function(){
        this.refresh(this.cat_id, this.formCurrentPage);
        // api.get('admin/form/list').then(data=>data.data).then(response=>{ 
        //     console.log("data",response); 
        //     let rows = response.data.subcategories.data.map(function(obj){
        //         return {...obj, "actions":[]}
        //     })
        //     this.meta = response.data.subcategories
            
        //     this.rows = rows;
        //     //this.refresh(1);
        // })
        
    },
    inject:["show","hide"],
    data(){
        return {
            isChild:  'id' in this.$route.params,
            
            refresh: function(pageIndex){
                console.log("Refresh Called..", pageIndex);
                api.get(`admin/form/listLikedToCat/${pageIndex}?page=${this.formCurrentPage}`).then(data=>data.data).then(response=>{ 
                    console.log("data",response); 
                    
                    let rows = response.data.map(function(obj){
                        let attached = false;
                            let filtered = obj.categories.filter(chunk=>{return chunk.category_id == pageIndex && chunk.form_id == obj.id});
                            if(filtered.length){
                                attached = true;
                                console.log("filtered--",filtered[0]);    
                            }
                            
                        
                        return {...obj, "actions":[{AttachButton, props:{id:obj.id, attached}}]}
                    })
                    this.meta = response.meta
                    
                    this.rows = rows;
                    //this.refresh(1);
                })
            },
            categoryTypes:[],
            classes:["table", "table-stripped","table-striped"],
            columns: [
                {'title':'ID', key:'id'},
                {'title':'Title', key:'title'},
                
                {'title':'Actions', key:'actions'},
            ],
            rows:[
                // {
                //     'id':'1',
                //     'title':'Electronics',
                //     'subcategories':'2',
                //     'actions':[{EditButton, props:{id:1}}]
                // }
            ],
            meta:{}
        }
    },
    created () {

    }
}
</script>

