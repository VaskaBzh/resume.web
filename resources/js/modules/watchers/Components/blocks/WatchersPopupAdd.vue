<template>
    <teleport to="body">
        <main-popup
            id="addWatcher"
            :wait="wait"
            :closed="closed"
        >
    <!--        createWatcher-->
            <div class="watchers-add">
                <main-title tag="h3">Добавить наблюдателя</main-title>
                <main-description>Наблюдатель получает возможность смотреть контент без возможности редактировать</main-description>
            </div>

        </main-popup>
    </teleport>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";

export default {
    name: "watchers-popup-add",
    components: {
        MainPopup,
        MainTitle,
        MainDescription,
    },
    props: {
        wait: Boolean,
        closed: Boolean,
    },
}
</script>

<style scoped>

</style>
