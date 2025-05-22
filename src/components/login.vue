<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 to-purple-600 p-4">
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-6 space-y-6">
      <h1 class="text-2xl font-bold text-center text-gray-800">Login</h1>
      
      <div v-if="errorMessage" class="text-red-500 text-sm text-center">{{ errorMessage }}</div>
      <div v-if="successMessage" class="text-green-500 text-sm text-center">{{ successMessage }}</div>

      <form @submit.prevent="handleLogin" class="space-y-4">
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <input v-model="username" id="username" type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required />
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input v-model="password" id="password" type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required />
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
          Login
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()
const username = ref('')
const password = ref('')
const errorMessage = ref('')
const successMessage = ref('')

const handleLogin = async () => {
  errorMessage.value = ''
  successMessage.value = ''

  try {
    const response = await axios.post('http://localhost/belajar-api/login.php', {
      username: username.value,
      password: password.value
    }, {
      headers: {
        'Content-Type': 'application/json'
      }
    })

    if (response.data.status === 'success') {
      successMessage.value = response.data.msg
      // Simpan data user ke localStorage
      localStorage.setItem('user', JSON.stringify(response.data.user))
      // Redirect ke halaman home
      router.push('/posts')
    } else {
      errorMessage.value = response.data.msg || 'Invalid username or password'
    }
  } catch (error) {
    console.error('Login error:', error)
    if (error.code === 'ERR_NETWORK') {
      errorMessage.value = 'Cannot connect to server. Please check if the server is running.'
    } else if (error.response) {
      errorMessage.value = error.response.data.msg || 'Login failed. Please try again.'
    } else {
      errorMessage.value = 'An unexpected error occurred. Please try again.'
    }
  }
}
</script>

<style scoped>
/* Tambahan opsional untuk animasi ringan */
button {
  transition: background-color 0.3s;
}
</style>
