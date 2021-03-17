<template>
  <ul class="profile_active_target_rates">
    <component
      v-for="target in targets"
      :is="activeTargetComp(target.target_type)"
      :targetData="target.target_data"/>
    <li
      v-if="targets != null && targets.length ===0"
      class="not_active_target">
      Hiç aktif hedefi yok.
    </li>
  </ul>
</template>

<script>

export default {
  name: "ActiveTarget",
  props: {
    targets: {
      type: Array,
      default: []
    }
  },
  components: {
    ActiveSchoolTarget: () => import('@/components/UserTargetsRate/UserProfile/ActiveSchoolTarget')
  },
  methods: {
    activeTargetComp(targetType) {
      return targetType === 'school_score' ? 'active-school-target' : '';
    }
  }
}
</script>

<style scoped>
.profile_active_target_rates {
  list-style-type: none;
  padding: 0px;
}

.profile_active_target_rates > .not_active_target {
  font-family: "Quicksand", sans-serif;
  font-size: 14px;
  color: #cb1d1d;
}
</style>
