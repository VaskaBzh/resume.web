<template>
    <div class="card">
        <main-title
            tag="h3"
            class="card_title"
            :class="{ 'card_title-empty': !!watcher }"
            >Настройка наблюдателя</main-title
        >
        <div class="card__content card__content-empty" v-if="!watcher">
            <img
                class="card_img"
                src="../../imgs/img_watcher-card.png"
                alt="chose-watcher"
            />
            <main-description
                >Для начала выберете наблюдателя из списка
            </main-description>
        </div>
        <div class="card__content" v-else>
            <main-input
                class="card_input"
                inputName="name"
                inputLabel="Имя наблюдателя"
                :inputValue="watcher.name"
                :editable="isEditable"
                :error="errorsExpired.name"
                @getValue="setFormName($event)"
            />
            <div class="card__block">
                <div class="card_label">Доступные страницы для наблюдения</div>
                <div class="card__block card__block-selects">
                    <main-checkbox
                        v-for="(route, i) in allowedRoutes"
                        :key="i"
                        :is_checked="route.checked"
                        class="checkbox-sm"
                        :editable="isEditable"
                        @is_checked="setAllowedRoutes($event, route.routes)"
                    >
                        {{ route.name }}
                    </main-checkbox>
                </div>
            </div>
            <main-copy
                :cutValue="45"
                :code="watcher.link"
                label="Ссылка наблюдателя"
            />
            <div class="card__buttons">
                <main-button
                    class="card_button"
                    :data-popup="isEditable ? null : '#removeWatcher'"
                    :class="firstButtonClass"
                    @click="buttonProcess"
                >
                    <template v-slot:text>{{
                        firstButtonText
                    }}</template></main-button
                >
                <main-button
                    class="button-blue card_button"
                    @click="changeWatcher"
                    ><template v-slot:text>{{
                        secondButtonText
                    }}</template></main-button
                >
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import MainInput from "@/modules/common/Components/inputs/MainInput.vue";
import MainCheckbox from "@/modules/common/Components/UI/MainCheckbox.vue";
import MainCopy from "@/modules/common/Components/UI/MainCopy.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import { mapGetters } from "vuex";

export default {
    name: "watchers-card",
    components: {
        MainTitle,
        MainDescription,
        MainInput,
        MainCheckbox,
        MainCopy,
        MainButton,
    },
    props: {
        watcher: Object,
    },
    computed: {
        ...mapGetters(["errorsExpired"]),
        firstButtonClass() {
            return this.isEditable ? "button-reverse" : "button-red";
        },
        firstButtonText() {
            return this.isEditable ? "Отменить" : "Удалить";
        },
        secondButtonText() {
            return this.isEditable ? "Сохранить" : "Изменить";
        },
    },
    watch: {
        watcher(newWatcher) {
            if (newWatcher?.tags) {
                this.getAllowedRoutes(newWatcher.tags);
                this.setId(newWatcher.id);
                this.setFormName(newWatcher.name);
            }
        },
    },
    data() {
        return {
            isEditable: false,
            form: {
                name: this.watcher?.name,
                allowedRoutes: [],
                id: this.watcher?.id,
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
    mounted() {
        if (this.watcher?.tags) this.getAllowedRoutes(this.watcher.tags);
    },
    methods: {
        setId(id) {
            this.form = {
                ...this.form,
                id: id,
            };
        },
        buttonProcess() {
            if (!this.isEditable) this.$emit("removeWatcher", this.watcher);
            else this.isEditable = false;
        },
        changeWatcher() {
            if (this.isEditable) {
                let routes = [];
                this.allowedRoutes.forEach(elem => {
                    routes = [
                        ...routes,
                        ...elem.routes,
                    ]
                })
                this.setAllowedRoutes(true, routes);
                this.$emit("changeWatcher", this.form.allowedRoutes);
            }

            this.isEditable = !this.isEditable;
        },
        setFormName(name) {
            this.form = {
                ...this.form,
                name: name,
            };
        },
        getAllowedRoutes(allowedRoutes) {
            this.allowedRoutes.forEach((route) => {
                route.routes.forEach((r) => {
                    route.checked = !!allowedRoutes.includes(r);
                });
            });
        },
        setAllowedRoutes(boolean, routes) {
            console.log(routes)
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
};
</script>

<style scoped>
.card {
    border-radius: 24px;
    background: var(--background-island);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    min-height: 680px;
    padding: 32px;
    display: flex;
    flex-direction: column;
}
.card_title {
    margin-bottom: 40px;
}
.card_title-empty {
    margin-bottom: 0;
}
.card_img {
    width: 240px;
    height: 240px;
}
.card__content {
    display: flex;
    flex-direction: column;
    gap: 40px;
    flex: 1 1 auto;
}
.card__content-empty {
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.card_input {
    background: var(--background-island-inner-3);
}
.card_label {
    padding: 0 16px;
    color: var(--text-teritary-day, #98a2b3);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
}
.card__block-selects {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 24px;
    border-radius: 24px;
    background: var(--background-island-inner-3);
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.01);
}
.card__buttons {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-top: auto;
}
.card_button {
    min-height: 56px;
    width: 100%;
    transition: all 0.5s ease 0s;
}
</style>
