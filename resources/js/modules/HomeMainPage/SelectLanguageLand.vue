<template>
    <div class="select-language" @click="selectMassage">
        <span> {{ $i18n.locale }}</span>
    </div>
</template>

<script>
export default {
    methods: {
        selectMassage() {
            const lang = this.$i18n.locale === "en" ? "ru" : "en";
            this.$i18n.locale = lang;
            localStorage.setItem("location", lang);
        },
    },
    mounted() {
        this.$i18n.locale = localStorage.getItem("location");
    },
};
</script>

<style scoped lang="scss">
.select-language {
    display: flex;
    width: 48px;
    height: 48px;
    padding: 8px 20px;
    justify-content: center;
    align-items: center;
    color: white;
    border-radius: 40px;
    border: 0.5px solid rgba(192, 228, 255, 0.6);
    background: rgba(13, 13, 13, 0.7);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    text-transform: uppercase;
    cursor: pointer;
    font-size: clamp(14px, 5vw, 18px);
    font-family: Unbounded;
}
</style>
