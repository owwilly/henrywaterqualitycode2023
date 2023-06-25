<?php
  define("BASE",'/views/assets/');
?>
<!doctype html>
<html lang="en">
<?php include 'parts/head.php'; ?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
</head>
<body >
    <style>
    #map {
      height: 600px;
    }

    .map-title {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    </style>

    <div class="wrapper">
    <?php include "parts/header.php"; ?>
    
    <?php include "parts/navbar.php"; ?>

    <div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title" style="color:red;">
                  Dashboard: Henry Buwembo (2022/HD05/1145U)
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
            <h3 style="color:red;">Water Quality Visualizations Per district</h3>

            <div class="col-lg-6">
                <div class="card">
                  <div class="card-header border-0">
                    <h4 class="card-title"> Water Quality Statistical Data </h4>  

                    </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header border-0">
                    <div id="tooltip" style="display: none;">
                        <span id="district"></span><br>
                        Value: <span id="value"></span>
                    </div>

                  </div>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="card">

                  <div class="card-table table-responsive">
                    <div id="mainWrapper">


                      <div id="graphs">

                        <div>
                            <label for="parameter-select">Select Parameter:</label>
                            <select id="parameter-select" onchange="updateMap()">
                                <option value="ecoli">Ecoli</option>
                                <option value="turbidity">Turbidity</option>
                                <option value="pH">pH</option>
                                <option value="sulphate">Sulphate</option>
                            </select>
                        </div>
                        <div id="map"></div>
                      
                      </div>

                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <?php include "parts/footer.php"; ?>
    </div>
    </div>

    <!-- Load d3.js -->
    <script src="https://d3js.org/d3.v6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://leaflet.github.io/Leaflet.heat/dist/leaflet-heat.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Libs JS -->
    <script src="<?= BASE ?>dist/libs/apexcharts/dist/apexcharts.min.js"></script>
    <!-- Tabler Core -->
    <script src="<?= BASE ?>dist/js/tabler.min.js"></script>
    <script src="<?= BASE ?>dist/js/demo.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.js" integrity="sha512-JjYSgzqo9K0IeYGEslMRYE8aO9tq7Ky3EQNmEVkAe6Cp14AwlJMLMnb0fpgEkr3YxJ8ghQiriOvZwIdRZieGIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE ?>map.js?v=<?= microtime() ?>"></script>
    </body>
</html>