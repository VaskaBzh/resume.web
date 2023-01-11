<template>
  <div class="nav__links_con">
    <div class="nav__links">
      <router-link class="nav__link" to="/"> Главная </router-link>
      <router-link class="nav__link" to="/complexity"> Сложность </router-link>
      <router-link class="nav__link" to="/faqview"> FAG </router-link>
      <router-link class="nav__link" to="/about"> О нас </router-link>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.nav__links {
  display: flex;
  justify-content: space-between;
  width: 100%;
  @media (max-width: 767.98px) {
    padding: 150px 64px 38px;
    flex-direction: column;
    gap: 64px;
  }
  &_con {
    width: 100%;
    @media (max-width: 767.98px) {
      position: absolute;
      background: linear-gradient(
        179.87deg,
        #e6eaf0 1.02%,
        #e6eaf1 4.79%,
        #e7ebf1 8.76%,
        #eaeef4 14.75%,
        #e8ecf2 19.07%
      );
      overflow: scroll;
      width: 100vw;
      height: 100vh;
      top: 0;
      right: -100vw;
      bottom: 0;
    }
    transition: all 0.5s ease 0s;
    &.open {
      right: 0;
    }
  }
}
.nav__link {
  font-style: normal;
  font-weight: 400;
  font-size: 17px;
  line-height: 143.1%;
  color: #000000;
  display: flex;
  gap: 16px;
  align-items: center;
  &::before {
    content: "";
    position: relative;
    height: 20px;
    width: 1px;
    background: rgba(0, 0, 0, 0.09);
    transform: matrix(-0.97, -0.26, -0.26, 0.97, 0, 0);
  }
  &.router-link-exact-active {
    color: #4182ec;
    &::before {
      background: rgba(65, 130, 236, 0.52);
    }
  }
  @media (max-width: 767.98px) {
    font-size: 20px;
    line-height: 143.1%;
    &::before {
      display: none;
    }
  }
}
</style>
