<template>
    <form @submit.prevent="saveForm()">
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            
            <input type="text" required v-model="name" class="form-control"  id="exampleInputEmail1" placeholder="Enter Title">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Amount</label>
            
            <input type="number" required v-model="amount" class="form-control"  id="exampleInputEmail1" placeholder="Enter Amount">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">No. Of Leads</label>
            
            <input type="number" required v-model="no_of_leads" class="form-control"  id="exampleInputEmail1" placeholder="Enter Number Of Leads">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Carry Forward Leads</label>
            
            <div class="custom-control custom-switch">
                <input type="checkbox" :class="'custom-control-input'" id="customSwitch1"  v-model="is_lead_carry_over">
                <label class="custom-control-label" for="customSwitch1"></label>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Plan Validity</label>
            
            <input type="number" required v-model="days" min="7" max="365" class="form-control"  id="exampleInputEmail1" placeholder="Enter Plan Validity">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Plan Level</label>
            
            <input type="number" required v-model="levels" min="1" max="5" class="form-control"  id="exampleInputEmail1" placeholder="Enter Plan Level">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</template>
<script>
import { api } from '@/store/api';
import { mapState, mapActions } from 'vuex';
function initialState(){
    return {
        name: '',
        amount: Number,
        no_of_leads: Number,
        is_lead_carry_over: false,
        days: Number,
        levels: Number,
    }
}
export default {
    props:["id"],
    computed:{
        ...mapState(['actionTaken'])
    },
    watch:{
        id: function(to, from){
            console.log("ID changed", to, from)
            if(typeof to != "undefined" && to){
                api.get(`admin/subscription/${to}`).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.name = response.data.name;
                    this.amount = response.data.amount;
                    this.no_of_leads = response.data.no_of_leads;
                    this.days = response.data.days;
                    this.levels = response.data.levels;
                    this.is_lead_carry_over = (response.data.is_lead_carry_over=="1" || response.data.is_lead_carry_over=="true") ? true : false;
                    //this.addPlan({Message:response.Message, status: true}); 
                })
            }
        }
    },
    data(){
        return initialState()
    },
    methods: {
        ...mapActions("helpers",["addPlan", "refreshForm"]),
        resetForm(){
            Object.assign(this.$data, initialState());
        },

        saveForm(){
            let dataToPost = {
                name: this.name, 
                amount: this.amount, 
                no_of_leads: this.no_of_leads, 
                is_lead_carry_over: this.is_lead_carry_over, 
                days: this.days,
                levels: this.levels
            }
            if(typeof this.id != "undefined" && this.id){
                api.put(`admin/subscription/${this.id}`,dataToPost)
                .then(data=>{console.log('data-->',data); return data.data})
                .then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.addPlan({message:response.message, status: true}); 
                })
            }
            else{
                api.post(`admin/subscription`,dataToPost)
                .then(data=>{console.log('data-->',data); return data.data})
                .catch(err=>{ this.refreshForm({data:{status:true, type:'error', message:"Invalid Data"}}); console.log('err-->',err.response.data.message);})
                .then(response=>{ 
                    this.resetForm();
                    console.log("Response of Add Scubscription", response)  
                    this.addPlan({message:response.message, status: true}); 
                })
            }
            console.log("Form Submitted", );
        }
    },
    mounted(){
        console.log("This is to edit id",this.id);
        api.get(`admin/subscription/${this.id}`).then(data=>data.data).then(response=>{ 
            console.log("Response of Add Scubscription", response)  
            this.name = response.data.name;
            this.amount = response.data.amount;
            this.no_of_leads = response.data.no_of_leads;
            this.days = response.data.days;
            this.levels = response.data.levels;
            this.is_lead_carry_over = (response.data.is_lead_carry_over=="1" || response.data.is_lead_carry_over=="true") ? true : false;
            //this.addPlan({Message:response.Message, status: true}); 
        })
        
    }

}
</script>