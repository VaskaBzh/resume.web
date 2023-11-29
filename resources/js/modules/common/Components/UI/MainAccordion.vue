<template>
    <div class="accordion" ref="accordion">
        <p class="accordion_title" @click="accordionFunc"
            >{{ accordion.title }}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"  v-show="!isOpen" class="svg-faq">
                <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" v-show="isOpen" class="svg-faq">
                <path d="M18 15C18 15 13.5811 9.00001 12 9C10.4188 8.99999 6 15 6 15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
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
            this.$refs.accordion.style.height =  64 + "px";
            if(window.innerWidth < 500){
                this.$refs.accordion.style.height =  56 + "px";
            }

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
.svg-faq{
    stroke: var(--svg-fill)
}
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
    padding: 16px 0;
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
        border-bottom: 1px solid #595E68;
    }
    &_title {
        color: #C5C8CD;
        font-family: NunitoSans, serif;
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
            line-height: 20px; /* 142.857% */
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
        color: #C5C8CD;
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
@media(max-width:500px){
    .faq__list .section__block{
        padding: 16px;
    }
}
</style>
