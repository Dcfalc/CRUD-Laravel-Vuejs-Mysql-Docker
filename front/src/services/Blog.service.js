import { config } from './config'

import axios from 'axios'

export const BlogService = {
  getPosts,
  getPost,
  sendPost,
  updatePost,
  deletePost
}

function getPosts () {
  const options = {
    url: `${config.apiUrl}/posts`,
    method: 'GET',
    headers: { 
      'Accept': 'application/json',
      'Content-Type': 'application/json;charset=UTF-8',
    }
  }

  return axios(options)
    .then(response => {
      if (response.data.posts) {
        return response.data
      }
      return false
    }, error => {
      console.log(error);
      // return false
      throw new Error(error)
    })
}

function sendPost ( author, title, email, phone, text ) {

  const options = {
    url: `${config.apiUrl}/posts`,
    method: 'POST',
    headers: { 
      'Accept': 'application/json',
      'Content-Type': 'application/json;charset=UTF-8',
    },
    data: {
      author,
      title,
      email,
      phone,
      text
    },
  }

  return axios(options)
    .then( response => {
      //console.log(response);
      if (response.status == 201) {
        return response.data
      }
      throw new Error('Erro no envio')
    }
    ).catch( e => {
      console.log(e.response.data.error);
      throw new Error(e.response.data.error)
    })
}

function getPost (id) {
  const options = {
    url: `${config.apiUrl}/posts/${id}`,
    method: 'GET',
    headers: { 
      'Accept': 'application/json',
      'Content-Type': 'application/json;charset=UTF-8',
    }
  }

  return axios(options)
    .then(response => {
      if (response.data.post) {
        return response.data
      }
      return false
    }, error => {
      console.log(error);
      // return false
      throw new Error(error)
    })
}

function updatePost ( id, author, title, email, phone, text ) {

  const options = {
    url: `${config.apiUrl}/posts/${id}`,
    method: 'put',
    headers: { 
      'Accept': 'application/json',
      'Content-Type': 'application/json;charset=UTF-8',
    },
    data: {
      author,
      title,
      email,
      phone,
      text
    },
  }

  return axios(options)
    .then( response => {
      //console.log(response.data);
      if (response.status == 200) {
        return response.data
      }
      throw new Error('Erro no envio')
    }
    ).catch( e => {
      console.log(e.response.data.error);
      throw new Error(e.response.data.error)
    })
}

function deletePost ( id ) {

  const options = {
    url: `${config.apiUrl}/posts/${id}`,
    method: 'delete',
    headers: { 
      'Accept': 'application/json',
      'Content-Type': 'application/json;charset=UTF-8',
    }
  }

  return axios(options)
    .then( response => {
      //console.log(response.data);
      if (response.status == 200) {
        return response.data
      }
      throw new Error('Erro no envio')
    }
    ).catch( e => {
      console.log(e.response.data.error);
      throw new Error(e.response.data.error)
    })
}
