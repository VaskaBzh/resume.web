<script>
function hintProcess(el, binding) {
    if (binding.value && el.textContent !== "") {
        el.style.visibility = "visible";
        el.style.opacity = 1;
        setTimeout(() => {
            el.removeAttribute("style");
        }, 2700);
    }
}
export default {
    methods: {},
    updated(el, binding) {
        hintProcess(el, binding);
    },
    mounted(el, binding) {
        hintProcess(el, binding);
    },
};
</script>
<style lang="scss">
.hint {
    position: fixed;
    top: 10%;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    gap: 8px;
    z-index: 999;
    visibility: hidden;
    &_item {
        padding: 12px;
        border-radius: 8px;
        background-color: #fff;
        visibility: hidden;
        opacity: 0;
        transition: all 0.3s ease 0s;
    }
}
</style>
