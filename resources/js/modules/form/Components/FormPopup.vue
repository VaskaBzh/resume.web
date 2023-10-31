<template>
    <form @submit.prevent="console.log('emit')" class="form">
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

    }
}
</style>
