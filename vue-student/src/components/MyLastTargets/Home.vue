<template>
  <div class="last_targets_container">
    <top title="Tamamlanmış Hedeflerim" backUrl="/anasayfa/hedeflerim"/>
    <ul class="last_targets">
      <component
        v-for="target in LastTarget.lastTargets"
        :is="target.last_target_type"
        :targetData="target.last_target_data">
      </component>
    </ul>
  </div>
</template>

<script>
import eventBus from "../../../eventBus";
import {mapState} from 'vuex'

export default {
  name: "Home",
  components: {
    Top: () => import('@/components/Shared/Top'),
    'last_school_score': () => import('@/components/MyLastTargets/LastSchoolTarget')
  },
  computed: {
    ...mapState(['LastTarget'])
  },
  activated() {
    this.$store.dispatch('getLastTargets')
      .catch(res => {
        eventBus.$emit('showAlert', {
          type: 'error',
          message: 'Bir hata oluştu!'
        });
      })
  }
}
</script>

<style scoped>
.last_targets_container {
}

.last_targets {
  list-style-type: none;
  padding: 0px 15px;
}

.last_targets > li {
  margin: 30px 0px
}
</style>
