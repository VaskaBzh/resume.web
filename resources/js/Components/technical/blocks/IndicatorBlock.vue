<template>
    <div class="wrap__block wrap__block-blue wrap__column">
        <main-title
            tag="h3"
            class="wrap_title wrap_title-white wrap_title-no-before"
            >{{ option[0].title }}</main-title
        >
        <p class="text text-sm text-ligth">
            {{ option[0].text }}
        </p>
        <button class="open-button" @click="openedToggle">
            Подробнее
            <svg
                width="15"
                height="14"
                viewBox="0 0 15 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M11.3234 4.83736C11.5512 5.06516 11.5512 5.43451 11.3234 5.66232L7.82341 9.16232C7.5956 9.39012 7.22626 9.39012 6.99845 9.16232L3.49845 5.66232C3.27064 5.43451 3.27064 5.06516 3.49845 4.83736C3.72626 4.60955 4.0956 4.60955 4.32341 4.83736L7.41093 7.92488L10.4985 4.83736C10.7263 4.60955 11.0956 4.60955 11.3234 4.83736Z"
                    fill="white"
                />
            </svg>
        </button>
    </div>

    <div
        :class="{ opened: opened }"
        class="wrap__block wrap__column wrap__menu"
    >
        <p class="text text-sm" v-for="opt in option[1]" v-html="opt"></p>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";

export default {
    name: "indicator-block",
    props: {
        option: Array,
    },
    components: {
        MainTitle,
    },
    data() {
        return {
            opened: false,
        };
    },
    methods: {
        openedToggle() {
            this.opened = !this.opened;
        },
        close(e) {
            if (this.opened === true && !e.target.closest(".open-button"))
                this.opened = false;
        },
    },
    mounted() {
        document.querySelector("body").addEventListener("click", this.close);
    },
};
</script>

<style scoped></style>
