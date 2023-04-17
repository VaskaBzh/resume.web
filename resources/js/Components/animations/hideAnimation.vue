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
