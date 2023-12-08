import{M as v}from"./MainMenu-3e28dd31.js";import{_ as l,r as _,o as c,c as r,a as s,t as k,n as h,d as f,p as m,e as d,m as S}from"./app-7a3a58ff.js";const w={name:"select-language",props:{viewportWidth:Number},data(){return{opened:!1,options:[{img:"ru.svg",value:"ru"},{img:"en.svg",value:"en"}]}},components:{MainMenu:v},computed:{active(){return this.options.filter(e=>e.value===this.$i18n.locale)[0]}},methods:{async changeActive(e){this.$i18n.locale!==e.value&&(this.$i18n.locale=e.value,localStorage.setItem("location",e.value))},toggle(){this.opened=!this.opened},closeSelect(e){this.$refs.selectLanguage&&!this.$refs.selectLanguage.contains(e.target)&&(this.opened=!1)},async setLanguage(){localStorage.getItem("location")&&(this.$i18n.locale=localStorage.getItem("location"))}},created(){localStorage.getItem("location")&&(this.$i18n.locale=localStorage.getItem("location"))},mounted(){document.addEventListener("click",this.closeSelect),this.setLanguage()},unmounted(){document.removeEventListener("click",this.closeSelect)}},T=e=>(m("data-v-01be2fc4"),e=e(),d(),e),b=T(()=>s("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",class:"svg-lang"},[s("path",{d:"M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9","stroke-width":"1.5","stroke-linecap":"round","stroke-linejoin":"round"})],-1));function C(e,t,n,u,o,i){const a=_("main-menu");return c(),r("div",{ref:"selectLanguage",class:"select",onClick:t[0]||(t[0]=(...p)=>i.toggle&&i.toggle(...p))},[s("div",{class:h(["select_title menu_toggle",{rotate:o.opened}])},[s("span",null,k(i.active.value),1),b],2),f(a,{className:"select__options",opened:o.opened,options:o.options,onClicked:i.changeActive},null,8,["opened","options","onClicked"])],512)}const D=l(w,[["render",C],["__scopeId","data-v-01be2fc4"]]),L="/bundle/assets/dark-theme-a2d8a285.css",M="/bundle/assets/light-theme-8ae93846.css";class ${constructor(){this.linkElement=this.setLink(),this.theme=this.baseTheme()}baseTheme(){return localStorage.getItem("theme")?JSON.parse(localStorage.getItem("theme")):"dark"}createLink(){return document.createElement("link")}setLink(){return document.querySelector(`link[href='../scss/theme/${this.theme}-theme.css']`)||this.createLink()}}class E{constructor(){this.ThemeModel=new $,this.linkElement=this.ThemeModel.linkElement}setAttributes(t){this.linkElement.setAttribute("rel","stylesheet"),this.linkElement.setAttribute("href",t)}setTheme(t=this.ThemeModel.theme){localStorage.setItem("theme",JSON.stringify(t))}toggleTheme(t){const n=new URL(Object.assign({"/resources/scss/theme/dark-theme.css":L,"/resources/scss/theme/light-theme.css":M})[`/resources/scss/theme/${t}-theme.css`],self.location);this.linkElement||(this.linkElement=this.ThemeModel.createLink()),this.setAttributes(n),this.setTheme(t),this.linkElement&&document.head.appendChild(this.linkElement)}}const I={name:"select-theme",props:{viewportWidth:Number},data(){return{opened:!1,timer:!0,service:new E}},computed:{...S(["isDark"]),theme(){return this.active.value},options(){return[{name:"Светлая",img:"light.svg",value:"light"},{name:"Темная",img:"dark.svg",value:"dark"}]},active(){return this.isDark?this.options.filter(e=>e.value==="dark")[0]:this.options.filter(e=>e.value==="light")[0]}},methods:{async changeActive(){this.timer&&(this.timer=!1,this.theme==="light"?(this.$store.dispatch("SetThemeVal",!0),this.service.toggleTheme("dark")):(this.$store.dispatch("SetThemeVal",!1),this.service.toggleTheme("light")),this.$store.dispatch("theme",this.isDark),setTimeout(()=>this.timer=!0,500))},initTheme(){const e=JSON.parse(localStorage.getItem("theme"))??this.isDark?"dark":"light";this.$store.dispatch("theme",e),this.service.setTheme(),this.$store.dispatch("SetThemeVal",e!=="light"),this.service.toggleTheme(e)}},mounted(){this.initTheme()}},g=e=>(m("data-v-747a2e2b"),e=e(),d(),e),x=g(()=>s("svg",{xmlns:"http://www.w3.org/2000/svg",width:"32",height:"32",viewBox:"0 0 32 32",fill:"none"},[s("path",{d:"M28.6663 18.7713C27.0668 19.6254 25.2399 20.1096 23.2999 20.1096C16.9985 20.1096 11.8902 15.0013 11.8902 8.69997C11.8902 6.75998 12.3744 4.93307 13.2285 3.3335C7.55654 4.66281 3.33301 9.75367 3.33301 15.831C3.33301 22.92 9.07981 28.6668 16.1688 28.6668C22.2462 28.6668 27.337 24.4433 28.6663 18.7713Z",stroke:"#595E68","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"})],-1)),y=g(()=>s("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},[s("path",{d:"M12 2V3.5M12 20.5V22M19.0708 19.0713L18.0101 18.0106M5.98926 5.98926L4.9286 4.9286M22 12H20.5M3.5 12H2M19.0713 4.92871L18.0106 5.98937M5.98975 18.0107L4.92909 19.0714M17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12C7 9.23858 9.23858 7 12 7C14.7614 7 17 9.23858 17 12Z",stroke:"#595E68","stroke-width":"1.5","stroke-linecap":"round"})],-1)),A=[x,y];function N(e,t,n,u,o,i){return c(),r("div",{class:h(["checkbox",{active:e.isDark}]),onClick:t[0]||(t[0]=a=>i.changeActive())},A,2)}const O=l(I,[["render",N],["__scopeId","data-v-747a2e2b"]]);export{D as S,O as a};
