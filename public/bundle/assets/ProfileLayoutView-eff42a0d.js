import{N as m,H as f}from"./NavTabs-a6ec92de.js";import{N as _}from"./NotificationList-09539f47.js";import{I as g}from"./InstructionService-d77d7f22.js";import{_ as h,m as v,r as n,o as a,c as b,d as c,a as u,s as y,g as B,i as w,K as S}from"./app-7a3a58ff.js";import"./SelectTheme-71497640.js";import"./MainMenu-3e28dd31.js";import"./wallet-icon-f914ad52.js";/* empty css                   *//* empty css                       */import"./AccountMenu-396d6837.js";import"./MainPopup-3ac77bbe.js";import"./anime.es-de4e5aa0.js";import"./MainTitle-5abaae33.js";/* empty css                                                                  */import"./MainIcon-57980112.js";const C={components:{NotificationList:_,NavTabs:m,HeaderComponentProfile:f},data(){return{isOpenBurger:!1,instructionService:new g}},methods:{change(t){this.isOpenBurger=t,document.body.style.overflowY=t?"hidden":"scroll"}},computed:{...v(["getActive","user","viewportWidth"])},async mounted(){var t,e,i;(t=this.$route)!=null&&t.query.access_key||await this.$store.dispatch("setUser"),this.$store.dispatch("set_accounts",{route:this.$route,user_id:(e=this.user)==null?void 0:e.id}),((i=this.$route.query)==null?void 0:i.onboarding)==="true"&&this.instructionService.setStepsCount(2).setVisible()}},N={class:"layout"},O={class:"layout__content"};function V(t,e,i,k,o,s){const p=n("nav-tabs"),l=n("header-component-profile"),d=n("notification-list");return a(),b("div",N,[c(p,{ref:"tabs","is-open-burger":o.isOpenBurger,"instruction-config":o.instructionService,onChangeBurger:e[0]||(e[0]=r=>s.change(r)),onCloseBurger:e[1]||(e[1]=r=>s.change(!1))},null,8,["is-open-burger","instruction-config"]),u("div",O,[c(l,{class:"header-container","is-open-burger":o.isOpenBurger,"instruction-config":o.instructionService,onChangeBurger:e[2]||(e[2]=r=>s.change(r))},null,8,["is-open-burger","instruction-config"]),u("div",{class:"page-container",style:y({"overflow-y":o.isOpenBurger&&t.viewportWidth<=900?"hidden":"scroll"})},[c(d),(a(),B(S,null,[w(t.$slots,"default",{},void 0,!0)],1024))],4)])])}const Y=h(C,[["render",V],["__scopeId","data-v-9dbdbf96"]]);export{Y as default};
