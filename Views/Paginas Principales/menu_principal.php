<nav
      class="navbar navbar-expand-lg fixed-top d-flex clean-navbar"
      style="border-color: rgb(37, 113, 188); background: rgb(217, 220, 189)"
    >
      <div class="container">
        <a
          class="navbar-brand text-start d-flex logo"
          href="index_prin.html"
          style="
            color: #587a2e;
            text-align: left;
            padding-top: 0px;
            padding-bottom: 0px;
            margin-right: 0px;
          "
          >&nbsp;
          <img
            src="../assets/img/Logo%20Yesid.svg"
            width="65"
            height="34"
          />&nbsp;<strong>S@télite Comunic@ciones</strong></a
        ><button
          data-bs-toggle="collapse"
          class="navbar-toggler"
          data-bs-target="#navcol-1"
          id="menu"
        >
          <span class="visually-hidden">Toggle navigation</span
          ><span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"></li>
            <li class="nav-item dropdown">
              <a
                class="dropdown-toggle nav-link"
                aria-expanded="false"
                data-bs-toggle="dropdown"
                href="#"
                style="color: #587a2e; font-size: 15.8px; font-weight: bold"
                >Productos</a
              >
              <?php
              // Database connection
              $servername = "localhost";
              $username = "root";
              $password = "586226";
              $dbname = "proyecto1";

              $conn = new mysqli($servername, $username, $password, $dbname);

              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              // Fetch categories from the database
              $sql = "SELECT nombre FROM categorias";
              $result = $conn->query($sql);
              ?>
              <div class="dropdown-menu" style="background: #d9dcbd">
                <?php
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '<a class="dropdown-item" href="../Categorias/categoria_prod.php?categoria=' . urlencode($row['nombre']) . '" style="color: #587a2e"><strong>' . htmlspecialchars($row['nombre']) . '</strong></a>';
                  }
                } else {
                  echo '<a class="dropdown-item" href="#" style="color: #587a2e"><strong>No categories available</strong></a>';
                }
                $conn->close();
                ?>
              </div>
            </li>
          </ul>
          <a
            style="color: #0b0b0b; font-size: 15.8px"
            href="../../Admin/Menú/login.html"
            ><i
              class="fa fa-user-circle-o"
              style="font-size: 30px; color: #587a2e"
            ></i><label for="text" style="margin-left: 2px">Iniciar Sesión</label>
          </a>
        </div>
      </div>
    </nav>