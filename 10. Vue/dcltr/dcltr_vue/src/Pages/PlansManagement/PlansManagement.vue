<template>
<SectionHeader header="Plans Management" :titleBoolen="true">
         <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                <router-link to="/plans">Plans Management</router-link>
            </li>
         </template>
        <template v-slot:title>
            <h3 class="card-title">Plans Management</h3>
            <span class="pull-right">
                <a class="btn btn-sm btn-primary" @click="closeModal({status:true, type:'plan'})" v-if="pagePermission.add">Create Plan</a>
            </span>
            <!-- <router-link :to="{name:'AddFormBuilder'}"><a class="btn btn-primary btn-sm pull-right" >Create Form </a></router-link>
                -->
        </template>
        <template v-slot:body>
            <div class="col-md-12">
                <div class="form-group">
                    <span v-if="pagePermission.delete || pagePermission.edit" ></span>
                         <span v-else>{{columns[3]=''}}</span>  
                    <!-- <h1>Category Management</h1> -->
                    <ITable :classes="classes" :columns="columns" :rows="rows" :meta="meta" section="plan"></ITable>
                </div>
            </div>
        </template>
</SectionHeader>    

    <template v-if="type == 'plan'">
        <Modal :status="status" @closeModal="closeModal({status:false})" :title="'Create Plan'">
            <PlanFormModal />
        </Modal>
    </template>
    <template v-if="type == 'editPlan'">
        <Modal :status="status" @closeModal="closeModal({status:false})" :title="'Edit Plan'">
            <PlanFormModal :id="id" />
        </Modal>
    </template>
</template>

<script>
import ITable from '../../components/ITable/ITable.vue'
import DeleteButton from './DeleteButton.vue';
import EditButton from './EditButton.vue';
import PlanFormModal from './PlanFormModal.vue';
import Modal from '@/components/Modal/Modal.vue'
import {
    mapActions,
    mapState
} from 'vuex'
import {
    api
} from '@/store/api'

import lodash from 'lodash'
export default {
    components: {
        ITable,
        Modal,
        PlanFormModal
    },
    computed: {
         ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      page :  state.permission?.plans_management?.includes('page')  ? true : false,
                      add :  state.permission?.plans_management?.includes('add')  ? true : false,

                      delete :  state.permission?.plans_management?.includes('delete')  ? true : false,
                      edit :  state.permission?.plans_management?.includes('edit')  ? true : false,
                  }
              }
          }),
        ...mapState('modal', ["status", "id", "type"]),
        ...mapState('helpers', ["planCurrentPage", "actionTaken", "refreshForm", "statusToken", "userType"])
    },
    watch: {
        status(to, from) {
            console.log(to, from);
            //this.isChild = 'id' in this.$route.params
            //this.refresh(to)
        },
        type(to, from) {
            console.log('Modal Type-->', to, from);
            //this.isChild = 'id' in this.$route.params
            //this.refresh(to)
        },

        statusToken(to, from) {
            console.log("statusToken", to, from);
            //this.isChild = 'id' in this.$route.params
            this.refresh(this.userType, this.planCurrentPage)
        },
        planCurrentPage: function (to, from) {
            if (typeof to != "undefined")
                this.refresh(this.userType, to)
            // this watcher will be called once address changed
            // you can have access to previous and new values.
        },

        actionTaken: function (newState, oldState) {
            if (newState.status) {
                this.show(newState.msg, newState.type, 2000)
                if (newState.type == 'success') {
                    this.closeModal({
                        status: false
                    })
                }
                this.refresh(this.userType, this.planCurrentPage);
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
    methods: {
        checkPermission(){
            return this.pagePermission.page;
        },
        ...mapActions('modal', {
            "closeModal": "toggleModal"
        }),
        addEditCat() {
            let _id = this.isChild ? this.$route.params.id : 0;
            this.closeModal({
                status: true,
                parent_id: _id
            });
        },
        updateUserType(e) {
            console.log("this is user type", e, this.userType)
        }
    },
    mounted: function () {
        this.refresh(this.cat_id, this.planCurrentPage);
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
    inject: ["show", "hide"],
    data() {
        return {
            isChild: 'id' in this.$route.params,
            currentPlan: {},
            refresh: function (userType) {
                userType = userType ? userType : 'Recycler';
                console.log("Refresh Called..", userType);
                api.get(`admin/subscription?page=${this.planCurrentPage}`).then(data => data.data).then(async response => {
                    console.log("data", response);
                    
                    let rows = response.data.map(function (obj) {
                        
                        return {
                            ...obj,
                            "actions": [{
                                DeleteButton,
                                props: {
                                    id: obj.id
                                }
                            }, {
                                EditButton,
                                props: {
                                    id: obj.id
                                }
                            }]
                        }
                    })
                    this.meta = response.meta

                    this.rows = rows;
                    console.log('response-response-data',response.data)
                    
                    //this.refresh(1);
                })
            },
            categoryTypes: [],
            classes: ["table", "table-stripped", "table-striped"],
            columns: [{
                    'title': 'Name',
                    key: 'name'
                },
                {
                    'title': 'Price',
                    key: 'amount'
                },
                {
                    'title': 'No. Of Leads',
                    key: 'no_of_leads'
                },

                {
                    'title': 'Actions',
                    key: 'actions'
                },
            ],
            rows: [
                // {
                //     'id':'1',
                //     'title':'Electronics',
                //     'subcategories':'2',
                //     'actions':[{EditButton, props:{id:1}}]
                // }
            ],
            meta: {}
        }
    },
    created () {
        if(!this.checkPermission()){
            this.$router.push('/dashboard');
        } 
    },
}
</script>
