<template>
  <li>
    <div class="date">
      {{ targetData.last_target_date }}
    </div>
    <div class="lessons_count">
      <span>{{ targetData.lessons_count }}</span> adet ders
    </div>
    <div class="success_rate">
      <span>{{ targetData.success_rate }}</span> Başarı Oranı
    </div>
  </li>
</template>

<script>
export default {
  name: "SchoolTarget",
  props: {
    targetData: {
      required: true,
      type: Object
    }
  }
}
</script>

<style scoped>

li {
  display: flex;
  justify-content: space-around;
  align-items: center;
  background-color: #f6f6f6;
  padding: 10px;
  border-radius: 4px;
  border-left: 2px solid #9b9b9b;
  font-family: "Quicksand", sans-serif;
  font-size: 17px;
  margin: 10px 0px;
  box-shadow: 0 0px 0.2px rgba(0, 0, 0, 0.008),
  0 0px 0.6px rgba(0, 0, 0, 0.012),
  0 0px 1.1px rgba(0, 0, 0, 0.015),
  0 0px 2px rgba(0, 0, 0, 0.018),
  0 0px 3.8px rgba(0, 0, 0, 0.022);
}

li > .date {
  font-family: "Comfortaa", cursive;
  color: black;
}

li span {
  background-color: #0e7fe3;
  color: white;
  padding: 7px 10px;
  border-radius: 50px;
  font-size: 14px;
}
</style>
