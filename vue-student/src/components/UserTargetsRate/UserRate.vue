<template>
  <li class="user_rate">
    <div class="user_info">
      <div class="image_container">
        <img :src="user.image">
        <div class="username">
          {{ user.name }}
        </div>
      </div>
      <router-link
        tag="div"
        class="profile_button"
        :to="{name:'GetProfileRates',params:{userId:user.id}}">
        daha fazla gör
      </router-link>
    </div>
    <div class="rate_container">
      <div class="title">
        Genel Hedef Oranı
      </div>
      <div class="rate">
        <vue-ellipse-progress
          :progress="100"
          :legendValue="user.targets_success_rate !=null? user.targets_success_rate.toFixed(2) : '0'"
          size="115"
          color="#11D859"
          animation="1600 800">
        </vue-ellipse-progress>
      </div>
    </div>
  </li>
</template>

<script>
export default {
  name: "UserRate",
  props: {
    user: {
      required: true
    }
  }
}
</script>

<style scoped>
.user_rate {
  display: flex;
  justify-content: space-between;
  padding: 12px 25px;
  border-radius: 3px;
  border: 1px solid #ececec;
  margin: 10px 0px;
}

.user_rate > .user_info {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.user_info > .image_container {
  display: flex;
  align-items: center;
}

.image_container > img {
  width: 90px;
  height: 90px;
  border-radius: 90px;
}

.image_container > .username {
  margin-left: 20px;
  font-family: "Quicksand", sans-serif;
  font-size: 19px;
}

.user_info > .profile_button {
  margin-top: 10px;
  cursor: pointer;
  font-family: "Comfortaa", cursive;
  font-size: 12px;
  color: black;
}

.user_info > .profile_button:hover {
  color: #0e7fe3;
}

.user_rate > .rate_container {
  display: flex;
  align-items: center;
}

.rate_container > .title {
  margin-right: 10px;
  font-family: "Comfortaa", cursive;
  font-size: 15px;
  color: #535353;
}

.rate_container > .rate {

}
</style>
