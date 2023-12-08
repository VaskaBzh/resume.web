var $=Object.defineProperty;var w=(e,t,o)=>t in e?$(e,t,{enumerable:!0,configurable:!0,writable:!0,value:o}):e[t]=o;var r=(e,t,o)=>(w(e,typeof t!="symbol"?t+"":t,o),o);import{_ as l,o as c,c as d,g as b,j as B,T as L,p as S,e as I,a as n,A as g,C as O,m as x,r as h,i as v,n as f,w as k,v as C,d as m}from"./app-7a3a58ff.js";import{a as i}from"./anime.es-de4e5aa0.js";const P="/bundle/assets/logo_high_quality-e71fc07b.svg",A={name:"logo-light"},D={src:P,alt:"logo"};function V(e,t,o,p,s,a){return c(),d("img",D)}const W=l(A,[["render",V]]),T="/bundle/assets/logo_high_quality-dark-9f6a330e.svg",q={name:"logo-dark"},E={src:T,alt:"logo"};function M(e,t,o,p,s,a){return c(),d("img",E)}const N=l(q,[["render",M]]);const U={name:"in-click-view",props:{wait:Boolean}},z={key:0,class:"un-click"};function F(e,t,o,p,s,a){return c(),b(L,{to:"body"},[o.wait===!0?(c(),d("div",z)):B("",!0)])}const j=l(U,[["render",F],["__scopeId","data-v-addc6de7"]]);const R={name:"popup-cross-icon"},Y=e=>(S("data-v-6ac37daf"),e=e(),I(),e),G={class:"cross_icon",width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},J=Y(()=>n("path",{d:"M19 5L5 19M5 5L19 19",stroke:"#D0D5DD","stroke-width":"1.5","stroke-linecap":"round","stroke-linejoin":"round"},null,-1)),K=[J];function Q(e,t,o,p,s,a){return c(),d("svg",G,K)}const X=l(R,[["render",Q],["__scopeId","data-v-6ac37daf"]]);class Z{constructor(t,o){r(this,"popupOpen",()=>{this.emit("opened"),this.animateContent(),this.isOpened.value=!0,this.pageContainer=document.querySelector(".page-container"),this.setBodyHidden()});r(this,"popupClose",()=>{this.emit("closed"),this.closeAnimate(),this.isOpened.value=!1,this.pageContainer=document.querySelector(".page-container"),this.setBodyScroll()});r(this,"clickClosed",t=>{this.isOpened.value?!t.target.closest(".popup__content")&&!t.target.closest(".un-click")&&this.popupClose():t.target.closest(`[data-popup="#${this.id}"]`)&&(t.preventDefault(),this.popupOpen())});r(this,"keyClosed",t=>{t.keyCode===27&&this.popupClose(t)});this.isOpened=g(!1),this.id=t,this.emit=o,this.popupContentHtml=null,this.popupBlockHtml=null,this.popupLogoHtml=null,this.clicked=g(!1),this.animate=null,this.pageContainer=document.querySelector(".page-container")}setPopupContentHtml(t){this.popupContentHtml=t}setPopupBlockHtml(t){this.popupBlockHtml=t}setPopupLogoHtml(t){this.popupLogoHtml=t}setBodyHidden(){this.pageContainer&&O.getters.viewportWidth>=998&&(this.pageContainer.style.overflowY="hidden")}setBodyScroll(){this.pageContainer&&this.pageContainer.removeAttribute("style")}dropAnimate(){this.animate&&(this.animate.remove(this.popupContentHtml),this.animate.remove(this.popupBlockHtml),this.animate.remove(this.popupLogoHtml))}closeAnimate(){this.dropAnimate(),this.animate=i({targets:this.popupContentHtml,opacity:"0",easing:"easeInCubic",duration:300}),this.animate=i({targets:this.popupBlockHtml,height:[`${this.getClearScrollHeight()}px`,"122px"],width:"280px",translateY:120,easing:"easeInCubic",duration:300}),this.animate=i({targets:this.popupLogoHtml,opacity:"1",easing:"easeInCubic",duration:300})}animateOpacity(){this.animate=i({targets:this.popupContentHtml,opacity:1,easing:"easeOutCubic",duration:150,complete:()=>{this.dropAnimate()}})}animateLogoOpacity(){this.animate=i({targets:this.popupLogoHtml,opacity:0,easing:"easeInCubic",duration:150,complete:()=>{this.dropAnimate(),this.animateOpacity()}})}getClearScrollHeight(){const t=this.getStyle(this.popupBlockHtml,"padding"),o=this.getStyle(this.popupBlockHtml,"borderWidth"),p=this.removeLetters(t),s=this.removeLetters(o),a=p*2,u=s*2;return this.popupContentHtml.scrollHeight+a+u}getStyle(t,o){return window.getComputedStyle(t)[o]}removeLetters(t,o="px"){return t.replace(o,"")}dropContentHeight(){this.popupBlockHtml.style.height="auto"}animateHeight(){this.animate=i({targets:this.popupBlockHtml,height:`${this.getClearScrollHeight()}px`,easing:"easeInCubic",duration:350,complete:()=>{this.dropAnimate(),setTimeout(this.dropContentHeight.bind(this),500),this.animateLogoOpacity()}})}animateWidth(){this.animate=i({targets:this.popupBlockHtml,width:"560px",easing:"easeInOutCubic",duration:250,complete:()=>{this.dropAnimate(),this.animateHeight()}})}animateTransform(){this.animate=i({targets:this.popupBlockHtml,translateY:0,easing:"easeInCubic",duration:150,complete:()=>{this.dropAnimate(),this.animateWidth()}})}animateContent(){this.animateTransform()}initFunc(){document.addEventListener("mousedown",this.clickClosed,!0),document.addEventListener("keydown",this.keyClosed)}destroyFunc(){document.removeEventListener("mousedown",this.clickClosed,!0),document.removeEventListener("keydown",this.keyClosed),this.popupClose()}}const tt={name:"main-popup",components:{PopupCrossIcon:X,UnClickView:j,LogoLight:W,LogoDark:N},props:{wait:Boolean,id:String,opened:{type:Boolean},closed:{type:Boolean},makeResize:{type:Boolean,default:!1},instructionConfig:Object,className:String},data(){return{service:new Z(this.id,this.$emit)}},watch:{closed(e){e&&this.service.popupClose()},opened(e){e&&this.service.popupOpen()},makeResize(e){}},computed:{...x(["getTheme","isDark"])},mounted(){this.service.setPopupContentHtml(this.$refs.popup_content),this.service.setPopupBlockHtml(this.$refs.popup_block),this.service.setPopupLogoHtml(this.$refs.popup_logo),this.service.initFunc()},beforeUnmount(){this.service.destroyFunc()}},et=["id"],ot={class:"popup__wrapper"},st={class:"popup__content-fake"},it={class:"popup__block-fake"},nt={class:"popup__block-logo",ref:"popup_logo"},pt={class:"popup__block",ref:"popup_content"};function at(e,t,o,p,s,a){const u=h("logo-light"),_=h("logo-dark"),y=h("popup-cross-icon");return c(),d("div",{class:f(["popup",{"popup-show":s.service.isOpened}]),id:o.id},[n("div",ot,[n("div",st,[n("div",it,[v(e.$slots,"instruction",{},void 0,!0)])]),n("div",{class:f(["popup__content onboarding_block",[o.wait?"popup__content_block-loading":"",o.className]]),ref:"popup_block"},[n("div",nt,[k(m(u,{class:"popup_logo"},null,512),[[C,!e.isDark]]),k(m(_,{class:"popup_logo"},null,512),[[C,e.isDark]])],512),n("div",pt,[n("button",{type:"button",class:"popup_close",onClick:t[0]||(t[0]=(...H)=>s.service.popupClose&&s.service.popupClose(...H))},[m(y)]),v(e.$slots,"default",{},void 0,!0)],512)],2)])],10,et)}const dt=l(tt,[["render",at],["__scopeId","data-v-36a1fbd1"]]);export{dt as M,T as _};
