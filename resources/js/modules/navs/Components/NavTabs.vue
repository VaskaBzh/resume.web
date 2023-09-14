<template>
    <div>
        <router-link :to="{ name: 'home' }">
            <div class="logo-container">
                <img
                    class="logo-img"
                    src="../assets/img/logo-img.svg"
                    alt="logo"
                 >
                 <div class="allbtc-logo-container">
                    <img
                    class="logo-img"
                    src="../assets/img/logo-allbtc.svg"
                    alt="logo"
                    >
                    <img
                    class="logo-pool"
                    src="../assets/img/logo-pool.svg"
                    alt="logo"
                    >       
                </div>
            </div>
        </router-link>
        <article class="article-tabs">
            <account-menu
                :errors="errors"
                :viewportWidth="viewportWidth"
                :user="user"
            ></account-menu>
        <div class="nav-link-container">
            <router-link
                v-for="(link, i) in mainLinks"
                :key="i"
                :to="link.url"
                class="nav-link"
            >
            <div class="nav-link-item">
                <svg
                    v-html="link.icon"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="25"
                    viewBox="0 0 24 25"
                    fill="#98A2B3"
                ></svg>
                <span>
                    {{ $t(`tabs.${link.name}`) }}
                </span>
            </div>
        </router-link>
        <button class="header-nav-tabs" @click="actionList('sub')">
            <h3 class="title-tabs">Субаккаунт</h3>
            <div :class="{'open-arrow': isOpenSub, 'close-arrow': closeSubList }">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke="#D0D5DD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                 </svg>
            </div>
        </button>
        <router-link
                v-for="(link, i) in subLinks"
                :key="i"
                :to="link.url"
                class="nav-link"
                :class="{'close-list': closeSubList}"
                v-if="isOpenSub"
            >
            <div class="nav-link-item">
                    <svg
                    v-html="link.icon"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="25"
                    viewBox="0 0 24 25"
                    fill="none"
                ></svg>
                <span>
                    {{ $t(`tabs.${link.name}`) }}
                </span>
            </div>
        </router-link>

        <button class="header-nav-tabs" @click="actionList('settings')">
            <h3 class="title-tabs">Настройки</h3>
            <div :class="{'open-arrow': isOpenSettings, 'close-arrow': closeSettingsList }">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke="#D0D5DD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                 </svg>
            </div>
        </button>
        <router-link
                v-for="(link, i) in settingLinks"
                :key="i"
                :to="link.url"
                class="nav-link"
                :class="{'close-list': closeSettingsList}"
                v-if="isOpenSettings"
            >
            <div class="nav-link-item">
                <svg
                    v-html="link.icon"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="25"
                    viewBox="0 0 24 25"
                    fill="none"
                ></svg>
                <span>
                    {{ $t(`tabs.${link.name}`) }}
                </span>
            </div>
        </router-link>
        </div>
    </article>
    <div class="logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M15.1 16.4603C14.79 20.0603 12.94 21.5303 8.89 21.5303H8.76C4.29 21.5303 2.5 19.7403 2.5 15.2703V8.75027C2.5 4.28027 4.29 2.49027 8.76 2.49027H8.89C12.91 2.49027 14.76 3.94027 15.09 7.48027M9 12.0203L20.38 12.0203M18.15 15.3703L21.5 12.0203L18.15 8.67027" stroke="#98A2B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="nav-link">
            {{ $t('header.login.menu.logout') }} 
        </span>
    </div>
    </div>
</template>
<script>
import { TabsService } from "../services/TabsService";
import { useRoute } from "vue-router";
import { mapGetters } from "vuex";
import AccountMenu from "@/Components/UI/profile/AccountMenu.vue";
import { defineComponent } from "vue";

export default  defineComponent({
    components: {
        AccountMenu,
    }, 
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    data() {
        return {
            viewportWidth: 0,
            service: new TabsService(),
            subaccounts: new TabsService(),
            settings: new TabsService(),
            isOpenSub: true,
            isOpenSettings: true,
            closeSubList: false,
            closeSettingsList: false,
        };
    },
    props: {
        is_auth: {
            type: Boolean,
            default: false,
        },
        user: {
            type: Object,
        },
        errors: {
            type: Object,
        },
    },
    methods: {
        ...mapGetters(["user"]),
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        setMainLinks() {
            this.service.setMainLinks(this.user);
        },
        setSubaccountLinks(){
            this.subaccounts.setSubaccountLinks();
        },
        setSettingsLinks(){
            this.settings.setSettingsLinks();
        },
        actionList(name){
            if(name == 'sub'){
                if(this.isOpenSub){
                this.closeSubList = true
                setTimeout(() => {
                    this.closeSubList = false
                    this.isOpenSub = false 
                }, 400);
                }
                else{
                    this.isOpenSub = true 
                }
            }else{
                if(this.isOpenSettings){
                    this.closeSettingsList = true
                    setTimeout(() => {
                        this.closeSettingsList = false
                        this.isOpenSettings = false 
                    }, 400);
                }
                else{
                    this.isOpenSettings = true 
                }
            }
        }
    },
    watch: {
        user() {
            this.setLinks();
        }
    },
    mounted() {
        this.setMainLinks();
        this.setSubaccountLinks();
        this.setSettingsLinks();
    },
    unmounted() {
        this.service.dropLinks();
    },
    computed: {
        ...mapGetters(["user"]),
        route() {
            return useRoute();
        },
        fullPage() {
            const pageArr = this.route.fullPath.split("/");
            const fullPages = ["income", "settings", "wallets"];
            return fullPages.find(
                (page) => page === pageArr[pageArr.length - 1]
            );
        },
        mainLinks() {
            return this.service.mainLinks;
        },
        subLinks(){
            return this.subaccounts.subLinks;
        },
        settingLinks(){
            return this.settings.settingLinks;
        }
    },
});
</script>
<style scoped>
.title-tabs{
    color: var(--gray-800, #1D2939);
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 175%; /* 31.5px */
}
.header-nav-tabs{
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}
.logo-container{
    display: inline-flex;
    padding: 40px 0 40px 16px;
    justify-content: center;
    align-items: flex-start;
    gap: 10px;
    flex-shrink: 0;
}
.allbtc-logo-container{
    display: flex;
    max-height: 54px;
    flex-direction: column;
}
.logo-pool{
    width: 47px;
    height: 23px;
}
.nav-link-container{
    display: flex;
    flex-direction: column;
    align-items: flex-start; 
    gap: 8px;
}
.nav-link{
    color: var(--gray-600, #475467);
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    padding: 8px;
    line-height: 175%; /* 31.5px */
    transition: all 0.3s ease 0s;
    animation: openList 0.5s ease-out;
}
.nav-link:hover{
    border-radius: 12px;
    background: var(--primary-25, #F5FAFF);
    width: 100%;
}
.nav-link:hover .nav-link-item{
    color: var(--primary-500, #2E90FA);
}
.nav-link:hover svg{
    color: var(--primary-500, #2E90FA);
    fill: #2E90FA;
}
@keyframes openList{
    0%{
        transform: translateY(-10px);
        opacity: 0;
    }
    100%{
        transform: translateY(0);
        
    }
}
.close-list{
    animation: closeList 0.4s ease-in;
}
@keyframes closeList{
    0%{
        transform: translateY(0px);
    }
    100%{
        transform: translateY(-10px);
        opacity: 0;
    }
}
.open-arrow{
    animation: openArrow 0.4s linear;
    transform: rotate(180deg);

}
@keyframes openArrow{
    0%{
        transform: rotate(0deg);
    }
    100%{

        transform: rotate(180deg);
    }
}
.close-arrow{
    animation: closeArrow 0.4s linear;
    transform: rotate(0deg);
}
@keyframes closeArrow{
    0%{
        transform: rotate(180deg);
    }
    100%{

        transform: rotate(0deg);
    }
}
.nav-link-item{
    display: flex;
    gap: 16px;
}
.logout{
    position: fixed;
    bottom: 32px;
    left: 40px;
    display: flex;
    align-items: center;
    gap: 16px;
}
</style>