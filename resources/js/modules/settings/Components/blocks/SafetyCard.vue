<template>
    <div class="card__subcontainer">
        <img :src="img" alt="image" class="img-safety-card" />
        <div class="card_inf_block">
            <p class="card__title">{{ card.title }}</p>
            <p class="card__text">{{ card.text }}</p>
        </div>
    </div>
    <div class="btn_container">
        <button
            class="btn_content"
            :class="{
                'btn_content-ghost': card.emit === 'dropFac',
            }"
            :data-popup="'#' + card.id"
            @mousedown="$emit(card.emit)"
        >
            {{ card.button }}
        </button>
        <!--        v-if="card.name !== 'verify_password' && !!user.email_verified_at"-->
        <!--        <verify-link-->
        <!--            v-else-->
        <!--            class="btn_content"-->
        <!--            :verifyText="card.button"-->
        <!--            verifyUrl="/password/reset"-->
        <!--        />-->
    </div>
</template>
<script>
import VerifyLink from "@/modules/verify/Components/UI/VerifyLink.vue";
import { SettingsMessage } from "@/modules/settings/lang/SettingsMessage";
import { mapGetters } from "vuex";

export default {
    name: "SafetyCard",
    i18n: {
        sharedMessages: SettingsMessage,
    },
    components: {
        VerifyLink,
    },
    props: {
        card: Object,
    },
    computed: {
        ...mapGetters(["user"]),
        img() {
            return new URL(
                `/resources/assets/img/${this.card.src}`,
                import.meta.url
            );
        },
    },
};
</script>
<style scoped>
.img-safety-card {
    width: 72px;
    height: 72px;
}
.card__text {
    color: var(--text-teritary, #98a2b3);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 145%;
}

.card_inf_block {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 2px;
}
@media (max-width: 998px) {
    .card_inf_block {
        width: 100%;
    }
}
.card__title {
    color: var(--text-secondary, #475467);
    font-family: Unbounded;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
}
@media (min-width: 767.98px) {
    .card__title {
        white-space: nowrap;
    }
}
@media (min-width: 767.98px) {
    .card__subcontainer {
        max-width: 62%;
    }
}
.card__subcontainer {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    min-width: 300px;
}

.btn_container {
    display: flex;
    align-items: center;
}

.btn_content {
    min-width: 163px;
    padding: 8px 16px;
    border-radius: 12px;
    background: var(--primary-500, #2e90fa);
    box-shadow: 0px 0px 1px 0px rgba(0, 0, 0, 0.4),
        0px 8px 12px -6px rgba(0, 0, 0, 0.05);
    font-family: NunitoSans, serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 767;
    color: var(--buttons-primary-text, var(--main-gohan, #fff));
    line-height: 175%; /* 31.5px */
    display: inline-flex;
    justify-content: center;
    align-items: center;
    border: 1px solid transparent;
    transition: all 0.3s ease 0s;
}
.btn_content-ghost {
    background: transparent;
    border-color: var(--buttons-stroke-border-default, #98A2B3);
    box-shadow: 0px 0px 1px 0px rgba(0, 0, 0, 0.40), 0px 8px 12px -6px rgba(0, 0, 0, 0.05);
    color: var(--text-secondary, #475467);
}
@media (max-width: 767.98px) {
    .card__subcontainer {
        width: 100%;
        flex-direction: column;
    }
    .btn_container {
        justify-content: center;
    }
    .btn_content {
        width: 100%;
        font-size: 14px;
        line-height: 20px; /* 142.857% */
        padding: 10px 12px;
    }
}
</style>
