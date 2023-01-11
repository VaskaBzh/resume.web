<template>
  <div class="blue-button">
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: "blue-button",
};
</script>

<style scoped lang="scss">
.blue-button {
  width: fit-content;
  font-style: normal;
  font-weight: 500;
  font-size: 18px;
  line-height: 107.6%;
  color: #ffffff;
  background: linear-gradient(84.14deg, #3f7bdd 8.75%, #4282ec 92.01%);
  border-radius: 5px;
  position: relative;
  transition: all 0.3s ease 0s;
  cursor: pointer;
  &::before {
    content: "";
    position: absolute;
    z-index: -1;
    background: linear-gradient(
      84.14deg,
      rgba(63, 123, 221, 0.27) 8.75%,
      rgba(66, 130, 236, 0.27) 92.01%
    );
    border-radius: 10px;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    transition: all 0.3s ease 0s;
  }
  @media (any-hover: hover) {
    &:hover {
      transform: translate(-4px, -4px);
      &::before {
        top: 4px;
        left: 4px;
      }
    }
  }
  &:active {
    transform: translate(0, 0);
    box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);
    &::before {
      top: 0px;
      left: 0px;
    }
  }
}
</style>
