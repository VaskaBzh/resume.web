<script>
const animationObserverFunction = (elem, bindingClass) => {
    const animationObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add(bindingClass + "-enter");
            }
            //  else {
            //   entry.target.classList.remove(bindingClass + "-enter");
            // }
        });
    });
    animationObserver.observe(elem);
};

export default {
    mounted(el, binding) {
        el.classList.add("transition");
        binding.value.split(" ").forEach((item, i) => {
            if (i === 0) {
                el.classList.add(item + "-before-enter");
                animationObserverFunction(el, item);
            } else {
                el.classList.add(item);
            }
        });
    },
};
</script>
