<template>
    <div class="container">
        <router-view></router-view>
        <router-link to="/home">Home</router-link>
        <router-link to="/about">About</router-link>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("App Component mounted.");
    }
};
</script>
