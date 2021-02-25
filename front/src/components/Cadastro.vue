<template>
  <main role="main" >
    <div class="container">
            
      <div class="jumbotron" v-if="load">
        <h1> Cadastro </h1>

        <ValidationObserver ref="observer" v-slot="{ handleSubmit }">
          <form @submit.prevent="handleSubmit(save)">

            <div class="form-group">
              <label for="author">Nome</label>
              <ValidationProvider rules="required|min:3|max:100" v-slot="{ errors }">
                <input type="text" class="form-control" id="author" name="author" placeholder="Preencha o nome do Autor" v-model="author">
                <span class="error">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>

            <div class="form-group">
              <label for="title">Título</label>
              <ValidationProvider rules="required|min:5|max:100" v-slot="{ errors }">
                <input type="text" class="form-control" id="title" name="title" placeholder="Informe o título" v-model="title">
                <span class="error">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>

            <div class="form-group">
              <label for="email">E-mail</label>
              <ValidationProvider rules="required|email|min:6|max:255" v-slot="{ errors }">
                <input type="email" class="form-control" id="email" name="email" placeholder="Informe o e-mail" v-model="email">
                <span class="error">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>

            <div class="form-group">
              <label for="phone">Telefone</label>
              <ValidationProvider :rules="{ max:'20', required:'required', regex: /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/ }" v-slot="{ errors }">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Informe o telefone" v-model="phone">
                <span class="error">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>

            <div class="form-group">
              <label for="text">Mensagem</label>
              <ValidationProvider rules="required|min:10|max:255" v-slot="{ errors }">
                <textarea class="form-control" id="text" name="text" placeholder="Mensagem..." v-model="text">
                </textarea>
                <span class="error">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>

            <div class="row justify-content-center mt-5">
              <button type="submit" class="btn btn-dark btn-lg"> Enviar </button>
            </div>
          </form>
        </ValidationObserver>
      </div>

    </div>
  </main>
</template>

<script>
import { ValidationObserver, ValidationProvider } from "vee-validate";
import { BlogService } from '@/services/Blog.service'

export default {
  name: 'Cadastro',

  components: {
    ValidationObserver,
    ValidationProvider
  },

  data () {
    return {
      id: this.$route.params.id,
      load: false,
      author: null,
      title: null,
      email: null,
      phone: null,
      text: null
    }
  },

  methods: {

    async save() {
      
      if (this.id == 0) {
        this.new()
      }else{
        this.update()
      }

    },

    async new () {
      
      const { author, title, email, phone, text } = this
      try {
        const { post } = await BlogService.sendPost( author, title, email, phone, text )
        console.log(post)
        this.clear()
        this.message('Cadastro realizado','success')
        this.$router.push({ name: 'home' });

      } catch (e) {
        console.log(e)
        this.message('Erro no cadastro','error')
      }

    },

    async update () {

      const { id, author, title, email, phone, text } = this
      try {
        const { post } = await BlogService.updatePost( id, author, title, email, phone, text )
        console.log(post)
        this.clear()
        this.message('Cadastro atualizado','success')
        this.$router.push({ name: 'home' });

      } catch (e) {
        console.log(e)
        this.message('Erro na atualização','error')
      }

    },

    clear () {
      this.author = null
      this.title = null
      this.email = null
      this.phone = null
      this.text = null
    },

    message (msg, tipo) {

      this.$toast.open({
        message: msg,
        type: tipo,
        position: 'top'
      });

    }

  },

  async mounted () {

    const id = this.$route.params.id
    if (id > 0) {
      
      try {
        let { post } = await BlogService.getPost(id)

        this.author = post.author
        this.title = post.title
        this.email = post.email
        this.phone = post.phone
        this.text = post.text
  
        this.load = true
      } catch (e) {
        console.error(e)
      }

    }else {
      this.load = true
    }

  },

}
</script>



<style scoped>

.error {
  color: red;
} 

</style>

