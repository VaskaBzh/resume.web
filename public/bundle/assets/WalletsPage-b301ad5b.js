import{M as E}from"./MainTitle-5abaae33.js";import{m as T,_ as B,o as c,c as w,a as l,t as n,p as I,e as P,r as d,d as p,h as u,b as _,B as N,F,C as r,P as b,f as R,g as v,j as m,n as Z,k as q,w as y,v as J,J as k,T as K}from"./app-7a3a58ff.js";import{M as Q}from"./MainMenu-3e28dd31.js";import{M as z}from"./MainButton-069506c4.js";import{M as X}from"./MainPreloader-edb92089.js";import{M as Y}from"./MainPopup-3ac77bbe.js";import{M as U}from"./MainDescriptionOld-8ed807b9.js";import{T as $}from"./TooltipCard-430f11e3.js";import{W as tt}from"./WarningBlock-e958f63d.js";import{a as et,I as st}from"./InstructionService-d77d7f22.js";import{I as lt}from"./InstructionButton-391a8821.js";import{M as it}from"./MainInput-7e1d9d63.js";import{a as at,V as ot,b as D}from"./VerifyLink-301fc5ba.js";import{D as nt}from"./DefaultSubsService-b95954c2.js";/* empty css                                                                  */import"./wallet-icon-f914ad52.js";import"./MainIcon-57980112.js";import"./StatesService-a0d6c34c.js";import"./anime.es-de4e5aa0.js";import"./MainDescription-a8d06221.js";const rt={name:"WalletBlock",components:{MainMenu:Q},props:{wallet:Object},data(){return{opened:!1,converter:null}},computed:{...T(["getActive","btcInfo"])},methods:{changeWalletObj(e){this.$emit("getWallet",e)}}},pt=e=>(I("data-v-90400841"),e=e(),P(),e),ct={class:"wallets__block_name"},dt={class:"wallet-inf"},ut={class:"wallet-fullname"},ht={class:"wallet-wallet_address"},_t=pt(()=>l("div",{class:"wallets__block_doths"},[l("div"),l("div"),l("div")],-1));function mt(e,t,o,a,s,h){return c(),w("div",{class:"wallets__block wallets__block-wallet",onClick:t[0]||(t[0]=L=>h.changeWalletObj(o.wallet))},[l("div",ct,[l("div",dt,[l("span",ut,n(o.wallet.fullName||"Wallet"),1),l("span",ht,n(o.wallet.wallet_address),1)]),_t])])}const wt=B(rt,[["render",mt],["__scopeId","data-v-90400841"]]);const ft={name:"VerifyForm",props:{title:Boolean,text:Boolean,placeholder:Boolean,re_verify_text:Boolean,button_text:Boolean,wait:{type:Boolean,default:!1}},emits:["back","sendForm"],computed:{...T(["user"])},i18n:{sharedMessages:at},components:{VerifyLink:ot,MainInput:it,MainTitle:E,MainDescription:U,MainButton:z},data(){return{service:new D}},methods:{sendFormWithCode(){var e;this.wait||((e=this.service.form.code)==null?void 0:e.length)>0&&this.$emit("sendForm",this.service.form.code)},backHandler(e){(e.pointerType==="touch"||e.pointerType==="mouse")&&this.$emit("back")}}},vt={class:"verify__head"},gt={class:"verify__buttons"};function bt(e,t,o,a,s,h){const L=d("main-title"),g=d("main-description"),x=d("main-input"),C=d("verify-link"),W=d("main-button");return c(),w(F,null,[l("div",vt,[p(L,null,{default:u(()=>[_(n(e.$t(o.title)),1)]),_:1}),p(g,null,{default:u(()=>[_(n(e.$t(o.text)),1)]),_:1})]),l("form",{class:"verify__content",onSubmit:t[1]||(t[1]=N((...f)=>h.sendFormWithCode&&h.sendFormWithCode(...f),["prevent"]))},[p(x,{class:"verify_input","input-name":"code","input-label":e.$t(o.placeholder),"input-value":s.service.form.code,onGetValue:t[0]||(t[0]=f=>s.service.form.code=f)},null,8,["input-label","input-value"]),p(C,{class:"verify_link","verify-text":e.$t(o.re_verify_text),"verify-url":`/send/code/${e.user.id}`},null,8,["verify-text","verify-url"]),l("div",gt,[p(W,{class:"button-reverse verify_button button-full",onClick:h.backHandler},{text:u(()=>[_(n(e.$t("back")),1)]),_:1},8,["onClick"]),p(W,{class:"button-blue verify_button button-full",type:"submit",wait:o.wait},{text:u(()=>[_(n(e.$t(o.button_text)),1)]),_:1},8,["wait"])])],32)],64)}const yt=B(ft,[["render",bt],["__scopeId","data-v-2ca91feb"]]),Lt={tera_hash_per_second:"Th/s",peta_hash_per_second:"Ph/s",exa_hash_per_second:"Eh/s",tera_hash:"T",peta_hash:"P",exa_hash:"E",bitcoin:"BTC",ruble:"₽",dollar:"$",usd:"USD"};class Ct{constructor(t){this.id=t.id,this.wallet_address=t.wallet,this.fullName=t.fullName,this.name=t.name,this.currency=Lt.bitcoin,this.total_payout=t.total_payout,this.percent=t.percent,this.minWithdrawal=t.minWithdrawal}}class Wt extends nt{constructor(t){super(),this.verify=new D(t),this.translate=t,this.form={id:"",name:"",wallet:"",group_id:this.group_id,code:""},this.waitWallets=!0,this.emptyTable=!1,this.wait=!1,this.closed=!1,this.opened=!1,this.isCodeSend=!1,this.waitAddWallet=!1,this.waitChangeWallet=!1,this.user={}}substring(t){return t.substr(0,4)+"..."+t.substr(t.length-4,t.length)}getName(t,o){return t?this.substring(t):this.substring(o)}clearForm(t){this.form={...t,id:"",name:"",wallet:"",group_id:this.group_id,code:""}}setForm(t){this.form={...this.form,id:t.id,name:t.fullName,wallet:t.wallet_address,group_id:this.group_id,code:""},this.openPopup()}openPopup(){this.opened=!0,setTimeout(()=>this.opened=!1,300)}closePopup(){setTimeout(()=>{this.closed=!0},300),setTimeout(()=>{this.closed=!1},600),this.isCodeSend=!1}async index(){var t;if(this.group_id!==-1){this.waitWallets=!0;try{const o=await this.fetch();o&&(this.wallets=o.map(a=>new Ct({...a,fullName:a.name??null}))),((t=this.wallets)==null?void 0:t.length)===0&&(this.emptyTable=!0)}catch(o){console.error(o)}this.waitWallets=!1}}validateAddress(){if(this.form.wallet.length<20)return r.dispatch("setNotification",{status:"error",title:"error",text:"text.wallet_address_minlength"}),!0;if(this.form.wallet.length>191)return r.dispatch("setNotification",{status:"error",title:"error",text:"text.wallet_address_maxlength"}),!0}validateName(){var t;if(this.form.name!==""&&((t=this.form.name)==null?void 0:t.length)<3)return r.dispatch("setNotification",{status:"error",title:"error",text:"text.name_minlength"}),!0}async addWallet(){if(this.waitAddWallet=!0,this.group_id!==-1){if(this.validateAddress()||this.validateName())return this.waitAddWallet=!1,this;if(this.wait=!0,this.form.code)try{const t={wallet_address:this.form.wallet,name:this.form.name,group_id:this.group_id,confirmation_code:this.form.code},o=await b.post("/wallets/create",t);this.isCodeSend=!1,r.dispatch("setNotification",{status:"success",title:"success",text:o.data.message}),await this.index(),this.clearForm(),this.closePopup(),this.waitAddWallet=!1}catch(t){this.waitAddWallet=!1,console.error("Error with: "+t),r.dispatch("setFullErrors",t.response.data.errors),t.response.status===403?r.dispatch("setNotification",{status:"warning",title:"warning",text:t.response.data.message}):r.dispatch("setNotification",{status:"error",title:"error",text:t.response.data.message})}else try{const t=await b.post(`/send/code/${this.user.id}`,this.form);this.isCodeSend=!0,r.dispatch("setNotification",{status:"success",title:"success",text:t.data.message}),this.waitAddWallet=!1}catch(t){this.waitAddWallet=!1,console.error("Error with: "+t),r.dispatch("setFullErrors",t.response.data.errors),r.dispatch("setNotification",{status:"error",title:"error",text:t.response.data.message})}this.wait=!1}else r.dispatch("getMessage",this.translate("wallets.messages[0]")),this.waitAddWallet=!1}setUser(t){this.user=t}back(){this.isCodeSend=!1,this.form.code=""}async changeWallet(){if(this.waitChangeWallet=!0,this.group_id!==-1){if(this.validateAddress()||this.validateName())return this.waitChangeWallet=!1,this;this.wait=!0;let t=0;const o=this.wallets.filter(a=>this.form.id===a.id)[0];try{if(o.fullName!==this.form.name)try{const a=await b.put(`/wallets/update/${o.wallet_address}`,this.form);r.dispatch("setNotification",{status:"success",title:"changed",text:a.data.data.message}),t++,this.waitChangeWallet=!1}catch(a){this.waitChangeWallet=!1,console.error("Error with: "+a),r.dispatch("setFullErrors",a.response.data.errors),r.dispatch("setNotification",{status:"error",title:"error",text:a.response.data.message})}if(this.form.code)try{const a={wallet_address:this.form.wallet,group_id:this.form.group_id,confirmation_code:this.form.code},s=await b.put(`/wallets/change/address/${o.wallet_address}`,a);r.dispatch("setNotification",{status:"success",title:"changed",text:s.data.message}),await this.index(),this.clearForm(),this.closePopup(),this.waitChangeWallet=!1;return}catch(a){this.waitChangeWallet=!1,console.error("Error with: "+a),r.dispatch("setFullErrors",a.response.data.errors),r.dispatch("setNotification",{status:"error",title:"error",text:a.response.data.message});return}if(o.wallet_address!==this.form.wallet)try{const a=await b.post(`/send/code/${this.user.id}`,this.form);this.isCodeSend=!0,r.dispatch("setNotification",{status:"success",title:"success",text:a.data.message}),t++,this.waitChangeWallet=!1;return}catch(a){this.waitChangeWallet=!1,console.error("Error with: "+a),r.dispatch("setFullErrors",a.response.data.errors),r.dispatch("setNotification",{status:"error",title:"error",text:a.response.data.message})}this.waitChangeWallet=!1,t>0&&(this.closePopup(),await this.index(),this.clearForm())}catch(a){this.waitChangeWallet=!1,console.error(a)}this.wait=!1}else r.dispatch("getMessage",this.translate("wallets.messages[0]")),this.waitChangeWallet=!1}async fetch(){if(this.group_id!==-1){this.emptyTable=!1,this.waitWallets=!0;let t=null;try{t=(await b.get(`/wallets/${this.group_id}`)).data.data}catch{this.emptyTable=!0,this.waitWallets=!1}return t}}}const kt="/bundle/assets/img_wallets-no-info-fb211771.png";const Mt={components:{VerifyForm:yt,InstructionButton:lt,WarningBlock:tt,MainPopup:Y,MainButton:z,MainTitle:E,WalletBlock:wt,TooltipCard:$,MainPreloader:X,MainDescription:U,InstructionStep:et},computed:{...T(["getActive","errors","user"]),endWallet(){var e;return((e=this.wallets.wallets)==null?void 0:e.length)>0},emptyWallet(){var e;return((e=this.wallets.wallets)==null?void 0:e.length)===0}},watch:{"wallets.form.name"(e,t){(e==null?void 0:e.length)>=16&&(this.wallets.form.name=t)},getActive(){this.walletInit()},"$i18n.locale"(){document.title=this.$t("header.links.wallets")},user(e){this.wallets.setUser(e)},"wallets.isCodeSend"(){this.makeResize=!0,setTimeout(()=>this.makeResize=!1,300)}},created(){window.addEventListener("resize",this.handleResize),this.handleResize()},props:["message","auth_user"],data(){return{viewportWidth:0,overTime:0,waitWallet:!0,wallets:new Wt(this.$t),isActiveLabelEmail:!1,makeResize:!1,isActiveLabelName:!1,isActiveLabelMinWithdrawal:!1,verifyButtonName:this.$t("wallets.no_info.verify_text"),instructionService:new st,isMounted:!1}},mounted(){this.isMounted=!0,this.instructionService.setStepsCount(2),this.walletInit(),document.title=this.$t("header.links.wallets"),this.$refs.page.style.opacity=1,this.user&&this.wallets.setUser(this.user)},methods:{changeWallet(e=null){this.wallets.waitChangeWallet||(this.setCode(e),this.wallets.changeWallet())},createWallet(e=null){this.wallets.waitAddWallet||(this.setCode(e),this.wallets.addWallet())},setCode(e){this.wallets.form.code=e},setForm(e){this.wallets.setForm(e)},walletInit(){this.getActive!==-1&&(this.wallets.setGroupId(this.getActive),this.wallets.index())},handleResize(){this.viewportWidth=window.innerWidth},sendEmailVerification(){this.wallets.verify.sendEmailVerification()}}},M=e=>(I("data-v-b0348aac"),e=e(),P(),e),xt={ref:"page",class:"wallets"},St={key:1,class:"wallet-wrapper"},Zt={class:"autopayout-component"},Nt={class:"header-component-wallet"},Ft={class:"tooltipe-container"},Tt={class:"form_column"},Bt={class:"autopayout-container"},At=M(()=>l("input",{id:"min",name:"minWithdrawal",type:"text",class:"input popup__input autopayout-input",placeholder:"0.005",disabled:""},null,-1)),Vt={for:"min",class:"main__label autopayout-label"},Et=M(()=>l("span",{class:"autopayout-btc"},"BTC",-1)),It={ref:"wallets",class:"wrap"},Pt={key:0,ref:"list",class:"wallets__list"},zt={key:2,class:"wallets__no-information cabinet__preloader cabinet__preloader-bg"},Ut={class:"wallets__no-information__content"},Dt=M(()=>l("img",{src:kt,alt:"",class:"wallets__no wallets__no-information_img"},null,-1)),Gt={class:"wallets__block-warning"},jt={class:"wallets__head"},Ht=M(()=>l("div",{class:"wallets_icon"},[l("svg",{width:"24",height:"25",viewBox:"0 0 24 25",fill:"none",xmlns:"http://www.w3.org/2000/svg"},[l("path",{d:"M22.5303 3.03033C22.8232 2.73744 22.8232 2.26256 22.5303 1.96967C22.2374 1.67678 21.7626 1.67678 21.4697 1.96967L22.5303 3.03033ZM19.4697 3.96967C19.1768 4.26256 19.1768 4.73744 19.4697 5.03033C19.7626 5.32322 20.2374 5.32322 20.5303 5.03033L19.4697 3.96967ZM19.4967 12.2619L18.9664 11.7316L19.4967 12.2619ZM16.5933 12.9877L17.1236 12.4574L16.5933 12.9877ZM18.7708 12.9877L19.3012 13.5181L18.7708 12.9877ZM11.5123 5.72916L10.9819 5.19883L11.5123 5.72916ZM11.5123 7.90674L10.9819 8.43707L11.5123 7.90674ZM12.2381 5.0033L12.7684 5.53363L12.2381 5.0033ZM4.53033 21.0303C4.82322 20.7374 4.82322 20.2626 4.53033 19.9697C4.23744 19.6768 3.76256 19.6768 3.46967 19.9697L4.53033 21.0303ZM1.46967 21.9697C1.17678 22.2626 1.17678 22.7374 1.46967 23.0303C1.76256 23.3232 2.23744 23.3232 2.53033 23.0303L1.46967 21.9697ZM11.7619 19.9967L12.2922 20.527H12.2922L11.7619 19.9967ZM12.4877 17.0933L13.0181 16.5629L12.4877 17.0933ZM12.4877 19.2708L11.9574 18.7405H11.9574L12.4877 19.2708ZM5.22916 12.0123L5.75949 12.5426L5.75949 12.5426L5.22916 12.0123ZM7.40674 12.0123L6.87641 12.5426L7.40674 12.0123ZM4.5033 12.7381L3.97297 12.2078L3.97297 12.2078L4.5033 12.7381ZM9.96967 9.46967C9.67678 9.76256 9.67678 10.2374 9.96967 10.5303C10.2626 10.8232 10.7374 10.8232 11.0303 10.5303L9.96967 9.46967ZM12.5303 9.03033C12.8232 8.73744 12.8232 8.26256 12.5303 7.96967C12.2374 7.67678 11.7626 7.67678 11.4697 7.96967L12.5303 9.03033ZM13.9697 13.4697C13.6768 13.7626 13.6768 14.2374 13.9697 14.5303C14.2626 14.8232 14.7374 14.8232 15.0303 14.5303L13.9697 13.4697ZM16.5303 13.0303C16.8232 12.7374 16.8232 12.2626 16.5303 11.9697C16.2374 11.6768 15.7626 11.6768 15.4697 11.9697L16.5303 13.0303ZM21.4697 1.96967L19.4697 3.96967L20.5303 5.03033L22.5303 3.03033L21.4697 1.96967ZM11.7078 4.47297L10.9819 5.19883L12.0426 6.25949L12.7684 5.53363L11.7078 4.47297ZM10.9819 8.43707L16.0629 13.5181L17.1236 12.4574L12.0426 7.37641L10.9819 8.43707ZM19.3012 13.5181L20.027 12.7922L18.9664 11.7316L18.2405 12.4574L19.3012 13.5181ZM20.027 12.7922C22.3243 10.4949 22.3243 6.77027 20.027 4.47297L18.9664 5.53363C20.6779 7.24514 20.6779 10.02 18.9664 11.7316L20.027 12.7922ZM12.7684 5.53363C14.48 3.82212 17.2549 3.82212 18.9664 5.53363L20.027 4.47297C17.7297 2.17568 14.0051 2.17568 11.7078 4.47297L12.7684 5.53363ZM12.0426 7.37641C11.8131 7.1469 11.7519 6.95527 11.75 6.82326C11.7482 6.69624 11.7993 6.5028 12.0426 6.25949L10.9819 5.19883C10.521 5.65975 10.2413 6.22436 10.2502 6.84472C10.259 7.46007 10.55 8.00512 10.9819 8.43707L12.0426 7.37641ZM18.2405 12.4574C18.011 12.6869 17.8194 12.7481 17.6874 12.75C17.5603 12.7518 17.3669 12.7007 17.1236 12.4574L16.0629 13.5181C16.5239 13.979 17.0885 14.2587 17.7088 14.2498C18.3242 14.241 18.8692 13.95 19.3012 13.5181L18.2405 12.4574ZM3.46967 19.9697L1.46967 21.9697L2.53033 23.0303L4.53033 21.0303L3.46967 19.9697ZM5.03363 13.2684L5.75949 12.5426L4.69883 11.4819L3.97297 12.2078L5.03363 13.2684ZM6.87641 12.5426L11.9574 17.6236L13.0181 16.5629L7.93707 11.4819L6.87641 12.5426ZM11.9574 18.7405L11.2316 19.4664L12.2922 20.527L13.0181 19.8012L11.9574 18.7405ZM11.2316 19.4664C9.52005 21.1779 6.74514 21.1779 5.03363 19.4664L3.97297 20.527C6.27027 22.8243 9.99492 22.8243 12.2922 20.527L11.2316 19.4664ZM3.97297 12.2078C1.67568 14.5051 1.67568 18.2297 3.97297 20.527L5.03363 19.4664C3.32212 17.7549 3.32212 14.98 5.03363 13.2684L3.97297 12.2078ZM7.93707 11.4819C7.50512 11.05 6.96007 10.759 6.34472 10.7502C5.72436 10.7413 5.15975 11.021 4.69883 11.4819L5.75949 12.5426C6.0028 12.2993 6.19624 12.2482 6.32326 12.25C6.45527 12.2519 6.6469 12.3131 6.87641 12.5426L7.93707 11.4819ZM13.0181 19.8012C13.45 19.3692 13.741 18.8242 13.7498 18.2088C13.7587 17.5885 13.479 17.0239 13.0181 16.5629L11.9574 17.6236C12.2007 17.8669 12.2518 18.0603 12.25 18.1874C12.2481 18.3194 12.1869 18.511 11.9574 18.7405L13.0181 19.8012ZM11.0303 10.5303L12.5303 9.03033L11.4697 7.96967L9.96967 9.46967L11.0303 10.5303ZM15.0303 14.5303L16.5303 13.0303L15.4697 11.9697L13.9697 13.4697L15.0303 14.5303Z",fill:"#FFB868"})])],-1)),Ot={class:"wallets_description-warning"},Rt={class:"autopayout-input_container"},qt={class:"label-popup"},Jt=["placeholder"],Kt={class:"autopayout-input_container"},Qt={class:"label-popup"},Xt=["placeholder"],Yt={class:"wallet-description"},$t={class:"autopayout-input_container"},te={class:"label-popup"},ee=["placeholder"],se={class:"autopayout-input_container"},le={class:"label-popup"},ie=["placeholder"];function ae(e,t,o,a,s,h){const L=d("main-preloader"),g=d("main-title"),x=d("tooltip-card"),C=d("instruction-step"),W=d("wallet-block"),f=d("warning-block"),G=d("main-description"),S=d("main-button"),A=d("verify-form"),V=d("main-popup"),j=d("instruction-button"),H=R("scroll");return c(),w(F,null,[l("div",xt,[s.wallets.emptyTable?m("",!0):(c(),v(L,{key:0,class:"cabinet__preloader cabinet__preloader-bg wallets__preloader",wait:s.wallets.waitWallets,interval:35,end:!s.wallets.waitWallets,empty:s.wallets.emptyTable},null,8,["wait","end","empty"])),!s.wallets.waitWallets&&!s.wallets.emptyTable?(c(),w("div",St,[l("div",{class:Z(["wallet__block onboarding_block",{"onboarding_block-target":s.instructionService.isVisible&&s.instructionService.step===1}])},[l("div",Zt,[l("div",Nt,[p(g,null,{default:u(()=>[_(n(e.$t("wallets.title[0]")),1)]),_:1}),l("div",Ft,[p(x,{text:e.$t("wallets.tooltip")},null,8,["text"])])]),l("div",Tt,[l("div",Bt,[At,l("label",Vt,n(e.$t("wallets.popups.change.labels.minWithdrawal")),1),Et])])]),p(C,{step_active:1,steps_count:s.instructionService.steps_count,step:s.instructionService.step,"is-visible":s.instructionService.isVisible,text:"texts.wallets[0]",title:"titles.wallets[0]","class-name":"onboarding__card-right",onNext:t[0]||(t[0]=i=>s.instructionService.nextStep()),onPrev:t[1]||(t[1]=i=>s.instructionService.prevStep()),onClose:t[2]||(t[2]=i=>s.instructionService.nextStep(6))},null,8,["steps_count","step","is-visible"])],2),l("div",{class:Z(["wallet__block onboarding_block",{"onboarding_block-target":s.instructionService.isVisible&&s.instructionService.step===2}])},[p(g,{class:"header-component-wallet"},{default:u(()=>[_(n(e.$t("wallets.title[1]")),1)]),_:1}),l("div",It,[s.wallets.waitWallets?m("",!0):(c(),w("div",Pt,[(c(!0),w(F,null,q(s.wallets.wallets,(i,O)=>y((c(),v(W,{key:O,wallet:i,onGetWallet:h.setForm},null,8,["wallet","onGetWallet"])),[[H,"top"]])),128)),p(f,{class:"wallets_warning",text:"wallets_change"})],512))],512),p(C,{step_active:2,steps_count:s.instructionService.steps_count,step:s.instructionService.step,"is-visible":s.instructionService.isVisible,text:"texts.wallets[1]",title:"titles.wallets[1]","class-name":"onboarding__card-right",onNext:t[3]||(t[3]=i=>s.instructionService.nextStep()),onPrev:t[4]||(t[4]=i=>s.instructionService.prevStep()),onClose:t[5]||(t[5]=i=>s.instructionService.nextStep(6))},null,8,["steps_count","step","is-visible"])],2)])):m("",!0),s.wallets.emptyTable&&!s.wallets.waitWallet?(c(),w("div",zt,[l("div",Ut,[Dt,p(G,null,{default:u(()=>[_(n(e.$t("wallets.no_info.description")),1)]),_:1}),y(l("div",Gt,[l("div",jt,[Ht,l("div",Ot,n(e.$t("wallets.no_info.message")),1)]),l("div",{class:"wallets_link-warning",onClick:t[6]||(t[6]=(...i)=>h.sendEmailVerification&&h.sendEmailVerification(...i))},n(s.verifyButtonName),1)],512),[[J,!e.user.email_verified_at]]),p(S,{class:Z(["button-blue button-full wallets_button-no-information",{"button-disabled":!e.user.email_verified_at}]),"data-popup":e.user.email_verified_at?"#addWallet":""},{text:u(()=>[_(n(e.$t("wallets.no_info.button_text")),1)]),_:1},8,["class","data-popup"])])])):m("",!0)],512),s.wallets.form?(c(),v(V,{key:0,id:"changeWallet",wait:s.wallets.wait,closed:s.wallets.closed,opened:s.wallets.opened,errors:e.errors,"make-resize":s.makeResize,onClosed:t[12]||(t[12]=i=>s.wallets.clearForm(s.wallets.form))},{default:u(()=>[s.wallets.isCodeSend?m("",!0):(c(),w("form",{key:0,class:"form form-popup popup__form",onSubmit:t[9]||(t[9]=N(i=>h.changeWallet(),["prevent"]))},[p(g,{class:"change-label_title"},{default:u(()=>[_(n(e.$t("wallets.popups.change.title")),1)]),_:1}),l("div",Rt,[l("label",qt,n(e.$t("wallets.popups.add.placeholders.wallet")),1),y(l("input",{"onUpdate:modelValue":t[7]||(t[7]=i=>s.wallets.form.wallet=i),autofocus:"",type:"text",class:"input popup__input autopayput_input",placeholder:e.$t("wallets.popups.change.placeholders.wallet")},null,8,Jt),[[k,s.wallets.form.wallet]])]),l("div",Kt,[l("label",Qt,n(e.$t("wallets.popups.add.placeholders.name")),1),y(l("input",{"onUpdate:modelValue":t[8]||(t[8]=i=>s.wallets.form.name=i),autofocus:"",type:"text",class:"input popup__input autopayput_input",placeholder:e.$t("wallets.popups.change.placeholders.name")},null,8,Xt),[[k,s.wallets.form.name]])]),p(f,{class:"wallets_warning",text:"wallets_change"}),p(S,{type:"submit",class:"button-full button-xl",wait:s.wallets.waitChangeWallet},{text:u(()=>[_(n(e.$t("wallets.popups.change.button")),1)]),_:1},8,["wait"])],32)),s.wallets.isCodeSend?(c(),v(A,{key:1,title:"form.wallets.title",text:"form.wallets.text",placeholder:"form.wallets.placeholder",re_verify_text:"form.wallets.re_verify_text",button_text:"form.wallets.button_text",wait:s.wallets.waitChangeWallet,onSendForm:t[10]||(t[10]=i=>h.changeWallet(i)),onBack:t[11]||(t[11]=i=>s.wallets.back())},null,8,["wait"])):m("",!0)]),_:1},8,["wait","closed","opened","errors","make-resize"])):m("",!0),s.wallets.form?(c(),v(V,{key:1,id:"addWallet",wait:s.wallets.wait,closed:s.wallets.closed,"make-resize":s.makeResize,onClosed:t[18]||(t[18]=i=>s.wallets.clearForm(s.wallets.form))},{default:u(()=>[s.wallets.isCodeSend?m("",!0):(c(),w("form",{key:0,class:"form form-popup popup__form",onSubmit:t[15]||(t[15]=N(i=>h.createWallet(),["prevent"]))},[p(g,null,{default:u(()=>[_(n(e.$t("wallets.popups.add.title"))+" ",1),l("p",Yt,n(e.$t("wallets.popups.note")),1)]),_:1}),l("div",$t,[l("label",te,n(e.$t("wallets.popups.add.placeholders.wallet")),1),y(l("input",{"onUpdate:modelValue":t[13]||(t[13]=i=>s.wallets.form.wallet=i),type:"text",autofocus:"",placeholder:e.$t("wallets.popups.add.placeholders.wallet"),class:"input popup__input autopayput_input"},null,8,ee),[[k,s.wallets.form.wallet]])]),l("div",se,[l("label",le,n(e.$t("wallets.popups.add.placeholders.name")),1),y(l("input",{"onUpdate:modelValue":t[14]||(t[14]=i=>s.wallets.form.name=i),type:"text",placeholder:e.$t("wallets.popups.add.placeholders.name"),class:"input popup__input autopayput_input"},null,8,ie),[[k,s.wallets.form.name]])]),p(f,{class:"wallets_warning",text:"wallets_change"}),p(S,{type:"submit",class:"button-full button-xl",wait:s.wallets.waitAddWallet},{text:u(()=>[_(n(e.$t("wallets.popups.add.button")),1)]),_:1},8,["wait"])],32)),s.wallets.isCodeSend?(c(),v(A,{key:1,title:"form.wallets_add.title",text:"form.wallets_add.text",placeholder:"form.wallets.placeholder",re_verify_text:"form.wallets.re_verify_text",button_text:"form.wallets_add.button_text",wait:s.wallets.waitAddWallet,onSendForm:t[16]||(t[16]=i=>h.createWallet(i)),onBack:t[17]||(t[17]=i=>s.wallets.back())},null,8,["wait"])):m("",!0)]),_:1},8,["wait","closed","make-resize"])):m("",!0),s.isMounted?(c(),v(K,{key:2,to:".header_button-instruction"},[p(j,{hint:"wallets",onOpenInstruction:t[19]||(t[19]=i=>s.instructionService.setStep().setVisible())})])):m("",!0)],64)}const Me=B(Mt,[["render",ae],["__scopeId","data-v-b0348aac"]]);export{Me as default};
