<template>
  <div class="school_point_create">
    <ul class="school_point_ul">
      <li class="lesson_row" v-for="(lesson, index) in lessonsScore.lessons">
        <input
          @focus="lessonNotesInputFocusShow(index)"
          v-model.trim="lessonsScore.lessons[index].name"
          type="text"
          placeholder="Ders Adı"
        />
        <input
          @focus="lessonNotesInputFocusShow(index)"
          v-model.number="lesson.credit"
          type="text"
          placeholder="Kredi"
        />
        <div class="lesson_avg">
          <div class="score">
            Ort:
            <span v-if="lesson.score.avgScore">
              {{ lesson.score.avgScore }}
              ({{ lesson.score.characterScore }})
            </span>
            <span v-else>
              --
            </span>
          </div>
          <i @click="lessonNotesShow(index)" class="fas fa-plus-circle"></i>
          <ul v-show="lessonNotesShowNotesIndex == index" class="lesson_notes">
            <li>
              <div class="exam_name">
                Vize
                <input
                  :class="{exam_perce_input: lessonsScore.lessonPerce.firstExam}"
                  v-model.number="lessonsScore.lessonPerce.firstExam"
                  type="text"
                  value="60"
                />
              </div>
              <input
                @input="avgCalculate(index)"
                v-model.number="lesson.score.firstExam"
                :class="{
                  exam_score_input: !lessonsScore.lessonPerce.firstExam
                }"
                type="text"
              />
            </li>
            <li>
              <div class="exam_name">
                Final
                <input
                  :class="{exam_perce_input: lessonsScore.lessonPerce.secondExam}"
                  v-model.number="lessonsScore.lessonPerce.secondExam"
                  type="text"
                  value="60"
                />
              </div>
              <input
                @input="avgCalculate(index)"
                v-model.number="lesson.score.secondExam"
                :class="{exam_score_input: !lessonsScore.lessonPerce.secondExam}"
                type="text"
              />
            </li>
          </ul>
        </div>
        <div @click="deleteLesson(index)" class="lesson_delete_row">
          <i class="fas fa-minus-circle"></i>
        </div>
      </li>
      <li @click="addLesson" class="lesson_new_row">
        <i class="fa fa-plus-circle"></i>
        Ekle
      </li>
      <li class="bottom">
        <div class="total_avg">
          Genel Ortalama
          <span>
            {{ lessonsScore.totalAvg }}
            <span v-if="lessonsScore.totalAvg < 2.0" style="color: #f32828;">
              <i class="fas fa-star"></i>
            </span>
            <span
              v-else-if="lessonsScore.totalAvg < 3.0"
              style="color: #baba16;"
            >
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </span>
            <span v-else style="color: #18a018;">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </span>
          </span>
        </div>
        <div
          @click="createTarget"
          class="target_save_button">
          Hedefi Kaydet
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import {required, minLength, maxLength, numeric, alpha} from 'vuelidate/lib/validators'
import eventBus from '../../../eventBus.js'

export default {
  name: "TargetCreate",
  props: ['createTargetSuccess'],
  data() {
    return {
      lessonNotesShowNotesIndex: null,
      lessonsScore: {
        type: 'school_score',
        lessonPerce: {
          firstExam: "",
          secondExam: ""
        },
        lessons: [
          {
            name: "",
            credit: "",
            score: {
              characterScore: "",
              avgScore: "",
              firstExam: "",
              secondExam: ""
            }
          }
        ],
        totalAvg: "0.00"
      }
    };
  },
  methods: {
    lessonNotesShow(index) {
      this.lessonNotesShowNotesIndex = this.lessonNotesShowNotesIndex === index ? null : index;
    },
    lessonNotesInputFocusShow(index) {
      this.lessonNotesShowNotesIndex = index;
    },
    pushLesson() {
      return {
        name: "",
        credit: "",
        score: {
          characterScore: "",
          avgScore: "",
          firstExam: "",
          secondExam: ""
        }
      };
    },
    addLesson() {
      this.lessonsScore.lessons.push(this.pushLesson());
    },
    deleteLesson(index) {
      this.lessonsScore.lessons.splice(index, 1);
    },
    avgCalculate(index) {
      var lessons = this.lessonsScore.lessons[index].score;
      lessons.avgScore = this.avgScoreCalculate(lessons);
      lessons.characterScore = this.avgCharacterCalculate(lessons.avgScore);
    },
    avgScoreCalculate(lessons) {
      const avgScore = (
        (lessons.firstExam * this.lessonsScore.lessonPerce.firstExam) / 100 +
        (lessons.secondExam * this.lessonsScore.lessonPerce.secondExam) / 100
      ).toFixed(2);

      if (avgScore >= 100) {
        return 100;
      } else if (avgScore <= 0) {
        return 0;
      }

      return avgScore;
    },
    avgCharacterCalculate(avg) {
      avg = parseInt(avg);
      if (!avg) {
        return "";
      }
      if (avg <= 100 && avg >= 82) {
        return "AA";
      } else if (avg <= 81 && avg >= 74) {
        return "BA";
      } else if (avg <= 73 && avg >= 65) {
        return "BB";
      } else if (avg <= 64 && avg >= 58) {
        return "CB";
      } else if (avg <= 57 && avg >= 50) {
        return "CC";
      } else if (avg <= 49 && avg >= 40) {
        return "DC";
      } else if (avg <= 39 && avg >= 35) {
        return "DD";
      } else if (avg <= 34 && avg >= 25) {
        return "FD";
      } else if (avg <= 24) {
        return "FF";
      }
    },
    totalAvgScoreCalculate() {
      let lessonsScore = 0, totalCredit = 0, totalAvgScore = 0;
      this.lessonsScore.lessons.forEach(lesson => {
        lessonsScore += lesson.credit * this.avgScoreCalculate(lesson.score);
        totalCredit += lesson.credit;
      });
      totalAvgScore = (lessonsScore / totalCredit / 25).toFixed(2);
      this.lessonsScore.totalAvg = !isNaN(totalAvgScore)
        ? totalAvgScore
        : "0.00";
    },
    createTarget() {
      this.$store.dispatch('postTarget', {...this.lessonsScore})
        .then(res => {
          eventBus.$emit('createTargetSuccess', true);
          eventBus.$emit('activeComponent', '');
        })
        .catch(res => {
          eventBus.$emit('createTargetSuccess', false);
        });
    }
  },
  beforeUpdate() {
    this.totalAvgScoreCalculate();
  },
  /*
  validations: {
    lessonsScore: {
      lessonPerce: {
        firstExam: {
          required,
          numeric,
          minLength: minLength(0),
          maxLength: maxLength(100)
        },
        secondExam: {
          required,
          numeric,
          minLength: minLength(0),
          maxLength: maxLength(100)
        }
      },
      lessons: {
        $each: {
          name: {
            alpha,
            required
          }
        }

         credit: {
           numeric,
           required
         },
         score: {
           characterScore: {
             maxLength: maxLength(2),
             alpha,
             required
           },
           avgScore: {
             numeric,
             required
           },
           firstExam: {
             required,
             numeric
           },
           secondExam: {
             required,
             numeric
           }
         }
},
totalAvg: {
  required,
    numeric,
    maxLength:maxLength(1),
    minLength:minLength(0)
}
},
}*/
}
;
</script>

<style scoped>
.school_point_create {
  width: 100%;
  margin-top: 20px;
}

.school_point_create > .school_point_ul {
  list-style-type: none;
  padding: 20px;
  background-color: #f5f5f5;
  border: 1px solid #eaeaea;
  border-radius: 4px;
}

.school_point_create > .school_point_ul > .lesson_new_row {
  font-family: "Comfortaa", cursive;
  font-size: 13px;
  margin-top: 5px;
  display: inline-block;
  cursor: pointer;
  color: #0c942f;
}

.school_point_ul > li {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  margin: 10px 0px;
}

.school_point_ul > .lesson_row {
  border-bottom: 1px solid #e9e9e9;
  padding-bottom: 10px;
}

.lesson_row > input {
  padding: 6px;
  border: 1px solid #b0b0b0;
  border-radius: 3px;
  font-family: "Comfortaa", cursive;
  margin-right: 40px;
}

.lesson_row > input:focus {
  border-color: #999999;
}

.lesson_row > .lesson_avg {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.lesson_avg > .score {
  font-family: "Quicksand", sans-serif;
  font-size: 14px;
  color: #151515;
}

.lesson_avg > .score > span {
  font-family: "Comfortaa", cursive;
}

.lesson_avg > i {
  margin-left: 5px;
  cursor: pointer;
  color: #4e4e4e;
}

.lesson_avg > i:hover {
  color: black;
}

.lesson_avg > .lesson_notes {
  position: absolute;
  list-style-type: none;
  background-color: white;
  padding: 5px;
  width: 100px;
  right: -110px;
  top: -80px;
  border: 1px solid #e7e7e7;
  border-radius: 4px;

  box-shadow: 0 0px 2.7px rgba(0, 0, 0, 0.009), 0 0px 6.9px rgba(0, 0, 0, 0.013),
  0 0px 14.2px rgba(0, 0, 0, 0.017), 0 0px 29.2px rgba(0, 0, 0, 0.021),
  0 0px 80px rgba(0, 0, 0, 0.03);
}

.lesson_notes:after {
  right: 100%;
  top: 50%;
  border: solid transparent;
  content: "";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-right-color: #d4d4d4;
  border-width: 10px;
  margin-top: -10px;
}

.lesson_notes > li {
  margin: 10px 0px;
  background-color: #efefef;
  border-radius: 4px;
  padding: 5px;
  font-family: "Quicksand", sans-serif;
}

.lesson_notes > li input {
  border: 1px solid #bababa;
  padding: 5px;
  border-radius: 3px;
}

.lesson_notes > li > .exam_name {
  display: flex;
  justify-content: flex-start;
  align-items: center;
}

.lesson_notes > li > .exam_name > input {
  width: 100%;
  margin-left: 5px;
}

.lesson_notes > li > .exam_name > .exam_perce_input {
  background-color: transparent;
  border-color: transparent;
}

.lesson_notes > li > .exam_score_input {
  background-color: #f4f4f4;
  color: #dcdcdc;
  pointer-events: none;
}

.lesson_notes > li > input {
  width: 100%;
  margin-top: 4px;
}

.school_point_ul > li .lesson_delete_row {
  color: #d41919;
  margin-left: auto;
  cursor: pointer;
  font-size: 18px;
  transition: 0.3s;
}

.school_point_ul > li .lesson_delete_row:hover {
  color: #e52525;
  transform: scale(1.2);
}

.school_point_ul > .bottom {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}

.school_point_ul > .bottom > .total_avg {
  font-family: "Quicksand", sans-serif;
  font-size: 15px;
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #efefef;
  padding: 5px;
  border-radius: 4px;
}

.school_point_ul > .bottom > .total_avg > span {
  font-family: "Comfortaa", cursive;
  font-size: 14px;
  color: #2f2f2f;
  margin-top: 4px;
}

.school_point_ul > .bottom > .target_save_button {
  padding: 7px 13px;
  background-color: #1f941f;
  color: white;
  font-family: "Comfortaa", cursive;
  font-size: 13px;
  border-radius: 3px;
  margin-top: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.school_point_ul > .bottom > .target_save_button:hover {
  background-color: #1da51d;
}
</style>
