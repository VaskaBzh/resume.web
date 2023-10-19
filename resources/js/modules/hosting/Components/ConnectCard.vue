<template>
    <div class="connect__section" ref="view">
        <landing-headline>{{ $t("connect.button") }}</landing-headline>
        <div class="card-connect">
            <div>
                <p class="card-title">{{ $t("connect.title") }}</p>
                <p class="card-text">{{ $t("connect.text") }}</p>
            </div>
            <!--            @submit.prevent="sendMessage"-->
            <form class="connect-form">
                <input
                    class="connect-input"
                    :placeholder="$t('connect.form.placeholder')"
                    v-model="form.message"
                />
                <input
                    class="connect-input"
                    placeholder="+7"
                    v-model="form.contacts"
                />
                <div class="buttons-connect-container">
                    <a
                        href="https://t.me/allbtc_support"
                        class="connect-order"
                        type="submit"
                    >
                        {{ $t("connect.form.button[0]") }}
                    </a>
                    <p class="or-text">{{ $t("connect.form.text") }}</p>
                    <div class="or-container">
                        <a
                            href="https://t.me/allbtc_support"
                            target="_blank"
                            class="or-button"
                        >
                            {{ $t("connect.form.button[1]") }}
                        </a>
                        <!--                        <button class="or-button">-->
                        <!--                            {{ $t("connect.form.button[2]") }}-->
                        <!--                        </button>-->
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import {HostingMessage} from "@/modules/hosting/lang/HostingMessage";
import LandingHeadline from "../../common/Components/UI/LandingHeadline.vue";
import {MainApi} from "@/api/api";
import {mapGetters} from "vuex";

export default {
    components: {LandingHeadline},
    i18n: {
        sharedMessages: HostingMessage,
    },
    data() {
        return {
            form: {
                message: "",
                contacts: "+7",
            },
        };
    },
    computed: {
        ...mapGetters(["viewportWidth"]),
    },
    methods: {
        async sendMessage() {
            try {
                await MainApi.put("/send_message", this.form);

                this.form.message = "";
                this.form.contacts = "";
            } catch (e) {
                console.error("Error with: " + e);
            }
        },
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
    display: inline-flex;
    align-items: center;
    justify-content: center;
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
    width: 100%;
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
