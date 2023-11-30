<template>
    <form class="form" @submit.prevent="$emit('submitForm')">
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

}
</script>

<style scoped lang="scss">
.form {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: auto;
    &__head {
        margin-bottom: adaptive-value(24px, 40px);
        width: inherit;
    }
    &__content {
        margin-bottom: adaptive-value(48px, 64px);
        @include columnMixin($gap: adaptive-value(8px, 16px));
        width: inherit;
    }
    &__info {
        margin-bottom: adaptive-value(24px, 12px);
        width: inherit;
    }
    &__buttons {
        display: flex;
        flex-wrap: wrap;
        width: inherit;
        gap: 8px;
    }
}
</style>
