<!-- eslint-disable vue/multi-word-component-names -->
<script setup>
import axios from 'axios';
import { defineProps } from 'vue';
import { RouterLink, useRouter } from 'vue-router';

const router = useRouter();

const props = defineProps({
    post: Object
});

const deletePost = async (postId) => {
    try {
        const confirmDelete = window.confirm('Are you sure you want to delete this post?');
        if (confirmDelete) {
            await axios.delete(`http://localhost/belajar-api/delete-data.php?student_id=${postId}`);
            router.push('/');
        }
    } catch (error) {
        console.error("Error deleting post: ", error);
    }
}
</script>

<template>
  <tr>
    <td>{{ post.student_id }}</td>
    <td>{{ post.student_no }}</td>
    <td>{{ post.student_name }}</td>
    <td>{{ post.student_class }}</td>
    <td class="action-buttons">
      <RouterLink :to="`/posts/${post.student_id}`" class="btn btn-view" title="View">👁️</RouterLink>
      <RouterLink :to="`/posts/edit/${post.student_id}`" class="btn btn-edit" title="Edit">✏️</RouterLink>
      <button @click="deletePost(post.student_id)" class="btn btn-delete" title="Delete">🗑️</button>
    </td>
  </tr>
</template>

<style scoped>
/* Modern font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

* {
  font-family: 'Poppins', sans-serif;
  transition: all 0.2s ease-in-out;
}

body {
  background-color: #f9fafb; /* Soft background color */
  margin: 0;
  padding: 0;
}

/* Table style */
table {
  width: 100%;
  border-collapse: collapse;
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  overflow: hidden;
  margin-top: 20px;
}

td {
  padding: 16px;
  text-align: center;
  font-size: 15px;
  color: #333;
}

tr {
  border-bottom: 1px solid #e5e7eb;
}

tr:hover {
  background-color: #fce4ec; /* Soft pink on hover */
}

/* Action buttons */
.action-buttons {
  display: flex;
  justify-content: center;
  gap: 8px;
}

/* Button styles */
.btn {
  padding: 10px 15px;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  border: none;
  cursor: pointer;
  text-decoration: none;
  display: inline-block;
  line-height: 1;
  transition: background-color 0.3s ease;
}

/* View Button */
.btn-view {
  background-color: #f8bbd0; /* Soft pink */
  color: #d81b60; /* Dark pink text */
}
.btn-view:hover {
  background-color: #f06292; /* Darker pink on hover */
  color: white;
}

/* Edit Button */
.btn-edit {
  background-color: #81d4fa; /* Soft blue */
  color: #0288d1; /* Dark blue text */
}
.btn-edit:hover {
  background-color: #4fc3f7; /* Blue hover */
  color: white;
}

/* Delete Button */
.btn-delete {
  background-color: #ffebee; /* Soft red */
  color: #c62828; /* Dark red text */
}
.btn-delete:hover {
  background-color: #ffcdd2; /* Lighter red on hover */
  color: white;
}
</style>
