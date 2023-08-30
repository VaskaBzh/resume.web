<template>
    <div class="card">
        <div class="card_icon" v-html="content.svg"></div>
        <p class="text text-gray card_text">{{ content.text }}</p>
        <span class="card_value">{{ statValue }}</span>
    </div>
</template>

<script>
export default {
    name: "stats-card",
    props: {
        content: Object,
    },
    data() {
        return {
            statValue: this.content.value,
        };
    },
    watch: {
        "content.value"(newValue, oldValue) {
            this.statValue = newValue;
            // let startValue = oldValue || 0;
            // let intervalStep = 2000 / newValue;
            // const interval = setInterval(function () {
            //     if (startValue <= newValue) {
            //         this.statValue = startValue;
            //     } else {
            //         clearInterval(interval);
            //     }
            //     startValue++;
            // }, intervalStep);
        },
    },
};
</script>

<style scoped lang="scss">
.card {
    display: flex;
    flex-direction: column;
    align-items: center;
    &_icon {
        margin-bottom: 8px;
        svg {
            width: 48px;
            height: 48px;
        }
    }
    &_text {
        font-size: 14px;
    }
    &_value {
        color: var(--light-theme-gray-3, #818c99);
        font-size: 22px;
        font-weight: 500;
        line-height: 130%;
    }
}
</style>
