<template>
  <div class="alert">
    {{ message }}
  </div>
</template>

<script>
export default {
  name: "Error",
  props: {
    message: {
      default: 'Bir hata oluştu!'
    }
  }
}
</script>

<style scoped>
.alert {
  background-color: #FF5549;
  color: white;
  position: absolute;
  padding: 10px 30px;
  font-family: "Quicksand", sans-serif;
  border-radius: 5px;
  right: 30px;
  top: 40px;
}
</style>
