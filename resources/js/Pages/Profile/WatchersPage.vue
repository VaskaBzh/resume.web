<template>
    <div class="watchers">
        <div class="watchers__head">
            <div class="watchers__head__block">
                <main-title tag="h1">Наблюдатели</main-title>
                <main-description
                    >Создавайте и управляйте ссылками
                    наблюдателя</main-description
                >
            </div>
            <main-button data-popup="#addWatcher">
                <template v-slot:svg>
                    <plus-icon />
                </template>
            </main-button>
        </div>
        <div class="cabinet watchers__wrapper">
            <main-slider
                :wait="service.waitTable"
                :empty="service.emptyTable"
                rowsNum="10"
                :meta="service.meta"
            >
                <watchers-list
                    @getWatcher="service.getCard($event)"
                    :blocks="service.table.get('rows')"
                />
            </main-slider>
            <watchers-card :watcher="service.card" />
        </div>
    </div>
    <watchers-popup-add
        :wait="service.wait"
        :closed="service.popupClosed"
        :form="service.form"
        @createWatcher="createWatcher($event)"
    />
</template>

<script>
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import PlusIcon from "@/modules/common/icons/PlusIcon.vue";
import MainSlider from "@/modules/slider/Components/MainSlider.vue";
import WatchersList from "@/modules/watchers/Components/blocks/WatchersList.vue";
import WatchersPopupAdd from "@/modules/watchers/Components/blocks/WatchersPopupAdd.vue";
import WatchersCard from "@/modules/watchers/Components/blocks/WatchersCard.vue";
import { WatchersService } from "@/modules/watchers/services/WatchersService";
import { mapGetters } from "vuex";

export default {
    name: "watchers-page",
    components: {
        WatchersList,
        MainSlider,
        PlusIcon,
        MainTitle,
        MainDescription,
        MainButton,
        WatchersPopupAdd,
        WatchersCard,
    },
    data() {
        return {
            service: new WatchersService(this.$t),
        };
    },
    computed: {
        ...mapGetters(["getActive", "getAccount"]),
    },
    methods: {
        async createWatcher(formData) {
            this.service.setForm(formData.name, formData.allowedRoutes);
            await this.service.createWatcher();
            await this.service.index();
        },
    },
    watch: {
        async getActive(newActiveId) {
            this.service.setGroupId(newActiveId);

            await this.service.index();
        },
        async getAccount() {
            await this.service.index();
        },
    },
    async mounted() {
        this.service.setGroupId(this.getActive);
        this.service.setForm();

        await this.service.index();
    },
};
</script>

<style scoped>
.watchers {
    height: 100%;
    padding: 24px;
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
    display: grid;
    gap: 12px;
    grid-template-rows: 1fr;
    grid-template-columns: repeat(2, 1fr);
}
</style>
