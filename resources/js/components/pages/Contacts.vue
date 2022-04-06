<template>
  <section id="contacts" class="container">
      <h1>Contattaci</h1>
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
          <button class="btn btn-primary">Invia</button>
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
    }
  }
}
}
</script>

<style>

</style>