<template>
  <div class="layout">
    <nav-tabs
        ref="tabs"
        :isOpenBurger="isOpenBurger"
        @changeBurger="change($event)"
        @closeBurger="change(false)"
        :instructionConfig="instructionService"
    />
    <div class="layout__content">
      <header-component-profile
          class="header-container"
          :isOpenBurger="isOpenBurger"
          @changeBurger="change($event)"
          :instructionConfig="instructionService"
      />

      <div class="page-container">
        <notification-list/>
        <keep-alive>
          <slot/>
        </keep-alive>
      </div>
    </div>
  </div>
</template>
<script>
import NavTabs from "@/modules/navs/Components/NavTabs.vue";
import HeaderComponentProfile from "@/modules/common/Components/HeaderComponentProfile.vue";
import NotificationList from "@/modules/notification/Components/NotificationList.vue";

import {InstructionService} from "@/modules/instruction/services/InstructionService";
import {mapGetters} from "vuex";

export default {
  components: {
    NotificationList,
    NavTabs,
    HeaderComponentProfile,
  },
  methods: {
    change(event) {
      this.isOpenBurger = event;
    },
  },
  data() {
    return {
      isOpenBurger: false,
      instructionService: new InstructionService(),
    };
  },
  computed: {
    ...mapGetters(["getActive", "user"]),
  },
  async mounted() {
    if (!this.$route?.query.access_key) {
      await this.$store.dispatch("setUser");
    }
    this.$store.dispatch("setToken");

    this.$store.dispatch("set_accounts", {
      route: this.$route,
      user_id: this.user?.id,
    });

    if (this.$route.query?.onboarding === "true") {
      this.instructionService.setStepsCount(2).setVisible();
    }
  },
};
</script>
<style scoped>
.layout {
  width: 100%;
  min-height: 100vh;
  height: 100%;
  background: var(--background-island);
  display: flex;
  overflow: hidden;
}

.layout__content {
  width: 100%;
  display: flex;
  flex-direction: column;
}

.header-container {
  width: 100%;
  min-height: 72px;
  display: flex;
  align-items: center;
  transition: all 0.3s ease 0s;
}

.page-container {
  /* padding: 24px; */
  overflow-x: hidden;
  display: flex;
  flex-direction: column;
  overflow-y: scroll;
  border-radius: 40px 0px 0px 0px;
  background: var(--background-globe);
  box-shadow: 0px 1px 4px 0px rgba(16, 24, 40, 0.05) inset;
  width: 100%;
  flex: 1 1 auto;
  height: calc(100vh - 72px);
}

@media (max-width: 900px) {
  .page-container {
    border-radius: 0;
  }
}

.header-card {
  display: flex;
  gap: 12px;
  align-items: center;
}

.notification-card {
  border-radius: 12px;
  padding: 16px;
  width: 285px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  background: var(--background-success, #e9f8f1);
  color: var(--status-succesfull, #1fb96c);
  font-family: Unbounded, serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 20px; /* 142.857% */
}

.green-card {
  background: var(--background-success);
  color: var(--status-succesfull, #1fb96c);
}

.red-card {
  background: var(--background-failed);
  color: var(--status-failed, #f1404a);
}

.note-animation {
  z-index: 9999999999;
  animation: noteAnimation 6s linear;
  position: fixed;
  top: 112px;
  right: 0px;
  opacity: 0;
}

@keyframes noteAnimation {
  0% {
    transform: translateX(280px);
    opacity: 1;
  }
  5% {
    transform: translateX(-24px);
  }
  95% {
    transform: translateX(-24px);
    opacity: 1;
  }
  100% {
    transform: translateX(260px);
    opacity: 0;
  }
}
</style>
