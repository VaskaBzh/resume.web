import{M as B}from"./MainTitle-5abaae33.js";import{B as b}from"./ButtonBlue-af33d8d4.js";import{M as g}from"./MainAccordion-fe732dfb.js";import{_ as F,r as d,o as e,c as i,a as o,d as r,h as n,b as _,t as h,F as m,k as u,x as v,g as C}from"./app-7a3a58ff.js";/* empty css                                                                *//* empty css                                                                  *//* empty css                                                                   *//* empty css                                                      */const L={components:{MainTitle:B,BlueButton:b,MainAccordion:g},data(){return{searchQuery:""}},computed:{filteredFaq(){const t=this.searchQuery.toLowerCase().trim();return t?this.faq.map(s=>{const a=Object.fromEntries(Object.entries(s.list).filter(([q,l])=>l.title.toLowerCase().includes(t)||l.text.toLowerCase().includes(t)));if(Object.keys(a).length)return{...s,list:a}}).filter(Boolean):this.faq},faq(){return[{title:this.$t("faq[0].title"),list:{0:{title:this.$t("faq[0].list[0].title"),text:this.$t("faq[0].list[0].text")},1:{title:this.$t("faq[0].list[1].title"),text:this.$t("faq[0].list[1].text")},2:{title:this.$t("faq[0].list[2].title"),text:this.$t("faq[0].list[2].text")},3:{title:this.$t("faq[0].list[3].title"),text:this.$t("faq[0].list[3].text")}}},{title:this.$t("faq[1].title"),list:{0:{title:this.$t("faq[1].list[0].title"),text:this.$t("faq[1].list[0].text")},1:{title:this.$t("faq[1].list[1].title"),text:this.$t("faq[1].list[1].text")},2:{title:this.$t("faq[1].list[2].title"),text:this.$t("faq[1].list[2].text")}}}]}},mounted(){document.title="FAQ"}},w={class:"faq"},M={class:"faq__main"},Q={class:"description-text"},j={class:"section__block section__block-light"};function A(t,s,a,q,l,p){const c=d("main-title"),x=d("main-accordion");return e(),i("div",w,[o("div",M,[r(c,{class:"faq_title"},{default:n(()=>[_(" FAQ")]),_:1}),o("p",Q,h(t.$t("faq[0].description")),1),r(v,{name:"fade"},{default:n(()=>[(e(!0),i(m,null,u(p.filteredFaq,(f,$)=>(e(),i("div",{key:$,class:"faq__list"},[r(c,{class:"title-gray"},{default:n(()=>[_(h(f.title),1)]),_:2},1024),o("div",j,[(e(!0),i(m,null,u(f.list,(k,y)=>(e(),C(x,{key:y,accordion:k},null,8,["accordion"]))),128))])]))),128))]),_:1})])])}const P=F(L,[["render",A],["__scopeId","data-v-dd8178b2"]]);export{P as default};