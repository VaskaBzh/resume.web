<template>
    <header-component :is_auth="auth_user" />
    <div class="page">
        <div class="account">
            <div class="account__container">
                <nav-tabs ref="tabs" />
                <slot class="padding" />
            </div>
        </div>
    </div>
    <footer-component />
</template>
<script>
import NavTabs from "@/Components/navs/NavTabs.vue";
import HeaderComponent from "@/Components/HeaderComponent.vue";
import FooterComponent from "@/Components/FooterComponent.vue";

export default {
    props: {
        auth_user: {
            type: Boolean,
            default: false,
        },
    },
    components: {
        FooterComponent,
        HeaderComponent,
        NavTabs,
    },
    methods: {
        // handleScroll(e) {
        //   if (e === "start") {
        //     this.$refs.tabs.$el.classList.add("fixed");
        //     this.$refs.tabs.$el.classList.remove("fixed");
        //   } else {
        //     const animationObserver = new IntersectionObserver((entries) => {
        //       entries.forEach((entry) => {
        //         if (entry.isIntersecting) {
        //           this.$refs.tabs.$el.classList.remove("fixed");
        //         } else {
        //           this.$refs.tabs.$el.classList.add("fixed");
        //         }
        //       });
        //     });
        //     animationObserver.observe(this.header);
        //   }
        // },
    },
    mounted() {
        // setTimeout(() => {
        //   this.handleScroll();
        // }, 1000);
    },
};
</script>
<style lang="scss">
.account {
    margin-top: 32px;

    &__container {
        display: flex;
        justify-content: space-between;
        position: relative;

        .padding {
            @media (min-width: 1271px) {
                //padding-left: 330px;
            }
        }
    }
}
</style>
