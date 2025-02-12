<template>
    <ul class="navbar-nav">
     <li class="nav-item">
       <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
       <router-link to="/" class="nav-link">Home</router-link>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <button class="nav-link" @click="logout">Logout</button>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
       <router-link to="/dashboard" class="nav-link">{{ user?.name }}</router-link>
     </li>
   </ul>
</template>
<script>
    import { mapState } from 'vuex';
    import { toast } from 'vue3-toastify';
    import 'vue3-toastify/dist/index.css';
    export default {
        computed: {
           ...mapState(['isAuthenticated', 'user']),
        },
        methods: {
            logout() {
                this.$store.dispatch('logout');
                toast("Logout Successful", {
                    "theme": "auto",
                        "type": "success",
                        "transition": "bounce",
                        "dangerouslyHTMLString": true
                    });
                setTimeout(() => {
                    this.$router.push('/login');
                }, 1000);
            },
        },
        created(){
            if(!this.user){
                this.$store.dispatch('fetchUser');
            }
        }
    }
</script>
