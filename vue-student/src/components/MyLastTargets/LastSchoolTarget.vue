<template>
  <li class="last_school_target">
    <div class="information">
      <div class="date">
        <i class="fas fa-calendar-week"></i>
        {{moment(targetData.last_target_created_at).format('DD MMMM Y')}}
      </div>
      <div class="target_type">
        <i class="fas fa-dot-circle"></i>
        Not Hedefi
      </div>
      <div class="lessons_count">
        <i class="fas fa-pencil-ruler"></i>
        {{targetData.lessons_count}}
      </div>
    </div>
    <div class="success_rate">
      <vue-ellipse-progress
        :progress="targetData.success_rate"
        :legendValue="targetData.success_rate"
        size="115"
        color="#11D859"
        animation="1600 800">
        <p slot="legend-caption">Başarı Oranı</p>
      </vue-ellipse-progress>
    </div>
  </li>
</template>

<script>
export default {
  name: "LastTarget",
  data() {
    return {

    }
  },
  props: {
    targetData: {
      required: true
    }
  }
}
</script>

<style scoped>
.last_school_target {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  margin: 10px 0px;
  padding: 10px 30px;
  border: 1px solid #e0e0e0;
  border-radius: 5px;
}

.last_school_target > .information {
  display: flex;
  flex-direction: column;
  width: 70%;
}

.information > div {
  margin: 5px 0px;
  font-size: 17px;
  display: flex;
  align-items: center;
  color: #5d6062;
}

.information > div > i {
  color: #21282d;
  margin-right: 15px;
  font-size: 13px;
}

.information > .date {
  font-family: "Comfortaa", cursive;
}

.information > .target_type {
  font-family: "Quicksand", sans-serif;
}

.information > .lessons_count {
  font-family: "Quicksand", sans-serif;
}

.last_school_target > .success_rate {
  width: 30%;
  display: flex;
  justify-content: flex-end;
  font-family: "Quicksand", sans-serif;
}


</style>
