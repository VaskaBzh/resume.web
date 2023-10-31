<script>
const nextString = "/";
const nextParagraph = "//";

function htmlElement(el, binding) {
    let resultTranslate = "";
    const paragraphs = binding.value.split(nextParagraph);
    resultTranslate = paragraphs.join("<br><br>");

    const strings = resultTranslate.split(nextString);
    resultTranslate = strings.join("<br>");

    el.innerHTML = resultTranslate;
}

export default {
    mounted(el, binding) {
        htmlElement(el, binding);
    },
    updated(el, binding) {
        htmlElement(el, binding);
    },
};
</script>
