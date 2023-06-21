<template>
    <div class="accordion" :class="{ opened: isOpen }">
        <main-title tag="h4" class="accordion_title" @click="isOpen = !isOpen"
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
            <p
                class="description description-xs"
                v-html="accordion.text"
                v-if="isOpen"
            ></p>
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
        };
    },
    props: {
        accordion: Object,
    },
    name: "main-accordion",
};
</script>

<style lang="scss">
.slide-fade-enter-active {
    transition: all 0.3s ease;
}
.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter {
    transform: translateY(10px);
    opacity: 0;
}
.slide-fade-leave-to {
    opacity: 0;
}
.accordion {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 24px 0;
    overflow: hidden;
    height: fit-content;
    max-height: 77px;
    transition: all 0.8s ease 0s;
    &.opened {
        max-height: 500px;
    }
    &:not(:last-child) {
        border-bottom: 1px solid #e6eaf0;
    }
    &_title {
        cursor: pointer;
        display: inline-flex;
        justify-content: space-between;
        width: 100%;
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
