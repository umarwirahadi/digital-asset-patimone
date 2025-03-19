<!--end::Sidebar Wrapper-->
<div class="sidebar-wrapper">
    <nav class="mt-2">
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-speedometer"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-database"></i>
                    <p>
                        Database
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-arrow-right"></i>
                            <p>Asset</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link">   
                            <i class="nav-icon bi bi-arrow-right"></i>
                            <p>Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-arrow-right"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="{{ route('package.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-arrow-right"></i>
                            <p>Package</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-clipboard-fill"></i>
                    <p>
                        Consumable
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../layout/unfixed-sidebar.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Request</p>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a href="../layout/logo-switch.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Sidebar Mini <small>+ Logo Switch</small></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../layout/layout-rtl.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Layout RTL</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-tree-fill"></i>
                    <p>
                        Assets
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('product.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../UI/general.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Procurement</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../UI/icons.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Distribution</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../UI/timeline.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>DO</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi-file-earmark-word"></i>
                    <p>
                        Report
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../forms/general.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>General Elements</p>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        <!--end::Sidebar Menu-->
    </nav>
</div>