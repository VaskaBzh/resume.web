import{S,N as M,B as H,H as B,F as I,A as C}from"./ArrowUpIcon-bc4b823a.js";import{H as F}from"./HomeMessage-d8fcb3c3.js";import{_ as g,r as s,o as m,c as v,a as c,d as a,h as y,b as L,t as P,F as N,p as b,e as w,i as V}from"./app-7a3a58ff.js";import"./HostingMessage-36b739f1.js";import"./NavMessages-72153b48.js";import"./policy-bc46909d.js";const z={components:{SelectLanguageLand:S,NavLinks:M,BurgerMenu:H,HeaderLogoIcon:B},i18n:{sharedMessages:F}},A={id:"header",class:"nav"},W={class:"nav__container"},E={class:"burger-mobile"};function G(e,d,o,_,n,r){const i=s("router-link"),l=s("header-logo-icon"),p=s("nav-links"),u=s("select-language-land"),h=s("burger-menu");return m(),v(N,null,[c("nav",A,[c("div",W,[a(i,{to:"login",class:"button-black"},{default:y(()=>[L(P(e.$t("footer.button")),1)]),_:1}),a(i,{to:"/"},{default:y(()=>[a(l,{class:"nav_logo"})]),_:1}),a(p,{class:"nav__navigation"}),a(u,{class:"nav_lang"})])]),c("div",E,[a(h)])],64)}const O=g(z,[["render",G],["__scopeId","data-v-df6cd15e"]]);function q(e){let d=e,o=d.getContext("2d"),_=[],n=window.innerWidth-15,r=window.innerHeight,i=o.createLinearGradient(0,0,n,r);i.addColorStop(0,"#194185"),i.addColorStop(1,"#002564");const l=()=>{for(let t of _)o.beginPath(),o.fillStyle=i,o.arc(t.x,t.y,t.rad,0,2*Math.PI),o.fill(),t.x+=t.vx,t.y+=t.vy,(t.x<t.rad||t.x+t.rad>n)&&(t.vx=-t.vx),(t.y<t.rad||t.y+t.rad>r)&&(t.vy=-t.vy)},p=()=>n<=480?.5:n<=768?.75:1,u=()=>{const t=p(),k=Math.floor(20*t),x=300*t;for(let $=0;$<k;$++)_.push({x:Math.random()*n,y:Math.random()*r,vx:Math.random()*4-2,vy:Math.random()*4-2,rad:Math.random()*x+10})},h=()=>{o.clearRect(0,0,n,r),l(),requestAnimationFrame(h)},f=()=>{n=d.width=window.innerWidth-15,r=d.height=window.innerHeight,o.globalCompositeOperation="lighter"};window.onresize=f,f(),u(),h()}const D={name:"MainBackground",mounted(){this.initBackgroundService()},methods:{initBackgroundService(){const e=this.$refs.canvas;q(e)}}},R=e=>(b("data-v-675db8d2"),e=e(),w(),e),T={class:"background"},U=R(()=>c("div",{class:"background_filter"},null,-1)),j={ref:"canvas",width:"100%",height:"100%"};function J(e,d,o,_,n,r){return m(),v("div",T,[U,c("canvas",j,null,512)])}const K=g(D,[["render",J],["__scopeId","data-v-675db8d2"]]);const Q={components:{MainBackground:K,FooterHosting:I,HeaderComponent:O,ArrowUpIcon:C},async created(){await this.$store.dispatch("getMiningStat"),await this.$store.dispatch("getGraph")}},X=e=>(b("data-v-0296a920"),e=e(),w(),e),Y={class:"layout"},Z={class:"layout__container"},tt={class:"layout__block layout__block-fixed"},et={href:"#header",class:"layout_button"},ot=X(()=>c("a",{href:"https://t.me/allbtc_support",target:"_blank",class:"layout_button"}," ? ",-1));function nt(e,d,o,_,n,r){const i=s("main-background"),l=s("header-component"),p=s("arrow-up-icon"),u=s("FooterHosting");return m(),v("div",Y,[a(i),a(l),c("div",Z,[V(e.$slots,"default",{},void 0,!0),c("div",tt,[c("a",et,[a(p,{class:"layout_icon"})]),ot])]),a(u)])}const _t=g(Q,[["render",nt],["__scopeId","data-v-0296a920"]]);export{_t as default};
