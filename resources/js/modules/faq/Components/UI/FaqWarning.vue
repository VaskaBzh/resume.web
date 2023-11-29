<template>
<component class="faq_info" :is="tag ? tag: 'div'">
    <MainIcon name="info" class="faq_icon icon-md"/>
    <div class="faq_info_text">
        <slot/>
    </div>
</component>
</template>


<script>
import MainIcon from "@/modules/common/icons/MainIcon.vue";

export default {
    name: "FaqWarning",
    components: {MainIcon},
    props: {
        tag: String
    }
}
</script>



<style scoped>
.faq_info {
    width: 100%;
    height: auto;
    padding: 16px;
    border-radius: 12px;
    background: rgba(83, 177, 253, 0.07);
    color: #53B1FD;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    justify-content: flex-start;
    gap: 6px;
}

.faq_icon {
    fill: #53B1FD;
}

.faq_info_text {
    display: flex;
    flex-flow: column nowrap;
    align-items: flex-start;
    gap: 5px;
}

</style>
