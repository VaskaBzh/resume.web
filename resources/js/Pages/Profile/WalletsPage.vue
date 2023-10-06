<template>
    <div class="wallets" ref="page">
        <main-preloader
            class="cabinet__preloader cabinet__preloader-bg wallets__preloader"
            :wait="wallets.waitWallets"
            :interval="35"
            :end="!wallets.waitWallets"
            :empty="wallets.emptyTable"
            v-if="!wallets.emptyTable"
        />
        <div class="wallet-wrapper" v-if="!wallets.waitWallets && !wallets.emptyTable">
            <div
                class="wallet__block onboarding_block"
                :class="{
                    'onboarding_block-target': instructionService.isVisible && instructionService.step === 1
                }"
            >
                <div class="autopayout-component">
                    <div class="header-component-wallet">
                        <main-title class="" tag="h3"
                        >{{ $t("wallets.title[0]") }}
                        </main-title>
                        <div class="tooltipe-container">
                            <tooltip-card
                                :text="$t('wallets.tooltip')"
                            ></tooltip-card>
                        </div>
                    </div>
                    <div class="form_column">
                        <div class="autopayout-container">
                            <input
                                name="minWithdrawal"
                                id="min"
                                type="text"
                                class="input popup__input autopayout-input"
                                placeholder="0.005"
                                disabled
                            />
                            <label for="min" class="main__label autopayout-label">{{
                                    $t("wallets.popups.change.labels.minWithdrawal")
                                }}</label>
                            <span class="autopayout-btc">BTC</span>
                        </div>
                    </div>
                </div>
                <instruction-step
                    @next="instructionService.nextStep()"
                    @prev="instructionService.prevStep()"
                    @close="instructionService.nextStep(6)"
                    :step_active="1"
                    :steps_count="instructionService.steps_count"
                    :step="instructionService.step"
                    :isVisible="instructionService.isVisible"
                    text="texts.wallets[0]"
                    title="titles.wallets[0]"
                    className="onboarding__card-right"
                />
            </div>
            <div
                class="wallet__block onboarding_block"
                :class="{
                    'onboarding_block-target': instructionService.isVisible && instructionService.step === 2
                }"
            >
                <main-title class="header-component-wallet" tag="h3"
                    >{{ $t("wallets.title[1]") }}
                </main-title>
                <div ref="wallets" class="wrap">
                    <div
                        ref="list"
                        class="wallets__list"
                        v-if="!wallets.waitWallets"
                    >
                        <wallet-block
                            v-for="(wallet, i) in wallets.wallets"
                            :key="i"
                            v-scroll="'top'"
                            :wallet="wallet"
                            @getWallet="setForm"
                        ></wallet-block>
    <!--                    @remove="wallets.removeWallet(wallet)"-->
                    </div>
                </div>
                <instruction-step
                    @next="instructionService.nextStep()"
                    @prev="instructionService.prevStep()"
                    @close="instructionService.nextStep(6)"
                    :step_active="2"
                    :steps_count="instructionService.steps_count"
                    :step="instructionService.step"
                    :isVisible="instructionService.isVisible"
                    text="texts.wallets[1]"
                    title="titles.wallets[1]"
                    className="onboarding__card-right"
                />
            </div>
<!--            <div class="blue-button-container">-->
<!--                <button class="add" data-popup="#addWallet">-->
<!--                    <svg-->
<!--                        xmlns="http://www.w3.org/2000/svg"-->
<!--                        width="24"-->
<!--                        height="24"-->
<!--                        viewBox="0 0 24 24"-->
<!--                        fill="none"-->
<!--                    >-->
<!--                        <path-->
<!--                            d="M12 4V20M4 12H20"-->
<!--                            stroke="#98A2B3"-->
<!--                            stroke-width="1.5"-->
<!--                            stroke-linecap="round"-->
<!--                            stroke-linejoin="round"-->
<!--                        />-->
<!--                    </svg>-->
<!--                </button>-->
<!--            </div>-->
        </div>
        <div class="wallets__no-information cabinet__preloader cabinet__preloader-bg" v-if="wallets.emptyTable && !wallets.waitWallet">
            <div class="wallets__no-information__content">
                <img src="../../../assets/img/img_wallets-no-info.png" alt="" class="wallets__no wallets__no-information_img">
                <main-description>{{ $t("wallets.no_info.description") }}</main-description>
                <div class="wallets__block-warning" v-show="!user.email_verified_at">
                    <div class="wallets__head">
                        <div class="wallets_icon">
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.5303 3.03033C22.8232 2.73744 22.8232 2.26256 22.5303 1.96967C22.2374 1.67678 21.7626 1.67678 21.4697 1.96967L22.5303 3.03033ZM19.4697 3.96967C19.1768 4.26256 19.1768 4.73744 19.4697 5.03033C19.7626 5.32322 20.2374 5.32322 20.5303 5.03033L19.4697 3.96967ZM19.4967 12.2619L18.9664 11.7316L19.4967 12.2619ZM16.5933 12.9877L17.1236 12.4574L16.5933 12.9877ZM18.7708 12.9877L19.3012 13.5181L18.7708 12.9877ZM11.5123 5.72916L10.9819 5.19883L11.5123 5.72916ZM11.5123 7.90674L10.9819 8.43707L11.5123 7.90674ZM12.2381 5.0033L12.7684 5.53363L12.2381 5.0033ZM4.53033 21.0303C4.82322 20.7374 4.82322 20.2626 4.53033 19.9697C4.23744 19.6768 3.76256 19.6768 3.46967 19.9697L4.53033 21.0303ZM1.46967 21.9697C1.17678 22.2626 1.17678 22.7374 1.46967 23.0303C1.76256 23.3232 2.23744 23.3232 2.53033 23.0303L1.46967 21.9697ZM11.7619 19.9967L12.2922 20.527H12.2922L11.7619 19.9967ZM12.4877 17.0933L13.0181 16.5629L12.4877 17.0933ZM12.4877 19.2708L11.9574 18.7405H11.9574L12.4877 19.2708ZM5.22916 12.0123L5.75949 12.5426L5.75949 12.5426L5.22916 12.0123ZM7.40674 12.0123L6.87641 12.5426L7.40674 12.0123ZM4.5033 12.7381L3.97297 12.2078L3.97297 12.2078L4.5033 12.7381ZM9.96967 9.46967C9.67678 9.76256 9.67678 10.2374 9.96967 10.5303C10.2626 10.8232 10.7374 10.8232 11.0303 10.5303L9.96967 9.46967ZM12.5303 9.03033C12.8232 8.73744 12.8232 8.26256 12.5303 7.96967C12.2374 7.67678 11.7626 7.67678 11.4697 7.96967L12.5303 9.03033ZM13.9697 13.4697C13.6768 13.7626 13.6768 14.2374 13.9697 14.5303C14.2626 14.8232 14.7374 14.8232 15.0303 14.5303L13.9697 13.4697ZM16.5303 13.0303C16.8232 12.7374 16.8232 12.2626 16.5303 11.9697C16.2374 11.6768 15.7626 11.6768 15.4697 11.9697L16.5303 13.0303ZM21.4697 1.96967L19.4697 3.96967L20.5303 5.03033L22.5303 3.03033L21.4697 1.96967ZM11.7078 4.47297L10.9819 5.19883L12.0426 6.25949L12.7684 5.53363L11.7078 4.47297ZM10.9819 8.43707L16.0629 13.5181L17.1236 12.4574L12.0426 7.37641L10.9819 8.43707ZM19.3012 13.5181L20.027 12.7922L18.9664 11.7316L18.2405 12.4574L19.3012 13.5181ZM20.027 12.7922C22.3243 10.4949 22.3243 6.77027 20.027 4.47297L18.9664 5.53363C20.6779 7.24514 20.6779 10.02 18.9664 11.7316L20.027 12.7922ZM12.7684 5.53363C14.48 3.82212 17.2549 3.82212 18.9664 5.53363L20.027 4.47297C17.7297 2.17568 14.0051 2.17568 11.7078 4.47297L12.7684 5.53363ZM12.0426 7.37641C11.8131 7.1469 11.7519 6.95527 11.75 6.82326C11.7482 6.69624 11.7993 6.5028 12.0426 6.25949L10.9819 5.19883C10.521 5.65975 10.2413 6.22436 10.2502 6.84472C10.259 7.46007 10.55 8.00512 10.9819 8.43707L12.0426 7.37641ZM18.2405 12.4574C18.011 12.6869 17.8194 12.7481 17.6874 12.75C17.5603 12.7518 17.3669 12.7007 17.1236 12.4574L16.0629 13.5181C16.5239 13.979 17.0885 14.2587 17.7088 14.2498C18.3242 14.241 18.8692 13.95 19.3012 13.5181L18.2405 12.4574ZM3.46967 19.9697L1.46967 21.9697L2.53033 23.0303L4.53033 21.0303L3.46967 19.9697ZM5.03363 13.2684L5.75949 12.5426L4.69883 11.4819L3.97297 12.2078L5.03363 13.2684ZM6.87641 12.5426L11.9574 17.6236L13.0181 16.5629L7.93707 11.4819L6.87641 12.5426ZM11.9574 18.7405L11.2316 19.4664L12.2922 20.527L13.0181 19.8012L11.9574 18.7405ZM11.2316 19.4664C9.52005 21.1779 6.74514 21.1779 5.03363 19.4664L3.97297 20.527C6.27027 22.8243 9.99492 22.8243 12.2922 20.527L11.2316 19.4664ZM3.97297 12.2078C1.67568 14.5051 1.67568 18.2297 3.97297 20.527L5.03363 19.4664C3.32212 17.7549 3.32212 14.98 5.03363 13.2684L3.97297 12.2078ZM7.93707 11.4819C7.50512 11.05 6.96007 10.759 6.34472 10.7502C5.72436 10.7413 5.15975 11.021 4.69883 11.4819L5.75949 12.5426C6.0028 12.2993 6.19624 12.2482 6.32326 12.25C6.45527 12.2519 6.6469 12.3131 6.87641 12.5426L7.93707 11.4819ZM13.0181 19.8012C13.45 19.3692 13.741 18.8242 13.7498 18.2088C13.7587 17.5885 13.479 17.0239 13.0181 16.5629L11.9574 17.6236C12.2007 17.8669 12.2518 18.0603 12.25 18.1874C12.2481 18.3194 12.1869 18.511 11.9574 18.7405L13.0181 19.8012ZM11.0303 10.5303L12.5303 9.03033L11.4697 7.96967L9.96967 9.46967L11.0303 10.5303ZM15.0303 14.5303L16.5303 13.0303L15.4697 11.9697L13.9697 13.4697L15.0303 14.5303Z" fill="#FFB868"/>
                            </svg>
                        </div>
                        <div class="wallets_description-warning">
                            {{ $t("wallets.no_info.message") }}
                        </div>
                    </div>
                    <div class="wallets_link-warning" @click="sendEmailVerification">
                        {{ verifyButtonName }}
                    </div>
                </div>
                <main-button class="button-blue button-full wallets_button-no-information" :class="{
                    'button-disabled': !user.email_verified_at
                }" :data-popup="!user.email_verified_at ? '' : '#addWallet'">
                    <template v-slot:text>
                        {{ $t("wallets.no_info.button_text") }}
                    </template>
                </main-button>
            </div>
        </div>
    </div>
    <main-popup
        id="changeWallet"
        :wait="wallets.wait"
        :closed="wallets.closed"
        :opened="wallets.opened"
        :errors="errors"
        @closed="wallets.clearForm(wallets.form)"
        v-if="wallets.form"
        :makeResize="makeResize"
    >
        <form
            v-if="!wallets.isCodeSend"
            @submit.prevent="wallets.changeWallet"
            class="form form-popup popup__form"
        >
            <main-title tag="h3" class="change-label_title">
                {{ $t("wallets.popups.change.title") }}
            </main-title>
            <div class="autopayout-input_container">
                <label class="label-popup">
                    {{ $t("wallets.popups.add.placeholders.wallet") }}
                </label>
                <input
                    v-model="wallets.form.wallet"
                    autofocus
                    type="text"
                    class="input popup__input autopayput_input"
                    :placeholder="
                        $t('wallets.popups.change.placeholders.wallet')
                    "
                />
            </div>
            <div class="autopayout-input_container">
                <label class="label-popup">
                    {{ $t("wallets.popups.add.placeholders.name") }}
                </label>
                <input
                    v-model="wallets.form.name"
                    autofocus
                    type="text"
                    class="input popup__input autopayput_input"
                    :placeholder="
                        $t('wallets.popups.change.placeholders.name')
                    "
                />
            </div>
            <warning-block
                class="wallets_warning"
                text="wallets_change"
            />
            <button type="submit" class="all-link change-autopyout_button">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 9.64 2 7.4 3.42 5.52C3.67 5.19 4.14 5.13 4.47 5.38C4.8 5.63 4.87 6.1 4.62 6.43C3.4 8.04 2.75 9.97 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75C11.59 2.75 11.25 2.41 11.25 2C11.25 1.59 11.59 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75Z"
                    />
                    <path
                        d="M12 19.75C7.73 19.75 4.25 16.27 4.25 12C4.25 11.59 4.59 11.25 5 11.25C5.41 11.25 5.75 11.59 5.75 12C5.75 15.45 8.55 18.25 12 18.25C15.45 18.25 18.25 15.45 18.25 12C18.25 8.55 15.45 5.75 12 5.75C11.59 5.75 11.25 5.41 11.25 5C11.25 4.59 11.59 4.25 12 4.25C16.27 4.25 19.75 7.73 19.75 12C19.75 16.27 16.27 19.75 12 19.75Z"
                    />
                    <path
                        d="M12 16.75C11.59 16.75 11.25 16.41 11.25 16C11.25 15.59 11.59 15.25 12 15.25C13.79 15.25 15.25 13.79 15.25 12C15.25 10.21 13.79 8.75 12 8.75C11.59 8.75 11.25 8.41 11.25 8C11.25 7.59 11.59 7.25 12 7.25C14.62 7.25 16.75 9.38 16.75 12C16.75 14.62 14.62 16.75 12 16.75Z"
                    />
                </svg>
                {{ $t("wallets.popups.change.button") }}
            </button>
        </form>
        <verify-form
            v-if="wallets.isCodeSend"
            title="form.wallets.title"
            text="form.wallets.text"
            placeholder="form.wallets.placeholder"
            re_verify_text="form.wallets.re_verify_text"
            button_text="form.wallets.button_text"
            @sendForm="changeWallet($event)"
            @back="wallets.back()"
        />
    </main-popup>
    <main-popup
        id="addWallet"
        :wait="wallets.wait"
        :closed="wallets.closed"
        @closed="wallets.clearForm(wallets.form)"
        v-if="wallets.form"
        :makeResize="makeResize"
    >
        <form
            v-if="!wallets.isCodeSend"
            @submit.prevent="wallets.addWallet"
            class="form form-popup popup__form"
        >
            <main-title tag="h3"
                >{{ $t("wallets.popups.add.title") }}
                <p class="wallet-description">
                    {{ $t("wallets.popups.note") }}
                </p>
            </main-title>
            <div class="autopayout-input_container">
                <label class="label-popup">
                    {{ $t("wallets.popups.add.placeholders.wallet") }}
                </label>
                <input
                    v-model="wallets.form.wallet"
                    type="text"
                    autofocus
                    :placeholder="
                        $t('wallets.popups.add.placeholders.wallet')
                    "
                    class="input popup__input autopayput_input"
                />
            </div>
            <div class="autopayout-input_container">
                <label class="label-popup">
                    {{ $t("wallets.popups.add.placeholders.name") }}
                </label>
                <input
                    v-model="wallets.form.name"
                    type="text"
                    :placeholder="
                        $t('wallets.popups.add.placeholders.name')
                    "
                    class="input popup__input autopayput_input"
                />
            </div>
            <button type="submit" class="all-link change-autopyout_button">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 9.64 2 7.4 3.42 5.52C3.67 5.19 4.14 5.13 4.47 5.38C4.8 5.63 4.87 6.1 4.62 6.43C3.4 8.04 2.75 9.97 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75C11.59 2.75 11.25 2.41 11.25 2C11.25 1.59 11.59 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75Z"
                    />
                    <path
                        d="M12 19.75C7.73 19.75 4.25 16.27 4.25 12C4.25 11.59 4.59 11.25 5 11.25C5.41 11.25 5.75 11.59 5.75 12C5.75 15.45 8.55 18.25 12 18.25C15.45 18.25 18.25 15.45 18.25 12C18.25 8.55 15.45 5.75 12 5.75C11.59 5.75 11.25 5.41 11.25 5C11.25 4.59 11.59 4.25 12 4.25C16.27 4.25 19.75 7.73 19.75 12C19.75 16.27 16.27 19.75 12 19.75Z"
                    />
                    <path
                        d="M12 16.75C11.59 16.75 11.25 16.41 11.25 16C11.25 15.59 11.59 15.25 12 15.25C13.79 15.25 15.25 13.79 15.25 12C15.25 10.21 13.79 8.75 12 8.75C11.59 8.75 11.25 8.41 11.25 8C11.25 7.59 11.59 7.25 12 7.25C14.62 7.25 16.75 9.38 16.75 12C16.75 14.62 14.62 16.75 12 16.75Z"
                    />
                </svg>
                {{ $t("wallets.popups.add.button") }}
            </button>
        </form>
        <verify-form
            v-if="wallets.isCodeSend"
            @sendForm="createWallet($event)"
            title="form.wallets.title"
            text="form.wallets.text"
            placeholder="form.wallets.placeholder"
            re_verify_text="form.wallets.re_verify_text"
            button_text="form.wallets.button_text"
            @back="wallets.back()"
        />
    </main-popup>
    <instruction-button
        @openInstruction="instructionService.setStep().setVisible()"
        hint="wallets"
    />
</template>
<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import WalletBlock from "@/Components/technical/blocks/profile/WalletBlock.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import TooltipCard from "@/modules/common/Components/UI/TooltipCard.vue";
import WarningBlock from "@/modules/common/Components/UI/WarningBlock.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";
import InstructionButton from "@/modules/instruction/Components/UI/InstructionButton.vue";
import VerifyForm from "@/modules/verify/Components/VerifyForm.vue";

import { InstructionService } from "@/modules/instruction/services/InstructionService";
import { mapGetters } from "vuex";
import { WalletsService } from "@/services/WalletsService";

export default {
    components: {
        VerifyForm,
        InstructionButton,
        WarningBlock,
        MainPopup,
        MainButton,
        MainTitle,
        WalletBlock,
        TooltipCard,
        MainPreloader,
        MainDescription,
        InstructionStep,
    },
    computed: {
        ...mapGetters(["getActive", "errors", "user"]),
        endWallet() {
            return this.wallets.wallets?.length > 0;
        },
        emptyWallet() {
            return this.wallets.wallets?.length === 0;
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    data() {
        return {
            viewportWidth: 0,
            overTime: 0,
            waitWallet: true,
            wallets: new WalletsService(this.$t),
            isActiveLabelEmail: false,
            makeResize: false,
            isActiveLabelName: false,
            isActiveLabelMinWithdrawal: false,
            verifyButtonName: this.$t("wallets.no_info.verify_text"),
            instructionService: new InstructionService(),
        };
    },
    watch: {
        getActive() {
            this.walletInit();
        },
        "$i18n.locale"() {
            document.title = this.$t("header.links.wallets");
        },
        user(newUserData) {
            this.wallets.setUser(newUserData);
        },
        "wallets.isCodeSend"() {
            this.makeResize = true;

            setTimeout(() => this.makeResize = false, 300);
        }
    },
    methods: {
        changeWallet(code) {
            this.setCode(code);

            this.wallets.changeWallet();
        },
        createWallet(code) {
            this.setCode(code);

            this.wallets.addWallet();
        },
        setCode(code) {
            this.wallets.form.code = code;
        },
        setForm(wallet) {
            this.wallets.setForm(wallet)
        },
        walletInit() {
            if (this.getActive !== -1) {
                this.wallets.setGroupId(this.getActive);
                this.wallets.index();
            }
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        sendEmailVerification() {
            this.wallets.verify.sendEmailVerification();
        }
    },
    mounted() {
        this.instructionService.setStepsCount(2);

        this.walletInit();
        document.title = this.$t("header.links.wallets");
        this.$refs.page.style.opacity = 1;

        if (this.user) {
            this.wallets.setUser(this.user);
        }
    },
    props: ["message", "auth_user"],
};
</script>
<style lang="scss" scoped>
.onboarding_block {
    transition: none;
}
.onboarding_block-target {
    background: var(--background-island);
}
.wallets_warning {
    margin: 80px 0 0;
    width: 100%;
}
.change-label_title {
    margin-bottom: 24px;
}
.change-label_button {
    margin-top: 80px;
}
.wallet-inf {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.wallet-wallet_address {
    color: var(--text-teritary, #98a2b3);
    font-family: NunitoSans;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 145%; /* 20.3px */
}
.wallet-fullname {
    color: var(--light-gray-500, #667085);
    font-family: Unbounded;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
}
.header-component-wallet {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    margin-bottom: 24px;
}
.autopayout-container {
    position: relative;
    width: 100%;
}
.wallet__remove-inf-container {
    display: flex;
    align-items: center;
    gap: 16px;
    border-radius: 24px;
    background: var(--background-island);
    padding: 16px 24px;
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
}
.autopayout-btc {
    color: var(--text-teritary, #98a2b3);
    font-family: NunitoSans;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 150%; /* 24px */
    position: absolute;
    top: 16px;
    right: 16px;
}
.autopayout-label {
    position: absolute;
    top: 8px;
    left: 16px;
    color: var(--text-teritary, #98a2b3);
    font-family: NunitoSans;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    line-height: 135%; /* 16.2px */
}
.autopayout-input {
    border: none;
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-island-inner-3) !important;
    padding: 24px 0 0 16px;
    width: 100%;
    height: 56px;
    outline: none;
}
input:focus {
    border: none !important;
    outline: none !important;
    background: var(--background-island-inner-3) !important;
}
.button-container {
    margin-top: 80px;
}
.add {
    border-radius: 12px;
    background: var(--background-island-inner-3);
    padding: 12px;
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.01);
    display: flex;
    align-items: center;
}
.wallet-description {
    color: var(--text-teritary, #98a2b3);
    font-family: NunitoSans;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
    margin: 8px 0 24px;
}
.wallet-wrapper {
    border-radius: 24px;
    background: var(--background-island);
    box-shadow: 0 2px 12px -5px rgba(16, 24, 40, 0.02);
    width: 560px;
}
.wallet__block {
    width: 100%;
    padding: 32px 40px 16px;
    border-radius: 24px;
    &:last-child {
        padding: 16px 40px 32px;
    }
    @media (max-width: 767.98px) {
        padding: 16px 16px 8px;
        &:last-child {
            padding: 8px 16px 16px;
        }
    }
}
.blue-button-container {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.wallet__remove-button-container {
    display: flex;
    width: 100%;
    justify-content: space-between;
    margin-top: 92px;
}
.button_wallet {
    border-radius: 12px;
    padding: 12px 16px;
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 175%; /* 31.5px */
    width: 48%;
}
.autopayout-input_container {
    display: flex;
    margin-bottom: 12px;
    flex-direction: column;
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-modal-input, #2C2F34);
    padding: var(--pt-3, 12px) var(--pr-4, 16px) var(--pb-2, 8px)
        var(--pl-4, 16px);
}
.change-autopyout_button {
    border-radius: 12px;
    background: var(--buttons-primary-fill-border-default, #2e90fa);
    box-shadow: 0px 10px 10px -6px rgba(0, 0, 0, 0.1);
    padding: 12px 16px;
    color: var(--buttons-primary-text, #fff);
    font-family: NunitoSans;
    margin: 36px 0 0;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 32px; /* 177.778% */
}
.autopayput_input {
    background: inherit !important;
}
.cancel-button {
    border: 1px solid var(--text-teritary, #98a2b3);
    color: var(--text-secondary, #475467);
}
.remove-button {
    color: var(--background-island);
    background: var(--light-red-100, #f1404a);
    box-shadow: 0px 10px 10px -6px rgba(0, 0, 0, 0.1);
}
.wallets {
    display: flex;
    padding: 24px;
    align-items: center;
    justify-content: center;
    flex: 1 1 auto;
    width: 100%;
    transition: all 0.3s linear 0.2s;
    opacity: 0;
    @media (max-width: 900px) {
        padding: 24px 12px;
    }
    .no-info.no-bg {
        padding: 0;
        .wallets {
            &__block {
                display: inline-flex;
                cursor: pointer;
                gap: 8px;
                align-items: center;
                justify-content: center;
                min-height: 140px;
                font-size: 18px;
                font-weight: 400;
                line-height: 135%;
                color: #3f7bdd;
                transition: all 0.5s ease 0s;
            }
        }
    }
    @media (max-width: 1271.98px) {
        transition: all 0.3s ease 0s;
    }
    .title.profile {
        @media (max-width: 767.98px) {
            flex-wrap: wrap;
            gap: 30px;
        }
    }
    // .wallets__filter
    &__filter {
        margin: 0 24px 0 auto;
        @media (max-width: 767.98px) {
            margin: 0;
            justify-content: flex-start !important;
        }
    }

    &__list {
        display: flex;
        gap: 16px;
        transition: all 0.3s ease 0s;
        width: 100%;
        @media (max-width: 1320.98px) {
            grid-template-columns: repeat(3, 1fr);
        }
        @media (max-width: 991.98px) {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        @media (max-width: 767.98px) {
            grid-template-columns: repeat(1, 1fr);
            .wallets__block {
                border-radius: 12px;
                border: none;
            }
        }
    }

    // .wallets__wrap
    .wrap {

        &_title {
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            @media (max-width: 767.98px) {
                margin-bottom: 0;
                &:after {
                    content: none;
                }
                flex-wrap: wrap;
                gap: 12px;
            }
        }
    }

    &__block {
        @media (max-width: 767.98px) {
            padding: 10px 0 10px;
            border-top: 1px solid #d7d8d9;
            border-radius: 0;

            &:first-child {
                border-top: none;
            }
        }
        &-warning {
            padding: 16px;
            border-radius: var(--surface-border-radius-radius-s-md, 12px);
            background: var(--background-waiting, #FFF8F0);
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 24px;
            @media (max-width: 500px) {
                padding: 8px;
            }
        }
    }

    &__head {
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
        gap: 12px;
    }

    &_description {
        &-warning {
            color: var(--status-waiting, #FFB868);
            font-family: NunitoSans, serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }
    }

    &_link {
        &-warning {
            color: var(--icons-accent, #53B1FD);
            font-family: NunitoSans, serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            cursor: pointer;
        }
    }

    // .wallets__column
    &__column {
        display: flex;
        flex-direction: column;
        @media (max-width: 767.98px) {
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
        @media (max-width: 479.98px) {
            gap: 0;
            flex-direction: column;
            align-items: flex-start;
        }
    }

    // .wallets__buttons
    &__buttons {
        display: flex;
        gap: 16px;
        @media (max-width: 767.98px) {
            width: 100%;
            justify-content: space-between;
            gap: 11px;
        }
    }

    &_button {
        &-no-information {
            min-height: 56px !important;
        }
    }

    &__no-information {
        padding: 32px 40px;
        @media (max-width: 500px) {
            padding: 24px 16px;
        }
        &__content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        &_img {
            margin-bottom: 24px;
            width: 160px;
            height: 160px;
        }
        .text {
            text-align: center;
            margin-bottom: 80px;
        }
    }
}
.wallets-popup-btn {
    margin-top: 25px;
}
.input-container {
    position: relative;
}
.label-popup {
    color: var(--text-teritary);
    font-family: NunitoSans;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    line-height: 16px; /* 133.333% */
}
.input-label {
    position: absolute;
    top: 17px;
    left: 15px;
    z-index: 1;
    transition-timing-function: ease-in-out;
    transition-duration: 0.3s;
    cursor: text;
    color: rgba(197, 197, 197, 1);
}
.move-label {
    transform: translate(-1px, -21px);
    font-size: 12px;
    transition-timing-function: ease-in-out;
    transition-duration: 0.3s;
    background: rgba(250, 250, 250, 1);
}
.input-wallet {
    width: 100%;
    padding: 0 12px;
    border-radius: 8px;
    font-weight: 300;
    font-size: 14px;
    line-height: 115%;
    outline: none;
    display: inline-flex;
    align-items: center;
    min-height: 48px;
    background: rgba(250, 250, 250, 1);
    border: 1px solid rgba(197, 197, 197, 1);
    color: black;
    transition-timing-function: ease-in-out;
    transition-duration: 0.3s;
    &:focus {
        & + .move-label {
            color: rgba(83, 137, 225, 1);
        }
    }
}
.input-minWithdrawal {
    text-align: end;
    padding-right: 40px;
    transition-timing-function: ease-in-out;
    transition-duration: 0.3s;
}
.input-minWithdrawal:focus {
    transition-timing-function: ease-in-out;
    transition-duration: 0.5s;
    padding-right: 80%;
}
.input-btc-text {
    position: absolute;
    right: 10px;
    top: 17px;
}
input:focus {
    border: 1px solid rgba(83, 137, 225, 1);
    background: transparent;
    color: var(--text-secondary);
}
.input-error {
    color: red;
    font-size: 12px;
    margin-top: 4px;
    transition: all 0.4s ease;
}
.error-input {
    border: 1px solid rgba(237, 24, 24, 1);
    transition: all 0.4s ease;
    animation: shake 0.5s;
}
@keyframes shake {
    0% {
        transform: translate(1px, 1px) rotate(0deg);
        box-shadow: 0 0 0px red;
    }
    10% {
        transform: translate(0px, -1px) rotate(-1deg);
    }
    20% {
        transform: translate(-2px, 1px) rotate(1deg);
    }
    30% {
        transform: translate(1px, 0px) rotate(0deg);
        box-shadow: 0 0 7px red;
    }
}
.form-wallet {
    padding: 5px;
}
</style>
