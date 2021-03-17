<template>
  <div class="container">
    <transition name="alert">
      <component
        v-if="alert.activeAlert != null"
        :message="alert.message"
        :is="alert.activeAlert"/>
    </transition>
    <div class="content">
      <router-view/>
    </div>
  </div>
</template>

<script>
import eventBus from "../eventBus";

export default {
  name: "App",
  data() {
    return {
      alert: {
        activeAlert: null,
        message: ''
      }
    }
  },
  components: {
    Success: () => import('@/components/Alert/Success'),
    Error: () => import('@/components/Alert/Error')
  },
  methods: {
    isChangeAlert() {
      setTimeout(() => {
        this.alert.activeAlert = null;
      }, 2000);
    }
  },
  mounted() {
    eventBus.$on('showAlert', (data) => {
      this.alert.activeAlert = data.type;
      this.alert.message = data.message;
      this.isChangeAlert();
    });
  },
}
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Quicksand&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Comfortaa&display=swap");

html,
body {
  height: 100%;
  margin: 0px;
}

* {
  outline: none;
  box-sizing: border-box;
}

a {
  text-decoration: none;
}

.container {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  height: 100%;
}

.content {
  width: 60%;
  background-color: white;
  border: 1px solid #f5f5f5;
  border-radius: 6px;
  display: flex;
  margin-top: 40px;
  padding: 10px;
  box-shadow: 0 0px 3.6px rgba(0, 0, 0, 0.014), 0 0px 10px rgba(0, 0, 0, 0.02),
  0 0px 24.1px rgba(0, 0, 0, 0.026), 0 0px 80px rgba(0, 0, 0, 0.04);
}

.alert-enter-active {
  animation: alert-enter-active-animate .2s ease-in-out;
}

.alert-leave-active {
  animation: alert-leave-active-animate .3s ease-in-out;
}

@keyframes alert-enter-active-animate {
  0% {
    opacity: 0;
    right: 0px;
  }
  50% {
    right: 35px;
  }
  100% {
    opacity: 1;
    right: 30px;
  }
}

@keyframes alert-leave-active-animate {
  0% {
    opacity: 1;
    right: 30px;
  }
  50% {
    right: 35px;
  }
  100% {
    opacity: 0;
    right: 0px;
  }
}

</style>
