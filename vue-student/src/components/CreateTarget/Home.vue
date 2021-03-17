<template>
  <div class="target_create_container">
    <top title="Hedef Oluştur" backUrl="/anasayfa"/>
    <div class="choose_target">
      <div class="title">
        Hedef Türü
      </div>
      <select v-model="activeComponent">
        <option value="SchoolPointTarget">Not Hedefi</option>
      </select>
    </div>
    <transition-group
      class="target_response"
      tag="div"
      name="scale-effect">
      <div
        :key="0"
        v-show="createTargetSuccess === false"
        class="target_save_error">
        <i class="fas fa-exclamation-circle"></i>
        Hedef Oluşturma Başarısız!
      </div>
      <div
        :key="1"
        v-show="createTargetSuccess === true"
        class="target_save_access">
        <i class="fas fa-check-circle"></i>
        Hedef Başarıyla Oluşturuldu!
      </div>
    </transition-group>
    <transition
      name="scale-effect">
      <component
        v-if="this.activeComponent !== ''"
        :createTargetSuccess="this.createTargetSuccess"
        :is="activeComponent"/>
    </transition>
  </div>
</template>

<script>
import eventBus from '../../../eventBus.js'

export default {
  name: "Home",
  data() {
    return {
      activeComponent: "",
      createTargetSuccess: null
    };
  },
  components: {
    SchoolPointTarget: () => import('@/components/CreateTarget/SchoolPointTarget'),
    Top: () => import('@/components/Shared/Top')
  },
  mounted() {
    eventBus.$on('createTargetSuccess', (data) => {
      this.createTargetSuccess = data;
    });
    eventBus.$on('activeComponent', (data) => {
      this.activeComponent = data;
    });
  },
  watch: {
    createTargetSuccess() {
      setTimeout(() => {
        this.createTargetSuccess = null;
      }, 3000);
    },
  },
};
</script>

<style scoped>

.target_create_container {
  width: 100%;
}

.target_create_container > .choose_target > .title {
  margin-top: 25px;
  font-family: "Quicksand", sans-serif;
}

.target_create_container > .choose_target > select {
  background-color: #f8f8f8;
  padding: 5px;
  cursor: pointer;
  border-radius: 3px;
  font-family: "Quicksand", sans-serif;
  margin-top: 5px;
}

.target_create_container > .target_response {
  width: 100%;
  height: 40px;
  margin: 20px 0px 10px 0px;
}

.target_response > .target_save_access {
  color: #12a712;
  background-color: #eeffee;
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  font-family: "Comfortaa", cursive;
  font-size: 16px;
  text-align: center;
}

.target_response > .target_save_error {
  color: #b01d23;
  background-color: #ffeded;
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  font-family: "Comfortaa", cursive;
  font-size: 16px;
  text-align: center;
}

.scale-effect-enter-active {
  animation: scale-effect-enter-active-animate .3s ease-in-out;
}

.scale-effect-leave-active {
  animation: scale-effect-leave-active-animate .3s ease-in-out;
}

@keyframes scale-effect-enter-active-animate {
  0% {
    opacity: 0;
    transform: scale(.8);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

@keyframes scale-effect-leave-active-animate {
  0% {
    opacity: 1;
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(0);
    opacity: 1;
  }
}

.target-component-effect-enter-active {

}

.target-component-effect-leave-active {

}

</style>
