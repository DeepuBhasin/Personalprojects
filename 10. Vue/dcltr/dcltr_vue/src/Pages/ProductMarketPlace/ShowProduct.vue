<template>
<SectionHeader header="Product Detail" :titleBoolen="true">
        <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                <router-link to="/productmarketplace">Product List</router-link>
            </li>
            <li class="breadcrumb-item active">View Product</li>
        </template>
    
        <template v-slot:title >
        
            <h3 class="card-title">Product - {{product?.title}}</h3>
            <span class="pull-right">
                <a class="btn btn-primary btn-xs" v-if="![1].includes(product.sale_option_id)" @click="viewAndSettlePayment(product?.id)">View And Settle Payment</a> &nbsp;
                <a class="btn btn-primary btn-xs" v-if="product.sale_option_id==4" @click="assignBidder(product?.id)">Assign To Recycler</a> &nbsp;
                <!-- <a class="btn btn-primary btn-xs" v-if="product.sale_option_id==4" @click="markPaid(product?.id)">Mark As Paid</a> &nbsp; -->
                <a class="btn btn-success btn-xs" v-if="product.sale_option_id==2" @click="assignCharity(product?.id)">Assign To Charity Organization</a> &nbsp;
                <!-- <a class="btn btn-info btn-xs" v-if="product.sale_option_id==2" @click="assignScrapDealer(product?.id)">Assign To Scrap Dealer</a> -->
            </span>
            &nbsp;&nbsp;
            
            <span class="badge badge-warning">{{product.saleOptionText}} - {{product.sale_option_id}}</span>&nbsp;&nbsp;
            <span class="badge badge-success">{{product.statusText}}<small>{{product.reject_reason}}</small></span>
            
            <!-- <router-link :to="{name:'AddFormBuilder'}"><a class="btn btn-primary btn-sm pull-right" >Create Form </a></router-link>
            
            -->
        </template>
        <template v-slot:body>
                <!-- {{product}} -->
                <div class="row">
                    <div class="col-sm-8" >
                        <div class="form-group">
                            <label>Title</label>
                            <div class="form-control">{{product?.title}}</div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right" v-if="product?.price && product.price>0">
                        <h3 style="margin-top: 26px;font-weight: bold;background-color: #ffc107;color: #000;display: inline-block;padding: 2px 10px;border: 0px none;border-radius: 5px;min-width: 80px;">&#x20b9 {{product?.price}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4" >
                        <div class="form-group">
                            <label>Category</label>
                            <div class="form-control">{{product?.category?.title}}</div>
                        </div>
                    </div>
                    <div class="col-sm-4" >
                        <div class="form-group">
                            <label>Sub Category</label>
                            <div class="form-control">{{product?.subcategory?.title}}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4" >
                        <div class="form-group">
                            <label>Address</label>
                            <div class="form-control" style="min-height: 90px;">{{product?.address?.address}},&nbsp;{{product?.address?.city?.name}},&nbsp;{{product?.address?.state?.name}}, &nbsp;{{product?.address?.country?.name}}</div>
                        </div>
                    </div>
                    <div class="col-sm-4" >
                        <div class="form-group">
                            <label>Description</label>
                            <div class="form-control" style="min-height: 90px;">{{product?.description}}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                     <div class="col-sm-4" >
                        <div class="form-group">
                            <label>Timings</label>
                            <div class="form-control" v-if="product?.start_time">{{product?.start_time}}-{{product?.end_time}}</div>
                            <div class="form-control" v-if="product?.time_slots && product.time_slots.length>0">
                             {{product.time_slots[0]['date']}}

                                <div v-for="timing in product.time_slots" :key="timing.date">{{timing?.start_time}}&nbsp;&nbsp;-&nbsp;&nbsp;{{timing?.end_time}}</div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Images</label>
                            <div class="gallery">
                                <template v-for="img in product?.uploads" :key="img.id" >
                                    <div class="galleryImg">
                                        <img :src="baseURL+'/../'+img.filepath" :class="{'img':true}" v-if="['png', 'jpg', 'jpeg', 'gif'].includes(img.filepath.split('.').pop().toLowerCase())" />
                                        <a :href="baseURL+'/'+img.filepath" v-else target="_blank" class="rem9"><i :class="[`rem9 fa fa-file-${['docx','doc'].includes(img.filepath.split('.').pop().toLowerCase())?'word-o':img.filepath.split('.').pop().toLowerCase()}`]"  aria-hidden="true"></i></a>
                                        <br />{{(img.filepath.split('/')[0].slice(0, -1).charAt(0).toUpperCase()+ img.filepath.split('/')[0].slice(1)).replace(/([a-z](?=[A-Z]))/g, '$1 ')}}
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8 customFormService">                        
                        <template v-if="product.subcategory && product.subcategory.form">
                            <BuilderView :editId="product?.subcategory?.form?.id" :filledData="product.formdata"></BuilderView>    
                        </template>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-sm-12"> 
                        <div class="form-group">
                            <label >Assigned Users</label>
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Assigned On</th>
                                    <th>Status</th>
                                    <th>Bid Amount</th>
                                    <th >Action</th>
                                </tr>
                                <template v-for="bid in product?.bids_for_admin" :key="bid.id" >
                                    <tr>
                                        <td>{{bid.user.name}}</td>
                                        <td>{{this.formatDate(new Date(bid.created_at))}}</td>
                                        <td>{{bid.statusText}}</td>
                                        <td>&#x20b9 {{bid.total_amount}}</td>
                                        
                                        <td v-if="bid.total_amount>0 && bid.status==-1">
                                            <a class="btn btn-xs btn-primary" @click="acceptBid(bid.id)">Accept</a>
                                        </td>
                                        <td v-if="bid.total_amount>0 && bid.status==1">
                                            <label>Waiting for payment</label>
                                        </td>
                                        <td v-if="bid.status==2">
                                            <a class="btn btn-xs btn-primary" @click="assignProductTo(bid.id)">Assign Product</a>
                                        </td>
                                        <td v-else-if="bid.status==3">
                                            <a class="btn btn-xs btn-success" @click="refund()">Refund</a>
                                        </td>
                                        <td v-else-if="bid.status==6">
                                            <a class="btn btn-xs btn-primary" v-if="product.sale_option_id==4" @click="assignIA()">Assign I.A.</a>
                                            <a class="btn btn-xs btn-secondary" @click="assignDA()">Assign D.A.</a>
                                            
                                        </td>
                                        <td v-else>
                                        </td>
                                    </tr>
                                </template>
                            </table>

                        </div>
                     </div>
                </div>
               

                
                
                
               
                
               
                
                    
                <Modal :status="status" v-if="type == 'rejectProduct'" @closeModal="toggleModal({status:false})" :title="'Reason to Reject Service'">
                    <form>
                        <textarea class="form-control" placeholder="Reason">
                        
                        </textarea>
                    </form>
                </Modal>
                <Modal :status="status" v-if="type == 'assignBidderModal'" @closeModal="toggleModal({status:false})" :title="'Assign Recyclers'">
                    <form @submit.prevent="assignBidders">
                        <div class="form-control">
                            <table class="table">
                                <tr>
                                    <th>Select</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                                <tr v-for="bidder in bidders" :key="bidder.id">
                                    <td><input type="checkbox" :value="bidder.id" v-model="selectedBidders" :checked="selectedBidders.includes(bidder.id)"/></td>
                                    <td>{{bidder.name}}</td>
                                    <td>{{bidder.email}}</td>
                                </tr>
                            </table>
                        </div>
                        <!-- <div class="form-control">
                            <label>Amount to be deducted!</label>
                            <input type="number" v-model="amountToBeDeducted" required class="form-control" placeholder="Amount to be deducted by Admin" />
                        </div> -->
                        <!-- <div class="form-control">
                            <label>Any Message to Bidder</label>
                            <textarea required class="form-control" v-model="messageToAssign" placeholder="Message"></textarea>
                        </div> -->
                        <button type="submit" class="btn btn-primary btn-xs">Submit</button>
                        
                    </form>
                </Modal>
                <Modal :status="status" v-if="type == 'assignCharityModal'" @closeModal="toggleModal({status:false})" :title="'Assign Charity Organizations'">
                            <form @submit.prevent="assignBidderSingle">
                        <div class="form-control">
                            <table class="table">
                                <tr>
                                    <th>Select</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                                <tr v-for="bidder in bidders" :key="bidder.id">
                                    <td><input type="radio" :checked="selectedBidders.includes(bidder.id)" name="dealer_id" @input="assignSelectedBidder(bidder.id)" :value="bidder.id" v-model="selectedBidder"/></td>
                                    <td>{{bidder.name}}</td>
                                    <td>{{bidder.email}}</td>
                                </tr>
                            </table>
                        </div>
                        <!-- <div class="form-control">
                            <label>Amount to be deposited!</label>
                            <input type="number" v-model="amountToBeDeducted" required class="form-control" placeholder="Amount to be deducted by Admin" />
                        </div> -->
                        <!-- <div class="form-control">
                            <label>Any Message to Bidder</label>
                            <textarea required class="form-control" v-model="messageToAssign" placeholder="Message"></textarea>
                        </div> -->
                        <!-- <button type="submit" class="btn btn-primary btn-xs">Submit</button> -->
                        
                    </form>
                </Modal>
                <Modal :status="status" v-if="type == 'assignScrapDealerModal'" @closeModal="toggleModal({status:false})" :title="'Assign Scrap Dealers'">
                    <form @submit.prevent="assignBidderSingle">
                        <div class="form-control">
                            <table class="table">
                                <tr>
                                    <th>Select</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                                <tr v-for="bidder in bidders" :key="bidder.id">
                                    <td><input type="radio"  name="dealer_id" @input="setSelectedBidder(bidder.id)" :value="bidder.id" v-model="selectedBidder"/></td>
                                    <td>{{bidder.name}}</td>
                                    <td>{{bidder.email}}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- <div class="form-control">
                            <label>Any Message to Bidder</label>
                            <textarea required class="form-control" v-model="messageToAssign" placeholder="Message"></textarea>
                        </div> -->
                        <button type="submit" class="btn btn-primary btn-xs">Submit</button>
                        
                    </form>
                </Modal>
                <Modal :status="status" v-if="type == 'assignIAModal'" @closeModal="toggleModal({status:false})" :title="'Assign Inspection Agent'">
                    <form @submit.prevent="assignIA">
                        <div class="form-control">
                            <table class="table">
                                <tr>
                                    <th>Select</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                                <tr v-for="agent in agents" :key="agent.id">
                                    <td><input type="radio"  @input="setSelectedBidder(agent.id)"  name="dealer_id" :value="agent.id" v-model="selectedAgents"/></td>
                                    <td>{{agent.name}}</td>
                                    <td>{{agent.email}}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- <div class="form-control">
                            <label>Any Message to Bidder</label>
                            <textarea required class="form-control" v-model="messageToAssign" placeholder="Message"></textarea>
                        </div> -->
                        <!-- <button type="submit" class="btn btn-primary btn-xs">Submit</button> -->
                        
                    </form>
                </Modal>
                <Modal :status="status" v-if="type == 'assignDAModal'" @closeModal="toggleModal({status:false})" :title="'Assign Delivery Agent'">
                    <form @submit.prevent="assignIA">
                        <div class="form-control">
                            <table class="table">
                                <tr>
                                    <th>Select</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                                <tr v-for="agent in agents" :key="agent.id">
                                    <td><input type="radio"  @input="setSelectedBidderDA(agent.id)"  name="dealer_id" :value="agent.id" v-model="selectedAgents"/></td>
                                    <td>{{agent.name}}</td>
                                    <td>{{agent.email}}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- <div class="form-control">
                            <label>Any Message to Bidder</label>
                            <textarea required class="form-control" v-model="messageToAssign" placeholder="Message"></textarea>
                        </div> -->
                        <!-- <button type="submit" class="btn btn-primary btn-xs">Submit</button> -->
                        
                    </form>
                </Modal>
                <Modal :status="status" v-if="type == 'viewAndSettlement'" @closeModal="toggleModal({status:false})" :title="'View And Settle Payments'">
                    
                    <template v-if="(product.bids_for_admin)?.filter(item=>item.status==6).length">
                    
                        <ViewAndSettlePayment :product_id="product?.id" @closeModal="toggleModal({status:false})"></ViewAndSettlePayment>
                    </template>
                    <!-- <template>
                        <ViewAndSettlePayment :product_id="product?.id"></ViewAndSettlePayment>
                    </template> -->
                    
                </Modal>
               
                
            
        </template>
        
        

</SectionHeader>
</template>

<style scoped>
    .accordion{
        position: relative;
        display: block;
        background-color: white;
        border: 1px solid #e0e0e0;
    }
    .accordion__item {
        display:block;
    }
    
    .accordion__content {
        /*display:block;
        padding: 0;
        height: 0;*/
        overflow:hidden;
        transition: height 0.5s ease, padding 0.3s linear;
    }
    /*.accordion .accordion__content div{
        padding: 0 30px;
        margin: 0;
    }*/
    .accordion .accordion__content:target{
        height: 150px;  
    }
    
    .open{
        min-height: 400px;  
    }
    img{
        width: 100px;
    }
    rem9{
        font-size: 9rem !important;
    }
    .gallery{
        display: grid;  
        grid-template-columns: repeat(8, minmax(10px, 1fr));
    }

</style>



<script>
import { api, baseURL, getRequest, putRequest } from "@/store/api";
import Modal from "@/components/Modal/Modal.vue";
import Card from "@/components/Card/Card.vue";
import { mapActions, mapState } from "vuex";
import BuilderView from "@/components/BuilderView.vue";
import ViewAndSettlePayment from "@/components/ViewAndSettlePayment.vue";

export default {
        computed: {
            ...mapState('modal',["status","id", "type", "form"]),
            baseURL(){
                return baseURL+'storage'
            }
            
        },
        components: { Card, Modal, BuilderView, ViewAndSettlePayment },
        inject:["show","hide"],
        data(){
            return {
                product: {},
                bidders: {},
                agents: {},
                pid:0,
                selectedBidders: [],
                processedDates:[],
                selectedBidder: false,
                messageToAssign:"",
                amountTbBeDeducted: 0
            }
        },
        watch: {
            id(to, from){
                console.log("id",to, from)
            },
            status(to, from){
                console.log("visibility",to, from)
            },
            type(to, from){
                console.log("type",to, from)
            },
        },

        methods: {
            ...mapActions("modal",["toggleModal"]),
            setSelectedBidder(_partnerId){
                // console.log("Saving Assigned Patner", e.target.value);
                // let _partnerId = e.target.value;
                let pid = this.$route.params.id;
                api.get(`admin/assignPartner/${pid}/${_partnerId}`).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.agents = response.data
                })
            },
            setSelectedBidderDA(_partnerId){
                // console.log("Saving Assigned Patner", e.target.value);
                // let _partnerId = e.target.value;
                let pid = this.$route.params.id;
                api.get(`admin/assignDeliveryPartner/${pid}/${_partnerId}`).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.agents = response.data
                })
            },
            assignSelectedBidder(bidId){
                // console.log("Saving Assigned Patner", e.target.value);
                // let _partnerId = e.target.value;
                let pid = this.$route.params.id;
                api.get(`admin/assignSelectedBidder/${pid}/${bidId}`).then(data=>data.data).then(response=>{
                    console.log("Here is assigned to charity response", response.message); 
                    this.show(response.message, "success", 2000);
                    this.toggleModal({status:false});
                    this.refreshProduct()
                })
            },
            formatDate(date){
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
            getUserByRole(){
                api.get(`admin/product/show/${sid}`).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.product = response.data
                    //this.addPlan({Message:response.Message, status: true}); 
                })
            },
            viewAndSettlePayment(pid){
                this.toggleModal({status:true, type:'viewAndSettlement', id: this.id })
            },
            assignBidder(pid){
                let that = this;
                this.pid = pid;
                api.get(`admin/product/show/${pid}`).then(data=>data.data).then(_response=>{ 
                    
                    this.product = _response.data
                    
                    this.selectedBidders = this.product.bids_for_admin.map((i,j)=>i.user.id)
                    console.log("here is selectedBidders", this.selectedBidders)
                    api.get(`admin/product/getRelatedUsers/${pid}`).then(data=>data.data).then(response=>{ 
                        console.log("Response of Add Scubscription", response)  
                        this.bidders = response
                        console.log("Bidder", this.bidders);
                        
                        //this.addPlan({Message:response.Message, status: true}); 
                    })
                    //this.addPlan({Message:response.Message, status: true}); 
                })
                
                this.type = 
                this.toggleModal({status:true, type:'assignBidderModal', id: this.id })
            },
            assignIA(bidid){
                let that = this;
                
                api.get(`admin/adminList/IA`).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.agents = response.data
                    // console.log("Bidder", this.bidders);
                    // that.selectedAgents = this.bidders.map((i,j)=>i.id)
                    //this.addPlan({Message:response.Message, status: true}); 
                })
                this.type = 
                this.toggleModal({status:true, type:'assignIAModal', id: this.id })
            },
            assignProductTo(bidid){
                api.get(`admin/assignProductTo/${bidid}`).then(data=>data.data).then(response=>{ 
                    console.log("Response of assignProductTo", response.data)  
                    this.refreshProduct();
                })
            },
            acceptBid(bidid){
                api.get(`admin/acceptBid/${bidid}`).then(data=>data.data).then(response=>{ 
                    console.log("Response of assignProductTo", response.data)  
                    this.refreshProduct();
                })
            },
            markPaid(bidid){
                api.get(`admin/markPaid/${bidid}`).then(data=>data.data).then(response=>{ 
                    console.log("Response of markPaid", response.data)  
                })
            },
            assignDA(bidid){
                let that = this;
                
                api.get(`admin/adminList/DA`).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.agents = response.data
                    // console.log("Bidder", this.bidders);
                    // that.selectedAgents = this.bidders.map((i,j)=>i.id)
                    //this.addPlan({Message:response.Message, status: true}); 
                })
                this.type = 
                this.toggleModal({status:true, type:'assignDAModal', id: this.id })
            },

            assignBidders(data){
                let that = this;
                // let users = this.selectedBidders.map((key, item)=> { console.log('key--->',key, 'item-->',item); if(key!=null && key){ return item; } } )
                // console.log("Assign Bidders called", users)
                let dataToBePosted = {};
                dataToBePosted['message'] = this.messageToAssign 
                dataToBePosted['pid'] = this.pid 
                dataToBePosted['amount_to_be_deducted'] = this.amountToBeDeducted 
                dataToBePosted['selected_users'] = this.selectedBidders;
                //.map((key, item)=> { console.log('key--->',key, 'item-->',item); if(key!=null && key){ return item; } } ).filter(Number);

                api.post(`admin/product/saveRelatedUsers/${this.pid}`, dataToBePosted).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.show(response.message, "success", 2000)
                    this.toggleModal({status:false});
                    console.log("Bidder", this.bidders);
                    //this.addPlan({Message:response.Message, status: true}); 
                })
            },
            assignBidderSingle(data){
                // let users = this.selectedBidders.map((key, item)=> { console.log('key--->',key, 'item-->',item); if(key!=null && key){ return item; } } )
                // console.log("Assign Bidders called", users)
                let dataToBePosted = {};
                dataToBePosted['message'] = this.messageToAssign 
                dataToBePosted['pid'] = this.pid 
                dataToBePosted['amount_to_be_deducted'] = this.amountToBeDeducted 
                dataToBePosted['selected_users'] = this.selectedBidder;
                //.map((key, item)=> { console.log('key--->',key, 'item-->',item); if(key!=null && key){ return item; } } ).filter(Number);

                api.post(`admin/product/saveRelatedUsers/${this.pid}`, dataToBePosted).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.show(response.message, "success", 2000)
                    this.toggleModal({status:false});
                    console.log("Bidder", this.bidders);
                    //this.addPlan({Message:response.Message, status: true}); 
                })
            },
            assignCharity(pid){ 
                this.pid = pid;
                this.selectedBidders = this.product.bids_for_admin.map((i,j)=>i.user.id)
                api.get(`admin/product/getRelatedUsers/${pid}`).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.bidders = response
                    console.log("Bidder", this.bidders);
                    //this.addPlan({Message:response.Message, status: true}); 
                })   
                this.type = 
                this.toggleModal({status:true, type:'assignCharityModal', id: this.id })
            },
            refreshProduct(){
                let sid = this.$route.params.id;
                api.get(`admin/product/show/${sid}`).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.product = response.data
                    //this.addPlan({Message:response.Message, status: true}); 
                })
            },
            assignScrapDealer(pid){
                let that = this;
                this.pid = pid;
                api.get(`admin/product/getRelatedUsers/${pid}`).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.bidders = response
                    this.bidders.forEach(function(item){
                        console.log("Bidder Item->", (item.bids).length)
                        if(item.bids.length){
                            console.log("this.selectedBidders",that.selectedBidders)
                            that.selectedBidders = item.id;
                        }
                    });
                    console.log("Bidder", this.bidders);
                    //this.addPlan({Message:response.Message, status: true}); 
                })
                this.type = 
                this.toggleModal({status:true, type:'assignScrapDealerModal', id: this.id })
            },
        },
        async mounted(){
            let sid = this.$route.params.id;
            let notificationId = this.$route.params.notificationId;
            this.product = await getRequest(`admin/product/show/${sid}`);
            putRequest(`admin/markNotificationAsRead/${notificationId}`);
        }
}
</script>