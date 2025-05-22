<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();

const postId = route.params.id;
const state = reactive({
  post: {}
});

onMounted(async () => {
  try {
    const response = await axios.get(`http://localhost/belajar-api/get-all-data.php?id=${postId}`);
    console.log(response.data);
    state.post = response.data;
  } catch (error) {
    console.log("Error while fetching: ", error);
  }
});
</script>

<template>
  <div class="center-container">
    <h1>🎉 Profil Super Rahasia 🎀</h1>
    <div class="post-card">
      <p><strong>👩 Namamu:</strong> {{ state.post.student_name }}</p>
      <p><strong>📟 Nomor Absen:</strong> {{ state.post.student_no }}</p>
      <p><strong>🏫 Kelasmu:</strong> {{ state.post.student_class }}</p>
    </div>
    <RouterLink :to="`/posts`" class="btn-pink">🔙 Kembali!</RouterLink>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap');

* {
  font-family: 'Comic Neue', cursive;
  box-sizing: border-box;
}

.center-container {
  max-width: 500px;
  margin: 40px auto;
  padding: 30px;
  background-color: #ffe6f0;
  border-radius: 16px;
  box-shadow: 0 10px 20px rgba(255, 105, 180, 0.3);
  text-align: center;
}

h1 {
  color: #d63384;
  margin-bottom: 25px;
  font-size: 26px;
}

.post-card {
  background-color: #fff5fa;
  padding: 20px;
  border-radius: 12px;
  border: 2px dashed #f06292;
  margin-bottom: 20px;
  color: #555;
  text-align: left;
  font-size: 18px;
}

p {
  margin: 10px 0;
}

.btn-pink {
  background-color: #f06292;
  color: white;
  text-decoration: none;
  padding: 10px 20px;
  border-radius: 12px;
  font-weight: bold;
  display: inline-block;
  transition: background 0.3s;
}

.btn-pink:hover {
  background-color: #ec407a;
}
</style>
