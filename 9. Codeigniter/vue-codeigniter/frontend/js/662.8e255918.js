"use strict";(self["webpackChunkvue_codeigniter"]=self["webpackChunkvue_codeigniter"]||[]).push([[662],{5662:function(e,a,t){t.r(a),t.d(a,{default:function(){return D}});var l=t(3396),s=t(9242);const i=(0,l._)("h2",null,"My Profile",-1),r={key:0,class:"my-3"},n={class:"form-group"},o=(0,l._)("label",{for:""},"Firstname",-1),m=(0,l._)("br",null,null,-1),u={class:"form-group"},d=(0,l._)("label",{for:""},"Lastname",-1),c=(0,l._)("br",null,null,-1),f={class:"form-group"},p=(0,l._)("label",{for:""},"Email",-1),h=(0,l._)("br",null,null,-1),_=(0,l._)("div",{class:"form-group"},[(0,l._)("button",{type:"submit",class:"btn btn-success"}," Update")],-1),g={key:1},y=(0,l._)("h2",null,"loading.......",-1),b=[y];function N(e,a,t,y,N,v){const w=(0,l.up)("alert-message");return(0,l.wg)(),(0,l.iD)(l.HY,null,[i,N.loading?((0,l.wg)(),(0,l.iD)("div",r,[(0,l._)("form",{onSubmit:a[3]||(a[3]=(0,s.iM)(((...e)=>v.UpdateUser&&v.UpdateUser(...e)),["prevent"]))},[N.alertStatus?((0,l.wg)(),(0,l.j4)(w,{key:0,color:N.color,message:N.message},null,8,["color","message"])):(0,l.kq)("",!0),(0,l._)("div",n,[o,(0,l.wy)((0,l._)("input",{type:"text",name:"firstName",placeholder:"Enter Firstname",class:"form-control","onUpdate:modelValue":a[0]||(a[0]=e=>N.firstName=e)},null,512),[[s.nr,N.firstName]]),m]),(0,l._)("div",u,[d,(0,l.wy)((0,l._)("input",{type:"text",name:"lastName",placeholder:"Enter Lastname",class:"form-control","onUpdate:modelValue":a[1]||(a[1]=e=>N.lastName=e)},null,512),[[s.nr,N.lastName]]),c]),(0,l._)("div",f,[p,(0,l.wy)((0,l._)("input",{type:"email",name:"email",placeholder:"Enter Email",class:"form-control","onUpdate:modelValue":a[2]||(a[2]=e=>N.email=e)},null,512),[[s.nr,N.email]]),h]),_],32)])):((0,l.wg)(),(0,l.iD)("div",g,b))],64)}var v=t(4483),w={name:"MyProfileComponent",data(){return{firstName:"",lastName:"",email:"",id:"",alertStatus:!1,color:"",message:"",loading:!1}},methods:{async myProfileDetails(){this.id=(0,v.yb)();let e=await(0,v.A_)(`my_profile/${this.id}`),a=e.data;this.loading=!0,this.firstName=a.first_name,this.lastName=a.last_name,this.email=a.email},async UpdateUser(){let e={id:this.id,firstName:this.firstName,lastName:this.lastName,email:this.email},a=await(0,v.j0)("update_profile",e);!1===a.data.error?(this.color="success",this.message=a.data.data):(this.color="danger",this.message=a.data.data),this.alertStatus=!0,setTimeout((()=>{this.alertStatus=!1}),3e3)}},async mounted(){await this.myProfileDetails()}},U=t(89);const k=(0,U.Z)(w,[["render",N]]);var D=k}}]);
//# sourceMappingURL=662.8e255918.js.map