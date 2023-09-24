<template>
    <main-popup id="removeWatcher" :wait="wait" :closed="closed">
        <div class="watchers__form">
            <div class="watchers__column">
                <div class="watchers__head">
                    <main-title tag="h3">Удалить наблюдателя</main-title>
                    <main-description>Удалить наблюдателя</main-description>
                </div>
                <div
                    class="watchers__card cabinet__block-card cabinet__block cabinet__block-light"
                >
                    <img
                        class="watchers_img"
                        src="../../imgs/img_watcher-remove.png"
                        alt="watcher"
                    />
                    <p class="watchers_text">{{ name }}</p>
                </div>
            </div>
            <div class="watchers__buttons">
                <main-button
                    @click.prevent="closePopup"
                    class="button-reverse button-full watchers_button"
                >
                    <template v-slot:text> Удалить </template>
                </main-button>
                <main-button
                    @click.prevent="removeWatcher"
                    class="button-red button-full watchers_button"
                >
                    <template v-slot:text> Удалить </template>
                </main-button>
            </div>
        </div>
    </main-popup>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";

export default {
    name: "watchers-popup-remove",
    components: {
        MainButton,
        MainPopup,
        MainTitle,
        MainDescription,
    },
    props: {
        wait: Boolean,
        name: String,
        id: Number,
    },
    methods: {
        closePopup() {
            this.closed = true;

            setTimeout(() => (this.closed = true), 300);
        },
        removeWatcher() {
            this.$emit("removeWatcher", this.id);

            this.closePopup();
        },
    },
    data() {
        return {
            closed: false,
        };
    },
};
</script>

<style scoped>
.watchers__form {
    display: flex;
    flex-direction: column;
    gap: 80px;
    width: 100%;
}
.watchers__column {
    display: flex;
    flex-direction: column;
    gap: 40px;
}
.watchers__buttons {
    width: 100%;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}
.watchers_button {
    min-height: 56px;
}
.watchers_img {
    width: 72px;
    height: 72px;
}
.watchers__card {
    display: flex;
    align-items: center;
    gap: 16px;
}
.watchers_text {
    color: var(--text-secondary, #475467);
    font-family: Unbounded, serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
}
</style>
