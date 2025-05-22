<script setup>
import axios from 'axios';
import { reactive } from 'vue';
import router from '@/router';

const form = reactive({
  student_no: '',
  student_name: '',
  student_class: ''
});

const handleSubmit = async () => {
  const newPost = {
    student_no: form.student_no,
    student_name: form.student_name,
    student_class: form.student_class
  };

  try {
    const response = await axios.post('http://localhost/belajar-api/insert-data.php', newPost);
    console.log('Response:', response.data);
    router.push('/posts');
  } catch (error) {
    console.error("Error on posting data:", error);
  }
};
</script>

<template>
  <div class="form-container">
    <RouterLink to="/posts" class="back-link">← Kembali ke Postingan</RouterLink>
    <h2>📝 Tambahkan Postingan Baru</h2>
    <form @submit.prevent="handleSubmit">
      <label for="no">📇 Nomor</label>
      <input v-model="form.student_no" type="number" placeholder="Masukkan nomor absenmu" />

      <label for="name">😊 Nama</label>
      <input v-model="form.student_name" type="text" placeholder="Masukkan nama mu" />

      <label for="class">🏫 Kelas</label>
      <input v-model="form.student_class" type="text" placeholder="Ketik nama kelas" />

      <button type="submit">💖 Kirim!</button>
    </form>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');

* {
  font-family: 'Quicksand', sans-serif;
  box-sizing: border-box;
}

body {
  background-color: #fff0f5;
  margin: 0;
  padding: 0;
}

.form-container {
  max-width: 500px;
  margin: 40px auto;
  background-color: #ffe4ec;
  padding: 30px;
  border-radius: 16px;
  box-shadow: 0 8px 16px rgba(255, 192, 203, 0.3);
  text-align: center;
}

h2 {
  color: #d63384;
  margin-bottom: 25px;
}

label {
  display: block;
  margin-top: 15px;
  margin-bottom: 5px;
  color: #c2185b;
  font-weight: bold;
}

input {
  width: 100%;
  padding: 10px 12px;
  border: 2px solid #f8bbd0;
  border-radius: 8px;
  font-size: 16px;
  background-color: #fffafc;
  margin-bottom: 10px;
  color: #444;
}

input:focus {
  outline: none;
  border-color: #ec407a;
  background-color: #fff0f7;
}

button {
  margin-top: 20px;
  width: 100%;
  padding: 12px;
  background-color: #f06292;
  border: none;
  border-radius: 10px;
  color: white;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}

button:hover {
  background-color: #ec407a;
}

.back-link {
  display: inline-block;
  margin-bottom: 20px;
  color: #d63384;
  font-weight: bold;
  text-decoration: none;
  transition: color 0.3s ease;
}

.back-link:hover {
  color: #ad1457;
}
</style>
