<template>
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block">Alexander Pierce</a>
       </div>
     </div>

     <!-- SidebarSearch Form -->


     <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p> Product <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <router-link to="/add-product" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Product</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/all-product" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage Product</p>
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
     <!-- /.sidebar-menu -->
</template>
