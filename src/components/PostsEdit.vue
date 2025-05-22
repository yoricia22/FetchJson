<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();
const postId = route.params.id;

const form = reactive({
  student_name: '',
  student_class: '',
  student_no: ''
});

onMounted(async () => {
  try {
    const response = await axios.get(`http://localhost/belajar-api/get-all-data.php?id=${postId}`);
    form.student_name = response.data.student_name;
    form.student_class = response.data.student_class;
    form.student_no = response.data.student_no;
  } catch (error) {
    console.log("Error fetching post", error);
  }
});

const handleSubmit = async () => {
  const updatePost = {
    student_id: postId,
    student_name: form.student_name,
    student_class: form.student_class,
    student_no: form.student_no
  };

  try {
    await axios.put(`http://localhost/belajar-api/update-data.php`, updatePost);
    router.push(`/posts/${postId}`);
  } catch (error) {
    console.error("Error updating post", error);
  }
};
</script>

<template>
  <div class="container">
    <RouterLink to="/posts" class="back-link">← Back to Posts</RouterLink>
    <div class="form-card">
      <h2>Edit Student</h2>
      <form @submit.prevent="handleSubmit">
        <label for="name">Nama</label>
        <input v-model="form.student_name" type="text" id="name" placeholder="Masukkan Nama" required />

        <label for="class">Kelas</label>
        <input v-model="form.student_class" type="text" id="class" placeholder="Masukkan Kelas" required />

        <label for="no">Nomor</label>
        <input v-model="form.student_no" type="text" id="no" placeholder="Masukkan Nomor" required />

        <button type="submit">Update</button>
      </form>
    </div>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap');

* {
  box-sizing: border-box;
  font-family: 'Roboto Mono', monospace;
}

body {
  background-color: #0d1b2a; /* Dark blue black background */
  margin: 0;
  padding: 0;
}

.container {
  padding: 20px;
  min-height: 100vh;
  background: linear-gradient(to bottom, #0d1b2a, #1b263b);
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.back-link {
  color: #a9c1d9;
  text-decoration: none;
  font-weight: bold;
  margin-bottom: 20px;
  transition: color 0.3s ease;
}
.back-link:hover {
  color: #ffffff;
}

.form-card {
  background-color: #1e293b;
  padding: 30px;
  border-radius: 12px;
  width: 100%;
  max-width: 500px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.25);
  color: #e0f2f1;
}

h2 {
  text-align: center;
  margin-bottom: 25px;
  color: #7dd3fc; /* Light cyan-blue */
}

form {
  display: flex;
  flex-direction: column;
}

label {
  margin-bottom: 6px;
  color: #cbd5e1;
  font-size: 14px;
}

input {
  padding: 10px 12px;
  margin-bottom: 20px;
  border-radius: 6px;
  border: 1px solid #334155;
  background-color: #0f172a;
  color: #e0f2f1;
  font-size: 16px;
}

input::placeholder {
  color: #64748b;
}

button {
  padding: 12px;
  border: none;
  border-radius: 8px;
  background-color: #2563eb; /* Blue primary */
  color: white;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #1e40af; /* Darker blue on hover */
}

/* Responsive */
@media (max-width: 600px) {
  .form-card {
    padding: 20px;
  }

  input, button {
    font-size: 15px;
  }

  h2 {
    font-size: 20px;
  }
}
</style>