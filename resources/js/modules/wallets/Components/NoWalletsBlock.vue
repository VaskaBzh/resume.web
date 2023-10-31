<template>
    <div
        class="no-wallets cabinet__block cabinet__block-light cabinet__block-md"
    >
        <div class="no-wallets__block">
            <img
                src="../images/img_no-wallets.png"
                alt="wallet image"
                class="no-wallets_image"
            />
            <main-description class="no-wallets_text">
                {{ $t("no_wallets.text") }}
            </main-description>
        </div>
        <div class="no-wallets__block">
            <warning-block
                v-show="!timerService.timerState.state"
                text="wallets_add"
                :time="timerService.overTime.value"
            />
            <main-button
                class="no-wallets_button button-blue button-lg button-full"
                @click="addWallet"
            >
                <template #text> {{ $t("no_wallets.button") }}</template>
            </main-button>
        </div>
    </div>
</template>

<script>
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import WarningBlock from "@/modules/common/Components/UI/WarningBlock.vue";

import { WalletsMessages } from "@/modules/wallets/lang/WalletsMessages";
import { TimerService } from "../../common/services/extends/TimerService";

export default {
    name: "NoWalletsBlock",
    components: {
        MainDescription,
        MainButton,
        WarningBlock,
    },
    i18n: {
        sharedMessages: WalletsMessages,
    },
    props: {
        time: String,
        isEmailConfirm: {
            type: Boolean,
            default: false,
        },
    },
    emits: ["addWallet"],
    data() {
        return {
            timerService: new TimerService(),
        };
    },
    watch: {
        time(newTimeValue) {
            this.timerService.getOverTime(newTimeValue).setTimer();
        },
    },
    mounted() {
        this.timerService
            .setConfirmState(this.isEmailConfirm)
            .getOverTime(this.time)
            .setTimer();
    },
    beforeUnmount() {
        this.timerService.endTimer();
    },
    methods: {
        addWallet() {
            this.$emit("addWallet");
        },
    },
};
</script>

<style scoped>
.no-wallets {
    display: flex;
    flex-direction: column;
    gap: clamp(40px, 5vw, 80px);
    max-width: 450px;
}
.no-wallets__block {
    display: flex;
    flex-direction: column;
    gap: clamp(12px, 5vw, 24px);
    align-items: center;
}
.no-wallets_image {
    width: clamp(112px, 15vw, 160px);
    height: clamp(112px, 15vw, 160px);
}
.no-wallets_text {
    text-align: center;
}
</style>
