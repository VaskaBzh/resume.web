<template>
    <div class="copy" @click="copy">
        <p class="copy_input">{{ code }}</p>
        <svg
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M16 12.9V17.1C16 20.6 14.6 22 11.1 22H6.9C3.4 22 2 20.6 2 17.1V12.9C2 9.4 3.4 8 6.9 8H11.1C14.6 8 16 9.4 16 12.9Z"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
            <path
                d="M22 6.9V11.1C22 14.6 20.6 16 17.1 16H16V12.9C16 9.4 14.6 8 11.1 8H8V6.9C8 3.4 9.4 2 12.9 2H17.1C20.6 2 22 3.4 22 6.9Z"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
    </div>
</template>

<script>
export default {
    name: "main-copy",
    props: {
        code: String,
    },
    methods: {
        copy() {
            navigator.clipboard.writeText(this.copyObject.link);
        },
    },
};
</script>

<style scoped lang="scss">
.copy {
    min-height: 48px;
    width: 100%;
    display: flex;
    align-items: center;
    border-radius: 8px;
    background: #ededed;
    cursor: pointer;
    position: relative;
    &_input {
        width: 100%;
        height: 100%;
        color: #818c99;
        font-size: 16px;
        font-weight: 400;
        line-height: 150%;
        outline: none;
        border: none;
        background: transparent;
        padding: 0 0 0 16px;
    }
    svg {
        stroke: #aeaeb2;
        width: 24px;
        height: 24px;
        position: absolute;
        top: 50%;
        right: 16px;
        transform: translateY(-50%);
    }
}
</style>
