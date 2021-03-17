<template>
  <div class="top">
    <router-link
      class="back_button"
      tag="div"
      :to="backUrl">
      <i class="fas fa-chevron-left"></i>
    </router-link>
    <div class="title">
      {{ title }}
    </div>
    <slot name="top-right"/>
  </div>
</template>

<script>
export default {
  name: "Top",
  props: {
    title: {
      required: true
    },
    backUrl: {
      required: true
    }
  }
}
</script>

<style scoped>
.top {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  border-bottom: 1px solid #f5f5f5;
  width: 100%;
  padding-bottom: 10px;
}

.top > .title {
  font-family: "Comfortaa", cursive;
  font-size: 23px;
  color: #535353;
}

.top > .back_button {
  font-size: 22px;
  padding: 7px;
  background-color: #ffffff;
  cursor: pointer;
  border: 1px solid white;
  border-radius: 3px;
  transition: 0.3s;
  margin-right: 10px;

  box-shadow: 0 0px 3.6px rgba(0, 0, 0, 0.014), 0 0px 10px rgba(0, 0, 0, 0.02),
  0 0px 24.1px rgba(0, 0, 0, 0.026), 0 0px 80px rgba(0, 0, 0, 0.04);
}

.top > .back_button:hover {
  transform: scale(1.1);
}
</style>
