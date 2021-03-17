<template>
  <div class="home">
    <div class="profile">
      <img :src="this.Auth.user.image"/>
      <div class="name">
        {{ this.Auth.user.name }}
      </div>
      <div
        @click="logout"
        class="exit">
        çıkış
      </div>
    </div>
    <ul class="menu">
      <router-link
        tag="li"
        :to="{name: 'TargetCreateHome'}">
        <i class="fas fa-plus"></i>
        Hedef Oluştur
      </router-link>
      <router-link
        tag="li"
        :to="{name:'MyTargetHome'}">
        <i class="fas fa-briefcase"></i>
        Hedeflerim
      </router-link>
      <router-link
        tag="li"
        :to="{name:'UserTargetRate'}">
        <i class="fas fa-users"></i>
        Kullanıcı Hedef Oranı
      </router-link>
      <router-link
        tag="li"
        :to="{name:'SettingsProfile'}">
        <i class="fas fa-cogs"></i>
        Ayarlar
      </router-link>
    </ul>
  </div>
</template>

<script>
import {mapState} from "vuex";

export default {
  name: "HomeMenu",
  methods: {
    logout() {
      this.$store.dispatch("logout")
        .then(res => {
          this.$router.push({name: "Login"});
        })
        .catch(res => {
          alert('Bir hata oluştu!');
        })
    }
  },
  computed: {
    ...mapState(['Auth'])
  },

}
</script>

<style scoped>
.home {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 10px;
  margin: auto;
  border-radius: 4px;
}

.home .profile {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 250px;
  padding: 5px;
  border: 1px solid #f1f1f1;
  border-radius: 4px;
  box-shadow: 0 12px 17px rgba(0, 0, 0, 0.04);
}

.home .profile .exit {
  font-family: "Quicksand", sans-serif;
  color: #c91515;
  cursor: pointer;
  padding: 5px 10px;
  border-radius: 3px;
}

.home .profile .exit:hover {
  background-color: #fff5f5;
}

.home .profile img {
  height: 64px;
  width: 64px;
  border-radius: 40px;
}

.home .profile > .name {
  font-family: "Comfortaa", cursive;
  margin-top: 10px;
}

.home .menu {
  padding: 0px;
  list-style-type: none;
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  width: 250px;
}

.home .menu > li {
  font-family: "Quicksand", sans-serif;
  font-size: 14px;
  background-color: #f8f8f8;
  border: 1px solid #e5e5e5;
  height: 80px;
  width: 80px;
  margin: 5px;
  text-align: center;
  padding: 5px;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border-radius: 7px;
  transition: .3s;
}

.home .menu > li:hover {
  transform: translateY(-4px);
}

.home .menu > li > i {
  padding-bottom: 2px;
}
</style>
