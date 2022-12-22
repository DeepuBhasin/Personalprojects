<template>
<div class="row">
    <div class="col-sm-4">
        <label>Name</label>
        <div class="form-control">{{user.name}}</div>
    </div>
    <div class="col-sm-4">
        <label>Email</label>
        <div class="form-control">{{user.email}}</div>
    </div>
    <div class="col-sm-4">
        <label>Phone Number</label>
        <div class="form-control">{{user.phone_number}}</div>
    </div>
</div>
<div>
    <template v-if="user.addresses && user.addresses.length">
    <div class="row">
        <div class="col-12"><h4>Address(s)</h4></div>
    </div>
    <template v-for="address in  user.addresses" :key="address.id">
        
        <fieldset>
        <legend>{{address.name}}</legend>
        <div class="row" >
            <div class="col-sm-4">
                <label>Name</label>
                <div class="form-control">{{address.name}}</div>
            </div>
            <div class="col-sm-4">
                <label>Address</label>
                <div class="form-control">{{address.address}}</div>
            </div>
            <div class="col-sm-4">
                <label>Pin</label>
                <div class="form-control">{{user.pin}}</div>
            </div>
        </div>
        </fieldset>
    </template>
</template>
</div>

<div class="accordion">

    <template v-for="usertype in user.types " :key="usertype.id">
        <div class="accordion__item" >
            <div href="#tab1" @click="tabClicked(usertype.id)" :class="{'accordion__trigger':true, 'accordion__title': true}">{{usertype.role.title}}</div>
            <div id="tab1" :class="{'accordion__content':true, 'open':openedTab==usertype.id && openedTabStatus?true:false}" class="">
            <div class="row">
                    <div class="col-sm-4" v-if="usertype.company && usertype.company.company_name">
                        <label>Company / Organisation Name</label>
                        <div class="form-control">{{usertype.company.company_name}}</div>
                    </div>
                    
                    <div class="col-sm-4" v-if="usertype.company && usertype.company.address">
                        <label>Company Address</label>
                        <div class="form-control" style="min-height: 80px;">{{usertype.company.address}}</div>
                    </div>
                    
                    <div class="col-sm-4" v-if="usertype.company && usertype.company.operation_area">
                        <label>Area Of Operation</label>
                        <div class="form-control">
                            {{usertype.company.operation_areas.map(({city})=>city.name).join(', ')}}
                        </div>
                        
                    </div>
                    <div class="col-sm-4" v-if="usertype.company && usertype.company.average_rate">
                        <label>Average Rate</label>
                        <div class="form-control">&#8377; {{usertype.company.average_rate}}</div>
                    </div>
                    <div class="col-sm-4" v-if="usertype.company && usertype.company.city">
                        <label>City</label>
                        <div class="form-control">{{usertype.company.city?.name}}</div>
                    </div>
                    <div class="col-sm-4" v-if="usertype.company && usertype.company.state">
                        <label>State</label>
                        <div class="form-control">{{usertype.company.state?.name}}</div>
                    </div>
                    <div class="col-sm-4" v-if="usertype.company && usertype.company.country">
                        <label>Country</label>
                        <div class="form-control">{{usertype.company.country?.name}}</div>
                    </div>
                    <div class="col-sm-4" v-if="usertype.company && usertype.company.pin">
                        <label>Pin Code</label>
                        <div class="form-control">{{usertype.company.pin}}</div>
                    </div>
                    <div class="col-sm-4" v-if="usertype.company && usertype.company.gst_number">
                        <label>GST Number</label>
                        <div class="form-control">{{usertype.company.gst_number}}</div>
                    </div>
                    <div class="col-sm-4" v-if="usertype.company && usertype.company.registration_number">
                        <label>Registration Number</label>
                        <div class="form-control">{{usertype.company.registration_number}}</div>
                    </div>
                    <div class="col-sm-12" v-if="usertype.company && usertype.company.description">
                        <label>Description</label>
                        <textarea class="form-control">{{usertype.company.description}}</textarea>
                        <br />
                    </div>


                    <div class="col-sm-12">
                        <div class="row">
                            <template v-if="usertype.company && usertype.company.categories" >
                                
                                <div class="col-sm-4" v-if="usertype.company && usertype.company.company_name">
                                    <strong>Categories</strong><br />
                                    <table class="table">
                                        <tr>
                                        <th>Category</th>
                                        <th>SubCategory</th>
                                        </tr>
                                    
                                    <template v-for="cat in usertype.company.categories" :key="cat.id">
                                        <tr>
                                            <td>
                                                {{cat.category.title}}
                                            </td>
                                            <td>
                                                {{cat.subcategory.title}}
                                            </td>
                                        </tr>
                                    
                                    </template>
                                    </table>

                                </div>
                                    
                            </template>
                            <template v-if="usertype.company && usertype.company.references" >
                                <div class="col-sm-4 pull-right" v-if="usertype.company && usertype.company.company_name">
                                    <strong>References</strong><br />
                                    <table class="table">
                                        <tr>
                                        <th>Name</th>
                                        <th>Phone No.</th>
                                        </tr>
                                    
                                    <template v-for="reference in usertype.company.references">
                                        <tr>
                                            <td>
                                                {{reference.person_name}}
                                            </td>
                                            <td>
                                                {{reference.phone_number}}
                                            </td>
                                        </tr>
                                    
                                    </template>
                                    </table>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="" v-if="usertype.company && usertype.company.uploads">
                    
                    <div class="gallery" >
                        <template v-for="img in usertype.company?.uploads" :key="img.id" >
                            <div class="galleryImg">
                            <img :src="baseURL+'/'+img.filepath" :class="{'img':true}" v-if="['png', 'jpg', 'jpeg', 'gif'].includes(img.filepath.split('.').pop().toLowerCase())" />
                            <a :href="baseURL+'/'+img.filepath" v-else target="_blank" class="rem9"><i :class="[`rem9 fa fa-file-${['docx','doc'].includes(img.filepath.split('.').pop().toLowerCase())?'word-o':img.filepath.split('.').pop().toLowerCase()}`]"  aria-hidden="true"></i></a>
                            <div>{{(img.filepath.split('/')[0].slice(0, -1).charAt(0).toUpperCase()+ img.filepath.split('/')[0].slice(1)).replace(/([a-z](?=[A-Z]))/g, '$1 ')}}</div>
                            </div>
                        </template>
                        
                    </div>
                </div>
            </div>
        </div>
    </template>
    

</div>
</template>
<style scoped>
fieldset {
  background-color: #eeeeee;
}

legend {
  background-color: gray;
  color: white;
  padding: 5px 10px;
}
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
        /*display: grid;  
        grid-template-columns: repeat(8, minmax(10px, 1fr));*/
    }

</style>

<script>
import {api, baseURL} from '@/store/api'
export default {
    props: ["user"],
    computed: {
        baseURL(){
            return baseURL+'storage'
        }
        
    },
    data(){
        return {
            openedTab: 1,
            openedTabStatus: true
        }
    },
    mounted(){
        
    },

    methods: {
        tabClicked(tabid){

            this.openedTab==tabid?this.openedTabStatus=!this.openedTabStatus:this.openedTabStatus=true;
            this.openedTab=tabid;

        }
    }

}

</script>