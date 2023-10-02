<template>
    <button class="button-black">
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: "button-blue",
};
</script>

<style lang="scss" scoped>
.button-black {
    width: 200px;
    height: 50px;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%; /* 21.6px */
    text-transform: uppercase;
    border-radius: 40px;
    border: 0.5px solid rgba(192, 228, 255, 0.60);
    background: transparent;
    backdrop-filter: blur(10px);
}

.header-land_btn {
    width: 40%;
    height: 40px;
    margin: 0 auto;
    backdrop-filter: unset;
    display: flex;
    position: absolute;
    bottom: 25%;
    align-items: center;
    justify-content: center;
    color: #F5FAFF;
    font-family: Unbounded, serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 21.6px */
    text-transform: uppercase;
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.60);
    background: rgba(13, 13, 13, 0.80);
}

.about_btn {
    width: 40%;
    height: 40px;
    margin: 0 auto;
    backdrop-filter: unset;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #F5FAFF;
    font-family: Unbounded, serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 21.6px */
    text-transform: uppercase;
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.60);
    background: rgba(13, 13, 13, 0.80);
}

.about_link {
    width: 170px;
    height: 170px;
    border-radius: 50%;
    backdrop-filter: blur(10px);
    padding: 24px;
    background: grey;
    font-family: Unbounded, serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%; /* 16.8px */
    text-transform: uppercase;
    position: absolute;
    right: -5%;
    transform: rotate(-20deg);
    top: -30%;
}

.make-up-cab_link {
    width: 40%;
    height: 40px;
    margin: 0 auto;
    backdrop-filter: unset;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #F5FAFF;
    font-family: Unbounded, serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 21.6px */
    text-transform: uppercase;
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.60);
    background: rgba(13, 13, 13, 0.80);
}

.mobile-view__btn {
    width: 170px;
    height: 170px;
    border-radius: 50%;
    fill: rgba(208, 213, 221, 0.20);
    stroke-width: 0.5px;
    background: rgba(208, 213, 221, 0.20);
    backdrop-filter: unset;
    bottom: 50%;
    color:#D0D5DD;
    text-align: center;
    font-family: Unbounded, serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%;
    align-self: center;
    text-transform: uppercase;
}
.connect-withus_btn {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: rgba(208, 213, 221, 0.20) url("../../../../../assets/img/arrow-down-land.png") no-repeat center;
    background-size: 40%;
    stroke-width: 0.5px;
    stroke: rgba(208, 213, 221, 0.20);
    backdrop-filter: blur(10px);

}

.footer-land_btn {
    display: flex;
    width: 310px;
    height: 48px;
    padding: 8px 20px;
    justify-content: center;
    align-items: center;
    border-radius: 40px;
    border: 0.5px solid rgba(192, 228, 255, 0.60);
    background: rgba(13, 13, 13, 0.70);
    backdrop-filter: blur(10px);
    color: #E4E7EC;
    font-family: Unbounded, serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%; /* 21.6px */
    text-transform: uppercase;
}

.footer-land_contacts_btn {
    display: flex;
    width: 134.667px;
    padding: 10px;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
    border: 1px solid rgba(152, 162, 179, 0.50);
    color: rgba(245, 250, 255, 0.70);
    text-align: center;
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
}

.mobile-view_prev {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: transparent url("../../../../../assets/img/Arrow-next.png") no-repeat center;
    background-size: 100%;
    transform: rotate(180deg);
    border: unset;

}

.mobile-view_next {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: transparent url("../../../../../assets/img/Arrow-next.png") no-repeat center;
    background-size: 100%;
    border: unset;
}
</style>
