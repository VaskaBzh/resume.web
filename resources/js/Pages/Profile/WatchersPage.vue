<template>
    <div class="watchers">
        <div class="watchers__head">
            <div class="watchers__head__block">
                <main-title tag="h1">Наблюдатели</main-title>
                <main-description>Создавайте и управляйте ссылками наблюдателя</main-description>
            </div>
            <main-button @click="service.createWatcher()">
                <template v-slot:svg>
                    <plus-icon />
                </template>
            </main-button>
        </div>
        <div class="cabinet watchers__wrapper">
            <main-slider
                :table="service.table"
                :wait="service.waitTable"
                :empty="service.emptyTable"
                rowsNum="10"
                :meta="service.meta"
            >
                <watchers-list :blocks="service.blocks" />
            </main-slider>
        </div>
    </div>
    <watchers-popup>

    </watchers-popup>
</template>

<script>
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import PlusIcon from "@/modules/common/icons/PlusIcon.vue";
import MainSlider from "@/modules/slider/Components/MainSlider.vue";
import WatchersList from "@/modules/watchers/Components/blocks/WatchersList.vue";
import { WatchersService } from "@/modules/watchers/services/WatchersService";
import { mapGetters } from "vuex";
import WatchersPopup from "@/modules/watchers/Components/blocks/WatchersPopup.vue";

export default {
    name: "watchers-page",
    components: {
        WatchersList,
        MainSlider,
        PlusIcon,
        MainTitle,
        MainDescription,
        MainButton,
        WatchersPopup,
    },
    data() {
        return {
            service: new WatchersService(this.$t),
        };
    },
    computed: {
        ...mapGetters([
            "getActive",
            "getAccount"
        ]),
    },
    watch: {
        getActive(newActiveId) {
            this.service.setGroupId(newActiveId);
        },
        async getAccount() {
            await this.service.index();
        },
    },
    async mounted() {
        this.service.setGroupId(this.getActive);

        await this.service.index();
    }
};
</script>

<style scoped>
.watchers {
    height: 100%;
    width: 100%;
    display: flex;
    flex-direction: column;
}
.watchers__head {
    display: flex;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 32px;
    align-items: center;
}
.watchers__head__block {
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.watchers__wrapper {
    height: 100%;
    width: 100%;
    flex: 1 1 auto;
}
</style>
