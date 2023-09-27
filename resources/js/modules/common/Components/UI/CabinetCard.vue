<template>
    <div
        class="cabinet__block cabinet__block-light cabinet__block-card card"
        :class="[page == 'worker' ? 'max-width' : '']"
    >

        <div class="card__content">
            <main-title class="headline">
                {{ title }}
            </main-title>
            <p class="card_num">
                {{ value }}
                <span class="card_unit" v-show="unit">
                    {{ unit }}
                </span>
            </p>
        </div>
    </div>
</template>
<script>
import MainTitle from "./MainTitle.vue";

export default {
    props: {
        title: String,
        value: String,
        unit: String,
        page: String,
    },
    components: {
        MainTitle,
    },
};
</script>
<style scoped>
.card {
    background: var(--background-island, #ffffff);

    display: flex;
    flex-wrap: nowrap;
    align-items: center;
}

.max-width {
    width: 48%;
}

.card_svg {
    margin-right: 24px;
}

.card__content {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.card-active .card_num {
    color: #1fb96c;
}

.card-in-active .card_num {
    color: #f1404a;
}

.card_num {
    color: var(--text-primary-80);
    font-family: Unbounded, serif;
    font-size: 41px;
    font-weight: 400;
    line-height: 137%;
    display: inline-flex;
    gap: 8px;
    align-items: flex-end;
    opacity: 0.8;
    flex-wrap: wrap;
}
.card_unit {
    color: var(--light-gray-300, #d0d5dd);
    font-family: Unbounded, serif;
    font-size: 27px;
    font-weight: 400;
    line-height: 147%;
}
@media (max-width: 1450px) {
    .card_num {
        font-size: 31px;
    }
    .card_unit {
        font-size: 25px;
    }
}
@media (max-width: 1350px) {
    .card_num {
        font-size: 25px;
    }
    .card_unit {
        font-size: 20px;
    }
}
@media (max-width: 1200px) {
    .card_num {
        font-size: 20px;
    }
    .card_unit {
        font-size: 14px;
    }
}
@media(max-width: 900px){
    .card_num {
        font-size: 27px;
    }
    .card_unit {
        color: var(--text-fourth-night, #595E68);
        font-family: Unbounded;
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        line-height: 31px; /* 155.556% */
    }
}
@media (max-width: 497.98px) {
    .card_svg {
        display: none;
    }
}
</style>
