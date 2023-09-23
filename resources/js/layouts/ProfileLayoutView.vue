<template>
    <div class="layout">
        <nav-tabs ref="tabs" />
        <div class="layout__content">
            <header-component-profile class="header-container" />
            <!-- Кнопка для тестирования -->
            <button @click="openNotification('all good', 'title')">add</button>

            <div class="page-container">
                <div :class="{ 'note-animation': messageNote }">
                    <div class="notification-card" v-if="messageNote">
                        <div class="header-card">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M16.6245 3.98703C16.983 4.19443 17.4418 4.07191 17.6492 3.71337C17.8566 3.35482 17.7341 2.89603 17.3755 2.68862L16.6245 3.98703ZM22.535 9.8508C22.4526 9.44487 22.0567 9.18259 21.6508 9.26499C21.2448 9.34739 20.9826 9.74326 21.065 10.1492L22.535 9.8508ZM8 11.75C7.58579 11.75 7.25 12.0858 7.25 12.5C7.25 12.9142 7.58579 13.25 8 13.25V11.75ZM11.5 16L10.8488 16.3721C10.9806 16.6028 11.2246 16.7465 11.4903 16.7499C11.7559 16.7534 12.0035 16.6161 12.1413 16.3889L11.5 16ZM22.2609 5.70316C22.6492 5.55907 22.8472 5.12745 22.7032 4.73911C22.5591 4.35076 22.1274 4.15275 21.7391 4.29684L22.2609 5.70316ZM12 1.25C6.06294 1.25 1.25 6.06294 1.25 12H2.75C2.75 6.89137 6.89137 2.75 12 2.75V1.25ZM1.25 12C1.25 17.9371 6.06294 22.75 12 22.75V21.25C6.89137 21.25 2.75 17.1086 2.75 12H1.25ZM12 22.75C17.9371 22.75 22.75 17.9371 22.75 12H21.25C21.25 17.1086 17.1086 21.25 12 21.25V22.75ZM17.3755 2.68862C15.7936 1.77351 13.9568 1.25 12 1.25V2.75C13.6861 2.75 15.2647 3.20043 16.6245 3.98703L17.3755 2.68862ZM22.75 12C22.75 11.2647 22.6761 10.5459 22.535 9.8508L21.065 10.1492C21.1862 10.7466 21.25 11.3655 21.25 12H22.75ZM8 12.5C8 13.25 7.99915 13.25 7.99831 13.25C7.99803 13.25 7.99719 13.25 7.99665 13.25C7.99555 13.25 7.99447 13.25 7.99342 13.25C7.99131 13.25 7.98929 13.2499 7.98735 13.2499C7.98348 13.2498 7.97995 13.2497 7.97675 13.2496C7.97036 13.2494 7.96533 13.2491 7.96164 13.2488C7.95424 13.2482 7.95226 13.2478 7.95553 13.2483C7.96192 13.2493 7.99 13.254 8.03822 13.2694C8.13381 13.2998 8.31593 13.3741 8.5699 13.5519C9.08002 13.909 9.88689 14.6887 10.8488 16.3721L12.1512 15.6279C11.1131 13.8113 10.17 12.841 9.4301 12.3231C9.05907 12.0634 8.74119 11.919 8.49303 11.84C8.36937 11.8006 8.26465 11.7781 8.18119 11.7654C8.13953 11.759 8.10338 11.7552 8.07303 11.7529C8.05786 11.7518 8.04417 11.7511 8.03198 11.7506C8.02588 11.7504 8.02017 11.7502 8.01484 11.7501C8.01217 11.7501 8.0096 11.7501 8.00713 11.75C8.00589 11.75 8.00468 11.75 8.00349 11.75C8.0029 11.75 8.00202 11.75 8.00173 11.75C8.00086 11.75 8 11.75 8 12.5ZM11.5 16C12.1413 16.3889 12.1413 16.389 12.1412 16.389C12.1413 16.3889 12.1413 16.3889 12.1413 16.3889C12.1414 16.3887 12.1416 16.3884 12.1418 16.388C12.1424 16.3871 12.1432 16.3857 12.1444 16.3838C12.1468 16.3799 12.1505 16.3738 12.1555 16.3657C12.1655 16.3493 12.1807 16.3246 12.201 16.2919C12.2415 16.2266 12.3022 16.1296 12.3814 16.005C12.5399 15.7557 12.7727 15.396 13.0678 14.9582C13.6584 14.0816 14.4957 12.8955 15.4838 11.6547C16.4733 10.4121 17.6046 9.1264 18.7822 8.04448C19.9682 6.95485 21.1579 6.11239 22.2609 5.70316L21.7391 4.29684C20.3715 4.80428 19.0134 5.79515 17.7674 6.93989C16.513 8.09235 15.3282 9.44207 14.3104 10.7203C13.291 12.0004 12.4299 13.2205 11.8238 14.12C11.5205 14.5701 11.2804 14.941 11.1156 15.2001C11.0332 15.3297 10.9696 15.4315 10.9263 15.5013C10.9046 15.5362 10.888 15.5631 10.8767 15.5816C10.871 15.5909 10.8667 15.598 10.8637 15.6029C10.8622 15.6054 10.861 15.6073 10.8602 15.6087C10.8598 15.6094 10.8594 15.6099 10.8592 15.6103C10.8591 15.6105 10.8589 15.6107 10.8589 15.6108C10.8588 15.611 10.8587 15.6111 11.5 16Z"
                                    fill="#1FB96C"
                                />
                            </svg>
                            <span>{{ titleNote }}</span>
                        </div>
                        <p>{{ messageNote }}</p>
                    </div>
                </div>
                <keep-alive>
                    <slot />
                </keep-alive>
            </div>
        </div>
    </div>
</template>
<script>
import NavTabs from "@/modules/navs/Components/NavTabs.vue";
import HeaderComponentProfile from "@/modules/common/Components/HeaderComponentProfile.vue";
import {
    messageNote,
    titleNote,
    openNotification,
} from "@/modules/notifications/services/NotificationServices";

export default {
    components: {
        NavTabs,
        HeaderComponentProfile,
    },
    computed: {
        messageNote() {
            return messageNote;
        },
        titleNote() {
            return titleNote;
        },
        openNotification() {
            return openNotification;
        },
    },
};
</script>
<style scoped>
.layout {
    width: 100%;
    min-height: 100vh;
    height: 100%;
    background: var(--background-island);
    display: flex;
}
.layout__content {
    width: 100%;
    display: flex;
    flex-direction: column;
}
.header-container {
    width: 100%;
    min-height: 72px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease 0s;
}
.page-container {
    /* padding: 24px; */
    overflow: hidden;
    border-radius: 40px 0px 0px 0px;
    background: var(--background-globe);
    box-shadow: 0px 1px 4px 0px rgba(16, 24, 40, 0.05) inset;
    width: 100%;
    height: 100%;
    flex: 1 1 auto;
}
.header-card {
    display: flex;
    gap: 12px;
    align-items: center;
}
.notification-card {
    border-radius: 12px;
    padding: 16px;
    width: 285px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    background: var(--background-success, #e9f8f1);
    color: var(--status-succesfull, #1fb96c);
    font-family: Unbounded;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 20px; /* 142.857% */
}
.note-animation {
    z-index: 10;
    animation: noteAnimation 6s linear;
    position: fixed;
    top: 112px;
    right: 0px;
    opacity: 0;
}
@keyframes noteAnimation {
    0% {
        transform: translateX(280px);
        opacity: 1;
    }
    15% {
        transform: translateX(-24px);
    }
    90% {
        transform: translateX(-24px);
        opacity: 1;
    }
    100% {
        transform: translateX(260px);
        opacity: 0;
    }
}
</style>
