<template>
    <span class="info">
        {{ startPage }}
        -
        {{ endPage }}
         из
        {{ fullLength }}
    </span>
</template>

<script>
export default {
    name: "page-info",
    props: {
        startPage: Number,
        endPage: Number,
        fullLength: Number,
    }
}
</script>

<style scoped>
.info {
    color: var(--old-light-gray-300, #D0D5DD);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 145%;
}
</style>
