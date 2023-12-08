import{M as B}from"./MainTitle-5abaae33.js";import{C as T,T as N}from"./TickIcon-df7ac9c5.js";import{_ as C,r as o,o as s,c as p,a as _,t as L,d as i,h as d,w as M,v as k,q as h,i as P,n as f,F as g,k as w,g as y,p as W,e as z,m as R,b as Z,T as A,j as D}from"./app-7a3a58ff.js";import{a as S,I as E}from"./InstructionService-d77d7f22.js";import{I as F}from"./InstructionButton-391a8821.js";import{M as H}from"./MainDescriptionOld-8ed807b9.js";import{W as q}from"./WarningBlock-e958f63d.js";/* empty css                                                                  */import"./MainIcon-57980112.js";import"./MainDescription-a8d06221.js";const G={name:"copy-row",props:{copyObject:Object},components:{CopyIcon:T,TickIcon:N},data(){return{active:!1}},methods:{copyLink(){navigator.clipboard.writeText(this.copyObject.link),this.active=!0,setTimeout(()=>{this.active=!1},800)}}},J={class:"copy_label"},K={class:"copy_link"};function Q(e,t,c,v,n,m){const l=o("copy-icon"),a=o("tick-icon");return s(),p("div",{class:f(["copy",{active:n.active}]),onClick:t[0]||(t[0]=(...r)=>this.copyLink&&this.copyLink(...r))},[_("span",J,L(this.copyObject.title)+":",1),_("span",K,L(this.copyObject.link),1),i(h,{name:"copy"},{default:d(()=>[M(i(l,{class:"copy_icon"},null,512),[[k,!n.active]])]),_:1}),i(h,{name:"tick"},{default:d(()=>[M(i(a,{class:"copy_tick"},null,512),[[k,n.active]])]),_:1}),P(e.$slots,"instruction",{},void 0,!0)],2)}const x=C(G,[["render",Q],["__scopeId","data-v-eee44ccf"]]);const U={components:{CopyRow:x,InstructionStep:S},name:"copy-block",props:{copyObject:Object,instructionConfig:Object}};function X(e,t,c,v,n,m){const l=o("copy-row"),a=o("instruction-step");return s(),p("div",{class:f(["copy__block onboarding_block",{"onboarding_block-target":c.instructionConfig.isVisible&&c.instructionConfig.step===1}])},[(s(!0),p(g,null,w(this.copyObject.copyObject,(r,b)=>(s(),y(l,{key:b,copyObject:r},null,8,["copyObject"]))),128)),i(a,{onNext:t[0]||(t[0]=r=>c.instructionConfig.nextStep()),onPrev:t[1]||(t[1]=r=>c.instructionConfig.prevStep()),onClose:t[2]||(t[2]=r=>c.instructionConfig.nextStep(6)),step_active:1,steps_count:c.instructionConfig.steps_count,step:c.instructionConfig.step,isVisible:c.instructionConfig.isVisible,text:"texts.connecting[0]",title:"titles.connecting[0]",className:"onboarding__card-right"},null,8,["steps_count","step","isVisible"])],2)}const Y=C(U,[["render",X],["__scopeId","data-v-598f59fe"]]);const t1={name:"connection-icon"},n1=e=>(W("data-v-77a33a8d"),e=e(),z(),e),e1={xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",class:"connecting_icon"},o1=n1(()=>_("path",{d:"M22.5303 2.53033C22.8232 2.23744 22.8232 1.76256 22.5303 1.46967C22.2374 1.17678 21.7626 1.17678 21.4697 1.46967L22.5303 2.53033ZM19.4697 3.46967C19.1768 3.76256 19.1768 4.23744 19.4697 4.53033C19.7626 4.82322 20.2374 4.82322 20.5303 4.53033L19.4697 3.46967ZM19.4967 11.7619L18.9664 11.2316L19.4967 11.7619ZM16.5933 12.4877L17.1236 11.9574L16.5933 12.4877ZM18.7708 12.4877L19.3012 13.0181L18.7708 12.4877ZM11.5123 5.22916L10.9819 4.69883L11.5123 5.22916ZM11.5123 7.40674L10.9819 7.93707L11.5123 7.40674ZM12.2381 4.5033L12.7684 5.03363L12.2381 4.5033ZM4.53033 20.5303C4.82322 20.2374 4.82322 19.7626 4.53033 19.4697C4.23744 19.1768 3.76256 19.1768 3.46967 19.4697L4.53033 20.5303ZM1.46967 21.4697C1.17678 21.7626 1.17678 22.2374 1.46967 22.5303C1.76256 22.8232 2.23744 22.8232 2.53033 22.5303L1.46967 21.4697ZM11.7619 19.4967L12.2922 20.027H12.2922L11.7619 19.4967ZM12.4877 16.5933L13.0181 16.0629L12.4877 16.5933ZM12.4877 18.7708L11.9574 18.2405H11.9574L12.4877 18.7708ZM5.22916 11.5123L5.75949 12.0426L5.75949 12.0426L5.22916 11.5123ZM7.40674 11.5123L6.87641 12.0426L7.40674 11.5123ZM4.5033 12.2381L3.97297 11.7078L3.97297 11.7078L4.5033 12.2381ZM9.96967 8.96967C9.67678 9.26256 9.67678 9.73744 9.96967 10.0303C10.2626 10.3232 10.7374 10.3232 11.0303 10.0303L9.96967 8.96967ZM12.5303 8.53033C12.8232 8.23744 12.8232 7.76256 12.5303 7.46967C12.2374 7.17678 11.7626 7.17678 11.4697 7.46967L12.5303 8.53033ZM13.9697 12.9697C13.6768 13.2626 13.6768 13.7374 13.9697 14.0303C14.2626 14.3232 14.7374 14.3232 15.0303 14.0303L13.9697 12.9697ZM16.5303 12.5303C16.8232 12.2374 16.8232 11.7626 16.5303 11.4697C16.2374 11.1768 15.7626 11.1768 15.4697 11.4697L16.5303 12.5303ZM21.4697 1.46967L19.4697 3.46967L20.5303 4.53033L22.5303 2.53033L21.4697 1.46967ZM11.7078 3.97297L10.9819 4.69883L12.0426 5.75949L12.7684 5.03363L11.7078 3.97297ZM10.9819 7.93707L16.0629 13.0181L17.1236 11.9574L12.0426 6.87641L10.9819 7.93707ZM19.3012 13.0181L20.027 12.2922L18.9664 11.2316L18.2405 11.9574L19.3012 13.0181ZM20.027 12.2922C22.3243 9.99492 22.3243 6.27027 20.027 3.97297L18.9664 5.03363C20.6779 6.74514 20.6779 9.52005 18.9664 11.2316L20.027 12.2922ZM12.7684 5.03363C14.48 3.32212 17.2549 3.32212 18.9664 5.03363L20.027 3.97297C17.7297 1.67568 14.0051 1.67568 11.7078 3.97297L12.7684 5.03363ZM12.0426 6.87641C11.8131 6.6469 11.7519 6.45527 11.75 6.32326C11.7482 6.19624 11.7993 6.0028 12.0426 5.75949L10.9819 4.69883C10.521 5.15975 10.2413 5.72436 10.2502 6.34472C10.259 6.96007 10.55 7.50512 10.9819 7.93707L12.0426 6.87641ZM18.2405 11.9574C18.011 12.1869 17.8194 12.2481 17.6874 12.25C17.5603 12.2518 17.3669 12.2007 17.1236 11.9574L16.0629 13.0181C16.5239 13.479 17.0885 13.7587 17.7088 13.7498C18.3242 13.741 18.8692 13.45 19.3012 13.0181L18.2405 11.9574ZM3.46967 19.4697L1.46967 21.4697L2.53033 22.5303L4.53033 20.5303L3.46967 19.4697ZM5.03363 12.7684L5.75949 12.0426L4.69883 10.9819L3.97297 11.7078L5.03363 12.7684ZM6.87641 12.0426L11.9574 17.1236L13.0181 16.0629L7.93707 10.9819L6.87641 12.0426ZM11.9574 18.2405L11.2316 18.9664L12.2922 20.027L13.0181 19.3012L11.9574 18.2405ZM11.2316 18.9664C9.52005 20.6779 6.74514 20.6779 5.03363 18.9664L3.97297 20.027C6.27027 22.3243 9.99492 22.3243 12.2922 20.027L11.2316 18.9664ZM3.97297 11.7078C1.67568 14.0051 1.67568 17.7297 3.97297 20.027L5.03363 18.9664C3.32212 17.2549 3.32212 14.48 5.03363 12.7684L3.97297 11.7078ZM7.93707 10.9819C7.50512 10.55 6.96007 10.259 6.34472 10.2502C5.72436 10.2413 5.15975 10.521 4.69883 10.9819L5.75949 12.0426C6.0028 11.7993 6.19624 11.7482 6.32326 11.75C6.45527 11.7519 6.6469 11.8131 6.87641 12.0426L7.93707 10.9819ZM13.0181 19.3012C13.45 18.8692 13.741 18.3242 13.7498 17.7088C13.7587 17.0885 13.479 16.5239 13.0181 16.0629L11.9574 17.1236C12.2007 17.3669 12.2518 17.5603 12.25 17.6874C12.2481 17.8194 12.1869 18.011 11.9574 18.2405L13.0181 19.3012ZM11.0303 10.0303L12.5303 8.53033L11.4697 7.46967L9.96967 8.96967L11.0303 10.0303ZM15.0303 14.0303L16.5303 12.5303L15.4697 11.4697L13.9697 12.9697L15.0303 14.0303Z"},null,-1)),i1=[o1];function c1(e,t,c,v,n,m){return s(),p("svg",e1,i1)}const s1=C(t1,[["render",c1],["__scopeId","data-v-77a33a8d"]]);const r1={components:{WarningBlock:q,MainDescription:H,InstructionButton:F,CopyRow:x,MainTitle:B,CopyBlock:Y,InstructionStep:S,ConnectionIcon:s1},data(){return{viewportWidth:0,instructionService:new E,isMounted:!1}},async created(){window.addEventListener("resize",this.handleResize),this.handleResize()},methods:{handleResize(){this.viewportWidth=window.innerWidth}},computed:{...R(["allAccounts","getAccount"]),copyObject(){return[{copyObject:[{link:"btc.all-btc.com:4444",title:"Port1"},{link:"btc.all-btc.com:3333",title:"Port 2"},{link:"btc.all-btc.com:2222",title:"Port 3"}]}]}},watch:{"$i18n.locale"(){document.title=this.$t("header.links.connecting")}},mounted(){this.isMounted=!0,this.instructionService.setStepsCount(2),document.title=this.$t("header.links.connecting")}},_1={class:"connecting"},p1={class:"connecting__wrapper"},l1={class:"connecting__content"},a1={class:"note-card"},u1={class:"note-text"};function L1(e,t,c,v,n,m){const l=o("main-title"),a=o("main-description"),r=o("copy-block"),b=o("instruction-step"),$=o("copy-row"),j=o("connection-icon"),I=o("warning-block"),O=o("instruction-button");return s(),p(g,null,[_("div",_1,[_("div",p1,[i(l,{class:"title-connecting"},{default:d(()=>[Z(L(e.$t("connection.title")),1)]),_:1}),i(a,{class:"connecting_description"},{default:d(()=>[Z(L(e.$t("connection.block.title")),1)]),_:1}),_("div",l1,[(s(!0),p(g,null,w(m.copyObject,(u,V)=>(s(),y(r,{key:V,"copy-object":u,"instruction-config":n.instructionService},null,8,["copy-object","instruction-config"]))),128)),i($,{"copy-object":{link:`${e.getAccount.name}.worker_name`,title:"Worker name"},class:f(["onboarding_block",{"onboarding_block-target":n.instructionService.isVisible&&n.instructionService.step===2}])},{instruction:d(()=>[i(b,{step_active:2,steps_count:n.instructionService.steps_count,step:n.instructionService.step,"is-visible":n.instructionService.isVisible,text:"texts.connecting[1]",title:"titles.connecting[1]","class-name":"onboarding__card-right",onNext:t[0]||(t[0]=u=>n.instructionService.nextStep()),onPrev:t[1]||(t[1]=u=>n.instructionService.prevStep()),onClose:t[2]||(t[2]=u=>n.instructionService.nextStep(6))},null,8,["steps_count","step","is-visible"])]),_:1},8,["copy-object","class"])]),_("div",a1,[i(j,{class:"note_icon"}),_("span",u1,L(e.$t("connection.note")),1)]),i(I,{link:e.$t("connecting_feedback"),text:e.$t("connecting_text")},null,8,["link","text"])])]),n.isMounted?(s(),y(A,{key:0,to:".header_button-instruction"},[i(O,{hint:"connecting",onOpenInstruction:t[3]||(t[3]=u=>n.instructionService.setStep().setVisible())})])):D("",!0)],64)}const h1=C(r1,[["render",L1],["__scopeId","data-v-8c5e8df9"]]);export{h1 as default};
