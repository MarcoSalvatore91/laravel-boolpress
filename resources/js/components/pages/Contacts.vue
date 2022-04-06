<template>
  <section id="contacts" class="container">
      <h1>Contattaci</h1>

      <Loader v-if='isLoading'/>

      <div v-else>

        <div v-if="successMessage" class="alert alert-primary" role="alert">
          {{ successMessage }}
        </div>

        <div v-else-if="hasErrorsMessage" class="alert alert-danger" role="alert">
          <li v-for="(error, key) in errorsMessage" :key="key">{{ error }}</li>
        </div>

        <div class="contact-form">
          <div class="form-group">
            <label for="email">Email</label>
            <input :class="{'is-invalid': errorsMessage.email}" type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="form.email">
            <small id="emailHelp" class="form-text text-muted">Inserisci una e-mail valida.</small>
          </div>

          <div class="form-group">
            <div class="form-group">
              <label for="message">Example textarea</label>
              <textarea :class="{'is-invalid': errorsMessage.message}" class="form-control" id="message" rows="10" v-model="form.message"></textarea>
              <small id="emailHelp" class="form-text text-muted">Inserisci il contenuto del messaggio.</small>
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button class="btn btn-primary" @click='sendForm'>Invia</button>
          </div>

        </div>
      </div>
  </section>
</template>

<script>
import Loader from '../Loader.vue';

export default {
name: "Contacts",
components: {
  Loader,
},

data() {
  return {
    form:{
      email: '',
      message: '',
    },
    isLoading: false,
    successMessage: '',
    errorsMessage: {},
  }
},

computed: {
  hasErrorsMessage() {
    return Object.keys(this.errorsMessage).length
  }
},

methods: {

  validateForm() {

    const errors = {};
    if(!this.form.email.trim()) errors.email = 'La mail è obbligatoria';
    if(!this.form.message.trim()) errors.message = 'Il messaggio è obbligatoria';
    if(this.form.message.trim() && !this.form.email.match(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/))errors.email = 'La mail non è valida';
    
    this.errorsMessage = errors;

  },

  sendForm() {

    this.validateForm();

    if(!this.hasErrorsMessage) {

      const params = {
        email: this.form.email,
        message: this.form.message,
      }
      this.isLoading = true;
  
      axios.post('http://localhost:8000/api/messages', params)
      .then(res => {
        this.form.email = '';
        this.form.message = '';
        this.successMessage = 'Email inviata con successo';
      })
      .catch(err => {
        this.errorsMessage = { error: 'Si è verificato un errore' }; 
      })
      .then(() => {
        this.isLoading = false;
      });

    }

  }
}

}
</script>

<style>

</style>