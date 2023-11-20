<template>
    <div class="wrap">
        <landing-title tag="h2" class="wrap_title wrap_title__security"  ref="title">
            <slot name="title"></slot>
        </landing-title>
        <div class="wrap__content">
            <slot name="content" />
        </div>

        <div class="wrap_link" v-if="$slots.link">
            <slot name="link" />
        </div>
    </div>
</template>

<script>
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";

export default {
    name: "LandingWrap",
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
    border-radius: clamp(20px, 5vw, 40px);
    border-top: 2px solid #555353;
    background: rgba(13, 13, 13, 0.8);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    gap: 50px;
    width: 100%;
    max-width: clamp(328px, 55vw, 860px);
    height: clamp(370px, 40vw, 680px);
    flex-flow: row nowrap;
    padding-right: 50px;
    margin-bottom: clamp(20px, 10vw, 30px);
    position: relative;
}


.wrap_title__security {
    position: relative;
    top: 0;
    left: 0;
    width: 50%;
    max-width: 584px;
    display: flex;
    flex-wrap: wrap;
    gap: 0 10px;
    overflow: visible;
    font-size: clamp(22px, 2.8vw, 65px);
    transform: translateX(-50%);
}

@media (min-width: 1500.98px) {
    .wrap_title__security {

    }
}

@media (max-width: 1500.98px) {
    .wrap_title__security {

        max-width: 625px;
    }
}

@media (max-width: 991.98px) {
    .wrap_title__security {
        width: 35%;
        max-width: 500px;
    }
}

@media (max-width: 768.98px) {

    .wrap_title__security {
        transform: translate(0%,-50%);
        max-width: 335px;
    }

}

.wrap__content {
    overflow: hidden;
    left: 50%;
    max-width: 380px;
}

@media (max-width: 1500.87px) {
    .wrap__content {
        top: clamp(50%, 40vw, 60%);

    }
}

@media (max-width: 768.87px) {
    .wrap__content {
        left: 50px;
        top: 50%;

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

    }
}

@media (max-width: 1500.98px) {
    .wrap_title {

        max-width: 625px;
    }
}

@media (max-width: 991.98px) {
    .wrap_title {

        max-width: 500px;
    }
}

@media (max-width: 768.98px) {
    .wrap__content {
        margin: auto 0;
    }

    .wrap {
        flex-flow: column nowrap;
        width: 100vw;
        padding: 0 clamp(16px, 10vw, 32px) 30px;
    }

    .wrap_title {
        width: 70%;
        max-width: 335px;
    }

    .wrap__content {
        position: relative;
        transform: none;
        left: 0;
        top: 0;
        margin-top: 0;
    }

}
</style>
