<template>
    <div class="card" ref="card">
        <div class="card_icon" v-html="content.svg"></div>
        <p class="text text-gray card_text">{{ content.text }}</p>
        <span class="card_value" v-show="changeStep">{{
            Number(cardValue) === 0 ? "-" : cardValue
        }}</span>
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
            cardValue: this.content.value,
            changeStep: true,
            satoshi: null,
            interval: null,
        };
    },
    watch: {
        "content.value"(newValue, oldValue) {
            if (Number(oldValue) === 0) {
                this.$refs.card.style.width = this.$refs.card.offsetWidth + "px";

                let startValue = Number(oldValue) || 0;
                this.satoshi =
                    newValue % 1 === 0 ? newValue : newValue * 10000000;
                const intervalStep = 1000 / this.satoshi;

                this.cardValue =
                    newValue % 1 === 0
                        ? startValue + 1
                        : (startValue + 1 / 100000000).toFixed(8) + " BTC";

                this.interval = setInterval(() => {
                    if (startValue <= this.satoshi && startValue > 0) {
                        this.cardValue =
                            newValue % 1 === 0
                                ? startValue
                                : (startValue / 100000000).toFixed(8) + " BTC";
                    } else if (startValue > this.satoshi) {
                        clearInterval(this.interval);
                    }
                    startValue = startValue + 1;
                }, intervalStep);

                setTimeout(() => {
                    this.$refs.card.style.width = this.$refs.card.scrollWidth + "px";
                }, 300)
            } else {
                clearInterval(this.interval);
                this.cardValue = 0;
            }
        },
    },
};
</script>

<style scoped lang="scss">
.card {
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: all 0.5s ease 0s;
    &_icon {
        margin-bottom: 8px;
        svg {
            width: 48px;
            height: 48px;
        }
    }
    &_text {
        font-size: 14px;
        white-space: nowrap;
    }
    &_value {
        color: var(--light-theme-gray-3, #818c99);
        font-size: 22px;
        font-weight: 500;
        line-height: 130%;
        white-space: nowrap;
    }
}
</style>
