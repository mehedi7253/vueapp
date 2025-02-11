<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-header">
                       Dashboard
                    </div>
                    <div class="card-body">
                        <h1>Welcome to <b>{{ user.name }}</b></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapState } from 'vuex';
    export default {
        computed:{
            ...mapState(['user']),
        },
        created(){
            this.$store.dispatch('fetchUser');
        }


    }
</script>
