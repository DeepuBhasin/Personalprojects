<template>
<div class="content-wrapper" style="min-height: 242px;">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Service Details</h1>
                    
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link to="/">Home</router-link>
                        </li>
                        <li class="breadcrumb-item active">
                            <router-link to="/services">Service Management</router-link>
                        </li>
                        <li class="breadcrumb-item active">View Service</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
        
    <Card class="serviceCardBody">
        <template v-slot:title>
            <h3 class="card-title">Service - {{service?.title}}</h3>
            <span class="pull-right">
                
            </span>
            <!-- <router-link :to="{name:'AddFormBuilder'}"><a class="btn btn-primary btn-sm pull-right" >Create Form </a></router-link>
            
            -->
        </template>
        <template v-slot:body>
            
                <div class="col-sm-8" >
                    <div class="form-group">
                        <label>Title</label>
                        <div class="form-control">{{service?.title}}</div>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-sm-4" >
                    <div class="form-group">
                        <label>Category</label>
                        <div class="form-control">{{service?.category?.title}}</div>
                    </div>
                </div>
                <div class="col-sm-4" >
                    <div class="form-group">
                        <label>Sub Category</label>
                        <div class="form-control">{{service?.subcategory?.title}}</div>
                    </div>
                </div>
                <div class="col-sm-4" >
                    <div class="form-group">
                        <label>Timings</label>
                        <div class="form-control">{{service?.start_time}}-{{service?.end_time}}</div>
                    </div>
                </div>
                <div class="col-sm-4" >
                    <div class="form-group">
                        <label>Address</label>
                        <div class="form-control" style="min-height: 90px;">{{service?.address?.address}},&nbsp;{{service?.address?.city?.name}},&nbsp;{{service?.address?.state?.name}}, &nbsp;{{service?.address?.country?.name}}</div>
                    </div>
                </div>
                <div class="col-sm-4"  style="min-height: 90px;">
                    <div class="form-group">
                        <label>Description</label>
                        <div class="form-control" style="min-height: 90px;">{{service?.description}}</div>
                    </div>
                </div>
                <div class="col-sm-12" >
                    <div class="form-group">
                        <label>Images</label>
                        <div class="gallery" >
                            <template v-for="img in service?.uploads" :key="img.id" >
                                <div class="galleryImg">
                                    <img :src="baseURL+'/'+img.filepath" :class="{'img':true}" v-if="['png', 'jpg', 'jpeg', 'gif'].includes(img.filepath.split('.').pop().toLowerCase())" />
                                    <a :href="baseURL+'/'+img.filepath" v-else target="_blank" class="rem9"><i :class="[`rem9 fa fa-file-${['docx','doc'].includes(img.filepath.split('.').pop().toLowerCase())?'word-o':img.filepath.split('.').pop().toLowerCase()}`]"  aria-hidden="true"></i></a>
                                    <br />{{(img.filepath.split('/')[0].slice(0, -1).charAt(0).toUpperCase()+ img.filepath.split('/')[0].slice(1)).replace(/([a-z](?=[A-Z]))/g, '$1 ')}}
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                
                <br>


                <div class="col-sm-4 customFormService" >
                    <template v-if="service.subcategory && service.subcategory.form">
                        <BuilderView :editId="service?.subcategory?.form?.id" :filledData="service.formdata"></BuilderView>    
                    </template>
                </div>
            
        </template>
    </Card>
    <Modal :status="status" @closeModal="toggleModal({status:false})" :title="'Reason to Reject Service'">
        <form>
            <textarea class="form-control" placeholder="Reason">
            
            </textarea>
        </form>
    </Modal>
</div>


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
       /* display: grid;  
        grid-template-columns: repeat(8, minmax(10px, 1fr)); */
    }
    .card-body{
        padding: 1.25rem !important;
    }

    

</style>



<script>
import Card from "@/components/Card/Card.vue";
import { api, baseURL } from "@/store/api";
import Modal from "@/components/Modal/Modal.vue";
import { mapActions } from "vuex";
import BuilderView from "@/components/BuilderView.vue";

export default {
        computed: {
            baseURL(){
                return baseURL+'storage'
            }
            
        },
        components: {Card, Modal, BuilderView},
        data(){
            return {
                service: {}
            }
        },
        watch: {
            id(to, from){
                console.log("id",to, from)
            },
            status(to, from){
                console.log("visibility",to, from)
            },
        },

        methods(){
            return {...mapActions("modal",["toggleModal"])}
        },
        mounted(){
            console.log("this.$route.params.id",this.$route.params.id)
            let sid = this.$route.params.id;
            api.get(`admin/service/show/${sid}`).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.service = response.data
                    //this.addPlan({Message:response.Message, status: true}); 
                })
        }
}
</script>