<template>
  <ul class="school_target">
    <li class="titles">
      <div>
        Ders Adı
      </div>
      <div>
        Kredi
      </div>
      <div>
        Ortalama
      </div>
      <div>
        Hedefe Yaklaşma Oranı
      </div>
    </li>
    <li
      v-for="(lesson,index) in targetData.lessons"
      :style="{'display':index > 3 ? moreTargetDisplay : 'flex'}"
      class="lesson">
      <div>
        {{ lesson.name }}
      </div>
      <div>
        {{ lesson.credit }}
      </div>
      <div>
        {{ lesson.score.average }} ({{ lesson.score.character }})
      </div>
      <div class="range_input">
        <input
          v-model="rangesValue[index]"
          :name="'range_'+index"
          type="range"
          value="0"
          min="0"
          max="100"
          step="5">
        <div>
          {{ rangesValue[index] ? rangesValue[index] : 0 }}
        </div>
      </div>
    </li>
    <li
      v-if="moreTargetDisplay === 'none' &&  targetData.lessons.length > 3"
      @click="showMoreLesson"
      class="more_button">
      daha fazla yükle
    </li>
    <li
      @click="postTargetRate"
      class="save">
      Gönder
    </li>
  </ul>
</template>

<script>
import eventBus from "../../../eventBus";

export default {
  name: "SchoolTarget",
  data() {
    return {
      moreTargetDisplay: 'none',
      rangesValue: []
    }
  },
  props: {
    targetData: {
      type: Object,
      required: true
    },
    targetId: {
      required: true
    }
  },
  methods: {
    showMoreLesson() {
      this.moreTargetDisplay = 'flex';
    },
    postTargetRate() {
      this.$store.dispatch('postTargetRate', {
        'targetRates': this.rangesValue,
        'targetId': this.targetId
      })
        .then(res => {
          eventBus.$emit('showAlert', {
            type: 'success',
            message: 'Hedef geçmiş hedeflere eklendi!'
          });
        })
        .catch(res => {
          eventBus.$emit('showAlert', {
            type: 'error'
          });
        });
    },
  }
}
</script>

<style scoped>
.school_target {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  padding: 0px;
}

.school_target > li {
  display: flex;
  justify-content: space-between;
  margin: 10px 0px;
  padding: 5px;
}

.school_target > li > div {
  width: 25%;
  text-align: left;
}

.school_target > .titles {
  border-bottom: 1px solid #d9d9d9;
}

.school_target > .titles > div {
  font-family: "Quicksand", sans-serif;
  font-size: 15px;
  color: #1ca90e;
}

.school_target > .lesson {

}

.school_target > .lesson > div {
  font-family: 'Comfortaa', cursive;
  font-size: 13px;
}

.school_target > .more_button {
  font-family: "Quicksand", sans-serif;
  font-size: 14px;
  cursor: pointer;
  color: #484848;
  display: inline-block;
  text-decoration: underline;
}

.school_target > .more_button:hover {
  color: #737373;
}

.school_target > li > .range_input {
  display: flex;
  justify-content: flex-start;
  align-items: center;
}

.school_target > li > .range_input > div {
  margin-left: 10px;
}

.school_target > .save {
  margin-left: auto;
  padding: 8px 17px;
  background-color: #259825;
  border-radius: 2px;
  border: 0px;
  color: white;
  font-family: "Comfortaa", cursive;
  font-size: 13px;
  cursor: pointer;
  transition: .3s;
}

.school_target > .save:hover {
  background-color: #2fac2f;
}

input[type=range] {
  outline: 0;
  border: 0;
  border-radius: 300px;
  width: 100%;
  max-width: 100%;
  overflow: hidden;
  height: 15px;
  -webkit-appearance: none;
  background-color: #ddd;
}

input[type=range]::-webkit-slider-thumb {
  width: 25px;
  -webkit-appearance: none;
  height: 25px;
  cursor: ew-resize;
  background: #fff;
  box-shadow: -340px 0 0 320px #1597ff, inset 0 0 0 40px #1597ff;
  border-radius: 50%;
  transition: box-shadow 0.2s ease-in-out;
  position: relative;
}

input[type=range]:active::-webkit-slider-thumb {
  background: #fff;
  box-shadow: -340px 0 0 320px #1597ff, inset 0 0 0 3px #1597ff;
}

</style>
