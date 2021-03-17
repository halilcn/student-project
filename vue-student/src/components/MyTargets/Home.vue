<template>
  <div class="targets_container">
    <top
      title="Hedeflerim"
      backUrl="/anasayfa">
      <div
        slot="top-right"
        class="top_right">
        <router-link
          :to="{name:'MyLastTargetHome'}"
          tag="div"
          class="last_targets_button">
          geçmiş hedeflerim
        </router-link>
        <div
          @click="updateTargets"
          class="targets_update_button">
          <i class="fas fa-history"></i>
        </div>
      </div>
    </top>
    <ul class="targets">
      <target
        :target="target"
        v-for="target in Target.targets"/>
      <li
        v-if="Target.hasTarget"
        @click="getMoreTargets"
        class="more_button">
        daha fazla yükle
      </li>
      <li
        v-else
        class="not_more_target">
        <i class="far fa-frown"></i>
        Başka hedef yok.
      </li>
      <li
        v-if="isTargetLoading"
        class="target_loading">
        <img src="@/assets/loading.gif" height="200" width="200"/>
      </li>
    </ul>
  </div>
</template>

<script>
import eventBus from "../../../eventBus";
import {mapState} from 'vuex'

export default {
  name: "Home",
  data() {
    return {
      isTargetLoading: false
    }
  },
  components: {
    target: () => import('@/components/MyTargets/Target'),
    top: () => import('@/components/Shared/Top')
  },
  methods: {
    getTargets() {
      this.isTargetLoading = true;
      this.$store.dispatch('getTargets')
        .catch(res => {
          alert('Bİr hata oluştu!');
        });
      this.isTargetLoading = false;
    },
    getMoreTargets() {
      this.isTargetLoading = true;
      this.$store.dispatch('getMoreTargets')
        .catch(res => {
          alert('Bİr hata oluştu!');
        })
        .finally(() => {
          this.isTargetLoading = false;
        });
    },
    updateTargets() {
      this.getTargets();
      eventBus.$emit('showAlert', {
        type: 'success',
        message: 'Hedefler Güncellendi!'
      });
    }
  },
  computed: {
    ...mapState(['Target'])
  },
  created() {
    this.getTargets();
  }
}
</script>

<style scoped>
.top_right {
  margin-left: auto;
  display: flex;
  justify-content: flex-start;
  align-items: center;
}

.top_right > .targets_update_button {
  padding: 5px;
  background-color: #e9ffea;
  color: #39b539;
  border-radius: 4px;
  cursor: pointer;
}

.top_right > .targets_update_button:hover {
  background-color: #d5ffd7;
}

.top_right > .last_targets_button {
  font-family: "Quicksand", sans-serif;
  font-size: 13px;
  cursor: pointer;
  color: black;
  margin-right: 20px;
}

.top_right > .last_targets_button:hover {
  color: #8d8d8d;
}

.targets_container {
  width: 100%;
  position: relative;
}

.targets {
  list-style-type: none;
  padding: 10px;
  display: flex;
  flex-direction: column;
}

.targets > li {
  margin-bottom: 40px;

}

.targets > .more_button {
  font-family: "Quicksand", sans-serif;
  color: #ffffff;
  background-color: #287fdd;
  cursor: pointer;
  padding: 6px 12px;
  border-radius: 4px;
  margin: 5px auto;
}

.targets > .more_button:hover {
  background-color: #1e71ca;
}

.targets > .not_more_target {
  text-align: center;
  color: #858585;
  font-family: "Quicksand", sans-serif;
  font-size: 14px;
}

.targets > .target_loading {
  display: flex;
  justify-content: center;
}

.targets > .target_loading > img {
  width: 70px;
  height: 70px;
}
</style>
