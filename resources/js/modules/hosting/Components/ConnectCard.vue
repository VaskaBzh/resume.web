<template>
    <div class="connect__section" ref="view">
        <landing-headline>{{ $t("connect.button") }}</landing-headline>
        <div class="card-connect">
            <div>
                <p class="card-title">{{ $t("connect.title") }}</p>
                <p class="card-text">{{ $t("connect.text") }}</p>
            </div>
            <form class="connect-form">
                <input
                    class="connect-input"
                    :placeholder="$t('connect.form.placeholder')"
                />
                <input class="connect-input" placeholder="+7" />
                <div class="buttons-connect-container">
                    <button class="connect-order">
                        {{ $t("connect.form.button[0]") }}
                    </button>
                    <p class="or-text">{{ $t("connect.form.text") }}</p>
                    <div class="or-container">
                        <button class="or-button">
                            {{ $t("connect.form.button[1]") }}
                        </button>
                        <button class="or-button">
                            {{ $t("connect.form.button[2]") }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { HostingMessage } from "@/modules/hosting/lang/HostingMessage";
import LandingHeadline from "../../common/Components/UI/LandingHeadline.vue";

export default {
    components: { LandingHeadline },
    i18n: {
        sharedMessages: HostingMessage,
    },
    data() {
        return {
            validScroll: false,
            startY: null,
            touchY: null,
        };
    },
    props: {
        start: Boolean,
    },
    methods: {
        handleTouchStart(e) {
            this.startY = e.touches[0].clientY;
        },
        handleTouchMove(e) {
            this.touchY = e.touches[0].clientY;
            this.handleWheel();
        },
        handleWheel(e) {
            if (this.startY ? this.startY - this.touchY > 110 : e.deltaY > 10) {
                this.remove();
                setTimeout(this.scroll, 650);

                if (
                    this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight >
                        20 &&
                    !this.validScroll
                ) {
                    this.$refs.view.style.transform = `translateY(-${
                        this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight
                    }px)`;

                    this.validScroll = true;
                } else {
                    this.$emit("next");
                }
            }
            if (
                this.startY ? this.touchY - this.startY > 110 : e.deltaY < -10
            ) {
                this.remove();
                setTimeout(this.scroll, 650);

                if (
                    this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight >
                        20 &&
                    this.validScroll
                ) {
                    this.$refs.view.style.transform = `translateY(0px)`;

                    this.validScroll = false;
                } else {
                    this.$emit("prev");
                }
            }
        },
        scroll() {
            if (this.$refs.view) {
                this.$refs.view.focus();
                this.$refs.view.addEventListener("wheel", this.handleWheel);
                this.$refs.view.addEventListener(
                    "touchstart",
                    this.handleTouchStart
                );
                this.$refs.view.addEventListener(
                    "touchmove",
                    this.handleTouchMove
                );
            }
        },
        remove() {
            if (this.$refs.view) {
                this.$refs.view.removeEventListener("wheel", this.handleWheel);
                this.$refs.view.removeEventListener(
                    "touchstart",
                    this.handleTouchStart
                );
                this.$refs.view.removeEventListener(
                    "touchmove",
                    this.handleTouchMove
                );
            }
        },
    },
    watch: {
        start(newStartState) {
            if (newStartState) {
                this.scroll();
            } else {
                this.remove();
            }
        },
    },
    mounted() {
        this.scroll();
    },
    unmounted() {
        this.remove();
    },
};
</script>
<style scoped>
.connect-with-us {
    width: 50%;
    text-align: center;
    color: var(--gray-3100, #d0d5dd);
    font-family: Unbounded;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 19.2px */
    text-transform: uppercase;
    border-radius: 20px;
    border: 0.5px solid var(--secondary-gray, #98a2b3);
    background: rgba(13, 13, 13, 0.1);
    padding: 10px 20px;
}

.card-title {
    color: var(--gray-1100, #f5faff);
    margin-bottom: 20px;
    /* Text Web/Headline 5 */
    font-family: Unbounded;
    font-size: 36px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 43.2px */
    text-transform: uppercase;
}

.card-text {
    color: var(--gray-170, rgba(245, 250, 255, 0.7));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 19.8px */
}

.card-connect {
    width: 534px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.connect-input {
    border-radius: 30px;
    border: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.4));
    width: 400px;
    height: 48px;
    padding: 4px 20px;
    background: inherit;
    color: #f5faff;
}

.connect-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 30px;
}

.buttons-connect-container {
    display: flex;
    flex-direction: column;
    gap: 40px;
    width: 400px;
    align-items: center;
}

.connect-order {
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.6);
    background: var(--gray-480, rgba(13, 13, 13, 0.8));
    padding: 8px 20px;
    width: 400px;
    color: var(--gray-1100, #f5faff);
    text-align: center;
    font-family: Unbounded;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    text-transform: uppercase;
    height: 48px;
    margin-top: 20px;
}

.or-text {
    color: var(--gray-3100, #d0d5dd);
    font-family: Unbounded;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%; /* 16.8px */
    text-transform: uppercase;
}

.or-container {
    display: flex;
    gap: 10px;
    width: 100%;
    justify-content: space-between;
    align-items: center;
}

.or-button {
    border-radius: 20px;
    border: 1px solid var(--secondary-gray-2, rgba(152, 162, 179, 0.5));
    background: var(--gray-25, rgba(228, 231, 236, 0.05));
    padding: 10px;
    color: var(--gray-1100, #f5faff);
    text-align: center;
    font-family: Unbounded;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%; /* 16.8px */
    text-transform: uppercase;
    width: 195px;
}

@media (min-width: 768px) {
    .card-connect {
        padding-left: 90px;
    }
}

@media (max-width: 768px) {
    .card-title {
        font-size: 24px;
        width: 361px;
    }

    .card-text {
        width: 280px;
    }

    .card-connect {
        width: auto;
        align-items: center;
    }

    .connect-input {
        width: 90vw;
        font-size: 20px;
    }

    .buttons-connect-container {
        width: auto;
    }

    .connect-order {
        width: 90vw;
    }

    .or-button {
        width: 49%;
    }

    .connect-with-us {
        width: 50%;
        text-align: center;
        font-size: 14px;
    }
}

@media (max-width: 450px) {
    .connect-with-us {
        font-size: 12px;
    }

    .card-title {
        font-size: 18px;
        width: 282px;
    }

    .card-text {
        font-size: 14px;
        width: 282px;
    }

    .connect-input {
        font-size: 14px;
    }

    .connect-order {
        font-size: 12px;
    }
}
</style>
