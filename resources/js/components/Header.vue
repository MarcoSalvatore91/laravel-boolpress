<template>
  <div id="head">
      <h1 class="p-3">{{ title }}</h1>
  </div>
</template>

<script>
export default {
name: 'Header',
props: ["title"],
}
</script>

<style scoped lang="scss">

#head {
    background-color: rgb(61, 72, 73);
}

</style>