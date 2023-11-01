<template>
    <form class="form" @submit.prevent="$emit('submitEvent')">
        <div class="form__head" v-show="$slots.head">
            <slot name="head" />
        </div>
        <div class="form__content" v-show="$slots.content">
            <slot name="content" />
        </div>
        <div class="form__info" v-show="$slots.info">
            <slot name="info" />
        </div>
        <div class="form__buttons" v-show="$slots.buttons">
            <slot name="buttons" />
        </div>
    </form>
</template>

<script>
export default {
    slots: ["head", "content", "info", "buttons"],
}
</script>

<style scoped lang="scss">
.form {
    @include columnMixin;
    width: 100%;
    height: auto;
    &__head {
        margin-bottom: adaptive-value(24px, 40px);
    }
    &__content {
        @include columnMixin(adaptive-value(8px, 16px));
        margin-bottom: adaptive-value(48px, 80px);
    }
    &__info {
        margin-bottom: adaptive-value(48px, 80px);
    }
}
</style>
