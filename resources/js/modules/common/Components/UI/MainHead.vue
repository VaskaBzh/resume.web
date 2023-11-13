<template>
    <div class="head">
        <main-title :class="titleClass">
            <slot name="title" />
        </main-title>
        <main-description>
            <slot name="text" />
        </main-description>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";

export default {
    name: "MainHead",
    components: {
        MainTitle,
        MainDescription,
    },
    props: {
        titleClass: {
            type: String,
            default: "title-popup",
        },
    },
};
</script>

<style scoped>
.head {
    display: flex;
    flex-direction: column;
    gap: 4px;
}
</style>
