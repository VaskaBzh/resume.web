<template>
  <div @click="actionBurger">
      <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none" v-if="isOpen">
        <rect x="0.824219" y="16.0254" width="21.757" height="0.870282" rx="0.435141" transform="rotate(-45 0.824219 16.0254)" fill="#E4E7EC"/>
        <rect x="1.43945" y="0.359375" width="21.757" height="0.870282" rx="0.435141" transform="rotate(45 1.43945 0.359375)" fill="#E4E7EC"/>
      </svg>
      <svg width="25" height="13" viewBox="0 0 25 13" fill="none" xmlns="http://www.w3.org/2000/svg" v-else>
        <rect x="10" width="15" height="1" rx="0.5" fill="#E4E7EC"/>
        <rect y="6" width="25" height="1" rx="0.5" fill="#E4E7EC"/>
        <rect y="12" width="25" height="1" rx="0.5" fill="#E4E7EC"/>
      </svg>
  </div>

  <div class="burger-background" v-if="isOpen" :class="{'open-burger': isOpen ,'close-burger': closeBurger}">
    <div class="menu-container">
      <nav-links/>
    </div>
    <div class="menu-footer">
      <button class="headline-menu">{{ $t("footer.button") }}</button>
      <select-language-land />
    </div>
  </div>

</template>
<script>
import NavLinks from "../../navs/Components/NavLinks.vue";
import { HomeMessage } from "@/modules/home/lang/HomeMessage";
import SelectLanguageLand from "../../HomeMainPage/SelectLanguageLand.vue";

  export default {
    components: { SelectLanguageLand, NavLinks},
    i18n: {
        sharedMessages: HomeMessage,
    },
    data() {
      return {
        isOpen: false,
        closeBurger: false
      }
    },
    methods: {
      actionBurger(){
        if(this.isOpen){
          this.closeBurger = true
          setTimeout(() => {
            this.isOpen = false
            this.closeBurger = false
          }, 400);
        } else{
          this.isOpen = true
        }
      }
    }

  }
</script>
<style scoped>
svg{
  position: relative;
  z-index: 10;
}
.burger-background{
  background: var(--gray-4100, #0D0D0D);
  position: fixed;
  top: 0px;
  bottom: 0px;
  width: 100vw;
  height: 100vh;
  right: 0px;
  display: flex;
  align-items: center;
  flex-direction: column;
  flex-direction: column;
  justify-content: center;
  padding: 0px 16px;
  gap: 190px;
}
.menu-footer{
  display: flex;
  align-items: center;
  justify-content: flex-start;
  gap: 15px;
  width: 100%;
}
.headline-menu{
  border-radius: 40px;
  border: 0.5px solid rgba(192, 228, 255, 0.60);
  background: var(--gray-470, rgba(13, 13, 13, 0.70));
  padding: 8px 20px;
  color: var(--gray-2100, #E4E7EC);
  font-family: Unbounded;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 15.4px */
  text-transform: uppercase;
  height: 48px;
}
.open-burger{
  animation: openBg 0.4s ease-in;
}
.close-burger{
  animation: closeBg 0.4s ease-in;
}
@keyframes openBg{
  0%{
    width: 10vw;
    height: 10vh;
    border-top-left-radius: 600px;
    border-bottom-left-radius: 1000px;
    border-bottom-right-radius: 100px;

  }
  100%{
    width: 100vw;
    height: 100vh;
    border-top-left-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
  }
}
@keyframes closeBg{
  100%{
    width: 10vw;
    height: 10vh;
    border-top-left-radius: 600px;
    border-bottom-left-radius: 1000px;
    border-bottom-right-radius: 100px;

  }
  0%{
    width: 100vw;
    height: 100vh;
    border-top-left-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
  }
}
.menu-container{
  animation: visList 0.7s linear;
}
@keyframes visList{
  0%{
    opacity: 0;
  }
  50%{
    opacity: 0;
  }
  100%{
    opacity: 1;
  }
}

</style>