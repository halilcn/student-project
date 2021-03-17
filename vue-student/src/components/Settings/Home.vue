<template>
  <div class="settings_container">
    <top title="Hedef Oluştur" backUrl="/anasayfa"/>
    <div class="settings_content">
      <top-menu></top-menu>
      <router-view class="settings_component"/>
    </div>
  </div>
</template>

<script>

export default {
  name: "Home",
  data() {
    return {}
  },
  components: {
    TopMenu: () => import('@/components/Settings/TopMenu'),
    Top: () => import('@/components/Shared/Top')
  }
}
</script>

<style>
.settings_content {
  display: flex;
  flex-direction: column;
}

.settings_component {
  padding: 20px;
  background-color: #fafafa;
  border: 1px solid #f6f6f6;
  border-radius: 4px;
}

/* In Components */
.settings_content .title_list {
  font-family: 'Comfortaa', cursive;
  font-size: 14px;
  margin-bottom: 7px;
  color: #2f2f2f;
  padding: 4px 10px;
  background-color: #f6f6f6;
  border-radius: 4px;
  border-bottom: 2px solid #eeeeee;
}

.settings_content .input_container > input {
  padding: 6px;
  border: 1px solid #d7d7d7;
  border-radius: 3px;
  font-family: "Quicksand", sans-serif;
  transition: .3s border-bottom-color;
}

.settings_content .input_container > input:focus {
  border-bottom-color: #c4c4c4;
}

.settings_content .input_container > .input_error {
  border-color: red !important;
}

.settings_content .input_container > .error {
  color: #dd1414;
  font-family: "Quicksand", sans-serif;
  font-size: 11px;
  margin-top: 3px;
}

.settings_content .save_button_list {
  margin-top: 10px;
}

.settings_content .save_button_list > .button {
  background-color: #22a513;
  color: white;
  font-family: 'Comfortaa', cursive;
  display: inline-block;
  padding: 5px 13px;
  border-bottom: 2px solid #18830c;
  border-radius: 5px;
  cursor: pointer;
}

.settings_content .save_button_list > .button:active {
  border-bottom-color: #FAFAFA;
}

</style>
