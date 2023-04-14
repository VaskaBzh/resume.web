<script>
export default {
    mounted(el) {
        setTimeout(() => {
            el.style.visibility = "hidden";
        }, 3000);
    },
};
</script>
