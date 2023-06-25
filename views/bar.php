<?php
  define("BASE",'/views/assets/');
?>
<!doctype html>
<html lang="en">
<?php include 'parts/head.php'; ?>
<body >
    <style>
#chart-container {
      margin-top: 30px;
    }

    #parameter-select {
      margin-bottom: 20px;
    }

    .bar {
      cursor: pointer;
      transition: fill 0.3s;
    }

    .bar:hover {
      fill: orange;
    }

    .target-line {
      stroke-dasharray: 3, 3;
      stroke: red;
      stroke-width: 1;
    }

    .y-axis-label {
      font-weight: bold;
      text-anchor: middle;
    }

    .tooltip {
      position: absolute;
      padding: 10px;
      background-color: white;
      border: 1px solid #ccc;
      pointer-events: none;
    }

    .tooltip div {
      margin-bottom: 5px;
    }

    .navbar-dark .navbar-nav .nav-link {
      color: #ffffff;
      /* Set the text color */
      transition: transform 0.3s ease-out;
      /* Add transition for animation */
    }

    .navbar-dark .navbar-nav .nav-link:hover {
      transform: translateY(-3px);
      /* Raise the word on hover */
    }

    .navbar-dark .navbar-nav .nav-link:not(.active):hover {
      background-color: #333333;
      /* Adjust background color on hover */
    }

    .container {
      text-align: center;
    }

    h1 {
      font-size: 32px;
      color: #333;
      margin-bottom: 40px;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    .select-wrapper {
      position: relative;
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-size: 18px;
      color: #666;
      margin-bottom: 10px;
    }

    .custom-select {
      position: relative;
      display: inline-block;
      background-color: #fff;
      border-radius: 4px;
      padding: 10px;
      width: 200px;
      cursor: pointer;
      border: 1px solid #ccc;
    }

    .custom-select select {
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      background: transparent;
      border: none;
      width: 100%;
      outline: none;
      cursor: pointer;
      padding-right: 20px;
    }

    .custom-select i {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      pointer-events: none;
      transition: transform 0.3s ease;
    }

    .custom-select:hover i {
      transform: translateY(-50%) rotate(180deg);
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

                        <div id="chart-container">
                        <h2 id="chart-title"></h2>
                        <div id="bar-chart"></div>
                        <svg id="myvisualization" width="1000" height="1000"></svg>

                        <!-- Tooltip -->
                        <div id="tooltip" class="tooltip" style="display: none;">
                            <div><strong>District:</strong> <span id="district"></span></div>
                            <div><strong>Value:</strong> <span id="value"></span></div>
                        </div>
                        </div>                    
                      
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Libs JS -->
    <script src="<?= BASE ?>dist/libs/apexcharts/dist/apexcharts.min.js"></script>
    <!-- Tabler Core -->
    <script src="<?= BASE ?>dist/js/tabler.min.js"></script>
    <script src="<?= BASE ?>dist/js/demo.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.js" integrity="sha512-JjYSgzqo9K0IeYGEslMRYE8aO9tq7Ky3EQNmEVkAe6Cp14AwlJMLMnb0fpgEkr3YxJ8ghQiriOvZwIdRZieGIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE ?>bar.js?v=<?= microtime() ?>"></script>
    </body>
</html>