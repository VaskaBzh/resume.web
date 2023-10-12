<template>
    <div class="block">
        <i class="block__hint" v-show="hint">
            <span class="block__hint__content">
            <hint-icon CLASS="block__hint_icon"/>
                <landing-text class="block__hint_text">{{ hint }}</landing-text>
            </span>
        </i>
        <span class="block_title">
            <landing-text class="block_prefix text-gray-360" v-show="prefix">{{ prefix }}</landing-text>
            {{ title }}
        </span>
        <landing-text class="block_text text-gray-360">
            {{ text }}
        </landing-text>
    </div>
</template>

<script>
import HintIcon from "@/modules/home/icons/HintIcon.vue";
import LandingText from "@/modules/common/Components/UI/LandingText.vue";

export default {
    name: "about-info",
    components: {LandingText, HintIcon},
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

.block__hint {
    position: absolute;
    right: -28px;
    top: 0;
    width: 28px;
    height: 28px;
    cursor: pointer;
}

.block__hint__content {
    position: relative;
    width: 100%;
    height: 100%;
    display: inline-flex;
}

.block__hint_text {
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

.block__hint:hover .block__hint_text {
    opacity: 1;
    visibility: visible;
    left: 44px;
    transform: scale(1);
    transition: all 0.3s ease 0s;
}

.block__hint_icon {
    width: 100%;
    height: 100%;
}
</style>
