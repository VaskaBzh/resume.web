<template>
    <teleport to="body">
        <main-popup id="addWatcher" :wait="wait" :closed="closed">
            <div class="watchers__form">
                <div class="watchers__column">
                    <div class="watchers-add">
                        <main-title tag="h3">Добавить наблюдателя</main-title>
                        <main-description
                            >Наблюдатель получает возможность смотреть контент
                            без возможности редактировать</main-description
                        >
                    </div>
                    <main-input
                        class="watchers_input"
                        inputName="name"
                        inputLabel="Имя наблюдателя"
                        :inputValue="name"
                        :error="errorsExpired.name"
                        @getValue="setFormName($event)"
                    />
                    <div class="watchers__block">
                        <div class="watchers_label">
                            Доступные страницы для наблюдения
                        </div>
                        <div class="watchers__block watchers__block-selects">
                            <main-checkbox
                                v-for="(route, i) in allowedRoutes"
                                :key="i"
                                :is_checked="route.checked"
                                class="checkbox-sm"
                                @is_checked="
                                    setAllowedRoutes($event, route.routes)
                                "
                            >
                                {{ route.name }}
                            </main-checkbox>
                        </div>
                    </div>
                </div>
                <main-button
                    type="submit"
                    @click.prevent="$emit('createWatcher', form)"
                    class="button-blue button-full watchers_button"
                >
                    <template v-slot:text> Добавить </template>
                </main-button>
            </div>
        </main-popup>
    </teleport>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainInput from "@/modules/common/Components/inputs/MainInput.vue";
import MainCheckbox from "@/modules/common/Components/UI/MainCheckbox.vue";
import { mapGetters } from "vuex";

export default {
    name: "watchers-popup-add",
    components: {
        MainCheckbox,
        MainInput,
        MainButton,
        MainPopup,
        MainTitle,
        MainDescription,
    },
    props: {
        wait: Boolean,
        closed: Boolean,
    },
    methods: {
        setFormName(name) {
            this.form = {
                ...this.form,
                name: name,
            };
        },
        setAllowedRoutes(boolean, routes) {
            if (boolean)
                this.form.allowedRoutes = [
                    ...this.form.allowedRoutes,
                    ...routes,
                ];
            else
                this.form.allowedRoutes = this.form.allowedRoutes.filter(
                    (route) => routes.filter((r) => r === route).length === 0
                );
        },
    },
    data() {
        return {
            form: {
                name: "",
                allowedRoutes: [],
            },
            allowedRoutes: [
                {
                    name: "Статистика",
                    checked: false,
                    routes: ["v1.sub.show"],
                },
                {
                    name: "Воркеры",
                    checked: false,
                    routes: ["v1.worker.show", "v1.worker.list"],
                },
                {
                    name: "Доходы",
                    checked: false,
                    routes: ["v1.income.list"],
                },
            ],
        };
    },
    computed: {
        ...mapGetters(["errorsExpired"]),
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
.watchers__block {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.watchers__block-selects {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 24px;
    border-radius: 24px;
    background: var(--main-gohan, #fff);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
}
.watchers_input {
    background: var(--main-gohan, #fff);
}
.watchers_label {
    padding: 0 16px;
    color: var(--text-teritary-day, #98a2b3);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
}
.watchers_button {
    min-height: 56px;
}
</style>
