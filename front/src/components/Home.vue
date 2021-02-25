<template>
    <main role="main" >
        <div class="container">
            
            <div class="jumbotron"  v-for="(post, index) in this.posts" v-bind:value="post" :key="index">
                <h1> {{post.title}} </h1>

                <h3> {{post.author}} </h3>
                <p class="lead">{{post.text}}</p>

                <router-link :to="{ name : 'post', params: { id: post.id} }" :class="'btn btn-primary mr-3'">
                    Ver todo texto
                </router-link>

                <router-link :to="{ name : 'cadastro', params: { id: post.id} }" :class="'btn btn-primary mr-3'">
                    Alterar
                </router-link>

                <a href="#" @click="delPost(post.id)" class="btn btn-primary mr-3"> Deletar </a>
            </div>

        </div>
    </main>
</template>

<script>
import { BlogService } from '@/services/Blog.service'

export default {
  name: 'Home',

//   components: {
//     'post-card' : PostCard
//   },

  data () {
    return {
      posts: [],
    }
  },

  async mounted () {
    try {
      const { posts } = await BlogService.getPosts()

      this.posts = posts

    } catch (e) {
      console.error(e)
    }
  },


  methods: {

    async delPost (id) {

        try {
            const { post } = await BlogService.deletePost( id )
            console.log(post)
            this.posts = this.posts.filter(item => { return item.id != id })
            this.message('Cadastro deletado','success')
        } catch (e) {
            console.log(e)
            this.message('Erro ao deletar','error') 
        }
        
    },

    message (msg, tipo) {

        this.$toast.open({
        message: msg,
        type: tipo,
        position: 'top'
        });

    }

  }

}
</script>

<style>


</style>

