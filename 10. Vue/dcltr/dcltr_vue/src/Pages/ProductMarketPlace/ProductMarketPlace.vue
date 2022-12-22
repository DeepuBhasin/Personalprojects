<template>
<SectionHeader header="Product List" :titleBoolen="true">
    <template v-slot:breadCrumbsLinks>
        <li class="breadcrumb-item active">
            <router-link to="/productmarketplace">Product List</router-link>
        </li>
    </template>
    <template v-slot:title>
            <h3 class="card-title">All Products</h3>
            <!-- <span class="pull-right">
                <select @change="updateUserType()" v-model="userType">
                    <option value="All">All</option>
                    <option value="Recycler">Recycler</option>
                    <option value="Charitable">Charitable Organization</option>
                    <option value="ScrapDealer">Scrap Dealer</option>
                    <option value="ServiceProvider">Service Provider</option>
                    <option value="Regular">Customer</option>
                </select>
            </span> -->
            <!-- <router-link :to="{name:'AddFormBuilder'}"><a class="btn btn-primary btn-sm pull-right" >Create Form </a></router-link>
            
            -->
        </template>
        <template v-slot:body>
            <div class="productListTable">
                <div class="">
                       <span v-if="pagePermission.view || pagePermission.approve ||  pagePermission.reject"></span>
                        <span v-else>{{columns[4]=''}}</span>   
                    <!-- <h1>Category Management</h1> -->
                    <ITable :classes="classes" :columns="columns" :rows="rows" :meta="meta" section="product" :perPageLimit="true"></ITable>
                        <Modal :status="status" @closeModal="toggleModal({status:false})" :title="'Reason to Reject Product From Lisitng'">
                            <form @submit.prevent="rejectRequest()">
                                <div class="form-control">
                                    <textarea required v-model="reason" class="form-control" placeholder="Reason">
                                    
                                    </textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                
                            </form>
                        </Modal>
                </div>
            </div>
        </template>


</SectionHeader>
</template>

<script>
import ITable from '../../components/ITable/ITable.vue'
import ViewButton from '@/Pages/ProductMarketPlace/ViewButton'
import RejectButton from '@/Pages/ProductMarketPlace/RejectButton'
import ApproveButton from '@/Pages/ProductMarketPlace/ApproveButton'
import Modal from '@/components/Modal/Modal.vue'
import { mapActions, mapState } from 'vuex'
import {api} from '@/store/api'
export default {
        components: {
        ITable,
        Modal
    },
    computed:{

         ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      page :  state.permission?.product_market_place?.includes('page')  ? true : false,
                
                      view :  state.permission?.product_market_place?.includes('view')  ? true : false,
                      approve :  state.permission?.product_market_place?.includes('approve')  ? true : false,
                      reject :  state.permission?.product_market_place?.includes('reject')  ? true : false,
                      
                  }
              }
          }),
        ...mapState('modal',["status","id"]),
        ...mapState('helpers',["productCurrentPage", "actionTaken", "refreshForm", "statusToken", "userType", "sortable", "perPage", "filterCriteria"])
    },
    watch: {

        id(to, from){
            console.log("id",to, from)
        },
        status(to, from){
            console.log("visibility",to, from)
        },
        sortable(to, from){
            console.log("Now Sortable chnaged", to, from)
            this.refresh(1);
        },
        perPage(to, from){
            console.log("Now Sortable chnaged", to, from)
            this.refresh(1);
        },
        filterCriteria: {
                handler(to, from){
                    console.log("Now filterCriteria", to, from)
                    this.refresh(1);
                },deep: true
        },
        userType(to, from){
                console.log(to, from);
                //this.isChild = 'id' in this.$route.params
                this.refresh(to,1)
        },
        statusToken(to, from){
                console.log("statusToken",to, from);
                //this.isChild = 'id' in this.$route.params
                this.refresh(this.productCurrentPage)
        },
        productCurrentPage: function (to, from) {
            if(typeof to != "undefined")
            this.refresh(to)
        // this watcher will be called once address changed
        // you can have access to previous and new values.
        },

        actionTaken: function(newState, oldState){
            if(newState.status){
                this.show(newState.msg, "success", 2000)
                this.refresh(this.productCurrentPage);
            }
        }
    },
    methods:{
        ...mapActions("modal",["toggleModal"]),
         checkPermission(){
            return this.pagePermission.page;
        },
        ...mapActions('modal',{"closeModal":"toggleModal"}),
        addEditCat(){
            let _id = this.isChild?this.$route.params.id:0;
            this.closeModal({status:true, parent_id: _id});
        },
        updateUserType(e){
            console.log("this is user type",e, this.userType)
        },
        formatDate(date){
            console.log('raw',date)
            const formatter = new Intl.DateTimeFormat('en-us', {
            weekday: 'long',
            year: 'numeric',
            month: 'numeric',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            fractionalSecondDigits: 3,
            hour12: true,
            timeZone: 'Asia/Kolkata'
            });

            return formatter.format(date);
        },
        rejectRequest(e){
            console.log("this is rejection", this.id)
            api.post(`admin/product/updateStatus/${this.id}`, {reason: this.id}).then(data=>data.data).then(response=>{ 
                    
                    this.closeModal({status:false});
                    
                    
                    this.refresh(1);
                })
        }
    },
    mounted:function(){
        this.refresh(this.productCurrentPage);
    },
    inject:["show","hide"],
    data(){
        return {
            
            reason:"",
            isChild:  'id' in this.$route.params,
            
            refresh: function(page=1){
                let _url = `admin/product/list?&page=${page}`;
                if(this.sortable.sortKey!=''){
                    _url = `${_url}&sort_by=${this.sortable.sortKey}&sort_direction=${this.sortable.sortDirection}`
                }
                if(this.perPage && this.perPage.hasOwnProperty('rowsPerPage') && this.perPage.rowsPerPage!=''){
                    _url = `${_url}&per_page=${this.perPage.rowsPerPage}`
                }
                if(this.filterCriteria.length){
                    let __url = _url;
                    // + '&debug=1';
                    this.filterCriteria.forEach((item, index)=>{
                        __url += '&'+Object
                        .keys(item)
                        .map(key => `${encodeURIComponent(key)}[${index}]=${encodeURIComponent(item[key])}`)
                        .join('&');

                        
                    });
                    _url = __url;
                    console.log('__url',__url);
                }
                let that = this;
                api.get(_url).then(data=>data.data).then(response=>{ 

                    let rows = response.data.map(function(obj){
                        obj = {...obj, created_at: that.formatDate(new Date(obj.created_at))};
                        if (obj.status == 1){
                            return {...obj, "actions":[{ViewButton ,props:{id:obj.id ,obj}},  {ApproveButton, props:{id:obj.id}}, {RejectButton, props:{id:obj.id}}]}    
                        }else{
                            return {...obj, "actions":[{ViewButton ,props:{id:obj.id ,obj}}]}
                        }
                        
                    })
                    this.meta = response.meta
                    
                    this.rows = rows;
                    //this.refresh(1);
                })
            },
            categoryTypes:[],
            classes:["table", "table-stripped","table-striped"],
            columns: [
                {'title':'ID', key:'id', sort:{sortable: 'id', direction:-1 }},
                {'title':'Title', key:'title', sort:{sortable: true, direction:-1 }, filter:{filterable:'title', key:'title', type:'text'}},
                {'title':'Date', key:'created_at', sort:{sortable: true, direction:-1 }},
                // {'title':'Date', key:'date'},
                {'title':'Type', key:'saleOptionText', filter:{filterable:'sale_option_id', key:'saleOptionText', type:'select', options:[
                    {key:0,value:"All"},
                    {key:1,value:"toss"},
                    {key:2,value:"donate"},
                    {key:4,value:"recycle"},
                    {key:5,value:"sell"},
                    {key:6,value:"share"}
                    ]}},
                {'title':'Status', key:'statusText', filter:{filterable:'status', key:'title', type:'select', options:[{key:1,value:"Pending"}]}},
                {'title':'User', key:'user.name', filter:{filterable:'user.name', key:'user.name', type:'text'}},
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
        if(!this.checkPermission()){
            this.$router.push('/dashboard');
        } 
            
    },
}
</script>

