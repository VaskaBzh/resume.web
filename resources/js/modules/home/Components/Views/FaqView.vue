<template>
    <div class="faq">
        <div class="faq__content">
            <landing-headline>
                {{ headline }}
            </landing-headline>
            <slot name="title"/>
            <faq-row
                v-for="(elem, i) in faq"
                :key="i"
                :title="elem.title"
                :text="elem.text"
                :preTitle="elem.preTitle"
                class="faq__row"
            />
        </div>
    </div>
</template>

<script>
import FaqRow from "../UI/FaqRow.vue";
import LandingHeadline from "@/modules/common/Components/UI/LandingHeadline.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import {closeOpacityTimeOut, showOpacityTimeOut} from "../../services/AnimationService";

export default {
    name: "faq-view",
    components: {FaqRow, LandingTitle, LandingHeadline},
    props: {
        faq: Array,
        headline: String,
        }

};
</script>

<style scoped>
.faq {
    width: 100%;
    display: flex;
    flex-direction: column;
}

.faq__content {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

.faq_title {
    margin-bottom: clamp(80px, 5vw, 140px);
    display: flex;
    flex-direction: column;
}
</style>
