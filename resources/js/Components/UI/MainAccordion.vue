<template>
    <div class="accordion" ref="accordion">
        <main-title tag="h4" class="accordion_title" @click="accordionFunc"
            >{{ accordion.title }}
            <svg
                width="28"
                height="28"
                viewBox="0 0 28 28"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                v-show="!isOpen"
            >
                <path
                    d="M13.125 4.375V13.125H4.375V14.875H13.125V23.625H14.875V14.875H23.625V13.125H14.875V4.375H13.125Z"
                    fill="#343434"
                />
            </svg>
            <svg
                width="28"
                height="28"
                viewBox="0 0 28 28"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                v-show="isOpen"
            >
                <path d="M4 13V14.75H23.25V13H4Z" fill="#343434" />
            </svg>
        </main-title>
        <transition name="slide-fade">
            <div
                ref="value"
                class="description description-xs"
                v-show="isOpen"
                v-html="accordion.text"
            ></div>
        </transition>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";

export default {
    components: {
        MainTitle,
    },
    data() {
        return {
            isOpen: false,
            height: null,
        };
    },
    methods: {
        accordionFunc() {
            this.isOpen = !this.isOpen;
            this.isOpen ? this.open() : this.close();
        },
        open() {
            setTimeout(() => {
                this.$refs.accordion.style.height =
                    this.height + this.$refs.value.offsetHeight + "px";
            }, 100);
        },
        close() {
            this.$refs.accordion.style.height = this.height + "px";
        },
    },
    props: {
        accordion: Object,
    },
    mounted() {
        this.height = this.$refs.accordion.scrollHeight;
        this.close();
    },
    name: "main-accordion",
};
</script>

<style lang="scss">
.slide-fade-leave-active,
.slide-fade-enter-active {
    transition: all 0.5s ease;
}
.slide-fade-leave-to,
.slide-fade-enter {
    opacity: 0;
}
.accordion {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 24px 0;
    overflow: hidden;
    height: fit-content;
    transition: all 0.8s ease 0s;
    @media (max-width: 991.98px) {
        padding: 16px 0;
    }
    @media (max-width: 479.98px) {
        padding: 10px 0;
    }
    &:not(:last-child) {
        border-bottom: 1px solid #e6eaf0;
    }
    &_title {
        cursor: pointer;
        display: inline-flex;
        justify-content: space-between;
        width: 100%;
        @media (max-width: 479.98px) {
            font-size: 14px;
        }
        svg {
            min-width: 28px;
            min-height: 28px;
            width: 28px;
            height: 28px;
            @media (max-width: 991.98px) {
                min-width: 24px;
                min-height: 24px;
                width: 24px;
                height: 24px;
            }
            @media (max-width: 767.98px) {
                min-width: 18px;
                min-height: 18px;
                width: 18px;
                height: 18px;
            }
        }
    }
    .description {
        height: fit-content;
        @media (max-width: 767.98px) {
            font-size: 14px;
        }
    }
    .list {
        max-width: 100%;
        cursor: default;
        counter-reset: myCounter;
        list-style-type: none;
        padding-left: 0;
        &_item {
            &::before {
                counter-increment: myCounter;
                content: counter(myCounter) ". ";
            }
        }
    }
}
</style>
