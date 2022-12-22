<template>
    <span v-if="pagePermission.view || pagePermission.edit ||  pagePermission.delete || pagePermission.active"></span>
    <span v-else>{{columns[7]=''}}</span>  
    <div class="form-group">
        <ITable :classes="classes" :columns="columns" :rows="rows" :meta="meta" section="product" :dragStatus="false" :perPageLimit="true"></ITable>
    </div>
</template>

<script>
import ITable from '../../components/ITable/ITable.vue'
import EditButton from '@/Pages/PromotionCampaigns/EditButton.vue';
import ViewButton from '@/Pages/PromotionCampaigns/ViewButton.vue';
import DeleteButton from '@/Pages/PromotionCampaigns/DeleteButton.vue';
import StatusButton from '@/Pages/PromotionCampaigns/StatusButton.vue';
import { mapActions, mapState } from 'vuex'
import {api} from '@/store/api'
export default {
  name : 'PromotionCampaigns',
        components: {
        ITable,
        EditButton,
        ViewButton,
        DeleteButton,
        StatusButton
    },
    computed:{

         ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      view :  state.permission?.promotion_campaigns?.includes('view')  ? true : false,
                      edit :  state.permission?.promotion_campaigns?.includes('edit')  ? true : false,
                      delete :  state.permission?.promotion_campaigns?.includes('delete')  ? true : false,
                      block :  state.permission?.promotion_campaigns?.includes('active')  ? true : false,
                      
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
    },
    mounted:function(){
        this.refresh(this.productCurrentPage);
    },
    inject:["show","hide"],
    data(){
        return {
            activePromotion : true,
            inActivePromotion : false,
            reason:"",
            isChild:  'id' in this.$route.params,
            
            refresh: function(page=1){
                let _url = `admin/campaign/pastCampaigns?&page=${page}`;
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
                }
                let that = this;
                api.get(_url).then(data=>data.data).then(response=>{ 
                  
                     let rows = response.data.map(function(obj){
                        let cities = obj.cities.map(element => {
                            return element.city_name.name;
                        });
                        let type =  obj.type == 0 ? 'Recycle' : 'Donation' ;
                        let is_active =  obj.is_active == 0 ? 'Inactive' : 'Active' ;
                        return {...obj,'is_active' : is_active,'type' : type,'cities' : (cities.length > 0 ? cities.join(', ') : 'N/A' ),"actions":[{ViewButton,props:{id:obj.id}},{EditButton,props:{id:obj.id}},{DeleteButton,props:{id:obj.id}},{StatusButton, props:{id:obj.id, obj}}]}
                    });
                    this.meta = response.meta
                    
                    this.rows = rows;
                    //this.refresh(1);
                })
            },
            categoryTypes:[],
            classes:["table", "table-stripped","table-striped",'capital','promotionTable'],
            columns: [
                {'title':'Id', key:'id'},
                {'title':'Title', key:'title'},
                {'title':'Type', key:'type'},
                {'title':'Sponsor', key:'company_name'},
                {'title':'Cities', key:'cities'},
                {'title':'Start Date', key:'start_date'},
                {'title':'End Date', key:'end_date'},
                {'title':'Status', key:'is_active'},
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
    }
}
</script>

