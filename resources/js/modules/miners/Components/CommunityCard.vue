<template>
    <div class="community__section community__section-wrap" ref="view">
        <div class="card-community">
            <p class="card-title card-web">{{ $t("community.title") }}</p>
            <p class="card-title card-mobile">{{ $t("community.title_mobile[0]") }} <br> {{ $t("community.title_mobile[1]") }} <br>  {{ $t("community.title_mobile[2]") }} <br> {{ $t("community.title_mobile[3]") }}</p>

            <p class="card-text">{{ $t("community.text") }}</p>
        </div>
        <div class="lists">
            <div>
                <p class="list-title">{{ $t("community.list.title[0]") }}</p>
                <div class="list-items">
                    <button class="list-item-tg">
                        {{ $t("community.list.buttons[0]") }}
                    </button>
                    <button class="list-item-tg">
                        {{ $t("community.list.buttons[1]") }}
                    </button>
                </div>
            </div>
            <div>
                <p class="list-title">{{ $t("community.list.title[1]") }}</p>
                <div class="list-items">
                    <button class="list-item-blog">
                        <img src="../assets/img/yandex.png" class="img-community-web">
                        <img src="../assets/img/yandex-mini.png" class="img-community-mobile">
                    </button>
                    <button class="list-item-blog">
                        <img src="../assets/img/tinkoff.svg" class="img-community-web">
                        <img src="../assets/img/tinkoff-mini.svg" class="img-community-mobile">

                    </button>
                    <button class="list-item-blog">
                        <img src="../assets/img/vc.svg" class="img-community-web">
                        <img src="../assets/img/vc-mini.svg" class="img-community-mobile">
                    </button>
                    <button class="list-item-blog">
                        <img src="../assets/img/habr.svg" class="img-community-web">
                        <img src="../assets/img/habr-mini.svg" class="img-community-mobile">

                    </button>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import { MinersMessage } from "@/modules/miners/lang/MinersMessage";

export default {
  i18n: {
          sharedMessages: MinersMessage,
        },
    data() {
        return {
            validScroll: false,
            startY: null,
            touchY: null,
        }

    },

    props: {
        start: Boolean,
    },
    methods: {
        handleTouchStart(e) {
            this.startY = e.touches[0].clientY;
        },
        handleTouchMove(e) {
            this.touchY = e.touches[0].clientY;
            this.handleWheel();
        },
        handleWheel(e) {
            if (this.startY ? this.startY - this.touchY > 110 : e.deltaY > 10) {
                this.remove();
                setTimeout(this.scroll, 650);

                if (
                    this.$refs.view.offsetHeight -
                    document.scrollingElement.clientHeight >
                    20 &&
                    !this.validScroll
                ) {
                    this.$refs.view.style.transform =
                        window.innerHeight >= 1100 || window.innerWidth < 991
                            ? `translateY(-${
                                  this.$refs.view.offsetHeight -
                                  document.scrollingElement.clientHeight
                              }px)`
                            : `translateY(-${
                                  this.$refs.view.offsetHeight -
                                  document.scrollingElement.clientHeight
                              }px) scale(0.8)`;

                    this.validScroll = true;
                } else {
                    this.$emit("next");
                }
            }
            if (
                this.startY ? this.touchY - this.startY > 110 : e.deltaY < -10
            ) {
                this.remove();
                setTimeout(this.scroll, 650);

                if (
                    this.$refs.view.offsetHeight -
                    document.scrollingElement.clientHeight >
                    20 &&
                    this.validScroll
                ) {
                    this.$refs.view.style.transform =
                        window.innerHeight >= 1100 || window.innerWidth < 991
                            ? `translateY(0px)`
                            : `translateY(0px) scale(0.8)`;

                    this.validScroll = false;
                } else {
                    this.$emit("prev");
                }
            }
        },
        scroll() {
            if (this.$refs.view) {
                this.$refs.view.focus();
                this.$refs.view.addEventListener("wheel", this.handleWheel);
                this.$refs.view.addEventListener(
                    "touchstart",
                    this.handleTouchStart
                );
                this.$refs.view.addEventListener(
                    "touchmove",
                    this.handleTouchMove
                );
            }
        },
        remove() {
            if (this.$refs.view) {
                this.$refs.view.removeEventListener("wheel", this.handleWheel);
                this.$refs.view.removeEventListener(
                    "touchstart",
                    this.handleTouchStart
                );
                this.$refs.view.removeEventListener(
                    "touchmove",
                    this.handleTouchMove
                );
            }
        },
    },
    watch: {
        start(newStartState) {
            if (newStartState) {
                this.scroll();
            } else {
                this.remove();
            }
        },
    },
    mounted() {
        setTimeout(this.scroll, 500);
    },
    unmounted() {
        this.remove();
    },
}
</script>
<style scoped>
.card-title{
  color: var(--gray-1100, #F5FAFF);
  /* Text Web/Headline 5 */
  font-family: Unbounded;
  font-size: 36px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%; /* 43.2px */
  text-transform: uppercase;
  margin-bottom: 20px;
}
.card-text{
  color: var(--gray-170, rgba(245, 250, 255, 0.70));
  font-family: NunitoSans;
  font-size: 20px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 22px */
  margin-bottom: 50px;
}
.card-community{
  width: 589px;
}
.list-title{
  color: var(--gray-1100, #F5FAFF);
  /* Text Web/Subtitle 3 */
  font-family: Unbounded;
  font-size: 24px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%; /* 28.8px */
  text-transform: uppercase;
}
.list-items{
  display: flex;
  gap: 10px;
  margin-top: 30px;
}
.list-item-tg{
  color: var(--gray-3100, #D0D5DD);
  font-family: Unbounded;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 120%; /* 21.6px */
  text-transform: uppercase;
  border-radius: 30px;
  border: 0.5px solid var(--gray-320, rgba(208, 213, 221, 0.20));
  background: var(--gray-320, rgba(208, 213, 221, 0.20));
  box-shadow: 0px 4px 7px 0px rgba(14, 14, 14, 0.05);
  padding: 10px 25px;
  cursor: pointer;
}
.list-item-blog{
  border-radius: 30px;
  border: 0.5px solid var(--gray-320, rgba(208, 213, 221, 0.20));
  background: var(--gray-3100, #D0D5DD);
  box-shadow: 0px 4px 7px 0px rgba(14, 14, 14, 0.05);
  padding: 10px 25px;
  cursor: pointer;
}
.lists{
  display: flex;
  flex-direction: column;
  gap: 100px;
}
.img-community-mobile, .card-mobile{
    display: none;
}
@media(max-width: 768px){
  .card-title{
    font-size: 24px;
  }
  .card-text{
    font-size: 18px;
  }
  .list-title{
    font-size: 16px;
  }
  .card-community{
    width: 386px;
  }
  .lists{
    width: 386px;
  }
  .list-items{
    flex-wrap: wrap;
  }
  .list-item-blog{
    width: 122px;
    height: 40px;

  }
  .img-community-web{
    display: none;
  }
  .img-community-mobile{
    display: inline;
  }
}
@media(max-width: 450px){
  .card-web{
    display: none;
  }
  .card-mobile{
    display: inline;
  }
  .card-title{
    font-size: 18px;
  }
  .card-text{
    font-size: 14px;
    margin: 30px 0;
  }
  .list-title{
    font-size: 14px;
  }
  .card-community{
    width: 282px;  }
  .lists{
    width: 282px;
  }
  .list-item-tg{
    font-size: 14px;
    padding: var(--gap-2, 8px) 10px;
  }
  .list-item-blog{
    width: 106px;
    height: 32px;
    padding: 0;
  }
  .lists{
    gap: 40px;
  }
  .list-items{
    margin-top: 20px;
  }
}
</style>
