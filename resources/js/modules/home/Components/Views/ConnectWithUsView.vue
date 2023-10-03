<template>
    <div class="connect-withus">
        <div class="connect-withus__run">
            <p class="connect-withus_text">Связаться с нами</p>
            <button-blue class="connect-withus_btn"/>
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">Связаться с нами</p>
            <button-blue class="connect-withus_btn"/>
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">Связаться с нами</p>
            <button-blue class="connect-withus_btn"/>
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">Связаться с нами</p>
            <button-blue class="connect-withus_btn"/>
        </div>
    </div>
</template>


<script>
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";
import {run} from "../../Services/RunString";

export default {
    name: "ConnectWithUsView",
    components: {ButtonBlue},
    mounted() {
        run()
    }
}
</script>


<style scoped lang="scss">
.connect-withus {
    width: 100vw;
    height: 20vh;
    display: flex;
    align-items: center;
    font-size: 0;
    justify-content: center;
    animation: scroll 5s linear 1s infinite;;

    @keyframes scroll {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    &_text {
        color: #F5FAFF;
        font-family: Unbounded, serif;
        font-size: 55px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%;
        text-transform: uppercase;
        white-space: nowrap;
    }
}

.connect-withus__run {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-left: 70px;
}
</style>
