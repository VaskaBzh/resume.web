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
</style>
