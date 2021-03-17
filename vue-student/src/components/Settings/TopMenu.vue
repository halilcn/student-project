<template>
  <ul class="settings_top_menu">
    <router-link
      exact
      tag="li"
      :to="{name:'SettingsProfile'}">
      <i class="fas fa-user"></i>
      Profil
    </router-link>
    <router-link
      tag="li"
      :to="{name:'SettingsPassword'}">
      <i class="fas fa-lock"></i>
      Şifre Değiştir
    </router-link>
    <router-link
      tag="li"
      :to="{name:'SettingsOther'}">
      <i class="fas fa-cogs"></i>
      Diğer
    </router-link>
  </ul>
</template>

<script>
export default {
  name: "LeftMenu"
}
</script>


<style scoped>
.settings_top_menu {
  list-style-type: none;
  padding: 10px;
  border-radius: 4px;
  display: flex;
  justify-content: center;
}


.settings_top_menu > li {
  font-family: 'Comfortaa', cursive;
  font-size: 13px;
  cursor: pointer;
  padding: 10px 20px;
  margin: 10px 10px;
  border-radius: 5px;
}

.router-link-active {
  background-color: #efefef;
  border-bottom: 2px solid #d6d6d6;
}

</style>
