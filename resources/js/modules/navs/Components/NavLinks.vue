<template>
    <ul class="nav__links">
        <li
            class="nav_link"
            v-for="item in link"
        >{{ item }}
        </li>
    </ul>
</template>

<script>

export default {
    data() {
        return {
            link: ['Главная','Дата-центра','Майнерам'],
            active: false,
        }
    },

};
</script>

<style lang="scss">
.shadow-enter-active,
.shadow-leave-active {
    transition: all 0.5s ease 0s, visibility 0.5s ease 0s;
    visibility: visible;
    opacity: 1;
}
.shadow-enter-from,
.shadow-leave-to {
    visibility: hidden;
    opacity: 0;
}
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.8s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.nav_link {
    color: rgba(228, 231, 236, 0.60);
    font-family: Unbounded, serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%; /* 21.6px */
    text-transform: uppercase;
    cursor: pointer;
    position: relative;
    left: 0;
    top: 0;
    transition: all .2s ease-in;

    &:before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        position: absolute;
        left: -10px;
        background: white;
        top: 30%;
        opacity: 0;
    }

    &:hover{
        color: white;
    }

    &:hover:before {
        opacity: 1;
    }

}
.active__link {
    position: relative;
    left: 0;
    top: 0;

    &:before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        position: absolute;
        left: -10px;
        background: white;
        top: 30%;
        opacity: 1;
    }
}


</style>
