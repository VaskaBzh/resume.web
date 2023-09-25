<template>
    <div class="watchers">
        <div class="watchers__head">
            <div class="watchers__head__block">
                <main-title tag="h4">{{ $t("title") }}</main-title>
                <main-description
                    >{{ $t("text") }}</main-description
                >
            </div>
            <main-button data-popup="#addWatcher">
                <template v-slot:svg>
                    <plus-icon />
                </template>
            </main-button>
        </div>
        <div
            class="cabinet watchers__wrapper"
        >
            <main-preloader
                class="cabinet__preloader watchers__preloader"
                :wait="service.waitTable"
                :interval="35"
                :end="!service.waitTable"
                :empty="service.emptyTable"
            />
            <transition name="fade">
                <main-slider
                    :wait="service.waitTable"
                    :empty="service.emptyTable"
                    v-show="!service.waitTable && !service.emptyTable"
                    rowsNum="1000"
                    :haveNav="false"
                    :havePreloader="false"
                    :meta="service.meta"
                >
                    <watchers-list
                        @getWatcher="service.getCard($event)"
                        :blocks="service.table.get('rows')"
                        :activeWatcher="service.card"
                    />
                </main-slider>
            </transition>
            <transition name="fade">
                <watchers-card
                    v-show="!service.waitTable && !service.emptyTable"
                    :watcher="service.card"
                    @changeWatcher="changeWatcher"
                    @removeWatcher="removeWatcher"
                />
            </transition>
        </div>
    </div>
    <watchers-popup-add
        :wait="service.wait"
        :closed="service.popupClosed"
        @createWatcher="createWatcher($event)"
    />
    <watchers-popup-remove
        :wait="service.wait"
        :closed="service.popupClosed"
        :name="name"
        :id="service.card?.id"
        @removeWatcher="removeWatcher($event)"
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
import WatchersPopupRemove from "@/modules/watchers/Components/blocks/WatchersPopupRemove.vue";
import { WatchersService } from "@/modules/watchers/services/WatchersService";
import { mapGetters } from "vuex";
import { WatchersMessage } from "@/modules/watchers/lang/WatchersMessages";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";

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
        WatchersPopupRemove,
        WatchersCard,
        MainPreloader,
    },
    i18n: {
        sharedMessages: WatchersMessage,
    },
    data() {
        return {
            service: new WatchersService(this.$t),
        };
    },
    computed: {
        ...mapGetters(["getActive", "getAccount"]),
        name() {
            return this.service.card?.name;
        },
    },
    methods: {
        async createWatcher(formData) {
            this.service.setForm(formData.name, formData.allowedRoutes);
            await this.service.createWatcher();
            await this.service.index();
        },
        async changeWatcher(formData) {
            this.service.setForm(formData.name, formData.allowedRoutes);
            await this.service.changeWatcher(formData.id);
            await this.service.index();
        },
        async removeWatcher(id) {
            await this.service.removeWatcher(id);
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
.fade-enter-active,
.fade-leave-active {
    transition: all 0.5s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.watchers {
    flex: 1 1 auto;
    padding: 24px;
    width: 100%;
    display: flex;
    flex-direction: column;
}
.watchers__preloader {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}
@media (max-width: 900px) {
    .watchers {
        padding: 24px 12px 24px;
    }
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
    position: relative;
}
@media (max-width: 700px) {
    .watchers__wrapper {
        display: flex;
    }
}
</style>
