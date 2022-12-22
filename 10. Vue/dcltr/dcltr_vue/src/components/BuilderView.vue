<template>

<div id='builder'>

    <form method="post" @submit.prevent="saveFormData()" class="formBuilderEdit">


        <template v-for="(elm,index) in elementsArr" >
            <div class="form-group" v-if="elm.type=='text'" :key="index">
                <label>{{elm.title || "title"}}</label>
                <input type="text" :value="getTextValue(elm)" :placeholder="elm.placeholder" class="form-control" name="key"  />
               
                <!-- {{elm}} -->
            </div>
            <div class="form-group" v-if="elm.type=='select'" :key="index">
                <label>{{elm.title || "title"}}</label>
                <select name="key"  class="form-control" v-model="formattr[elm.name]">
                    <option>Select Box</option>
                    <template v-for="(op, i) in elm.options" :key="i">
                        <option :selected="getSelectedOpt(elm,op)?'selected':''" >{{op.value}}</option>
                    </template>
                    

                </select>
                <!-- {{elm}} -->
            </div>
            <div class="form-group" v-if="elm.type=='file' && typeof getImagePath(elm)!='undefined'" :key="index" >
                <label>{{elm.title || "title"}}</label>
                <img :src="baseURL+'/../'+getImagePath(elm)" :class="{'img':true}" v-if="['png', 'jpg', 'jpeg', 'gif'].includes(getImagePath(elm).split('.').pop().toLowerCase())" />
                <a :href="baseURL+'/'+getImagePath(elm)" v-else target="_blank" class="rem9"><i :class="[`rem9 fa fa-file-${['docx','doc'].includes(getImagePath(elm).split('.').pop().toLowerCase())?'word-o':getImagePath(elm).split('.').pop().toLowerCase()}`]"  aria-hidden="true"></i></a>
                
                <!-- {{elm}} -->
            </div>
            <div class="form-group" v-if="elm.type=='checkbox'" :key="index">
                
                <label>{{elm.title || "title"}}</label>
                <br/>
                <template v-for="(op, i) in elm.options" :key="i">
                    <div class="form-check">
                        <input class="form-check-input" :checked="getSelectedCheck(elm, op)" type="checkbox" >&nbsp;
                        <label class="form-check-label">{{op.value}}</label>
                    </div>
                    
                </template>
                
                <!-- {{elm}} -->
            </div>
            <div class="form-group" v-if="elm.type=='radio'" :key="index">
                
                
                <label>{{elm.title || "title"}}</label>&nbsp;
                <br/>
                <template v-for="(op, i) in elm.options" :key="i">
                    <div class="form-check" >
                        <input class="form-check-input" :checked="getSelectedRadio(elm, op)" type="radio" >&nbsp;
                        <label class="form-check-label">{{op.value}}</label>
                    </div>
                    
                </template>
                
                <!-- {{elm}} -->
            </div>
            <!-- <div class="form-group" v-if="elm.type=='radio'" :key="index">
                <input type="radio" placeholder="Key" name="key" />

                
            </div> -->
            <!-- <div v-if=""></div> -->
        </template>
    </form>


    
    <!-- <template v-for="(elm,index) in elementsArr">
        <div>
            <input type="text" />
            {{elm}}
        </div>
        <div v-if=""></div>
    </template> -->
</div>
</template>

<script>
import { ref } from "vue";

import Modal from "./Modal/Modal.vue";
import InputType from './InputType.vue';
import { api } from "@/store/api";
export default {
    name: "Builder",
    props: {
       editId:Number,
       filledData:{}
    },
    computed:{
       
    },
    data(){
        return {
            
            title:"",
            formTitle:"",
            elementsArr:[],
            status:false,
            elmModalStatus:false,
            img:{},
            formattr:[]
        }
    },
    components: { Modal },
    inject:["show","hide"],
    mounted(){
        console.log("this.editId--->",this.editId)
        if(this.editId){
            api.get(`admin/form/getFormFields/${this.editId}`).then(data=>data.data).then(response=>{ 
                    //console.log("data",JSON.parse(response.data.form_fields)); 
                    
                    //this.meta = response.meta
                    
                    this.elementsArr = response.data.form_fields;
                    //this.refresh(1);
                })
        }
    },
    methods:{
        InputType,
        getSingle(elm){ return this.filledData.data.filter(item=>item.name==elm.name) && this.filledData.data.filter(item=>item.name==elm.name)[0]?this.filledData.data.filter(item=>item.name==elm.name)[0]:null; },
         getTextValue(elm){
            return this.getSingle(elm)?this.getSingle(elm)['value']:"";
        },
         getImgSrc(elm){
            this.img = this.getSingle(elm)?this.getSingle(elm):"";
            return this.getSingle(elm)?this.getSingle(elm)['filepath']:"";
        },
         getImagePath(elm){
            return this.img = this.getSingle(elm)?this.getSingle(elm)['filepath']:"";
            
        },

         getSelectedOpt(elm, opt){
            console.log("am select", this.getSingle(elm)['options'][0]["key"], opt.key, this.getSingle(elm)['options'][0]["key"]== opt.key)
            opt.key == this.getSingle(elm)['options'][0]["key"]?this.formattr[elm.name]=this.getSingle(elm)['options'][0]["value"]:false
            return opt.key == this.getSingle(elm)['options'][0]["key"]?true:false;
        },

         getSelectedRadio(elm, opt){
            console.log("am select", this.formattr, elm, opt)
            opt.key == this.getSingle(elm)['options'][0]["key"]?this.formattr[elm.name]=this.getSingle(elm)['options'][0]["value"]:false
            return opt.key == this.getSingle(elm)['options'][0]["key"]?true:false;
        },
         getSelectedCheck(elm, opt){
            console.log("am check", this.getSingle(elm)['options'].includes(opt), this.getSingle(elm)['options'], elm['options'], opt)
            //return this.getSingle(elm)['options'] 
            
            return this.getSingle(elm)["options"].filter(item=> { return item.key==opt.key && item.value==opt.value;}).length?true:false
            return opt.key == this.getSingle(elm)['options'][0]["key"]?true:false;
        },

        toggleModal(){
            this.status = !this.status
            console.log("STtaus", this.status)
        },
        updateName(e){
            console.log("Name Update call", e.selectedElem);
            let newName = (e.selectedElem.name).toLowerCase().replace(/[^A-Z0-9]/ig, "_");
            console.log("newName", newName);
            e.selectedElem.name = newName;
            
        },
        changeStatus(){
            console.log("Got event");
            this.status = false;
        },
        changeElmModalStatus(){
            console.log("Got event");
            
            //this.elmModalStatus = false;
        },

        openAttrPanel(index){
            console.log("openAttrPanel clicked", index, this.elementsArr);
            this.selectedElem = this.elementsArr[index];
            console.log("this.selectedElem clicked", this.selectedElem);
            this.elmModalStatus = true;
        },

        removeSelected(index){
            
            let selected = this.selectedElem;
            console.log("Removing Selected", selected);
            this.elementsArr.splice(index,1)
            
        },
        removeSelectedOption(elem, index){
            
            let selected = elem;
            console.log("Removing Selected", selected);
            this.selectedElem.options.splice(index,1)
            
        },
        updateSelected(e){
            let key = e.target.name;
            let val = e.target.value;
            this.selectedElem[key] = val;
        },
        updateSelectedOption(e, i){
            
            let key = e.target.name;
            let val = e.target.value;
            console.log("Updating Option",this.selectedElem['options'],i,  key, val)
            this.selectedElem['options'][i][key] = val;
        },
        
        addElement(item){
            switch (item) {
                case "TEXT":
                    this.elementsArr.push(
                        {
                            type:"text",
                            name:'',
                            placeholder:'',
                            title:'',
                            is_required:false
                        }
                    );
                    break;
                case "FILE":
                    this.elementsArr.push(
                        {
                            type:"file",
                            name:'',
                            placeholder:'',
                            title:'',
                            is_required:false
                        }
                    );
                    break;
                case "RADIO":
                    this.elementsArr.push(
                        {
                            type:"radio",
                            name:'',
                            placeholder:'',
                            title:'',
                            options:[],
                            is_required:false
                        }
                    );
                    break;
                case "CHECKBOX":
                    this.elementsArr.push(
                        {
                            type:"checkbox",
                            name:'',
                            placeholder:'',
                            title:'',
                            options:[],
                            is_required:false
                        }
                    );
                    break;

                case "OPTION":
                    this.selectedElem?.options.push(
                        {
                            key:'',
                            value:''
                        }
                    );
                    break;
            
                case "SELECTBOX":
                    this.elementsArr.push(
                        {
                            type:"select",
                            name:'',
                            placeholder:'',
                            title:'',
                            options:[],
                            is_required:false
                        }
                    );
                    break;
            
                default:
                    break;
            }
            console.log("Element Clicked");
        },

        async saveFormData(){
            console.log("elementsArr",this.elementsArr)
            if(this.editId){
                //UPDATE FORM DATA
                let response = await api.post('admin/form/update',{editId: this.editId, title:this.title,'form_fields':this.elementsArr})
                this.show(response.message, response.data.status, 2000)
            }
            else{
                //CREATE FORM DATA
                let response = await api.post('admin/form/create',{title:this.formTitle,'form_fields':this.elementsArr})
                console.log("Hee is msg op", response)
                this.show(response.data.message,response.data.status, 2000)
            }
            
            //console.log("I am the server response", response);
            
        },

        saveFormAttributes(){
            console.log("Wait holdon.. need form to be validated");
            this.elmModalStatus = false;
        }


    }
}
</script>