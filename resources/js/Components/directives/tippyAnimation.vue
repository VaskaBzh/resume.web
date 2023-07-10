<script>
import "tippy.js/dist/tippy.css";
import tippy from "tippy.js";

export default {
    beforeMount(el, binding, vnode, oldVnode) {
        if (binding.value) {
            tippy(el, {
                content: binding.value.message,
            });
        }
    },
    beforeUpdate(el, binding, vnode, oldVnode) {
        if (binding.value) {
            tippy(el, {
                content: binding.value.message,
            });
        }
    },
};
</script>
