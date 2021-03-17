<template>
  <li class="target">
    <div class="information">
      12 Ocak - {{ target.target_type === 'school_score' ? 'Not Hedefi' : '' }}
    </div>
    <div class="settings">
      <div class="dropdown_icon">
        <i class="fas fa-ellipsis-h"></i>
      </div>
      <div class="dropdown">
        <div
          @click="deleteTarget(target.id)"
          class="delete">
          <i class="fas fa-trash"></i>
          sil
        </div>
      </div>
    </div>
    <component
      class="target_content"
      :targetId="target.id"
      :targetData="target.target_data"
      :is="target.target_type">
    </component>
  </li>
</template>

<script>
import SchoolTarget from "@/components/MyTargets/SchoolTarget";
import eventBus from "../../../eventBus";

export default {
  name: "Target",
  props: {
    target: {
      type: Object,
      required: true
    }
  },
  data() {
    return {}
  },
  methods: {
    deleteTarget(targetId) {
      this.$store.dispatch('deleteTarget', targetId)
        .then(res => {
          eventBus.$emit('showAlert', {
            type: 'success',
            message: 'Hedef Silindi!'
          });
        })
        .catch(res => {
          eventBus.$emit('showAlert', {
            type: 'success'
          });
        })
    }
  },
  components: {
    'school_score': SchoolTarget
  }
}
</script>

<style scoped>
.target {
  position: relative;
}

.target > .information {
  font-family: "Quicksand", sans-serif;
  font-size: 14px;
  padding: 4px 0px;
}

.target > .settings {
  position: absolute;
  right: 5px;
  top: 30px;
}

.target > .settings:hover .dropdown {
  visibility: visible;
  opacity: 1;
}

.target > .settings > .dropdown_icon {
  cursor: pointer;
}

.target > .settings > .dropdown {
  visibility: hidden;
  opacity: 0;
  position: absolute;
  right: 0px;
  background-color: white;
  border-radius: 3px;
  transition: .3s;
  border: 1px solid #c4c4c4;
}

.target > .settings > .dropdown:before {
  right: 2px;
  top: -8px;
  border: solid transparent;
  content: "";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-color: rgba(0, 0, 0, 0);
  border-bottom-color: #c4c4c4;
  border-width: 7px;
  margin-top: -7px;
}

.target > .settings > .dropdown > .delete {
  color: #e91515;
}

.target > .settings > .dropdown > div {
  display: flex;
  padding: 8px 15px;
  font-family: 'Comfortaa', cursive;
  font-size: 11px;
  cursor: pointer;
}

.target > .settings > .dropdown > div:hover {
  background-color: #f5f5f5;
}

.target > .settings > .dropdown > div > i {
  padding-right: 3px;
}

.target_content {
  list-style-type: none;
  background-color: #f8f8f8;
  border: 1px solid #eeeeee;
  border-radius: 4px;
  padding: 10px;
}


</style>
