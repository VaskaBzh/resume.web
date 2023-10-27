<script>
import anime from "animejs/lib/anime.es.js";

const animationObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            let change = {
                changevalue: "0",
            };
            if (entry.target.innerText.split(" ").length === 1) {
                anime({
                    targets: change,
                    changevalue: entry.target.innerText,
                    easing: "linear",
                    round: 1,
                    update: function () {
                        entry.target.innerHTML = change.changevalue;
                    },
                });
            } else {
                let changeFloat = {
                    changefloat: "0",
                };
                let unit = entry.target.innerText.split(" ")[1];
                let base = entry.target.innerText.split(" ")[0];
                anime({
                    targets: change,
                    changevalue: base,
                    easing: "linear",
                    round: 1,
                    update: function () {
                        base = change.changevalue;
                    },
                });
                anime({
                    targets: changeFloat,
                    changefloat: base.split(".")[1],
                    easing: "linear",
                    round: 1,
                    update: function () {
                        entry.target.innerHTML = `${base.trim()}.${
                            changeFloat.changefloat
                        } ${unit}`;
                    },
                });
            }
            animationObserver.unobserve(entry.target);
        }
    });
});

export default {
    created(el) {
        animationObserver.observe(el);
    },
};
</script>
