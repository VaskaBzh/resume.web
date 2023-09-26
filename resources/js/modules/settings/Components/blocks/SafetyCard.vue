<template>
    <div class="card__subcontainer">
        <img :src="img" alt="image" />
        <div>
            <p class="card__title">{{ card.title }}</p>
            <p class="card__text">{{ card.text }}</p>
        </div>
    </div>
    <div class="btn_container">
        <button
            class="btn_content"
            :data-popup="'#' + card.id"
            @mousedown="$emit('send2fac')"
        >
            {{ card.button }}
        </button>
    </div>
</template>
<script>
import { SettingsMessage } from "@/modules/settings/lang/SettingsMessage";
import { mapGetters } from "vuex";
export default {
    name: "safety-card",
    i18n: {
        sharedMessages: SettingsMessage,
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
.card__text {
    color: var(--light-gray-400, #98a2b3);
    font-family: NunitoSans;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 145%; /* 20.3px */
}
.card__title {
    color: var(--text-secondary, #475467);
    font-family: Unbounded;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
}
.card__subcontainer {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 62%;
}

.btn_container {
    display: flex;
    align-items: center;
}

.btn_content {
    width: 163px;
    padding: 8px 16px;
    border-radius: 12px;
    border: 1px solid var(--primary-500, #2e90fa);
    background: var(--primary-500, #2e90fa);
    box-shadow: 0px 0px 1px 0px rgba(0, 0, 0, 0.4),
        0px 8px 12px -6px rgba(0, 0, 0, 0.05);
    font-family: NunitoSans, serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    color: var(--buttons-primary-text, var(--main-gohan, #FFF));
    line-height: 175%; /* 31.5px */
}
@media (max-width: 900px) {
    .card__subcontainer {
        width: 100%;
        flex-direction: column;
    }
    .btn_container {
        justify-content: center;
    }
    .btn_content {
        width: 100%;
    }
}
</style>
