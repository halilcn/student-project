<template>
  <div class="login">
    <slot></slot>
    <div class="title">
      Giriş Yap
    </div>
    <form>
      <input
        v-model.trim="$v.user.email.$model"
        :class="{ input_border_warning: $v.user.email.$error }"
        placeholder="E-mail"
        type="text"
        name="email"
      />
      <template v-if="$v.user.email.$dirty">
        <div class="input_warning" v-if="!$v.user.email.required">
          E-mail boş bırakılamaz.
        </div>
        <div class="input_warning" v-if="!$v.user.email.email">
          Geçersiz E-mail.
        </div>
      </template>

      <input
        v-model.trim="$v.user.password.$model"
        :class="{ input_border_warning: $v.user.password.$error }"
        placeholder="Şifre"
        type="password"
        name="password"
      />
      <template v-if="$v.user.password.$dirty">
        <div class="input_warning" v-if="!$v.user.password.required">
          Şifre alanı boş bırakılamaz.
        </div>
        <div v-if="formWarning" class="login_warning">
          Şifre veya E-mail yanlış.
        </div>
      </template>
      <button
        :class="{ button_disable: $v.$invalid }"
        @click.prevent="loginPost">
        Giriş Yap
      </button>
    </form>
    <div class="register_link">
      <router-link
        tag="a"
        to="/kayit">
        Kayıt Ol
      </router-link>
    </div>
  </div>
</template>

<script>
import {required, email} from "vuelidate/lib/validators";

export default {
  name: "Login",
  data() {
    return {
      user: {
        email: "",
        password: ""
      },
      formWarning: false
    };
  },

  methods: {
    loginPost() {
      this.$store.dispatch('loginPost', {...this.user})
        .then(res => {
          if (res === false) {
            this.formWarning = true;
            return 0;
          }

          this.$router.push('/anasayfa');
        })
    }
  },
  validations: {
    user: {
      email: {
        required,
        email
      },
      password: {
        required
      }
    }
  }
};
</script>

<style scoped>
.login {
  width: 500px;
  margin: 50px auto;
}
.login > .title {
  font-family: "Comfortaa", cursive;
  font-size: 30px;
  text-align: center;
}

.login form {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  flex-wrap: wrap;
  width: 50%;
  margin: 30px auto;
}

.login form input {
  padding: 10px;
  border: 1px solid #e0e0e0;
  border-radius: 3px;
  width: 100%;
  margin-top: 15px;
  font-family: "Quicksand", sans-serif;
  outline: none;
}

.login form .input_border_warning {
  border-color: #dd1919;
}

.login form input:focus {
  background-color: #fafafa;
}

.login form .input_warning {
  color: #d41717;
  font-family: "Quicksand", sans-serif;
  font-size: 12px;
  margin-top: 4px;
}

.login form > .login_warning {
  color: #e71818;
  background-color: #fff4f4;
  border-left: 1px solid #e71818;
  font-family: "Quicksand", sans-serif;
  font-size: 12px;
  padding: 6px;
  width: 100%;
  margin-top: 20px;
}

.login form button {
  width: 100%;
  margin-top: 30px;
  background-color: #189b0b;
  color: white;
  border: 0px;
  border-radius: 3px;
  padding: 14px 8px;
  font-family: "Comfortaa", cursive;
  cursor: pointer;
  transition: 0.3s;
}

.login form button:hover {
  background-color: #1ca90e;
  transform: translateY(-2px);
}

.login form > .button_disable {
  background-color: #aaaaaa;
  color: #878787;
  pointer-events: none;
}

.login .register_link {
  text-align: center;
  margin-top: 40px;
  font-family: 'Comfortaa', cursive;
}

.login .register_link a {
  color: #343434;
}

.login .register_link a:hover {
  text-decoration: underline;
}
</style>
