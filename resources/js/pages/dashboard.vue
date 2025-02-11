<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-header">
                       Dashboard
                    </div>
                    <div class="card-body">
                        {{ this.$store.state.isAuthenticated  }}
                        <h1>Welcome to {{ user.name }}</h1>
                        <button class="btn btn-danger" @click="logout">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapState, mapGetters } from 'vuex';
    import { toast } from 'vue3-toastify';
    import 'vue3-toastify/dist/index.css';
    export default {
        computed:{
            ...mapState(['user']),
            // isAuthenticated(){
            //     return this.$store.state.isAuthenticated
            // },
            // authToken(){
            //     return this.$store.state.token
            // }
        },
        // mounted(){
        //     this.$store.dispatch('checkUserAuthenticationStatus')
        // },
        methods:{
            logout(){
            axios.post('api/logout')
            .then(response => {
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
                })
                .catch(error => {
            });
            }
        },
        created(){
            this.$store.dispatch('fetchUser');
        }


    }
</script>
