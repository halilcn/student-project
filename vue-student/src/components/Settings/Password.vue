<template>
  <ul class="password_settings">
    <li>
      <div class="title_list">
        Mevcut Şifre
      </div>
      <div class="input_container">
        <input
          v-model.trim="password"
          :class="{'input_error':$v.password.$error}"
          type="password">
        <template v-if="$v.password.$dirty">
          <div
            v-if="!$v.password.required"
            class="error">
            Şifre alanı boş bırakılamaz.
          </div>
          <div
            v-if="customValidations.checkPassword"
            class="error">
            Şifre yanlış.
          </div>
        </template>
      </div>
    </li>
    <li>
      <div class="title_list">
        Yeni Şifre
      </div>
      <div class="input_container">
        <input
          v-model.trim="newPassword"
          :class="{'input_error':$v.newPassword.$error || $v.repeatNewPassword.$error}"
          type="password">
        <template v-if="$v.newPassword.$dirty">
          <div
            v-if="!$v.newPassword.required"
            class="error">
            Yeni Şifre alanı boş bırakılamaz.
          </div>
          <div
            v-if="!$v.newPassword.minLength"
            class="error">
            Yeni Şifre alanı minimum {{ $v.newPassword.$params.minLength.min }} karakter olmalıdır.
          </div>
        </template>
      </div>
    </li>
    <li>
      <div class="title_list">
        Yeni Şifre Tekrar
      </div>
      <div class="input_container">
        <input
          v-model.trim="repeatNewPassword"
          :class="{'input_error':$v.repeatNewPassword.$error}"
          type="password">

        <template v-if="$v.repeatNewPassword.$dirty">
          <div
            v-if="!$v.repeatNewPassword.sameAs"
            class="error">
            Yeni Şifre ve Yeni Şifre Tekrar alanları aynı olmalıdır.
          </div>
        </template>
      </div>
    </li>
    <li class="save_button_list">
      <div
        @click="updatePassword"
        class="button">
        Şifreyi Değiştir
      </div>
    </li>
  </ul>
</template>

<script>
import {required, minLength, sameAs} from 'vuelidate/lib/validators'
import eventBus from "../../../eventBus";

export default {
  name: "Password",
  data() {
    return {
      password: '',
      newPassword: '',
      repeatNewPassword: '',
      customValidations: {
        checkPassword: false
      }
    }
  },
  methods: {
    updatePassword() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        return 0;
      }
      const data = {
        password: this.password,
        newPassword: this.newPassword,
        _method: 'PUT'
      };
      this.$store.dispatch('updatePassword', data)
        .then(res => {
          eventBus.$emit('showAlert', {
            type: 'success',
            message: 'Şifre Değiştirildi!'
          });
          this.resetData();
        })
        .catch(res => {
          if (res.response.status === 401) {
            this.customValidations.checkPassword = true;
          }
          eventBus.$emit('showAlert', {
            type: 'error'
          });
        });
    },
    resetData() {
      Object.assign(this.$data, this.$options.data.call(this));
      this.$v.$reset();
    }
  },
  validations: {
    password: {
      required,
    },
    newPassword: {
      required,
      minLength: minLength(4),
    },
    repeatNewPassword: {
      sameAs: sameAs('newPassword')
    }
  }
}
</script>

<style scoped>
.password_settings {
  list-style-type: none;
}

.password_settings > li {
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}
</style>
