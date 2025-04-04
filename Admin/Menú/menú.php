<nav class="navbar navbar-expand bg-white shadow mb-4 topbar">
    <div class="container-fluid">
        <button
            class="btn btn-link d-md-none rounded-circle me-3"
            id="sidebarToggleTop"
            type="button">
            <i class="fas fa-bars"></i>
        </button>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow">
                    <a
                        class="dropdown-toggle nav-link"
                        aria-expanded="false"
                        data-bs-toggle="dropdown"
                        href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php
                                                                                            echo $_SESSION['user']; ?></span><img
                            class="border rounded-circle img-profile"
                            src="../assets/img/avatars/avatar1.jpeg" /></a>

                    <!-- esto se reeemplazara por los datos del login, queda pendiente -->
                    <div
                        class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                        <a class="dropdown-item" href="../Menú/login.html"><i
                                class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Cerrar Sesión</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>