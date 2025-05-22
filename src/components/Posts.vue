<!-- eslint-disable vue/multi-word-component-names -->
<script setup>
import { onMounted, reactive } from 'vue';
import { RouterLink, useRouter } from 'vue-router';
import axios from 'axios';
import Post from '@/components/Post.vue';

const router = useRouter();
const state = reactive({
    posts: []
})

const handleLogout = () => {
    // Konfirmasi sebelum logout
    if (confirm('Apakah Anda yakin ingin logout?')) {
        // Hapus data user dari localStorage
        localStorage.removeItem('user');
        // Redirect ke halaman home
        router.push('/');
    }
};

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost/belajar-api/get-all-data.php');
    state.posts = response.data;
  } catch (error) {
    console.error('Error fetching posts:', error);
  }
});
</script>

<template>
    <div class="center-container">
        <h1>Semua Postingan</h1>
        <div class="buttons-container">
            <button @click="handleLogout" class="btn btn-pink">Logout 🚪</button>
            <RouterLink :to="`/posts/add`" class="btn btn-green">Tambahkan Postingan ✨</RouterLink>
        </div>
        <br />
        <table id="posts">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nomor</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <Post v-for="post in state.posts" :key="post.student_id" :post="post" />
            </tbody>
        </table>
    </div>
</template>

<style scoped>
/* Modern font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

* {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Background and layout adjustments */
body {
  background-color: #fce4ec; /* Pink pastel background */
  padding: 0 10px;
}

/* Centered container */
.center-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  background-color: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

h1 {
  text-align: center;
  color: #333;
  margin-bottom: 20px;
  font-size: 2rem;
  font-weight: 600;
}

/* Buttons container */
.buttons-container {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
  gap: 15px;
}

/* Button styles */
.btn {
  padding: 12px 24px;
  font-size: 16px;
  border-radius: 8px;
  font-weight: 600;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  display: inline-block;
  line-height: 1.2;
  border: none;
}

/* Pink button (now for logout) */
.btn-pink {
  background-color: #f8bbd0;
  color: #d81b60;
}

.btn-pink:hover {
  background-color: #f06292;
  color: #fff;
}

/* Green button */
.btn-green {
  background-color: #a5d6a7; /* Pastel green */
  color: #388e3c;
  border: none;
}

.btn-green:hover {
  background-color: #81c784;
  color: #fff;
}

/* Table style */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

table th,
table td {
  padding: 14px;
  text-align: center;
  font-size: 15px;
  color: #333;
}

table th {
  background-color: #f1c6d4; /* Light pink */
  color: #333;
}

table tr {
  border-bottom: 1px solid #e5e7eb;
}

table tr:hover {
  background-color: #fce4ec; /* Soft pink on hover */
}

table tbody {
  background-color: #ffffff;
}

/* Styling the Post component (make sure your Post.vue style matches) */
.post {
  background-color: #fafafa;
  padding: 12px;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
  margin-bottom: 10px;
}

.post:hover {
  background-color: #f1f5f9;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Responsiveness for smaller screens */
@media (max-width: 768px) {
  .center-container {
    padding: 10px;
  }

  .btn {
    padding: 10px 18px;
    font-size: 14px;
  }

  table th, table td {
    font-size: 14px;
    padding: 10px;
  }
}
</style>
