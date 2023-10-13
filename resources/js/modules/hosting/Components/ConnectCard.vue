<template>
    <landing-headline>{{ $t("connect.button") }}</landing-headline>
    <div class="card-connect">
        <div>
            <p class="card-title">{{ $t("connect.title") }}</p>
            <p class="card-text">{{ $t("connect.text") }}</p>
        </div>
        <form class="connect-form">
            <input class="connect-input" :placeholder="$t('connect.form.placeholder')">
            <input class="connect-input" placeholder="+7">
            <div class="buttons-connect-container">
                <button class="connect-order">{{ $t("connect.form.button[0]") }}</button>
                <p class="or-text">{{ $t("connect.form.text") }}</p>
                <div class="or-container">
                    <button class="or-button">{{ $t("connect.form.button[1]") }}</button>
                    <button class="or-button">{{ $t("connect.form.button[2]") }}</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import {HostingMessage} from "@/modules/hosting/lang/HostingMessage";
import LandingHeadline from "../../common/Components/UI/LandingHeadline.vue";

export default {
    components: {LandingHeadline},
    i18n: {
        sharedMessages: HostingMessage,
    },
}
</script>
<style scoped>
* {
    transition: all 0.3s linear;
}

.connect-with-us {
    width: 50%;
    text-align: center;
    color: var(--gray-3100, #D0D5DD);
    font-family: Unbounded;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 19.2px */
    text-transform: uppercase;
    border-radius: 20px;
    border: 0.5px solid var(--secondary-gray, #98A2B3);
    background: rgba(13, 13, 13, 0.10);
    padding: 10px 20px;
}

.card-title {
    color: var(--gray-1100, #F5FAFF);
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
    color: var(--gray-170, rgba(245, 250, 255, 0.70));
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
    border: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.40));
    width: 400px;
    height: 48px;
    padding: 4px 20px;
    background: inherit;
    color: #F5FAFF;
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
    border: 1px solid rgba(192, 228, 255, 0.60);
    background: var(--gray-480, rgba(13, 13, 13, 0.80));
    padding: 8px 20px;
    width: 400px;
    color: var(--gray-1100, #F5FAFF);
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
    color: var(--gray-3100, #D0D5DD);
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
    border: 1px solid var(--secondary-gray-2, rgba(152, 162, 179, 0.50));
    background: var(--gray-25, rgba(228, 231, 236, 0.05));
    padding: 10px;
    color: var(--gray-1100, #F5FAFF);
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
