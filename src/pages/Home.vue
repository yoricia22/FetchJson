<script setup>
import { RouterLink } from 'vue-router';
</script>

<template>
    <div class="center-container">
        <h1>Welcome to Vue Post CRUD tutorial.</h1>
        <RouterLink :to="`/login`" class="btn btn-green">Login</RouterLink>
    </div>
</template>

<style scoped>
.center-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    text-align: center;
    padding: 20px;
}

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

.btn-green {
    background-color: #a5d6a7;
    color: #388e3c;
}

.btn-green:hover {
    background-color: #81c784;
    color: #fff;
}
</style>