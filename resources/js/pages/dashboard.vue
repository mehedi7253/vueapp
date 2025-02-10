<template>
    <div>
        <h2>Welcome, {{ user.name }}</h2>
        <button @click="logout">Logout</button>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    computed: {
        ...mapState(['user']),
    },
    methods: {
        ...mapActions(['logout']),
        logout() {
            this.logout();
            this.$router.push('/login');
        },
    },
};
</script>
