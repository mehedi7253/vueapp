<template>

 <div class="preloader flex-column justify-content-center align-items-center ">
   <img class="animation__wobble" src="backend/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
 </div>

    <span v-if="this.$store.state.isAuthenticated">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <NavBar/>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="backend/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <SideBar/>
        </div>
        <!-- /.sidebar -->
        </aside>
    </span>
    <div class="content-wrapper">
        <RouterView></RouterView>
    </div>

    <footer class="main-footer" v-if="this.$store.state.isAuthenticated">
    <Footer/>
    </footer>
</template>


<script>
    import NavBar from './components/layouts/Nav.vue';
    import Footer from './components/layouts/Footer.vue';
    import SideBar from './components/layouts/Sidebar.vue';

    export default {
        name: "App",
        components: {NavBar, Footer, SideBar},
    }

</script>
