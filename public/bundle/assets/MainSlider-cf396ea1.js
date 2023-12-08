import{_ as l,o as a,c as o,a as f,r as u,d as p,n as g,t as v,m as y,i as k,g as b,j as m,F as L,k as N,p as S,e as P}from"./app-7a3a58ff.js";import{M as $}from"./MainPreloader-edb92089.js";const B={name:"swipe-icon"},j={width:"16",height:"16",viewBox:"0 0 16 16",fill:"none",xmlns:"http://www.w3.org/2000/svg"},C=f("path",{d:"M6.00003 4C6.00003 4 9.99999 6.94596 10 8.00003C10 9.05411 6 12 6 12","stroke-linecap":"round","stroke-linejoin":"round"},null,-1),M=[C];function T(s,t,e,i,n,c){return a(),o("svg",j,M)}const O=l(B,[["render",T]]);const x={name:"slider-swipe",props:{direction:Boolean},components:{SwipeIcon:O}};function I(s,t,e,i,n,c){const _=u("swipe-icon");return a(),o("div",{class:"button",onClick:t[0]||(t[0]=h=>s.$emit("swipe",e.direction))},[p(_,{class:g(["button__icon",{"button__icon-rotate":!e.direction}])},null,8,["class"])])}const A=l(x,[["render",I],["__scopeId","data-v-26ac0ffd"]]);const F={name:"slider-button",props:{value:Number,active:Number}};function R(s,t,e,i,n,c){return a(),o("div",{class:g(["button",{"button-active":e.active===e.value}]),onClick:t[0]||(t[0]=_=>s.$emit("swipePage",e.value))},v(e.value),3)}const z=l(F,[["render",R],["__scopeId","data-v-d2cab1bb"]]);const D={name:"page-info",props:{startPage:Number,endPage:Number,fullLength:Number}},E={class:"info"};function G(s,t,e,i,n,c){return a(),o("span",E,v(e.startPage)+" - "+v(e.endPage)+" из "+v(e.fullLength),1)}const V=l(D,[["render",G],["__scopeId","data-v-ac91659e"]]);class W{constructor(t){this.meta=t,this.saveTable={},this.haveMeta=!1,this.links=[],this.activeLink=-1}getMeta(t){let e=!!(t!=null&&t.meta.to);return e?this.haveMeta=e:setTimeout(()=>{e&&(this.haveMeta=e)},200),this}metaProcess(t){var e;if(t!=null&&t.meta.links){this.links=newValue==null?void 0:newValue.meta.links,this.service.dropButtonLinks();let i=Number(this.links[Object.values(this.links).length-1].label);if(i>9){let n=((e=this.service.activeLink)==null?void 0:e.label)??1;n=Number(n),this.service.setLinks(n,i)}}return this}cacheTable(t){t!=null&&t.meta&&(this.saveTable=this.table)}validateRowsNumber(t,e){return/^[0-9]*\.?[0-9]*$/.test(t)&&t<=100&&t>0?t:e}setActiveLink(t){this.activeLink=t.filter((e,i)=>{if(e.active)return i})[0]}mapLinks(t,e){return this.links.filter((i,n)=>{if(n>=t&&n<=e)return i})}dropButtonLinks(){this.links.splice(0,1),this.links.splice(this.links.length-1,1)}dropLinks(){this.links=[]}setLinks(t,e){this.dropLinks();let i=[];t<=4&&(i=i.concat(this.mapLinks(0,4),["..."],this.mapLinks(e-2,e))),t>4&&t<=e-5&&(i=i.concat(this.mapLinks(0,3),["..."],this.mapLinks(t-2,t),["..."],this.mapLinks(e-2,e))),t>e-5&&t<=e&&(i=i.concat(this.mapLinks(0,3),["..."],this.mapLinks(e-5,e))),this.links=[...i]}}const q={components:{MainPreloader:$,PageInfo:V,SliderButton:z,SliderSwipe:A},props:{table:Object,wait:Boolean,haveNav:{type:Boolean,default:!0},havePreloader:{type:Boolean,default:!0},empty:Object,rowsNum:{type:Number,default:10},meta:Object},data(){return{rowsNumber:this.rowsNum,saveTable:{},service:new W(this.meta)}},watch:{"service.link"(s){this.service.setActiveLink(s)},meta(s){this.service.getMeta(s).metaProcess(s).cacheTable(s)},rowsNumber(s,t){this.rowsNumber=this.service.validateRowsNumber(s,t),this.$emit("changePerPage",this.rowsNumber)}},computed:{...y(["viewportWidth"])},methods:{ajax(s){if(s){let t=s.split("=");this.$emit("changePage",t[t.length-1])}}}},H=s=>(S("data-v-fddc5c75"),s=s(),P(),s),J={class:"slider"},K={key:1,class:"slider__content"},Q={key:2,class:"slider__nav"},U={class:"slider__nav-slides"},X={key:0,class:"slider__slides"},Y=H(()=>f("span",null,"...",-1)),Z=[Y],ee={key:1,class:"slider__slides"};function te(s,t,e,i,n,c){const _=u("main-preloader"),h=u("slider-swipe"),w=u("slider-button");return a(),o("div",J,[k(s.$slots,"instruction",{},void 0,!0),e.havePreloader&&(e.wait||e.empty)?(a(),b(_,{key:0,class:"cabinet__preloader",wait:e.wait,interval:35,end:!e.wait,empty:e.empty},null,8,["wait","end","empty"])):m("",!0),!e.wait&&!e.empty?(a(),o("div",K,[k(s.$slots,"default",{},void 0,!0)])):m("",!0),e.haveNav&&!e.wait&&!e.empty?(a(),o("div",Q,[f("div",U,[p(h,{direction:!1,onSwipe:t[0]||(t[0]=d=>{var r;return c.ajax((r=e.meta)==null?void 0:r.links.prev)})}),n.service.haveMeta?(a(),o("div",ee,[(a(!0),o(L,null,N(s.links,(d,r)=>(a(),b(w,{key:r,value:d.label,active:n.service.activeLink,onSwipePage:se=>c.ajax(d.url)},null,8,["value","active","onSwipePage"]))),128))])):(a(),o("div",X,Z)),p(h,{direction:!0,onSwipe:t[1]||(t[1]=d=>{var r;return c.ajax((r=e.meta)==null?void 0:r.links.next)})})])])):m("",!0)])}const ae=l(q,[["render",te],["__scopeId","data-v-fddc5c75"]]);export{ae as M};
