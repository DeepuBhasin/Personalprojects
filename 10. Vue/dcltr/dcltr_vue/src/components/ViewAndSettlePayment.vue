<template>
<span>
        
    <table class="table">
        <tr>
            <th>Profile</th>
            <th>Context</th>
            <th>Name</th>
            <th>Amount/Chages</th>
            <th>Action</th>
        </tr>
        <tr v-if="![2,6].includes(product?.sale_option_id)">
            <th><a class="btn btn-warning btn-xs">Bidder</a></th>
            <th>
                Approved Bid Amount
            </th>
            <th >
                <span v-if="(product.bids_for_admin)?.filter(item=>item.status==6).length">
                    {{(product.bids_for_admin)?.filter(item=>item.status==6)[0]['user']['name']}}
                </span>
                <span v-else>N/A</span>
                
            </th>
            <th>
                <span v-if="(product.bids_for_admin)?.filter(item=>item.status==6).length">
                    &#x20B9;{{(product.bids_for_admin)?.filter(item=>item.status==6)[0]['bid_amount']}}
                </span>
                <span v-else>N/A</span>
                
            </th>
            <th>
                
            </th>
        </tr>
        <tr v-if="![2,6].includes(product?.sale_option_id)">
            <th><a class="btn btn-warning btn-xs">Inspection Agent</a></th>
            <th>
                Charges 
            </th>
            <th>
                <template v-if="product?.ia?.length">
                    
                    <label>{{product['ia'][0]['name']}}</label>
                </template>
                <span v-else>N/A</span>
            </th>
            <th>
                &#x20B9;{{settingsData?.filter(item=>item.title=='inspection_charges')[0]?.value}}
            </th>
            <th>
                <template v-if="product?.ia?.length">
                    <a class="btn btn-xs btn-success" v-if="product['ia'][0]['bank_detail']">Pay Now</a>
                    <label v-else>No Bank Details Available</label>
                </template>
                <label v-else>No Inspection Agent Assigned</label>
            </th>
        </tr>
        <tr v-if="![2,6].includes(product.sale_option_id)">
            <th><a class="btn btn-warning btn-xs">Seller</a></th>
            <th>
                Amount To Be Paid To Seller
            </th>
            <th>
                <template v-if="product?.user">
                    
                    <label>{{product['user']['name']}}</label>
                </template>
            </th>
            <th>
                <span v-if="product.sale_option_id==4 && (product.bids_for_admin)?.filter(item=>item.status==6).length">
                    &#x20B9;{{parseFloat((product.bids_for_admin)?.filter(item=>item.status==6)[0]['bid_amount'])-parseFloat(settingsData?.filter(item=>item.title=='inspection_charges')[0]?.value)}}
                </span>
                <span v-else-if="[5].includes(product.sale_option_id) && (product.bids_for_admin)?.filter(item=>item.status==6).length">
                    &#x20B9;{{parseFloat((product.bids_for_admin)?.filter(item=>item.status==6)[0]['bid_amount'])}}
                </span>
               
                <span v-else>N/A</span>
                
            </th>
            <th>
                <span v-if="!(product.bids_for_admin)?.filter(item=>item.status==6).length">
                    No Approved Bid
                </span>
                <span v-else-if="processing">
                    Please Wait
                </span>
                
                <span v-else>
                    <a v-if="[4].includes(product.sale_option_id) && product?.user?.bank_detail  && !processing && !underProcessingFor(2)" @click="payNow(product.user, 'Pay-Seller-For-Recycle')" class="btn btn-xs btn-success">Pay Now</a>
                    <a v-else-if="[5].includes(product.sale_option_id) && product?.user?.bank_detail  && !processing && !underProcessingFor(2)" @click="payNow(product.user, 'Pay-Seller')" class="btn btn-xs btn-success">Pay Now</a>
                    <label v-else-if="product?.user?.bank_detail  && underProcessingFor(2)"><a class="btn btn-xs btn-primary" @click="goTo('Transactions')">View Transaction(s)</a></label>
                    <label v-else>No Bank Details Available </label>
                </span>
            </th>
        </tr>
        <tr v-if="![2,6].includes(product.sale_option_id)">
            <th><a class="btn btn-warning btn-xs">Bidder</a></th>
            <th>
                Margin To Be Paid To Bidder
            </th>
            <th>
                {{(product.bids_for_admin)?.filter(item=>item.status==6)[0]['user']['name']}}
            </th>
            <th>
                 <span v-if="product.sale_option_id==5 && product.margin>0">
                    &#x20B9;{{parseFloat(product.margin)}}
                </span>
               
                <span v-else>N/A</span>
                
            </th>
            <th>
                <span v-if="!(product.bids_for_admin)?.filter(item=>item.status==6).length">
                    No Approved Bid
                </span>
                <span v-else-if="processing">
                    Please Wait
                </span>
                <span v-else>
                    <a v-if="!processing && bidder?.bank_detail && !underProcessingFor(3)" @click="payNow(bidder, 'Pay-Bidder')" class="btn btn-xs btn-success">Pay Now</a>
                    <label v-else-if="underProcessingFor(3) && bidder.bank_detail"><a class="btn btn-xs btn-primary" @click="goTo('Transactions')">View Transaction(s)</a></label>
                    <label v-else>No Bank Details Available </label>
                </span>
            </th>
        </tr>
        <tr >
            <th><a class="btn btn-warning btn-xs">Delivery Agent</a></th>
            <th>
                Amount To Be Paid To Delivery Agent
            </th>
            <th>
                <template v-if="product?.da?.length">
                    
                    <label>{{product['ia'][0]['name']}}</label>
                </template>
                <span v-else>N/A</span>
            </th>
            <th>

                &#x20B9;{{getCharges(product)}}
            </th>
            <th>
                <template v-if="product?.da?.length">
                    <a class="btn btn-xs btn-success" v-if="product['da'][0]['bank_detail']">Pay Now</a>
                    <label v-else>No Bank Details Available</label>
                </template>
                <label v-else>No Delivery Agent Assigned</label>
            </th>
        </tr>            
    </table>
</span>
</template>
<script>
import { api, baseURL } from "@/store/api";
import {mapState, mapActions} from "vuex";
export default {
    name: "ViewAndSettlePayment",
    computed: {
        ...mapState('modal',["status","id", "type", "form"]),
        bidder(){
            let _bidder = (this.product.bids_for_admin).filter(item=>item.status==6)[0]['user']
            console.log("am bidder", _bidder)
            return _bidder;
        }
    },
    watch: {
        status(to, from){
                api.get(`admin/product/show/${this.product_id}`).then(data=>data.data).then(response=>{ 
                    
                    this.product = response.data
                    console.log("<---", this.product.sale_option_id)  
                    //this.addPlan({Message:response.Message, status: true}); 
                })
            console.log("Settle Pay status",to, from)
        },
        type(to, from){
            console.log("Settle Pay type",to, from)
        },
    },
    props: {
       product_id:Number
    },
    data(){
        return {
            
            title:"",
            formTitle:"",
            elementsArr:[],
            // status:false,
            product:{},
            settingsData:[],
            processing: false
        }
    },
    
    inject:["show","hide"],
    mounted(){
        console.log("this.editId--->",this.product_id)
        
        api.get("/admin/generalSetting").then((response) => {
            console.log("this.generalSetting--->",response)
            if (response.status == 200) {
                this.settingsData = response.data.data;
            }
        });
        api.get(`admin/product/show/${this.product_id}`).then(data=>data.data).then(response=>{ 
            console.log("Response of Add Scubscription", response)  
            this.product = response.data
            //this.addPlan({Message:response.Message, status: true}); 
        })

        
    },
    methods: {
        ...mapActions("modal",["toggleModal"]),
        getCharges(product){
            let fProduct = (product.bids_for_admin)?.filter(item=>item.status==6);
            if(typeof fProduct!= "undefined" && fProduct.length){
                return fProduct[0]['charges'];
            }
            else{
                return 0
            }
            
        },
        goTo(page){
            this.toggleModal({status:false});
            let approvedBid = (this.product.bids_for_admin)?.filter(item=>item.status==6)[0];
            let order_id = approvedBid.order.id;
            let resolved = this.$router.push({name:page,params:{id:order_id}})
            console.log("resolved",resolved);
        },
        underProcessingFor(status){
            let approvedBid = (this.product.bids_for_admin)?.filter(item=>item.status==6)[0];
            
            let underProcessingForData = approvedBid.order.payments.filter(item=>item.payment_type==status);
            //console.log("underProcessingForData==>",underProcessingForData);
            return underProcessingForData.length?true:false;
            
            
        },
        payNow(user, type){
            
            if (!this.processing) {
                this.processing = true
            }
            let amount = 0;
            let payment_type = 0;
            let paid_to = user.id;
            let purpose = "payout";
            let notes = "";
            let fund_account = user.bank_detail.fund_account;
            //let fund_account = 'xxx';
            
            let approvedBid = (this.product.bids_for_admin)?.filter(item=>item.status==6)[0];
            let order_id = approvedBid.order.id;
            switch (type) {
                case 'Pay-Seller-For-Recycle':
                    amount = parseFloat(approvedBid['bid_amount'])-parseFloat(this.settingsData?.filter(item=>item.title=='inspection_charges')[0]?.value)
                    payment_type = 2;
                    notes="Paying To Seller";
                    
                    break;
                case 'Pay-Seller':
                    amount = parseFloat(approvedBid['bid_amount'])
                    payment_type = 2;
                    notes="Paying To Seller";
                    
                    break;
                case 'Pay-Bidder':
                    amount = parseFloat(this.product.margin)
                    payment_type = 3;
                    notes="Paying To Bidder Margin Amount";
                    paid_to = this.bidder.id;
                    fund_account = this.bidder.bank_detail.fund_account;
                    
                    break;
            
                default:
                    break;
            }
            let dataToPost = {
                amount,
                payment_type,
                paid_to,
                purpose,
                notes,
                fund_account,
                order_id
            }
            
            
            
            
            console.log('dataToPost->',dataToPost);

            api.post("/admin/payment/paynow",dataToPost).then((response) => {
                console.log("Here is response", response)
                this.show(response.data.message, "success", 2000)
                this.processing = false
                this.toggleModal({status:false})
            });
        }

         
    }
}
</script>