<template>
    <div class="watchers profile">
        <div class="watchers__wrapper">
            <form class="watchers__form">
                <main-input
                    inputName="watchers_name"
                    inputLabel="Имя наблюдателя"
                    :inputValue="watchers_form.name"
                    @getValue="watchers_form.name = $event"
                />
                <main-checkbox
                    class="watchers_checkbox"
                    @is_checked="watchers_form.statistic = $event"
                    >Статистика</main-checkbox
                >
                <main-checkbox
                    class="watchers_checkbox"
                    @is_checked="watchers_form.workers = $event"
                    >Воркеры</main-checkbox
                >
                <main-checkbox
                    class="watchers_checkbox"
                    @is_checked="watchers_form.incomes = $event"
                    >Доходы</main-checkbox
                >
                <button @submit.prevent="sendWorkers" class="watchers_button">
                    Отправить
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import MainInput from "@/Components/UI/inputs/MainInput.vue";
import api from "@/api/api";
import MainCheckbox from "@/Components/UI/MainCheckbox.vue";

export default {
    name: "watchers-page",
    components: {
        MainInput,
        MainCheckbox,
    },
    data() {
        return {
            watchers_form: {
                name: "",
                statistic: true,
                workers: true,
                incomes: true,
            },
        };
    },
    methods: {
        async sendWorkers() {
            let response = null;
            try {
                response = await api.post(
                    "/watchers/create",
                    this.watchers_form
                );

                console.log(response);
            } catch (err) {
                console.errors("Error with: " + err);
            }
        },
    },
};
</script>

<style scoped lang="scss">
.watchers {
    &__form {
        display: flex;
        flex-direction: column;
        gap: 16px;
        max-width: 300px;
    }
    &_checkbox {
        max-width: 200%;
        display: flex;
        justify-content: space-between;
        background: transparent !important;
    }
    &_button {
        background: #d2dff3;
        outline: none;
        border: 0.5px solid #040d15;
        min-width: 100%;
        border-radius: 16px;
        width: fit-content;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
    }
}
</style>
