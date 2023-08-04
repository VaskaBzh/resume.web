<template>
    <Datepicker
        v-model="date"
        range
        :placeholder="this.placeholder"
        auto-apply
        :locale='[$i18n.locale == "ru" ? "ru" : "en"]'
        position="center"
        :hide-navigation="['time']"
        :enable-time-picker="false"
        @update:modelValue="this.iconRemover"
        @open="this.opener"
        @closed="isOpen = false"
        ref="datePicker"
    >
   <template #input-icon>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" ref="icon">
                <path :d="[isOpen ?  'M6 14L12 8L18 14' : 'M18 10L12 16L6 10']"
                stroke="#818C99"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"/>
            </svg>
        </template>

    </Datepicker>
</template>
<script>
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

export default {
    components: { Datepicker },
    props: {
        placeholder: String,
    },
    data() {
        return {
            date: {},
            isOpen: false,
        };
    },
    name: "main-date",
    methods: {
        iconRemover(e) {
            this.$emit("calendarChange", e)
            return this.$refs.icon.style.display = this.date !== null ? "none" : "inline"
        },
        opener() {
            this.isOpen = true;
            document.querySelector(".dp__input_wrap input").focus();
        },
        //Может сделать teleport-center для мобилки ? то есть где-то фиксировать ширину экрана и
    },
}

</script>
<style lang="scss" scoped>

</style>
