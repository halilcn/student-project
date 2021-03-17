<template>
  <form ref="userForm">
    <ul class="profile_settings">
      <li class="image_list">
        <div class="title_list">
          Fotoğraf
        </div>
        <div class="image">
          <img
            ref="userImage"
            :src="Auth.user.image">
          <input
            @change="uploadImage"
            type="file"
            name="image"
            id="user_image">
          <label for="user_image">
            <i class="far fa-edit"></i>
          </label>
        </div>
      </li>
      <li class="input_list">
        <div class="title_list">
          Ad Soyad
        </div>
        <div class="input_container">
          <input
            type="text"
            name="name"
            :value="Auth.user.name"
            @keypress.enter.prevent="updateUser">
        </div>
      </li>
      <li class="save_button_list">
        <div
          @click="updateUser"
          class="button">
          Kaydet
        </div>
      </li>
    </ul>
  </form>
</template>

<script>
import {mapState} from 'vuex'
import eventBus from "../../../eventBus";

export default {
  name: "ProfileSettings",
  data() {
    return {}
  },
  methods: {
    updateUser() {
      const userForm = new FormData(this.$refs.userForm);
      userForm.append('_method', 'PUT');
      this.$store.dispatch('updateUser', userForm)
        .then(res => {
          eventBus.$emit('showAlert', {
            type: 'success',
            message: 'Başarıyla Kaydedildi!'
          });
        })
        .catch(res => {
          eventBus.$emit('showAlert', {
            type: 'error',
          });
        });
    },
    uploadImage(event) {
      const file = event.target.files[0];
      this.$refs.userImage.src = URL.createObjectURL(file);
    }
  },
  computed: {
    ...mapState(['Auth'])
  },
}
</script>

<style scoped>
.profile_settings {
  list-style-type: none;
  padding: 0px;
}

.profile_settings > li {
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.profile_settings > .image_list {

}

.profile_settings > .image_list > .image {
  position: relative;
}

.profile_settings > .image_list > .image > img {
  width: 100px;
  height: 100px;
  border-radius: 50px;
}

.profile_settings > .image_list > .image > input[type='file'] {
  display: none;
}

.profile_settings > .image_list > .image > label[for='user_image'] {
  position: absolute;
  top: 0px;
  cursor: pointer;
  color: #0e7fe3;
}

.profile_settings > .image_list > .image > label[for='user_image']:hover {
  color: #0e67b7;
}
</style>
