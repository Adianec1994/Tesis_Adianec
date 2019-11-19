<template>
  <v-layout row>
    <v-flex
      xs12
      sm8
      offset-sm2
      lg4
      offset-lg4
    >
      <v-card>
        <progress-bar :show="form.busy"></progress-bar>
        <form
          @submit.prevent="register"
          @keydown="form.onKeydown($event)"
        >
          <v-card-title primary-title>
            <h3 class="headline mb-0">Registrar nuevo usuario</h3>
          </v-card-title>
          <v-card-text>

            <!-- Name -->
            <text-input
              :form="form"
              :label="'Nombre y Apellidos'"
              :v-errors="validationErrors"
              :value.sync="form.name"
              browser-autocomplete="name"
              counter="60"
              name="name"
              v-validate="'required|max:60|alpha_spaces'"
            ></text-input>

            <!-- Username -->
            <text-input
              :form="form"
              :label="'Usuario'"
              :v-errors="validationErrors"
              :value.sync="form.username"
              browser-autocomplete="username"
              counter="20"
              name="username"
              v-validate="'required|max:20'"
            ></text-input>

            <!-- Email -->
            <email-input
              :form="form"
              :label="$t('email')"
              :v-errors="validationErrors"
              :value.sync="form.email"
              name="email"
              v-validate="'required|email'"
            ></email-input>

            <!-- Entidades -->
            <select-input
              :form="form"
              :items="entidades"
              :value.sync="form.entidad"
              :v-errors="validationErrors"
              :label="'Entidad'"
              :itemText="'nombre'"
              :itemValue="'id'"
              name="entidad"
              v-validate="'required'"
            ></select-input>

            <!-- Cargo -->
            <select-input
              :form="form"
              :items="roles"
              :value.sync="form.cargo"
              :v-errors="validationErrors"
              :label="'Cargo'"
              :itemText="'name'"
              :itemValue="'name'"
              name="cargo"
              v-validate="'required'"
            ></select-input>

            <!-- Password -->
            <password-input
              :form="form"
              :hint="$t('password_length_hint')"
              :v-errors="validationErrors"
              :value.sync="form.password"
              browser-autocomplete="new-password"
              v-on:eye="eye = $event"
              name="password"
              ref="password"
              v-validate="'required|min:8|max:30'"
            ></password-input>

            <!-- Password Confirmation -->
            <password-input
              :form="form"
              :hide="eye"
              :label="$t('confirm_password')"
              :v-errors="validationErrors"
              :value.sync="form.password_confirmation"
              browser-autocomplete="new-password"
              data-vv-as="password"
              hide-icon="true"
              name="password_confirmation"
              v-validate="'required|confirmed:password'"
            ></password-input>

          </v-card-text>

          <v-card-actions>
            <submit-button
              :form="form"
              :label="$t('registrar')"
            ></submit-button>
          </v-card-actions>
        </form>
      </v-card>
    </v-flex>
  </v-layout>

</template>

<script>
import Form from 'vform'
import axios from 'axios'

export default {
  name: 'register-view',
  metaInfo () {
    return { title: this.$t('register') }
  },

  data: () => ({
    form: new Form({
      name: '',
      username: '',
      email: '',
      entidad: '',
      cargo: '',
      password: '',
      password_confirmation: ''
    }),
    roles: [],
    entidades: [],
    eye: true
  }),

  async mounted () {
    let response = await axios.get('/api/rol')
    this.roles = response.data

    response = await axios.get('/api/entidad')
    this.entidades = response.data
  },

  methods: {
    async register () {
      if (await this.formHasErrors()) return

      // Register the user.
      await this.form.post('/api/register').then(result => {
        this.$store.dispatch('responseMessage', {
          type: result.status === 201 ? 'success' : 'error',
          text: result.status === 201 ? 'Ahora debe esperar que el administrador apruebe su usuario antes de poder loguearse.' : `Ocurrió un problema en el registro. Por favor, vuelva a intentarlo más tarde.`,
          title: result.status === 201 ? 'Usuario creado correctamente' : 'Error al registrar usuario',
          modal: true
        })
      })

      // // Log in the user.
      // const { data: { token }} = await this.form.post('/api/login')

      // // Save the token.
      // this.$store.dispatch('saveToken', { token })

      // // Update the user.
      // await this.$store.dispatch('updateUser', { user: data })

      // // Redirect home.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>
