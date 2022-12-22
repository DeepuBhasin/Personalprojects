<template>
    <br/>
    <input type="text" name="" id="" class="form-control col-md-4" placeholder="Enter Title" @input="getDataAccordingToName">
    <span v-if="pagePermission.view || pagePermission.edit ||  pagePermission.delete || pagePermission.active"></span>
    <span v-else>{{columns[7]=''}}</span>  
    <div class="form-group">
       <table class="table" :ref="tableId">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Sponser</th>
                    <th>Cities</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <draggable v-model="activePromotionList" tag="tbody" item-key="id" @change="moveColumn">
            <template #item="{ element }">
                <tr style="cursor: all-scroll">
                    <td>{{ element.id}}</td>
                    <td>{{ element.title}}</td>
                    <td>{{ element.type}}</td>
                    <td>{{ element.company_name}}</td>
                    <td>{{ element.cities}}</td>
                    <td>{{ element.start_date}}</td>
                    <td>{{ element.end_date}}</td>
                    <td style="width:200px">
                        <template v-for="(btn, i) in element.actions" :key="i">
                            <component :is="btn?.EditButton" v-bind="btn.props"></component>
                            <component :is="btn?.ViewButton" v-bind="btn.props"></component>
                            <component :is="btn?.DeleteButton"  v-bind="btn.props" @click="activeEvent"></component>
                            <component :is="btn?.StatusButton" v-bind="btn.props" @click="activeEvent"></component>
                        </template>
                    </td>
                </tr>
            </template>
            </draggable>    
        </table> 
    </div>
</template>

<script>
import draggable from "vuedraggable";
import ITable from '../../components/ITable/ITable.vue'
import EditButton from '@/Pages/PromotionCampaigns/EditButton.vue';
import ViewButton from '@/Pages/PromotionCampaigns/ViewButton.vue';
import DeleteButton from '@/Pages/PromotionCampaigns/DeleteButton.vue';
import StatusButton from '@/Pages/PromotionCampaigns/StatusButton.vue';
import {mapState } from 'vuex'
import {getRequest, postRequest} from '@/store/api'
import lodash from "lodash";
export default {
  name : 'PromotionCampaigns',
        components: {
        ITable,
        EditButton,
        ViewButton,
        DeleteButton,
        StatusButton,
        draggable
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
    },
    mounted:function(){
        this.refreshdata();
    },
    inject:["show","hide"],
    data(){
        return {
            activePromotionList : [],
            refresh: this.refreshdata(),
            tableId : 'promotionTable',
            positionArray : [],
            serachStatus : false
        }
    },
    methods:{
        getDataAccordingToName:  lodash.debounce(
            async function(e) {
                let title = e.target.value;
                let responseData = await getRequest(`admin/campaign?title=${title}`);
                this.commonnFunction(responseData);
                this.serachStatus = true;

                if(title.length == 0) {
                    this.serachStatus = false;
                }
        }, 300),
        refreshdata : async function(){
            let response = await getRequest('admin/campaign');  
            this.commonnFunction(response); 
            
        },
        activeEvent() {
            setTimeout(()=> {
                this.refreshdata();
            },500)
        },
        commonnFunction(objt) {
            
            this.activePromotionList = objt.map(function(obj){
                let cities = obj.cities.map(element => {
                    return element.city_name.name;
            });
            cities =  (cities.length > 0 ? cities.join(', ') : 'N/A' );
            let type =  obj.type == 0 ? 'Recycle' : 'Donation' ;
            let status =  obj.is_active == 0 ? 'Inactive' : 'Active' ;
            return {...obj, status, type, cities , "actions":[{ViewButton,props:{id:obj.id}},{EditButton,props:{id:obj.id}},{DeleteButton,props:{id:obj.id}},{StatusButton, props:{id:obj.id, obj}}]}
            });

            let positionArrayWithOrderId = objt.map(item => {
                return {
                    id : item.id,
                    order_no : item.order_no
                }
            });
            this.positionArray = positionArrayWithOrderId;
        },
       async moveColumn(e){
            let oTable = this.$refs[this.tableId];
            let data = [...oTable.rows].map(t => [...t.children].map(u => u.innerText));
            if(data.length > 1){
                data = data.splice(1, data.length); 
                data = data.map(i=>i[0])   // getting only ids
                if(this.serachStatus == true ) {
                    for(let i in data) {
                        this.positionArray[i].order_no = data[i];
                    }

                    let userObject = {
                        campaign : JSON.stringify(this.positionArray)
                    }

                    let responseData =  await postRequest('admin/campaign/reordringlocationAfterSearch',userObject);
                    if(responseData.status === 200 || responseData.status === 201) {
                        this.show('Campaign Re-ordered Successfully','success', 3000);
                    } else {
                        this.show(responseData,'error', 3000);
                    }

                } else {
                    let fd = new FormData();
                        data.forEach(item => {
                        fd.append('campaignIds[]', item);
                    });
                    
                    let responseData =  await postRequest('admin/campaign/reOrdering',fd);
                    if(responseData.status === 200 || responseData.status === 201) {
                        this.show('Campaign Re-ordered Successfully','success', 3000);
                    } else {
                        this.show(responseData,'error', 3000);
                    }
                }
            }
        },
        
    },
}
</script>

