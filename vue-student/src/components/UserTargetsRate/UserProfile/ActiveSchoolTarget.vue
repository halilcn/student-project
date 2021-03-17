<template>
  <li>
    <div class="lessons_count">
      <span>{{ targetData.lessons_count }}</span> adet ders
    </div>
    <div class="target_rates">
      <span>{{ targetData.total_average }}</span> Hedeflenen Ortalama
    </div>
  </li>
</template>

<script>
export default {
  name: "ActiveSchoolTarget",
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
  background-color: #F6F6F6;
  padding: 10px;
  display: flex;
  justify-content: flex-start;
  border-left: 2px solid #17b317;
  border-radius: 4px;
  font-family: "Quicksand", sans-serif;
  font-size: 17px;
  margin: 10px 0px;
}

li > .lessons_count {
  margin: 0px 20px;
}

li span {
  background-color: #0e7fe3;
  color: white;
  padding: 7px 10px;
  border-radius: 50px;
  font-size: 14px;
}
</style>
