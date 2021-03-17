<template>
  <div class="users_targets_rate_container">
    <top title="Kullanıcı Hedef Oranları" backUrl="/anasayfa">
      <div
        slot="top-right"
        class="top_right">
        <div class="rates_ranking">
          <div
            @click="activeRatesRanking = !activeRatesRanking"
            class="title">
            sıralama
            <i class="fas fa-caret-down"></i>
          </div>
          <ul
            v-show="activeRatesRanking">
            <li @click="getUsersRates('asc')">
              en düşük
            </li>
            <li @click="getUsersRates('desc')">
              en yüksek
            </li>
          </ul>
        </div>
      </div>
    </top>
    <ul class="users_targets_rate_content">
      <user-rate
        v-for="user in UserRate.users"
        :user="user"/>
      <li
        v-if="UserRate.hasUsers"
        @click="moreGetUsersRates"
        class="more_button">
        daha fazla yükle
      </li>
      <li
        v-else
        class="not_users">
        Başka kullanıcı yok
      </li>
    </ul>
  </div>
</template>

<script>
import {mapState} from 'vuex'

export default {
  name: "Home",
  data() {
    return {
      activeRatesRanking: false
    }
  },
  components: {
    Top: () => import('@/components/Shared/Top'),
    UserRate: () => import('@/components/UserTargetsRate/UserRate')
  },
  methods: {
    getUsersRates(listType) {
      this.$store.dispatch('getUsersRates', listType)
        .catch(res => {
          alert('Bir hata oluştu!');
        })
    },
    moreGetUsersRates() {
      this.$store.dispatch('getUsersRates', null)
        .catch(res => {
          alert('Bir hata oluştu!');
        });
    }
  },
  computed: {
    ...mapState(['UserRate'])
  },
  activated() {
    this.$store.commit('restartState');
    this.getUsersRates(null);
  }
}
</script>

<style scoped>

.top_right {
  margin-left: auto;
}

.rates_ranking {
  position: relative;
}

.rates_ranking > .title {
  cursor: pointer;
  font-family: "Comfortaa", cursive;
  font-size: 13px;
  color: #5d5d5d;
}

.rates_ranking > ul {
  position: absolute;
  right: 0px;
  top: 5px;
  list-style-type: none;
  font-family: "Quicksand", sans-serif;
  font-size: 13px;
  background-color: white;
  padding: 0px;
  width: 87px;
  border-radius: 3px;
  border: 1px solid #e7e7e7;
  box-shadow: 0 0px 0.3px rgba(0, 0, 0, 0.008),
  0 0px 0.8px rgba(0, 0, 0, 0.012),
  0 0px 1.5px rgba(0, 0, 0, 0.015),
  0 0px 2.7px rgba(0, 0, 0, 0.018),
  0 0px 5px rgba(0, 0, 0, 0.022),
  0 0px 12px rgba(0, 0, 0, 0.03);
}

.rates_ranking > ul > li {
  padding: 6px 12px;
  cursor: pointer;
}

.rates_ranking > ul > li:hover {
  background-color: #eeeeee;
}

.users_targets_rate_content {
  list-style-type: none;
  padding: 5px;
}

.users_targets_rate_content > .more_button {
  text-align: center;
  font-family: "Comfortaa", cursive;
  font-size: 15px;
  cursor: pointer;
  margin-top: 30px;
}

.users_targets_rate_content > .more_button:hover {
  color: #808080;
}

.users_targets_rate_content > .not_users {
  font-family: "Comfortaa", cursive;
  color: #d03c3c;
  margin-top: 10px;
  text-align: center;
}

</style>
