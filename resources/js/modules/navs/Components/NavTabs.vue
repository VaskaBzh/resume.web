<template>
    <div class="nav">
        <div class="nav__block">
            <logo-block class="nav_logo" />
            <div class="nav__tabs">
                <account-menu
                    :viewportWidth="viewportWidth"
                    :user="user"
                ></account-menu>
                <nav class="nav__column">
                    <nav-group
                        v-for="(group, i) in service.links"
                        :group="group"
                        :key="i"
                    />
                </nav>
            </div>
        </div>
        <logout-link class="nav_logout" />
    </div>
</template>
<script>
import { TabsService } from "@/modules/navs/services/TabsService";
import { mapGetters } from "vuex";
import AccountMenu from "@/modules/common/Components/UI/AccountMenu.vue";
import { defineComponent } from "vue";
import LogoBlock from "@/modules/navs/Components/blocks/LogoBlock.vue";
import LogoutLink from "@/modules/navs/Components/UI/LogoutLink.vue";
import NavGroup from "@/modules/navs/Components/UI/NavGroup.vue";

export default defineComponent({
    components: {
        LogoutLink,
        AccountMenu,
        LogoBlock,
        NavGroup,
    },
    data() {
        return {
            service: new TabsService(),
        };
    },
    mounted() {
        this.service.setLinks(this.user);
    },
    unmounted() {
        this.service.dropLinks();
    },
    computed: {
        ...mapGetters(["user", "viewportWidth"]),
    },
});
</script>
<style scoped>
.nav {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    min-height: 100vh;
    width: 320px;
    padding: 40px 24px 24px;
}
.nav_logo {
    margin: 0 0 40px 16px;
}
</style>
