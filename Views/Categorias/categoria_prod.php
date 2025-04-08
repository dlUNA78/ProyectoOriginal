<!DOCTYPE html>
<html data-bs-theme="light" lang="en" style="background: #abba87">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>About Us1 - Brand</title>
    <meta
      name="description"
      content="Categorias general de productos"
    />
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=ADLaM+Display&amp;display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=AR+One+Sans&amp;display=swap"
    />
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/fonts/simple-line-icons.min.css" />
    <link rel="stylesheet" href="../assets/css/bs-theme-overrides.css" />
    <link
      rel="stylesheet"
      href="../assets/css/Animated-Pretty-Product-List-v12-Animated-Pretty-Product-List.css"
    />
    <link rel="stylesheet" href="../assets/css/baguetteBox.min.css" />
    <link
      rel="stylesheet"
      href="../assets/css/Banner-Heading-Image-images.css"
    />
    <link rel="stylesheet" href="../assets/css/dark_navbar.css" />
    <link
      rel="stylesheet"
      href="../assets/css/Dark-NavBar-Navigation-with-Button.css"
    />
    <link
      rel="stylesheet"
      href="../assets/css/Dark-NavBar-Navigation-with-Search.css"
    />
    <link
      rel="stylesheet"
      href="../assets/css/Footer---4-Columns---No-Social-Networks.css"
    />
    <link rel="stylesheet" href="../assets/css/Footer-Clean-icons.css" />
    <link
      rel="stylesheet"
      href="../assets/css/multiple-item-carousel-slider.css"
    />
    <link rel="stylesheet" href="../assets/css/vanilla-zoom.min.css" />
  </head>

  <body style="background: #abba87">
  <?php
    include 'C:\Git\GitHub\ProyectoOriginal\ProyectoWeb-main\ProyectoWeb-main\ProyectoOriginal\Views\Paginas Principales\menu_principal.php';
    ?>
    <main class="page">
      <section
        class="clean-block"
        style="background: #d9dcbd; height: 181.15px"
      >
        <div class="container">
          <div class="block-heading">
            <h2
              style="
                border-color: #587a2e;
                border-top-color: rgb(59, 153, 224);
                border-right-color: rgb(59, 153, 224);
                border-bottom-color: rgb(59, 153, 224);
                border-left-color: rgb(59, 153, 224);
                color: #587a2e;
                font-family: 'ADLaM Display', serif;
              "
            >
              <?php
                $categoria = isset($_GET['categoria']) ? htmlspecialchars($_GET['categoria']) : 'Categoria no especificada';
                echo $categoria;
              ?>
            </h2>
          </div>
        </div>
      </section>
    </main>
    <div class="container" style="background: #abba87; margin-top: 38px">
      <div class="row product-list dev">
        <div
          class="col-sm-6 col-md-4 m-auto product-item animation-element slide-top-left"
          style="border-radius: 43px"
        >
          <a class="text-decoration-none m-auto" href="product_1.html">
            <div class="product-container" style="border-radius: 20px">
              <div class="row">
                <div
                  class="col-md-12 offset-lg-0 offset-xl-1 d-flex justify-content-center align-items-center"
                  style="width: 270px"
                >
                  <img
                    class="img-fluid d-flex float-start m-auto"
                    src="../assets/img/avatars/DSC_6469.webp"
                    style="width: 270px; text-align: center"
                  />
                </div>
              </div>
              <div class="row">
                <div
                  class="col-8 col-lg-10 col-xl-8 offset-lg-0 offset-xl-1"
                  style="text-align: center; width: 190px"
                >
                  <h2 style="color: rgb(0, 0, 0); text-align: center">
                    Piedras para molino
                  </h2>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <p class="product-description" style="text-align: justify">
                    Juego de piedras de 4 pulgadas fabricadas en piedra volcánica, ideales para moler maíz y otros granos.
                    Su material garantiza un molido fino y homogéneo.

                  </p>
                  <div class="row">
                    <div
                      class="col-6 offset-lg-3 offset-xl-3"
                      style="text-align: center"
                    >
                      <p class="product-price" style="text-align: center">
                        $599.00
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        
        
          </a>
        </div>
      </div>
    </div>
    <footer
      class="text-center py-4"
      style="background: #d9dcbd; margin-top: 38px"
    >
      <div class="container">
        <div class="row row-cols-1 row-cols-lg-3">
          <div class="col">
            <p class="my-2" style="font-size: 19px; color: rgb(88, 122, 46)">
              <i
                class="icon-location-pin"
                style="font-weight: bold; font-size: 25px"
              ></i
              >&nbsp; AV. Álvaro obregón N.- 1796
            </p>
          </div>
          <div class="col">
            <p class="my-2" style="font-size: 19px; color: rgb(88, 122, 46)">
              <i
                class="icon-screen-smartphone"
                style="
                  color: rgb(88, 122, 46);
                  font-size: 25px;
                  font-weight: bold;
                "
              ></i
              >&nbsp; 453-537-06-03
            </p>
          </div>
          <div class="col">
            <p class="my-2" style="color: rgb(88, 122, 46); font-size: 19px">
              <i
                class="icon-envelope"
                style="
                  color: rgb(88, 122, 46);
                  font-size: 25px;
                  font-weight: bold;
                "
              ></i
              >&nbsp; yesid_amale@hotmail.com
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <p class="my-2" style="font-size: 19px; color: rgb(88, 122, 46)">
            <strong
              >TECNM Campus Coalcomán Ingeniería en Sistemas Computacionales 6º
              Semestre-2025&nbsp;&nbsp;</strong
            >
          </p>
        </div>
      </div>
    </footer>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/baguetteBox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/multiple-item-carousel-slider-multiple-item-carousel-slider-bootstrap.min.js"></script>
    <script src="../assets/js/vanilla-zoom.js"></script>
    <script src="../assets/js/multiple-item-carousel-slider-multiple-item-carousel-slider-slider.js"></script>
    <script src="../assets/js/Theme_Prin.js"></script>
    <script src="../assets/js/Animated-Pretty-Product-List-v12-Animated-Pretty-Product-List.js"></script>
  </body>
</html>
