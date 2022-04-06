<template>
  <section id="contacts" class="container">
      <h1>Contattaci</h1>
      <div v-if="alertMessage" class="alert alert-primary" role="alert">
        {{ alertMessage }}
      </div>
      <div class="contact-form">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="form.email">
          <small id="emailHelp" class="form-text text-muted">Inserisci una e-mail valida.</small>
        </div>

        <div class="form-group">
          <div class="form-group">
            <label for="message">Example textarea</label>
            <textarea class="form-control" id="message" rows="10" v-model="form.message"></textarea>
            <small id="emailHelp" class="form-text text-muted">Inserisci il contenuto del messaggio.</small>
          </div>
        </div>

        <div class="d-flex justify-content-end">
          <button class="btn btn-primary" @click='sendForm'>Invia</button>
        </div>

      </div>
  </section>
</template>

<script>
export default {
name: "Contacts",

data() {
  return {
    form:{
      email: '',
      message: '',
    },
    alertMessage: '',
  }
},

methods: {
  sendForm() {
    const params = {
      email: this.form.email,
      message: this.form.message,
    }

    axios.post('http://localhost:8000/api/messages', params)
    .then(res => {
      this.form.email = '';
      this.form.message = '';
      this.alertMessage = 'Email inviata con successo';
    })
    .catch(err => {})
    .then(() => {});
  }
}

}
</script>

<style>

</style>