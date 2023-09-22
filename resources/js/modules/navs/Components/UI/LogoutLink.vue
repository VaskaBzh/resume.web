<template>
    <div class="logout" @click="logout">
        <logout-icon class="logout_icon" />
        <span class="logout_text">
            {{ $t("header.login.menu.logout") }}
        </span>
    </div>
</template>

<script>
import LogoutIcon from "../../icons/LogoutIcon.vue";
import api from "@/api/api";
import { mapGetters } from "vuex";

export default {
    name: "logout-link",
    components: {
        LogoutIcon
    },
    computed: {
        ...mapGetters(["token"]),
    },
    methods: {
        async logout() {
            try {
                await api.post(
                    "/logout",
                    {},
                    {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    }
                );

                await this.$router.push({ name: "home" });

                this.$store.dispatch("dropUser");
                this.$store.dispatch("dropToken");
                this.$store.dispatch("drop_all");
            } catch (e) {
                console.error("Error with: " + e);
            }
        }
    },
}
</script>

<style scoped>
.logout {
    width: 100%;
    display: inline-flex;
    align-items: center;
    padding: 0 16px;
    min-height: 48px;
    transition: all 0.5s ease 0s;
    border-radius: 12px;
    background: transparent;
    gap: 16px;
    cursor: pointer;
}
.logout:hover {
    background: var(--primary-4007, rgba(83, 177, 253, 0.07));
}
.logout_text {
    color: var(--light-gray-600, #475467);
    font-family: NunitoSans, serif;
    font-size: 18px;
    font-weight: 400;
    line-height: 32px;
    transition: all 0.5s ease 0s;
}
.logout_icon {
    stroke: var(--light-gray-400, #98A2B3);
}
.logout:hover .logout_text {
    color: var(--primary-500, #2E90FA);
}
.logout:hover .logout_icon {
    stroke: var(--primary-500, #2E90FA);
}
</style>
