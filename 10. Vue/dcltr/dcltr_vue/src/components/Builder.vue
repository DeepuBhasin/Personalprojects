<template>

<div id='builder'>
    <Modal :title="'Update Attributes'" :status="elmModalStatus" @closeModal="changeElmModalStatus">
        <!-- {{selectedElem}}
        {{selectedElem?.type}} -->
        <form @submit.prevent="saveFormAttributes()">
            <div v-if="selectedElem?.type=='text'">
                <!-- <div class="form-group">
                    <label class="form-label">Label</label>
                    <input required type="text" @input="updateSelected" placeholder="Name"  @change="updateName(this)"  name="name" class="form-control" v-bind:value="selectedElem.name"/>
                </div> -->
                <div class="form-group">
                
                    <input required type="text" @input="updateSelected" placeholder="Title" @change="updateName(this)" name="title" class="form-control" v-bind:value="selectedElem.title"/>
                
                </div>
                <div class="form-group">
                    <input required type="text" @input="updateSelected" placeholder="Placeholder" name="placeholder" class="form-control" v-bind:value="selectedElem.placeholder"/>
                </div>
                <div class="form-group">
                <label>Is Required</label>
                     <span>
                        
                        <div class="custom-control custom-switch">
                        <input type="checkbox" :class="'custom-control-input '" value="true" :checked="selectedElem.is_required==true" id="customSwitch1"  name="is_required" @click="updateSelected">
                        <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </span>
                    <!-- <select required name="is_required"  @input="updateSelected">
                        <option value="false">Is Required</option>
                        <option value="true" :selected="selectedElem.is_required==true">Yes</option>
                        <option value="false" :selected="selectedElem.is_required==false">No</option>
                    </select> -->
                </div>
            </div>
            <div v-if="selectedElem?.type=='file'">
                <!-- <div class="form-group">
                    <label class="form-label">Label</label>
                    <input required type="text" @input="updateSelected" placeholder="Name"  @change="updateName(this)" name="name" class="form-control" v-bind:value="selectedElem.name"/>
                </div> -->
                <div class="form-group">
                
                    <input type="text" required @input="updateSelected"  @change="updateName(this)" placeholder="Title" name="title" class="form-control" v-bind:value="selectedElem.title"/>
                </div>
                <div class="form-group">
                     <label>Is Required</label>
                     <span>
                        
                        <div class="custom-control custom-switch">
                        <input type="checkbox" :class="'custom-control-input '" value="true" :checked="selectedElem.is_required==true" id="customSwitch1"  name="is_required" @click="updateSelected">
                        <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </span>
                    <!-- <select name="is_required" required @input="updateSelected">
                        <option value="false">Is Required</option>
                        <option value="true" :selected="selectedElem.is_required=='true'">Yes</option>
                        <option value="false" :selected="selectedElem.is_required=='false'">No</option>
                    </select> -->
                </div>
            </div>
            <div v-if="selectedElem?.type=='select'">
                <!-- <input type="text" required  @input="updateSelected" placeholder="Name"  @change="updateName(this)" name="name" class="form-control" v-bind:value="selectedElem.name"/> -->
                <input type="text" required @input="updateSelected" placeholder="Title" @change="updateName(this)" name="title" class="form-control" v-bind:value="selectedElem.title"/>
                <label>Is Required</label>
                     <span>
                        
                        <div class="custom-control custom-switch">
                        <input type="checkbox" :class="'custom-control-input '" value="true" :checked="selectedElem.is_required==true" id="customSwitch1"  name="is_required" @click="updateSelected">
                        <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </span>
                <!-- <select name="is_required" required @input="updateSelected">
                    <option value="false">Is Required</option>
                    <option value="true"  :selected="selectedElem.is_required=='true'">Yes</option>
                    <option value="false" :selected="selectedElem.is_required=='false'">No</option>
                </select> -->
                <br/>
                <template v-for="(elm,index) in selectedElem?.options">
                    <div>
                        <input type="text" required placeholder="Key" name="key" @input="updateSelectedOption($event, index)" v-bind:value="selectedElem.options[index]['key']"/>
                        <input type="text" required placeholder="val" name="value" @input="updateSelectedOption($event, index)" v-bind:value="selectedElem.options[index]['value']"/>
                        {{elm}}
                    </div>
                    <!-- <div v-if=""></div> -->
                </template>
                <a class="btn btn-xs btn-primary" @click="addElement('OPTION')">Add New Option</a>
            </div>
            <div v-if="selectedElem?.type=='checkbox'">
                <!-- <input type="text" required @input="updateSelected" placeholder="Name"  @change="updateName(this)" name="name"  v-bind:value="selectedElem.name" class="form-control" /> -->
                <input type="text" required @input="updateSelected" placeholder="Title" name="title" @change="updateName(this)" class="form-control"  v-bind:value="selectedElem.title"/>
                <!-- <input type="text" @input="updateSelected" placeholder="Placeholder" name="placeholder" class="form-control"/> -->
                <label>Is Required</label>
                     <span>
                        
                        <div class="custom-control custom-switch">
                        <input type="checkbox" :class="'custom-control-input '" value="true" :checked="selectedElem.is_required==true" id="customSwitch1"  name="is_required" @click="updateSelected">
                        <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </span>
                <!-- <select name="is_required" required @input="updateSelected">
                    <option value="false">Is Required</option>
                    <option value="true" :selected="selectedElem.is_required=='true'">Yes</option>
                    <option value="false" :selected="selectedElem.is_required=='false'">No</option>
                </select> -->
                <br/>
                <template v-for="(elm,index) in selectedElem?.options">
                    <div>
                        <input type="text" required placeholder="Title" name="key" @input="updateSelectedOption($event, index)" v-bind:value="selectedElem.options[index]['key']"/>
                        <input type="text" required placeholder="Value" name="value" @input="updateSelectedOption($event, index)" v-bind:value="selectedElem.options[index]['value']"/>
                        &nbsp;<strong><a style="color:red; cursor: pointer;" @click="removeSelectedOption(elem, index)">X</a></strong>
                        <!-- {{elm}} -->
                    </div>
                    <!-- <div v-if=""></div> -->
                </template>
                <a class="btn btn-xs btn-primary" @click="addElement('OPTION')">Add New Option</a>
            </div>
            <div v-if="selectedElem?.type=='radio'">
                <!-- <input type="text" required @input="updateSelected" placeholder="Name"  @change="updateName(this)" name="name" class="form-control" v-bind:value="selectedElem.name" /> -->
                <input type="text" required @input="updateSelected" placeholder="Title" @change="updateName(this)" name="title" class="form-control" v-bind:value="selectedElem.title" />
                <!-- <input type="text" @input="updateSelected" placeholder="Placeholder" name="placeholder" class="form-control"/> -->
                <label>Is Required</label>
                     <span>
                        
                        <div class="custom-control custom-switch">
                        <input type="checkbox" :class="'custom-control-input '" value="true" :checked="selectedElem.is_required==true" id="customSwitch1"  name="is_required" @click="updateSelected">
                        <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </span>
                <!-- <select required name="is_required"  @input="updateSelected">
                    <option value="false">Is Required</option>
                    <option value="true" :selected="selectedElem.is_required=='true'">Yes</option>
                    <option value="false" :selected="selectedElem.is_required=='false'">No</option>
                </select> -->
                <br/>
                <template v-for="(elm,index) in selectedElem?.options">
                    <div>
                        <input required type="text" placeholder="key" name="key" @input="updateSelectedOption($event, index)" v-bind:value="selectedElem.options[index]['key']"/>
                        <input required type="text" placeholder="Value" name="value" @input="updateSelectedOption($event, index)" v-bind:value="selectedElem.options[index]['value']"/>
                        <!-- {{elm}} -->
                    </div>
                    <!-- <div v-if=""></div> -->
                </template>
                <a class="btn btn-xs btn-primary" @click="addElement('OPTION')">Add New Option</a>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </Modal>
    <Modal :title="'Add New Element'" :status="status" @closeModal="changeStatus">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-7">
                    <input type="text" class="form-control" placeholder="Input Box" disabled/>
                </div>
                <div class="col-sm-5">
                    <a class="btn btn-success btn-sm" @click="addElement('TEXT')">Text Input</a>
                </div>
            </div>            
        </div>
            
        <div class="form-group">
            <div class="row">
                <div class="col-sm-7">
                    <input type="text" class="form-control" placeholder="File Picker" disabled/>
                </div>
                <div class="col-sm-5">
                    <a class="btn btn-success btn-sm" @click="addElement('FILE')">File Picker</a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-7">
                    <select class="form-control" disabled><option>Select Box</option></select>
                </div>
                <div class="col-sm-5">
                    <a class="btn btn-success btn-sm" @click="addElement('SELECTBOX')">Selectbox</a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-7">
                    <input type="checkbox" class=""/>
                </div>
                <div class="col-sm-5">
                <a class="btn btn-success btn-sm" @click="addElement('CHECKBOX')">Checkbox</a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-7">
                    <input type="radio" class=""/>
                </div>
                <div class="col-sm-5">
                <a class="btn btn-success btn-sm" @click="addElement('RADIO')">Radio Button</a>
                </div>
            </div>
        </div>

    

        
        

    </Modal>
    <a class="btn btn-primary btn-sm pull-right" id="addFormElement" @click="toggleModal()">Add Form Element</a>
    <div class="row">
    <div class="col-md-6">
    <form method="post" @submit.prevent="saveFormData()" class="formBuilderEdit">
        <div class="form-group">
            <label>Title</label>
            <input type="text" required placeholder="Form Title" class="form-control" name="form_title" v-model="formTitle"/>
        </div>

        <template v-for="(elm,index) in elementsArr" >
            <div class="form-group" v-if="elm.type=='text'" :key="index">
                <label>{{elm.title || "title"}}</label>
                <input type="text" :placeholder="elm.placeholder" class="form-control" name="key"  @click.prevent="openAttrPanel(index)"/>
                &nbsp;<div class="removeIcon"><a style="color:red; cursor: pointer;" @click="removeSelected(index)"><i class="fas fa-trash"></i></a></div>
                <!-- {{elm}} -->
            </div>
            <div class="form-group" v-if="elm.type=='select'" :key="index">
                <label>{{elm.title || "title"}}</label>
                <select name="key" @click.prevent="openAttrPanel(index)" class="form-control" >
                    <option>Select Box</option>
                    <option v-for="(op, i) in elm.options" :key="i">{{op.value}}</option>

                </select>
                &nbsp;<div class="removeIcon"><a style="color:red; cursor: pointer;" @click="removeSelected(index)"><i class="fas fa-trash"></i></a></div>

                <!-- {{elm}} -->
            </div>
            <div class="form-group" v-if="elm.type=='file'" :key="index">
                <label>{{elm.title || "title"}}</label>
                <input type="file" placeholder="Key" name="key" @click.prevent="openAttrPanel(index)" class="form-control" />
                &nbsp;<div class="removeIcon"><a style="color:red; cursor: pointer;" @click="removeSelected(index)"><i class="fas fa-trash"></i></a></div>
                <!-- {{elm}} -->
            </div>
            <div class="form-group" v-if="elm.type=='checkbox'" :key="index">
                
                <input type="checkbox" placeholder="Key" name="key" @click.prevent="openAttrPanel(index)" />&nbsp;<label>{{elm.title || "title"}}</label>
                &nbsp;<span class="removeBtn"><a style="color:red; cursor: pointer;" @click="removeSelected(index)"><i class="fas fa-trash"></i></a></span>
                <br/>
                <template v-for="(op, i) in elm.options" :key="i">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" >&nbsp;
                        <label class="form-check-label">{{op.value}}</label>
                    </div>
                    
                </template>
                
                <!-- {{elm}} -->
            </div>
            <div class="form-group" v-if="elm.type=='radio'" :key="index">
                
                <input type="radio" placeholder="Key" name="key" @click.prevent="openAttrPanel(index)" />&nbsp;
                <label>{{elm.title || "title"}}</label>&nbsp;<span class="removeBtn"><a style="color:red; cursor: pointer;" @click="removeSelected(index)"><i class="fas fa-trash"></i></a></span>
                <br/>
                <template v-for="(op, i) in elm.options" :key="i">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" >&nbsp;
                        <label class="form-check-label">{{op.value}}</label>
                    </div>
                    
                </template>
                
                <!-- {{elm}} -->
            </div>
            <!-- <div class="form-group" v-if="elm.type=='radio'" :key="index">
                <input type="radio" placeholder="Key" name="key" @click.prevent="openAttrPanel(index)"/>

                
            </div> -->
            <!-- <div v-if=""></div> -->
        </template>
        <br>
        <button class="btn btn-primary" type="submit">Save Form</button>
    </form>
    </div>
    </div>

    
    <!-- <template v-for="(elm,index) in elementsArr">
        <div>
            <input type="text" @click.prevent="openAttrPanel(index)"/>
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
       editId:Number
    },
    data(){
        return {
            
            title:"",
            formTitle:"",
            elementsArr:[],
            status:false,
            elmModalStatus:false
        }
    },
    components: { Modal },
    inject:["show","hide"],
    mounted(){
        console.log("this.editId--->",this.editId)
        if(this.editId){
            api.get(`admin/form/getFormFields/${this.editId}`).then(data=>data.data).then(response=>{ 
                    console.log("data",response.data); 
                    
                    //this.meta = response.meta
                    
                    this.elementsArr = response.data.form_fields;
                    this.formTitle = response.data.title;
                    //this.refresh(1);
                })
        }
    },
    methods:{
        InputType,
        toggleModal(){
            this.status = !this.status
            console.log("STtaus", this.status)
        },
        updateName(e){
            console.log("Name Update call", e.selectedElem.title);
            let newName = (e.selectedElem.title).toLowerCase().replace(/[^A-Z0-9]/ig, "_");
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
            console.log("e-->",e.target.name, e.target.checked)
            let key = e.target.name;
            let val = e.target.value;
            if(key=="is_required"){
                val = e.target.checked;
            }
            
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
                this.show(response.data.message, response.data.status, 2000)
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