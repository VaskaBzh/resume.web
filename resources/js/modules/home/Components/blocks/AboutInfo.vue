<template>
    <div class="block">
        <span class="block_title">
            <landing-hint :hint="hint" v-show="hint"/>
            <landing-text class="block_prefix text-gray-360" v-show="prefix">{{
                    prefix
                }}</landing-text>
            {{ title }}
        </span>
        <landing-text class="block_text text-gray-360">
            {{ text }}
        </landing-text>
    </div>
</template>

<script>
import LandingText from "@/modules/common/Components/UI/LandingText.vue";
import LandingHint from "@/modules/common/Components/UI/LandingHint.vue";

export default {
    name: "about-info",
    components: {LandingHint, LandingText},
    props: {
        title: String,
        prefix: String,
        text: String,
        hint: String,
    },
};
</script>

<style scoped>
.block {
    display: flex;
    flex-direction: column;
    width: fit-content;
    position: relative;
}

.block_title {
    color: var(--gray-3100, #d0d5dd);
    font-family: Unbounded, serif;
    font-size: 75px;
    font-weight: 600;
    line-height: 100%;
    text-transform: uppercase;
    display: inline-flex;
    align-items: flex-end;
}

.block_prefix {
    text-transform: none;
}
</style>
