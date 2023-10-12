<template>
    <i class="hint" v-show="hint">
        <span class="hint__content">
            <hint-icon class="hint_icon"/>
            <landing-text class="hint_text">{{ hint }}</landing-text>
        </span>
    </i>
</template>

<script>
import LandingText from "@/modules/common/Components/UI/LandingText.vue";
import HintIcon from "@/modules/common/icons/HintIcon.vue";

export default {
    name: "landing-hint",
    components: {LandingText, HintIcon},
    props: {
        hint: String,
    },
};
</script>

<style scoped>
.hint {
    position: absolute;
    right: -28px;
    top: 0;
    width: 28px;
    height: 28px;
    cursor: pointer;
}

.hint__content {
    position: relative;
    width: 100%;
    height: 100%;
    display: inline-flex;
}

.hint_text {
    position: absolute;
    left: 28px;
    top: -10px;
    padding: 20px;
    border-radius: 20px;
    background: var(--gray-310, rgba(208, 213, 221, 0.1));
    box-shadow: 2px 4px 4px 0px rgba(24, 73, 169, 0.05);
    text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease 0.5s;
    transform: scale(0);
    transform-origin: left 20px;
    min-width: 363px;
}

.hint:hover .hint_text {
    opacity: 1;
    visibility: visible;
    left: 44px;
    transform: scale(1);
    transition: all 0.3s ease 0s;
}

.hint_icon {
    width: 100%;
    height: 100%;
}
</style>
