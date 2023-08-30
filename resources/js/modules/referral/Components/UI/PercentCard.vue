<template>
    <div class="card">
        <p class="card_text">{{ $t("percent.text") }} - {{ percent }} %</p>
        <div
            class="card_question"
            @mouseenter="openGradeList"
            @mouseleave="closeGradeList(true)"
            v-if="percentSvg"
        >
            <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                v-html="percentSvg"
            ></svg>
        </div>
        <transition name="grade">
            <svg
                v-show="opened"
                v-if="percentList"
                class="card_arrow"
                width="8"
                height="16"
                viewBox="0 0 8 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                @mouseenter="unClose"
                @mouseleave="closeGradeList"
            >
                <path
                    d="M-6.99382e-07 0L0 16L6.58579 9.41421C7.36683 8.63316 7.36683 7.36683 6.58579 6.58579L-6.99382e-07 0Z"
                />
            </svg>
        </transition>
        <transition name="grade">
            <div
                class="card__list"
                v-if="percentList"
                v-show="opened"
                @mouseenter="unClose"
                @mouseleave="closeGradeList"
            >
                <p class="card__list_text">
                    {{ $t("grade.hint") }}
                </p>
                <info-list :gradeList="percentList" />
            </div>
        </transition>
    </div>
</template>

<script>
import InfoList from "@/modules/referral/Components/blocks/InfoList.vue";
import { ReferralsMessage } from "../../lang/ReferralsMessage";

export default {
    name: "percent-card",
    components: {
        InfoList,
    },
    i18n: {
        sharedMessages: ReferralsMessage,
    },
    props: {
        percent: Number,
        percentSvg: {
            type: Number,
            default: null,
        },
        percentList: {
            type: Array,
            default: null,
        },
    },
    data() {
        return {
            opened: false,
            timeout: null,
            wait: false,
        };
    },
    methods: {
        openGradeList() {
            clearTimeout(this.timeout);
            this.opened = true;
            this.wait = false;
        },
        closeGradeList(bool = false) {
            this.wait = bool;
            if (!this.wait) this.opened = false;
            else this.timeout = setTimeout(() => (this.opened = false), 500);
        },
        unClose() {
            clearTimeout(this.timeout);
            if (!this.wait) this.opened = true;
        },
    },
};
</script>

<style scoped lang="scss">
.grade-enter-active,
.grade-leave-active {
    transition: all 0.5s ease 0s;
}
.grade-enter-from,
.grade-leave-to {
    opacity: 0;
}
.card {
    display: flex;
    min-height: 48px;
    width: 100%;
    padding: 0 16px;
    justify-content: center;
    align-items: center;
    border-radius: 8px;
    background: #dce4f1;
    position: relative;
    gap: 10px;
    &_text {
        color: var(--blue-90, #5389e1);
        font-size: 18px;
        font-weight: 500;
        line-height: 135%;
    }
    &_question {
        stroke: #99acd3;
        cursor: pointer;
        width: 24px;
        height: 24px;
    }
    &_arrow {
        fill: var(--dark-bg, #fff);
        position: absolute;
        right: 38px;
        top: 50%;
        transform: translateY(-50%);
        width: 8px;
        height: 16px;
        z-index: 101;
    }
    &__list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        position: absolute;
        right: calc(38px + 8px);
        top: 50%;
        transform: translateY(-50%);
        padding: 16px;
        border-radius: 16px;
        background: var(--dark-bg, #fff);
        min-width: 350px;
        z-index: 101;
        &_text {
            color: #818c99;
            font-size: 12px;
            font-weight: 400;
            line-height: 130%;
        }
    }
}
</style>
