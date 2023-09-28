<template>
    <div class="select-language" @click="selectMassage">
        <span > {{ $i18n.locale }}</span>
    </div>
</template>



<script>
import { SettingsMessage } from "../settings/lang/SettingsMessage";

export default {

    methods: {
        selectMassage() {
            const languageValue = Object.keys(SettingsMessage)
            this.language = languageValue.filter(item => item !== this.language).join()
        }
    }
}
</script>



<style scoped lang="scss">
.select-language {
    display: flex;
    width: 48px;
    height: 48px;
    padding: 8px 20px;
    justify-content: center;
    align-items: center;
    color: white;
    border-radius: 40px;
    border: 0.5px solid rgba(192, 228, 255, 0.60);
    background: rgba(13, 13, 13, 0.70);
    backdrop-filter: blur(10px);
    text-transform: uppercase;
    cursor: pointer;
}
</style>
