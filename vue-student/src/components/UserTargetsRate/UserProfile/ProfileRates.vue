<template>
  <div class="profile_rates_container">
    <div
      v-if="isLoading"
      class="loading">
      <img src="../../../assets/loading.gif" height="150" width="150"/>
    </div>
    <template v-else>
      <top title="" backUrl="/anasayfa/kullanici-hedef-orani">
        <div
          slot="top-right"
          class="top_right">
          <div class="profile_username">
            {{ UserProfileRate.user.name }}
          </div>
        </div>
      </top>
      <ul class="profile_information">
        <li>
          <div class="image">
            <img :src="UserProfileRate.user.image">
          </div>
          <div class="informations">
            <div>
            <span>
              Toplam Hedef Sayısı:
            </span>
              {{ UserProfileRate.user.targets_count }}
            </div>
          </div>
        </li>
        <li class="target_container">
          <ul>
            <li
              @click="getActiveTargets"
              class="title">
              Aktif Hedefler
              <i class="fas fa-caret-down"></i>
            </li>
            <li>
              <active-target :targets="UserProfileRate.activeTargets"/>
            </li>
          </ul>
        </li>
        <li class="target_container">
          <ul>
            <li
              @click="getLastTargets"
              class="title">
              Tamamlanmış Hedefler
              <i class="fas fa-caret-down"></i>
            </li>
            <li>
              <last-target :targets="UserProfileRate.lastTargets"/>
            </li>
          </ul>
        </li>
      </ul>
    </template>
  </div>
</template>

<script>
import {mapState} from 'vuex'

export default {
  name: "ProfileRates",
  data() {
    return {
      isLoading: true
    }
  },
  components: {
    Top: () => import('@/components/Shared/Top'),
    ActiveTarget: () => import('@/components/UserTargetsRate/UserProfile/ActiveTarget'),
    LastTarget: () => import('@/components/UserTargetsRate/UserProfile/LastTarget')
  },
  methods: {
    getProfile() {
      this.$store.commit('restartState');
      this.isLoading = true;
      this.$store.dispatch('getProfile', this.getUserId)
        .catch(res => {
          alert('Bir hata oluştu.');
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    getActiveTargets() {
      if (this.UserProfileRate.activeTargets !== null)
        return 0;

      this.$store.dispatch('getActiveTargets', this.getUserId)
        .catch(res => {
          alert('Bir hata oluştu!');
        })
    },
    getLastTargets() {
      if (this.UserProfileRate.lastTargets !== null)
        return 0;

      this.$store.dispatch('getLastTargets', this.getUserId)
        .catch(res => {
          alert('Bir hata oluştu!');
        })
    }
  },
  activated() {
    this.getProfile();
  },
  computed: {
    ...mapState(['UserProfileRate']),
    getUserId() {
      return this.$route.params.userId;
    }
  }
}
</script>

<style scoped>

.loading {
  display: flex;
  justify-content: center;
}

.top_right {
  width: 100%;
  text-align: center;
}

.profile_username {
  font-family: "Quicksand", sans-serif;
  font-size: 24px;
}

.profile_rates_container > .profile_information {
  list-style-type: none;
  padding: 0px;
}

.profile_information > li {
  display: flex;
  justify-content: flex-start;
  padding: 10px 20px;
}

.profile_information > li > .image > img {
  width: 100px;
  height: 100px;
  border-radius: 100px;
}

.profile_information > li > .informations {
  display: flex;
  align-items: center;
  margin-left: 10px;
}

.informations > div {
  font-family: "Quicksand", sans-serif;
}

.informations > div > span {
  font-family: "Comfortaa", cursive;
}

.profile_information .target_container > ul {
  list-style-type: none;
  padding: 0px;
  width: 100%;
}

.profile_information .target_container > ul > .title {
  font-family: "Comfortaa", cursive;
  font-size: 17px;
  color: #474747;
  display: inline-block;
  border-radius: 3px;
  padding: 5px 10px;
  cursor: pointer;
  transition: .2s;
}

.profile_information .target_container > ul > .title:hover {
  color: #0e7fe3;
  background-color: #f6f6f6;
}

.profile_information .target_container > ul > li > ul {
  margin: 10px 0px;
}

</style>
