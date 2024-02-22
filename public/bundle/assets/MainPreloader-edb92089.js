import{_ as u,o as l,c as d,a as h,l as D,m as w,r as C,f as b,w as x,v as L,g as $,j as P,d as S,n as y,h as k,t as I,q as E}from"./app-7a3a58ff.js";import{S as A}from"./StatesService-a0d6c34c.js";import{a as c}from"./anime.es-de4e5aa0.js";const V={name:"preloader-end-icon",mounted(){this.$emit("getCross",this.$refs.cross)}},T={width:"26",ref:"cross",height:"26",viewBox:"0 0 26 26",fill:"none",xmlns:"http://www.w3.org/2000/svg"},O=h("rect",{y:"3.65527",width:"5",height:"0",rx:"1",transform:"rotate(-45 0 3.65527)",fill:"#4281E8"},null,-1),R=h("rect",{x:"23.7109",width:"5",height:"0",rx:"1",transform:"rotate(45 23.7109 0)",fill:"#4281E8"},null,-1),B=[O,R];function M(s,e,i,n,t,r){return l(),d("svg",T,B,512)}const G=u(V,[["render",M]]),z={name:"preloader-logo-icon"},N={width:"67",height:"54",viewBox:"0 0 67 54",fill:"none",xmlns:"http://www.w3.org/2000/svg"},F=D('<path d="M48.6241 32C39.8415 32 32.2238 33.8403 27.5367 36.4467C27.407 36.5193 27.1213 36.6579 27 36.7384C28.4004 36.0769 30.0703 35.575 31.6329 35.3815H31.6412C32.216 35.3087 32.7986 35.2765 33.3817 35.2765C33.6565 35.2765 33.9237 35.2846 34.1909 35.3006C37.1861 35.4703 40.0354 36.5595 42.3589 38.3752C42.3749 38.3833 42.3911 38.3914 42.4074 38.4076C42.4317 38.4238 42.4398 38.44 42.4561 38.4559C43.5893 39.3519 44.5931 40.433 45.4269 41.6599L45.6616 42.0067L45.6857 42.0471H45.6941L51.2148 50.206C53.886 54.1521 59.2451 55.1851 63.1954 52.522C65.6729 50.8596 67 48.1479 67 45.3882C67 43.7338 66.523 42.0552 65.5186 40.5785C61.8921 35.212 55.821 32 49.3369 32H48.6241Z" fill="url(#paint0_linear_1203_1968)"></path><path d="M26.4091 3.7912L7.30018 31.9697L5.07577 35.2508L4.15034 36.6166L1.48013 40.56C1.05775 41.1821 0.732814 41.8448 0.489305 42.5236C-0.0302829 43.9781 -0.127228 45.5217 0.156484 46.9924C0.497447 48.7947 1.415 50.4834 2.85188 51.7765C3.15238 52.0433 3.46841 52.2935 3.80937 52.52C7.77116 55.1868 13.1528 54.1523 15.8316 50.2007C15.8316 50.2007 20.256 42.9276 22.212 40.8022C22.3257 40.673 22.4476 40.5438 22.5774 40.4144C23.7786 38.9842 25.2483 37.8124 26.8796 36.9476C27.0506 36.8587 27.7239 36.4952 27.8539 36.4225C32.5541 33.8125 40.193 31.9697 49 31.9697H28.1949L33.7152 23.8321L40.769 13.4317C41.7675 11.9531 42.2464 10.2803 42.2464 8.61562C42.2464 5.84397 40.9151 3.12855 38.4314 1.46384C36.9861 0.494194 35.3465 0.0174828 33.7152 0.00127029C33.6653 0.000259399 33.6162 0 33.5663 0C30.8002 0 28.0755 1.33036 26.4091 3.7912Z" fill="url(#paint1_linear_1203_1968)"></path><defs><linearGradient id="paint0_linear_1203_1968" x1="37" y1="43" x2="63.2063" y2="23.1808" gradientUnits="userSpaceOnUse"><stop offset="0.158705" stop-color="#1B3867"></stop><stop offset="0.566881" stop-color="#1C70DC"></stop><stop offset="0.977621" stop-color="#3565B5"></stop></linearGradient><linearGradient id="paint1_linear_1203_1968" x1="-4.5" y1="60.5" x2="62.0194" y2="23.2461" gradientUnits="userSpaceOnUse"><stop offset="0.158705" stop-color="#024BC0"></stop><stop offset="0.977621" stop-color="#3597F9"></stop></linearGradient></defs>',3),H=[F];function U(s,e,i,n,t,r){return l(),d("svg",N,H)}const Z=u(z,[["render",U]]);class q{constructor(){this.progressPercentage=0,this.interval=null}nullProgressPercentage(){return this.progressPercentage=0,this}setInterval(e){return this.interval=setInterval(()=>{this.progressPercentage<80?this.progressPercentage+=1:this.setSlowInterval()},e),this}setSlowInterval(){return this.progressPercentage>=80&&(this.interval=setInterval(()=>{this.progressPercentage<98&&(this.progressPercentage+=1)},500)),this}endProgress(){const r=200/(100-this.progressPercentage);this.interval=setInterval(()=>{this.progressPercentage<100?this.progressPercentage+=1:(this.setProgressEnd(),this.killInterval())},r)}killInterval(){return clearInterval(this.interval),this}setProgressEnd(){this.progressPercentage="preloader.text"}}class j{constructor(){this.animateData=null}setAnimateData(e){this.animateData=e}restartAnimation(){var e;if((e=this.animateData)!=null&&e.remove){this.animateData.restart();return}}dropAnimate(e){var i;(i=this.animateData)!=null&&i.remove&&(this.animateData.pause(e),this.animateData.remove(e))}}class W{constructor(){this.element=null}setElement(e){this.element=e}getData(){}}class J{constructor(){this.polygon=this.createDomElementService(),this.cross=this.createDomElementService(),this.rotate=null,this.dashOffSet=null}createDomElementService(){return new W}getRotate(){this.rotate=this.polygon.element.style.webkitTransform.substr(7,3)}getDashOffSet(){this.dashOffSet=this.polygon.element.style.strokeDashoffset.split("px")[0]}setPolygonTransform(e){this.polygon.element.style.transform=e}}class K extends J{constructor(){super(),this.lineAnimate=this.createAnimateDataService(),this.lineResizeAnimate=this.createAnimateDataService(),this.crossAnimate=this.createAnimateDataService(),this.lineCloseAnimate=this.createAnimateDataService(),this.isCrossVisible=this.createStatesService(),this.isProgressVisible=this.createStatesService(),this.isLogoCenter=this.createStatesService(),this.isProgressVisible.setState()}createStatesService(){return new A}createAnimateDataService(){return new j}setCrossDataGetter(){this.cross.getData=function(){return this.element.querySelectorAll("rect")}}endAnimation(){this.lineResizeAnimate.dropAnimate(),this.lineAnimate.dropAnimate(),this.closeLine()}animateLineResize(){this.lineResizeAnimate.restartAnimation(),this.lineResizeAnimate.dropAnimate(this.polygon.element);const e=-890,i=-1247,n=1600,t="easeInOutSine",r="alternate",o={targets:this.polygon.element,strokeDashoffset:[e,i],duration:n,loop:!0,easing:t,direction:r};this.lineResizeAnimate.setAnimateData(c(o))}animateLine(){this.lineAnimate.restartAnimation(),this.setPolygonTransform("rotate(0deg)"),this.lineAnimate.dropAnimate(this.polygon.element);const e=720,i=2500,n="linear",t={targets:this.polygon.element,rotate:e,duration:i,loop:!0,easing:n};return this.lineAnimate.setAnimateData(c(t)),this}animateCloseLine(){this.lineCloseAnimate.dropAnimate(this.polygon.element),this.getDashOffSet();const e=100,i=12.47,n=32,t=-1247,r=(e-Math.abs(this.dashOffSet/i))*n,o="easeInOutSine",m={begin:()=>{this.animateCross()}},p={targets:this.polygon.element,strokeDashoffset:[this.dashOffSet,t],easing:o,duration:r,...m};this.lineCloseAnimate.setAnimateData(c(p))}animateCross(){if(this.cross){this.isCrossVisible.setState(),this.setCrossDataGetter();const e=this.cross.getData(),i="linear",n=300,t=33.361,r=400,o={targets:e,easing:i,duration:n,height:t,delay:c.stagger(r),complete:()=>{this.isProgressVisible.setState()}};this.crossAnimate.setAnimateData(c(o))}}closeLine(){this.lineCloseAnimate.dropAnimate(this.polygon.element),this.getRotate();const e=100,i=7.2,n=3.6,t=125,r=720,o=360,g=this.rotate<=o?o:r,m=(e-this.rotate/this.rotate<=o?n:i)*t,p="linear",v={complete:()=>{this.animateCloseLine()}},_={targets:this.polygon.element,rotate:g,duration:m,easing:p,...v};this.lineCloseAnimate.setAnimateData(c(_))}}class Q extends q{constructor(){super(),this.endTable=this.createStatesService(),this.waitTable=this.createStatesService(),this.emptyTable=this.createStatesService(),this.animateService=this.createAnimateService()}createAnimateService(){return new K}createStatesService(){return new A}setPolygon(e){this.animateService.polygon.setElement(e)}setCross(e){this.animateService.cross.setElement(e)}setEmptyState(e){return this.emptyTable.setState(e),this}setWaitState(e){return this.waitTable.setState(e),this}setEndState(e){return this.endTable.setState(e),this}setProgressVisible(e){return this.animateService.isProgressVisible.setState(e),this}setLogoCenter(e){return this.animateService.isLogoCenter.setState(e),this}setCrossVisible(e){return this.animateService.isCrossVisible.setState(e),this}startProcess(e){this.nullProgressPercentage().killInterval().setInterval(e),this.animateService.animateLine().animateLineResize()}slowProcess(){this.killInterval().setSlowInterval()}endProcess(e){e&&(this.killInterval().endProgress(),this.animateService.endAnimation())}}const X={name:"preloader-container-icon",mounted(){this.$emit("getPolygon",this.$refs.polygon)}},Y={width:"150",height:"150",viewBox:"0 0 150 150",fill:"none",xmlns:"http://www.w3.org/2000/svg"},ee={fill:"none","fill-rule":"evenodd",stroke:"currentColor","stroke-width":"1",class:"lines"},te={ref:"polygon",class:"preloader_polygon",d:"M75 150C57.6484 150 40.8335 143.984 27.4205 132.976C14.0075 121.968 4.82624 106.65 1.4411 89.6318C-1.94403 72.6135 0.676395 54.948 8.8559 39.6452C17.0354 24.3425 30.2679 12.3492 46.2987 5.70904C62.3296 -0.931151 80.1669 -1.80744 96.7713 3.22947C113.376 8.26639 127.72 18.9049 137.36 33.3322C147 47.7596 151.34 65.0832 149.639 82.3513C147.938 99.6194 140.302 115.764 128.033 128.033L125.381 125.381C137.037 113.725 144.291 98.3884 145.907 81.9837C147.523 65.579 143.4 49.1216 134.242 35.4156C125.084 21.7096 111.457 11.6031 95.6828 6.818C79.9085 2.03293 62.9631 2.86541 47.7338 9.17359C32.5045 15.4818 19.9336 26.8753 12.1631 41.413C4.39258 55.9506 1.90317 72.7329 5.11905 88.9002C8.33493 105.068 17.0571 119.62 29.7995 130.077C42.5418 140.534 58.5159 146.25 75 146.25V150Z","stroke-dasharray":"834.85528564453125",style:{"stroke-dashoffset":"-890px"},stroke:"#4282EC","stroke-width":"3"};function se(s,e,i,n,t,r){return l(),d("svg",Y,[h("g",ee,[h("path",te,null,512)])])}const ie=u(X,[["render",se],["__scopeId","data-v-53426355"]]);const ne={name:"main-preloader",props:{wait:Boolean,empty:{type:Boolean,default:!1},interval:{type:Number,default:15}},components:{PreloaderEndIcon:G,PreloaderLogoIcon:Z,PreloaderContainerIcon:ie},computed:{...w(["getActive"]),killPreloaderCondition(){return!this.service.waitTable.state&&!this.service.emptyTable.state&&this.service.endTable.state}},data(){return{service:new Q}},watch:{wait(s){this.service.setWaitState(s).setEndState(!s)},empty(s){this.service.setEmptyState(s).setCrossVisible(s).setLogoCenter(s)},"service.endTable.state"(s){this.service.setProgressVisible(!s).endProcess(s)},getActive(s,e){e!==-1&&this.service.startProcess(this.interval)}},mounted(){this.service.startProcess(this.interval)},unmounted(){this.service.endProcess(!0)}},re={class:"preloader cabinet__block"},oe={class:"preloader__icon"},ae={key:0,class:"preloader_progress"};function ce(s,e,i,n,t,r){var f,v,_;const o=C("preloader-end-icon"),g=C("preloader-logo-icon"),m=C("preloader-container-icon"),p=b("scroll");return x((l(),d("div",re,[h("div",{class:y(["preloader__wrap",{"preloader__wrap-no-info":(f=t.service.animateService.isCrossVisible)==null?void 0:f.state}])},[h("div",oe,[!t.service.animateService.cross.element||(v=t.service.animateService.isCrossVisible)!=null&&v.state?(l(),$(o,{key:0,class:"preloader_cross",id:"preloader_cross",onGetCross:e[0]||(e[0]=a=>t.service.setCross(a))})):P("",!0),S(g,{class:y(["preloader_logo",{"preloader_logo-center":(_=t.service.animateService.isLogoCenter)==null?void 0:_.state}]),id:"preloader_logo"},null,8,["class"]),S(m,{class:"preloader__icon-custom",onGetPolygon:e[1]||(e[1]=a=>t.service.setPolygon(a))})]),S(E,{name:"progress"},{default:k(()=>{var a;return[(a=t.service.animateService.isProgressVisible)!=null&&a.state?(l(),d("span",ae,I(String(t.service.progressPercentage).length<=3?`${t.service.progressPercentage}%`:s.$t(t.service.progressPercentage)),1)):P("",!0)]}),_:1})],2)])),[[p,"opacity transition--fast"],[L,!r.killPreloaderCondition]])}const pe=u(ne,[["render",ce],["__scopeId","data-v-1c7fac45"]]);export{pe as M,Q as P,Z as a,ie as b};