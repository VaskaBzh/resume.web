import{_ as l,o as u,c as s,a as i,t as r,w as _,J as p,n as c}from"./app-7a3a58ff.js";const d={name:"MainInput",props:{inputName:String,inputLabel:String,inputValue:String,error:String,autocomplete:String,editable:{type:Boolean,default:!0}},data(){return{value:this.inputValue}},watch:{inputValue(t){this.value=t},value(t){this.editable&&this.$emit("getValue",t)}}},m=["for"],f={class:"input_label"},v=["id","readonly","autocomplete"];function g(t,n,e,h,a,b){return u(),s("label",{for:e.inputName,class:c(["input_row",{"input_row-error":e.error,"input_row-focus":a.value}])},[i("span",f,r(e.inputLabel),1),_(i("input",{id:e.inputName,"onUpdate:modelValue":n[0]||(n[0]=o=>a.value=o),type:"text",class:"input",readonly:!e.editable,autocomplete:e.autocomplete},null,8,v),[[p,a.value]])],10,m)}const w=l(d,[["render",g],["__scopeId","data-v-e8f53369"]]);export{w as M};
