<template>
    <div class="no-information">
        <div class="no-information__block">
            <img src=../../../../assets/img/img_no-statistic.png
            class="no-information_img" alt="no-statistic-info">
            <p class="no-information_text">
                {{ $t("no_info.text") }}
            </p>
        </div>
        <router-link to="connecting" class="button button-blue button-full">
            {{ $t("no_info.button") }}</router-link
        >
    </div>
</template>

<script>
import { StatisticMessage } from "@/modules/statistic/lang/StatisticMessage";

export default {
    name: "NoInformation",
    i18n: {
        sharedMessages: StatisticMessage,
    },
};
</script>

<style scoped>
.button {
    min-width: 80px;
    width: fit-content;
    min-height: 56px;
    border-radius: 12px;
    background: var(--background-island, #fff);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    border: none;
    outline: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #2e90fa;
    padding: 0 16px;
}
.button-blue {
    background: var(--old-primary-500, #2e90fa);
    color: #FFFFFF;
    box-shadow: 0px 10px 10px -6px rgba(0, 0, 0, 0.1);
}
.button-full {
    min-width: 100%;
}
.no-information {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.no-information__block {
    display: flex;
    flex-direction: column;
    gap: 24px;
    align-items: center;
}
.no-information_text {
    color: var(--text-teritary);
    text-align: center;
    font-family: NunitoSans, serif;
    font-size: 20px;
    font-weight: 400;
    line-height: 24px;
}
.no-information_img {
    width: 160px;
    height: 160px;
}
</style>
