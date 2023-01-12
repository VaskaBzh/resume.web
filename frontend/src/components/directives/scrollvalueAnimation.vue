<script>
import anime from "animejs/lib/anime.es.js";

const animationObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      let change = {
        changevalue: "0",
      };
      anime({
        targets: change,
        changevalue: entry.target.innerText.split(" ").join(""),
        easing: "linear",
        round: 1,
        update: function () {
          entry.target.innerHTML = change.changevalue;
        },
      });
      animationObserver.unobserve(entry.target);
    }
  });
});

export default {
  mounted(el) {
    animationObserver.observe(el);
  },
};
</script>
