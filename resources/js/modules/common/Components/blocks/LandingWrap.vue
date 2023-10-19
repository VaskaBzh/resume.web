<template>
    <div class="wrap">
        <landing-title tag="h2" class="wrap_title" ref="title">
            <slot name="title"></slot>
        </landing-title>
        <div class="wrap__content">
            <slot name="content"/>
        </div>


        <div class="wrap_link" v-if="$slots.link">
            <slot name="link"/>
        </div>
    </div>
</template>

<script>
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";

export default {
    name: "landing-wrap",
    components: {
        LandingTitle,
    },
    props: {
        title: String,
    },
};
</script>

<style scoped>
.wrap {
    border-radius: 40px;
    border-top: 2px solid #555353;
    background: rgba(13, 13, 13, 0.8);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    gap: 50px;
    width: 100%;
    max-width: clamp(860px, 10vw, 100%);
    height: clamp(680px, 10vw, 444px);
    margin-bottom: clamp(20px, 10vw, 30px);
    position: relative;
}

@media (max-width: 1500.87px) {
    .wrap {
        flex-direction: column;
    }
}

.wrap__content {
    position: absolute;
    overflow: hidden;
    left: 50%;
    max-width: 380px;
}

@media (max-width: 1500.87px) {
    .wrap__content {
        top: clamp(50%, 40vw, 60%);
        transform: translate(-50%, -50%);
    }
}

@media (max-width: 768.87px) {
    .wrap__content {
        left: 50px;
        top: 50%;
        transform: translateY(-50%);
    }

    .wrap {
        align-items: flex-start;
        gap: unset;
    }
}

.wrap_link {
    border-radius: 50%;
    background: var(--gray-320, rgba(208, 213, 221, 0.2));
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    flex-direction: column;
    gap: 6px;
    width: 170px;
    height: 170px;
    position: absolute;
    right: -85px;
    top: 54px;
    color: var(--gray-3100, #d0d5dd);
    font-family: Unbounded, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 120%;
    text-transform: uppercase;
    visibility: hidden;
}

.wrap_title {
    max-width: 584px;
    display: flex;
    flex-wrap: wrap;
    gap: 0 10px;
    overflow: visible;
    font-size: clamp(22px, 2.8vw, 65px);
}

@media (min-width: 1500.98px) {
    .wrap_title {
        transform: translateX(-50%);
    }
}

@media (max-width: 1500.98px) {
    .wrap_title {
        transform: translateY(-50%);
        max-width: 625px;
    }
}

@media (max-width: 991.98px) {
    .wrap_title {
        transform: translateY(-50%);
        max-width: 500px;
    }
}

@media (max-width: 768.98px) {
    .wrap__content {
        margin: auto 0;
    }

    .wrap {
        width: 100vw;
        padding: 0 clamp(16px, 10vw, 32px);
    }

    .wrap_title {
        max-width: 335px;
    }
}

@media (max-width: 479.98px) {
    .wrap__content {
        position: relative;
        transform: none;
        left: 0;
        top: 0;
        margin-top: 0;
    }

    .wrap {
        height: auto;
        padding: 0 clamp(16px, 10vw, 32px) 30px;
    }
}
</style>
