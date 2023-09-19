<template>
    <div class="watchers">
        <div class="watchers__head">
            <div class="watchers__head__block">
                <main-title>Наблюдатели</main-title>
                <main-description>Создавайте и управляйте ссылками наблюдателя</main-description>
            </div>
            <main-button>
                <template v-slot:svg>
                    <plus-icon />
                </template>
            </main-button>
        </div>
        <div class="cabinet watchers__wrapper">
            <main-slider

            >
                <watchers-list :blocks="service.blocks" />
            </main-slider>
        </div>
    </div>
</template>

<script>
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import PlusIcon from "@/modules/common/icons/PlusIcon.vue";
import MainSlider from "@/modules/slider/Components/MainSlider.vue";
import WatchersList from "../../modules/watchers/Components/blocks/WatchersList.vue";
import { WatchersService } from "../../modules/watchers/services/WatchersService";

export default {
    name: "watchers-page",
    components: {
        WatchersList,
        MainSlider,
        PlusIcon,
        MainTitle,
        MainDescription,
        MainButton,
    },
    data() {
        return {
            service: new WatchersService(),
        };
    },
};
</script>

<style scoped>
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
</style>
