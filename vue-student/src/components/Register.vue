<template>
  <div class="register">
    <div class="title">
      Kayit Ol
    </div>
    <form>
      <input
        v-model.trim="$v.user.name.$model"
        :class="{ input_border_warning: $v.user.name.$error }"
        type="text"
        placeholder="Ad Soyad"
      />
      <template v-if="$v.user.name.$dirty">
        <div v-if="!$v.user.name.required" class="input_warning">
          Ad-Soyad boş bırakılamaz.
        </div>
        <div v-if="!$v.user.name.maxLength" class="input_warning">
          Ad-Soyad alanı çok uzun.
        </div>
      </template>
      <input
        v-model.trim="$v.user.email.$model"
        :class="{ input_border_warning: $v.user.email.$error }"
        type="email"
        placeholder="E-mail"
      />
      <template v-if="$v.user.email.$dirty">
        <div v-if="!$v.user.email.required" class="input_warning">
          E-mail alanı boş bırakılamaz.
        </div>
        <div v-if="!$v.user.email.email" class="input_warning">
          Geçerli bir E-mail adresi giriniz.
        </div>
      </template>
      <input
        v-model.trim="$v.user.password.$model"
        :class="{ input_border_warning: $v.user.password.$error }"
        type="text"
        placeholder="Şifre"
      />
      <template v-if="$v.user.password.$dirty">
        <div v-if="!$v.user.password.required" class="input_warning">
          Şifre alanı boş bırakılamaz.
        </div>
        <div v-if="!$v.user.password.minLength" class="input_warning">
          Şifre alanı minimum
          {{ $v.user.password.$params.minLength.min }} karakter olmalıdır.
        </div>
      </template>
      <input
        v-model.trim="$v.user.passwordRepeat.$model"
        :class="{ input_border_warning: $v.user.passwordRepeat.$error }"
        type="password"
        placeholder="Şifre Tekrar"
      />
      <template v-if="$v.user.passwordRepeat.$dirty">
        <div v-if="!$v.user.passwordRepeat.required" class="input_warning">
          Şifre Tekrar alanı boş bırakılamaz.
        </div>
        <div
          v-if="!$v.user.passwordRepeat.sameAs"
          class="input_warning">
          Şifre alanları aynı değil.
        </div>
      </template>
      <div v-if="registerWarning" class="register_warning">
        Bir hata oluştu
      </div>
      <button
        @click.prevent="registerPost">
        Kayit Ol
        <!--:class="{ button_disable: $v.$invalid }"-->
      </button>
    </form>
  </div>
</template>

<script>
import {
  required,
  minLength,
  maxLength,
  email,
  sameAs
} from "vuelidate/lib/validators";

export default {
  name: "Register",
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        passwordRepeat: ""
      },
      registerWarning: false
    };
  },
  methods: {
    registerPost() {
      this.$store.dispatch('registerPost', {...this.user})
        .then(res => {
          if (res === false) {
            this.registerWarning = true;
            return 0;
          }

          this.$router.push('anasayfa');
        })
    }
  },
  validations: {
    user: {
      name: {
        required,
        maxLength: maxLength(50)
      },
      email: {
        required,
        email
      },
      password: {
        required,
        minLength: minLength(4)
      },
      passwordRepeat: {
        required,
        sameAs: sameAs("password")
      }
    }
  }
};
</script>

<style scoped>
.register {
  width: 500px;
  margin: 50px auto;
}

.register > .title {
  font-family: "Comfortaa", cursive;
  font-size: 30px;
  text-align: center;
}

.register form {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  flex-wrap: wrap;
  width: 50%;
  margin: 20px auto;
}

.register form input {
  padding: 10px;
  border: 1px solid #e0e0e0;
  border-radius: 3px;
  width: 100%;
  margin-top: 15px;
  font-family: "Quicksand", sans-serif;
  outline: none;
}

.register form .input_warning {
  color: #d41717;
  font-family: "Quicksand", sans-serif;
  font-size: 12px;
  margin-top: 4px;
}

.register form .input_border_warning {
  border-color: #dd1919;
}

.register form input:focus {
  background-color: #fafafa;
}

.register form > .register_warning {
  color: #e71818;
  background-color: #fff4f4;
  border-left: 1px solid #e71818;
  font-family: "Quicksand", sans-serif;
  font-size: 12px;
  padding: 6px;
  width: 100%;
  margin-top: 20px;
}

.register form button {
  width: 100%;
  margin-top: 40px;
  background-color: #189b0b;
  color: white;
  border: 0px;
  border-radius: 3px;
  padding: 12px 0px;
  font-family: "Comfortaa", cursive;
  cursor: pointer;
  transition: 0.3s;
}

.register form button:hover {
  background-color: #1ca90e;
  transform: translateY(-2px);
}

.register form > .button_disable {
  background-color: #aaaaaa;
  color: #878787;
  pointer-events: none;
}
</style>
