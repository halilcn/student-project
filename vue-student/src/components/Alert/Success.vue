<template>
  <div class="alert">
    {{ message }}
  </div>
</template>

<script>
export default {
  name: "Success",
  props: {
    message: {
      default: 'Başarılı!'
    }
  }
}
</script>

<style scoped>
.alert {
  background-color: #2ac37c;
  color: white;
  position: fixed;
  padding: 10px 30px;
  font-family: "Quicksand", sans-serif;
  border-radius: 5px;
  right: 30px;
  top: 40px;
}
</style>
