<template>
  <main role="main" >
    <div class="container">
        
      <div class="jumbotron" v-if="load">
          <h1> {{post.title}} </h1>

          <h3> {{post.author}} </h3>
          <p class="lead">{{post.text}}</p>
      </div>

    </div>
  </main>
</template>

<script>
import { BlogService } from '@/services/Blog.service'

export default {
  name: 'post',

  data() {
    return {
        id: this.$route.params.id,
        post: [],
        load: false
    }
  },

  async mounted () {
    const id = this.$route.params.id
    try {
      let { post } = await BlogService.getPost(id)

      this.post = post
      this.load = true

    } catch (e) {
      console.error(e)
    }
  },

}
</script>

<style scoped>

  .main { 
    margin-top: 10rem;
  }

  .main .container{
    margin-right: 16%;
    margin-left: 16%;
    padding: 0;
    width: fit-content;
  }

  .post-card {
    padding-top: 1.4rem;
    padding-left: 6rem;
    padding-right: 6rem;
  }

  .post-card .date-post, .author, .title {
    margin-bottom: 2.4rem;
  }

  .post-card .date-post {
    font-size: .9rem;
    font-style: normal;
    font-weight: normal;
  }

  .post-text {
    background-color: #fff;
    padding: 6rem 12.5rem 10rem 12.5rem;
    margin-bottom: 10rem;
  }

  .post-text p {
    font-size: 1.2rem;
    font-weight: 500;
  }

</style>
