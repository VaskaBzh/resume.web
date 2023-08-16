<template>
  <div class="input-block">
    <label><slot name="label"></slot></label>
      <div class="input-container">
        <input :placeholder="props.placeholder">
        <span class="unit">
          <slot name="units"></slot>
        </span>
      </div>
  </div>
  </template>
  <script setup>
  import { defineProps } from 'vue';
   const props = defineProps(['placeholder'])
  </script>
  <style scoped>
  .input-block{
    width: 48%;
  }
  .input-container{
    position: relative;
  }
  .unit{
    position: absolute;
    right: 12px;
    top: 16px;
    color: var(--light-gray-400, #98A2B3);
    font-size: 13px;
    font-weight: 400;
    line-height: 18px; /* 138.462% */
    letter-spacing: -0.078px;
  }
  input{
    padding: 0px 12px;
    border: none;
    width: 100%;
    border-radius: 12px;
    background: var(--light-secondary-color-1, #FFF);
    height: 48px;
    box-shadow: 1px 1px 6px -2px rgba(29, 41, 57, 0.05);
  }
  input::placeholder{
    color: var(--light-gray-300, #D0D5DD);
    font-size: 16px;
    font-weight: 400;
    line-height: 21px; /* 131.25% */
    letter-spacing: -0.32px;
  }
  label{
    color: var(--light-gray-400, #98A2B3);
    font-size: 12px;
    padding-bottom: 4px;
    font-weight: 400;
    line-height: 16px; /* 133.333% */
  }
  </style>