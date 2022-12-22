<template>
<SectionHeader header="Category Management" :titleBoolen="true">
    <template v-slot:breadCrumbsLinks>
        <li class="breadcrumb-item active">
            <router-link to="/categorymanagement"> Category Management</router-link>
        </li>
        <li class="breadcrumb-item active" v-if="isChild">View Category</li>
    </template>    
    <template v-slot:title>
            <h3 class="card-title">{{!isChild ? "All Categories" : "Category:"}} <strong>{{isChild ? currentResponse?.title : ""}}</strong></h3>
            <a class="btn btn-primary btn-sm pull-right" v-if="!isChild && pagePermission.add" @click="addEditCat()" >Create Category </a>
            <a class="btn btn-primary btn-sm pull-right" v-if="isChild && pagePermission.add" @click="addEditCat()">Create SubCategory</a>
        </template>
        <template v-slot:body>
            <div class="col-md-12">
                <div class="form-group">
                    <span v-if="pagePermission.delete || pagePermission.edit ||  pagePermission.link_form || pagePermission.manage_search || pagePermission.view" ></span>
                    <span v-else>{{columns[3]=''}}</span>  
                    <ITable :classes="classes" :columns="columns" :rows="rows" :meta="meta" section="Cat"></ITable>
                </div>
            </div>
        </template>
    </SectionHeader>    
    <template v-if="type == 'manageSearchForm'">
        <Modal :status="status" @closeModal="closeModal({status:false})" :title="'Manage Search'">
            <SearchFormModal :id="id" :openSelect="true" />
        </Modal>
    </template>
    <template v-if="type == 'createForm'">
        <Modal :status="status" @closeModal="closeModal({status:false})" :title="isChild?'Add / Edit Subcategory':'Add / Edit Category'">
            <CategoryForm :id="id" :categoryTypes="categoryTypes" :openSelect="true" :formType="isChild"/>
        </Modal>
    </template>
    <template v-if="type == 'editForm'">
        <Modal :status="status" @closeModal="closeModal({status:false})" :title="isChild?'Add / Edit Subcategory':'Add / Edit Category'">
            <CategoryForm :id="id" :categoryTypes="categoryTypes" :openSelect="false" :formType="isChild"/>
        </Modal>
    </template>
    <template v-if="type === 'linkForm'">
        <Modal :status="status" @closeModal="closeModal({status:false})" :title="isChild?'Link Form To Sub Category':'Link Form To Category'">
            <FormList :cat_id="id" :formType="isChild"/>
        </Modal>
    </template>

</template>

<script>
import ITable from '../../components/ITable/ITable.vue'
import EditButton from '@/Pages/CategoryManagement/EditButton'
import LinkForm from '@/Pages/CategoryManagement/LinkForm'
import ViewButton from '@/Pages/CategoryManagement/ViewButton'
import SearchFormModal from './SearchFormModal'
import ManageSearchButton from '@/Pages/CategoryManagement/ManageSearchButton'
import DeleteButton from '@/Pages/CategoryManagement/DeleteButton'
import Modal from '@/components/Modal/Modal.vue'
import { mapActions, mapState } from 'vuex'
import {api} from '@/store/api'
import CategoryForm from './CategoryForm.vue'
import lodash from 'lodash'
import FormList from './FormList.vue'


export default {
    components: {
        ITable,
        Modal,
        CategoryForm,
        LinkForm,
        FormList,
        SearchFormModal
    },
    computed:{
        ...mapState('users', {
            pagePermission : (state) =>{ 
                return {
                    page :  state.permission?.category_management?.includes('page')  ? true : false,
                    add :  state.permission?.category_management?.includes('add')  ? true : false,

                    delete :  state.permission?.category_management?.includes('delete')  ? true : false,
                    edit :  state.permission?.category_management?.includes('edit')  ? true : false,
                    link_form :  state.permission?.category_management?.includes('link_form')  ? true : false,
                    manage_search :  state.permission?.category_management?.includes('manage_search')  ? true : false,
                    view :  state.permission?.category_management?.includes('view')  ? true : false,
                }
            }
        }),
        ...mapState('modal',["status","id", "type", "form"]),
        ...mapState('helpers',["catCurrentPage","actionTaken"])
    },
    watch: {
        $route (to, from){
                console.log('route changed -->',to, from);
                this.isChild = 'id' in this.$route.params
                this.refresh(1)
        },
        catCurrentPage: function (catCurrentPageNew, catCurrentPageOld) {
            if(typeof catCurrentPageNew != "undefined")
            console.log("catCurrentPageNew",catCurrentPageNew);
            this.refresh(catCurrentPageNew)

            
        // this watcher will be called once address changed
        // you can have access to previous and new values.
        },
        actionTaken: function(newState, oldState){
            if(newState.status){
                this.show(newState.msg, "success", 2000)
                this.refresh(1);
                // api.get('admin/category/getScrapCategories?page=1').then(data=>data.data).then(response=>{ 
                //     console.log("data",response); 
                //     let rows = response.data.map(function(obj){
                //         return {...obj,"actions":[{EditButton, props:{id:obj.id}},{DeleteButton, props:{id:obj.id}}]}
                //     })
                //     this.meta = response.meta
                //     this.rows = rows;
                // })
            }
        },
        type(to, from){
            console.log("type changed", this.id, to, from);
            
        },
        form(to, from){
            console.log("form changed", to, from);
        }

    },
    methods:{
        checkPermission(){
            return this.pagePermission.page;
        },
        ...mapActions('modal',{"closeModal":"toggleModal"}),
        ...mapActions('helpers',["updateCatTypes"]),
        addEditCat(){
            
            let _id = this.isChild?this.$route.params.id:0;
            if(!_id){
                api.get('admin/category/getTypes').then(data=>data.data).then(response=>{ 
                    console.log("data",response); 
                    let _categoryTypes = response.data;
                    this.updateCatTypes({categoryTypes:_categoryTypes})
                    this.refresh(1);
                })
            }
            console.log("addEditCat-->", _id);
            this.closeModal({status:true, parent_id: _id, type:'createForm'});
        },
    },
    mounted:function(){
        // this.show("okok", 'success',20000)
        // api.get('admin/category/getScrapCategories?page='+this.catCurrentPage).then(data=>data.data).then(response=>{ 
        //     console.log("data",response); 
        //     //showToast("wow",1000);
            
        //     let rows = response.data.map(function(obj){
                
        //         return {...obj,"actions":[{EditButton, props:{id:obj.id}},{DeleteButton, props:{id:obj.id}}]}
        //     })
        //     this.meta = response.meta
        //     this.rows = rows;
        // });
        api.get('admin/category/getTypes').then(data=>data.data).then(response=>{ 
            console.log("data",response); 
            let _categoryTypes = response.data;
            this.updateCatTypes({categoryTypes:_categoryTypes})
            this.refresh(1);
        })
        
    },
    inject:["show","hide"],
    data(){
        return {
            isChild:  'id' in this.$route.params,
            currentResponse: {},
            refresh: function(pageIndex){
                let catTypesInverted = lodash.invert(this.categoryTypes)
                if(this.isChild){
                    api.get('admin/category/getCategoryDetails?id='+(this.$route.params.id)+'&page='+this.catCurrentPage).then(data=>data.data).then(response=>{ 
                        console.log("data",response); 
                        this.currentResponse = response.data;
                        this.updateCatTypes({categoryTypes:response.data.category_type})
                        let rows = response.data.subcategories.data.map(function(obj){
                            return {...obj,"category_type": lodash.keys(obj.category_type).join(','), "actions":[
                                {LinkForm, props:{cat_id:obj.id}},
                                {EditButton, props:{id:obj.id}},
                                {DeleteButton, props:{id:obj.id}}
                            ]}
                        })
                        this.meta = response.data.subcategories
                        
                        this.rows = rows;
                    })
                }
                else{

                
                    api.get('admin/category/getAllParentCat?page='+pageIndex).then(data=>data.data).then(response=>{ 
                        console.log("data",response); 
                        
                        let rows = response.data.map(function(obj){
                            
                            let actions = [
                                    {
                                        EditButton, props:{id:obj.id}
                                    },
                                    {
                                        LinkForm, props:{cat_id:obj.id}
                                    },
                                    {
                                        ViewButton, props:{id:obj.id}
                                    },
                                    {
                                        DeleteButton, props:{id:obj.id}
                                    }
                                ];
                                if(obj != null && obj.hasOwnProperty('form') && obj.form && obj.form.hasOwnProperty('form_fields')){
                                    actions.splice(1, 0, {ManageSearchButton, props:{cat_id:obj.id, form:obj.form}});
                                    console.log("am the form",obj.form); 
                                }

                            return {...obj, 
                                "category_type": lodash.isObject(obj.category_type)?lodash.keys(obj.category_type).join(','):"",
                                "actions":actions
                            }
                        })
                        this.meta = response.meta
                        this.rows = rows;
                    })
                }
            },
            categoryTypes:[],
            classes:["table", "table-stripped","table-striped"],
            columns: [
                {'title':'ID', key:'id'},
                {'title':'Category Title', key:'title'},
                {'title':'Category Type', key:'category_type'},
                {'title':'Actions', key:'actions'},
            ],
            rows:[],
            meta:{}
        }
    },
     created () {
        if(!this.checkPermission()){
            this.$router.push('/dashboard');
        } 
    },
}
</script>

