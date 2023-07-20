<script>
function changeEl(el, letter) {
    let elem = el.textContent.replace(" ", "").split(letter);
    let val = Number(elem[0]);
    let unit = "T";

    switch (unit) {
        case "T":
            if (val / 1000 >= 1) {
                val = val / 1000;
                unit = "P";
                if (val / 1000 >= 1) {
                    val = val / 1000;
                    unit = "E";
                }
            }
            break;
        case "P":
            if (val / 1000 >= 1) {
                val = val / 1000;
                unit = "E";
            }
            break;
    }

    unit += "H/s";

    el.textContent = [val.toFixed(2), unit].join(" ");
}
function unitChanger(el) {
    let t = new RegExp("T");
    let p = new RegExp("P");
    t.test(el.textContent.trim())
        ? changeEl(el, "T")
        : p.test(el.textContent.trim())
        ? changeEl(el, "P")
        : changeEl(el, "E");
}
let regExp = new RegExp("/s");
export default {
    mounted(el) {
        if (regExp.test(el.textContent.trim())) unitChanger(el);
    },
    beforeUpdate(el) {
        if (regExp.test(el.textContent.trim())) unitChanger(el);
    },
};
</script>
