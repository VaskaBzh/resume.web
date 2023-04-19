<script>
export default {
    updated(el, binding) {
        if (binding.value) {
            el.style.visibility = "visible";
            el.style.opacity = 1;
            setTimeout(() => {
                el.removeAttribute("style");
            }, 2700);
        }
    },
};
</script>
<style lang="scss">
.hint {
    position: fixed;
    top: 10%;
    left: 50%;
    transform: translateX(-50%);
    padding: 12px;
    border-radius: 8px;
    background-color: #fff;
    visibility: hidden;
    opacity: 0;
    transition: all 0.3s ease 0s;
    z-index: 999;
}
</style>
