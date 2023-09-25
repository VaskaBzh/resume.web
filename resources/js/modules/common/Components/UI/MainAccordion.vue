<template>
    <div class="accordion" ref="accordion">
        <p class="accordion_title" @click="accordionFunc"
            >{{ accordion.title }}
            <!-- <svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" v-show="!isOpen">
               <path d="M13 1.00005C13 1.00005 8.58107 6.99999 6.99995 7C5.41884 7.00001 1 1 1 1" stroke="#D0D5DD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg> -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" v-show="!isOpen">
                <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke="#D0D5DD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            <!-- <svg
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
            </svg> -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" v-show="isOpen">
             <path d="M18 15C18 15 13.5811 9.00001 12 9C10.4188 8.99999 6 15 6 15" stroke="#D0D5DD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <!-- <svg
                width="28"
                height="28"
                viewBox="0 0 28 28"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                v-show="isOpen"
            >
                <path d="M4 13V14.75H23.25V13H4Z" fill="#343434" />
            </svg> -->
        </p>
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
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";

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
    // @media (max-width: 991.98px) {
    //     padding: 16px 0;
    // }
    // @media (max-width: 479.98px) {
    //     padding: 10px 0;
    // }
    &:not(:last-child) {
        border-bottom: 1px solid #e6eaf0;
    }
    &_title {
        color: var(--text-secondary, #475467);
        font-family: NunitoSans;
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 175%; /* 31.5px */
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
