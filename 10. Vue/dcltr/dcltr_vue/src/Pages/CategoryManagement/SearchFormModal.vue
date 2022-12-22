<template>

<Card>
        
            <template v-slot:title>
                <h3 class="card-title">Arrange Seachable Columns</h3>
                <!-- <router-link :to="{name:'AddFormBuilder'}"><a class="btn btn-primary btn-sm pull-right" >Create Form </a></router-link>
                
                -->
            </template>
            <template v-slot:body>
            <form method="post" @submit.prevent="submitForm()">
                <div class="col-md-12">
                    <div class="form-group">
                    <template v-for="val,key in JSON.parse(form.form_fields)">
                        <div class="form-group">
                            <input type="checkbox" :value="val.name" v-model="fields_to_be_searched" />&nbsp;{{val.title}}
                        </div>
                    </template>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-success btn-xs">Submit</button>
            </form>
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
        ...mapState('modal',["status","id", "cat_id", "form"]),
        ...mapState('helpers',["formCurrentPage", "actionTaken", "refreshForm", "statusToken"])
    },
    watch: {
        form(to, from){
                console.log('FORM-->',to, from);
        },
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
        submitForm(){
            let myTarget = this.fields_to_be_searched

            console.log("fields_to_be_searched...",myTarget);
            console.log("form...",this.form);
             api.post(`admin/category/saveSearchFields`, {data: this.fields_to_be_searched, category_id: this.form.laravel_through_key, form_id: this.form.id} ).then(data=>data.data).then(response=>{ });
        },
        addEditCat(){
            let _id = this.isChild?this.$route.params.id:0;
            this.closeModal({status:true, parent_id: _id});
        },
    },

    inject:["show","hide"],
    data(){
        return {
            fields_to_be_searched: [],
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

