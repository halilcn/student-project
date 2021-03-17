<template>
  <ul class="profile_school_target_rates">
    <component
      v-for="target in targets"
      :is="activeTargetComp(target.last_target_type)"
      :targetData="target.last_target_data"/>
    <li
      v-if="targets != null && targets.length ===0"
      class="not_last_target">
      Hiç tamamlanmış hedef yok.
    </li>
    <li
      v-if="targets != null && targets.length ===0"
      class="not_last_target">
      Hiç tamamlanmış hedef yok.
    </li>
  </ul>
</template>

<script>
export default {
  name: "LastTarget",
  props: {
    targets: {
      type: Array,
      default: []
    }
  },
  components: {
    LastSchoolTarget: () => import('@/components/UserTargetsRate/UserProfile/LastSchoolTarget')
  },
  methods: {
    activeTargetComp(targetType) {
      return targetType === 'last_school_score' ? 'last-school-target' : '';
    }
  }
}
</script>

<style scoped>
.profile_school_target_rates {
  width: 100%;
  padding: 0px;
  list-style-type: none;
}

.not_last_target {
  font-family: "Comfortaa", cursive;
  font-size: 13px;
  color: #d61919;
}
</style>

