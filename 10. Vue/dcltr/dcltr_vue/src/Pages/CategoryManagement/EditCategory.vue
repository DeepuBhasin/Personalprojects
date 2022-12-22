<template>

<div class="content-wrapper" style="min-height: 242px;">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View & Edit Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link to="/">Home</router-link>
                        </li>
                        <li class="breadcrumb-item">
                            <router-link to="/">Category Management</router-link>
                        </li>
                        
                        <li class="breadcrumb-item active">View Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <Card>
        <template v-slot:title>
            <h3 class="card-title">Category Management - {{id}}</h3>
        </template>
        <template v-slot:body>
            <div class="col-md-12">
                <div class="form-group">
                    <!-- <h1>Category Management</h1> -->
                    <ITable :section="'Cat'" :classes="classes" :columns="columns" :rows="rows" :meta="meta"></ITable>
                </div>
            </div>
        </template>
    </Card>
    <!-- <Modal :status="status" @closeModal="closeModal({status:false})">
        <CategoryForm :id="id"/>
    </Modal> -->
</div>

</template>

<script>
import Card from '@/components/Card/Card.vue'
import ITable from '../../components/ITable/ITable.vue'
import EditButton from '@/Pages/CategoryManagement/EditButton'
import DeleteButton from '@/Pages/CategoryManagement/DeleteButton'
import Modal from '@/components/Modal/Modal.vue'
import { mapActions, mapState } from 'vuex'
import {api} from '@/store/api'
// import CategoryForm from './CategoryForm.vue'
export default {
        components: {
        Card,
        ITable,
        Modal
        // CategoryForm
    },
    computed:{
        // ...mapState('modal',["status","id"]),
        ...mapState('helpers',["catCurrentPage","actionTaken"])
    },
    watch: {
        catCurrentPage: function (catCurrentPageNew, catCurrentPageOld) {
            if(typeof catCurrentPageNew != "undefined")
            console.log("catCurrentPageNew",catCurrentPageNew);
            api.get('admin/category/getCategoryDetails?id='+(this.id)+'&page='+catCurrentPageNew).then(data=>data.data).then(response=>{ 
                    console.log("data",response); 
                    let rows = response.data.subcategories.data.map(function(obj){
                    return {...obj,"actions":[{EditButton, props:{id:obj.id}},{DeleteButton, props:{id:obj.id}}]}
                        })
                        this.meta = response.data.subcategories
                        
                        this.rows = rows;
                    })
        // this watcher will be called once address changed
        // you can have access to previous and new values.
        },
        actionTaken: function(newState, oldState){
            if(newState.status){
                this.show(newState.msg, "success", 2000)
                
                api.get('admin/category/getCategoryDetails?id='+(this.id)+'&page=1').then(data=>data.data).then(response=>{ 
                    console.log("data",response); 
                    let rows = response.data.subcategories.data.map(function(obj){
                        return {...obj,"actions":[{EditButton, props:{id:obj.id}},{DeleteButton, props:{id:obj.id}}]}
                    })
                    this.meta = response.data.subcategories
                    
                    this.rows = rows;
                })
            }
        }
    },
    methods:{
        ...mapActions('modal',{"closeModal":"toggleModal"}),
    },
    mounted:function(){
        // this.show("okok", 'success',20000)
        // api.get('getScrapCategories?page='+this.catCurrentPage).then(data=>data.data).then(response=>{ 
        //     console.log("data",response); 
        //     //showToast("wow",1000);
            
        //     let rows = response.data.map(function(obj){
                
        //         return {...obj,"actions":[{EditButton, props:{id:obj.id}},{DeleteButton, props:{id:obj.id}}]}
        //     })
        //     this.meta = response.meta
        //     this.rows = rows;
        // })
        api.get('admin/category/getCategoryDetails?id='+(this.id)+'&page='+this.catCurrentPage).then(data=>data.data).then(response=>{ 
            console.log("data",response); 
            let rows = response.data.subcategories.data.map(function(obj){
                return {...obj,"actions":[{EditButton, props:{id:obj.id}},{DeleteButton, props:{id:obj.id}}]}
            })
            this.meta = response.data.subcategories
            
            this.rows = rows;
        })
    },
    inject:["show","hide"],
    data(){
        return {
            id: this.$route.params.id,
            classes:["table", "table-stripped"],
            columns: [
                {'title':'ID', key:'id'},
                {'title':'Title', key:'title'},
                {'title':'Subcategories', key:'subcategories'},
                {'title':'Actions', key:'actions'},
            ],
            rows:[
                {
                    'id':'1',
                    'title':'Electronics',
                    'subcategories':'2',
                    'actions':[{EditButton, props:{id:1}}]
                }
            ],
            meta:{}
        }
    },
    created () {

    }
}
</script>

