<?php
  define("BASE",'/views/assets/');
?>
<!doctype html>
<html lang="en">
<?php include 'parts/head.php'; ?>
<style>
        #mainWrapper {
            height: auto;
            width: 100%;
            /* overflow-x:auto; */
        }

        #graphs{
          margin-top: 20px;
        }

        #selectionPane {
            /* position: absolute; */
            top: 50px;
            left: 300px;
            height: 40px;
            font-size: 18px;
        }

        #bubbleChart {
            /* position: absolute; */
            /* top: 200px; */
            left: 10px;
            width: 150px;
            height: 400px;
            margin-bottom: 50px;
            margin-top: 50px;
        }



        #histogram {
            /* position: absolute; */
            /* top: 100px; */
            left: 10px;
            width: 150px;
            height: 400px;
            margin-bottom: 50px;
            margin-top: 50px;
        }

        #histogram_label {
            /* position: absolute; */
            /* top: 510px; */
            left: 10px;
            width: 200px;
        }

        #connectedScatter {
            /* position: absolute; */
            /* top: 600px; */
            left: 10px;
            width: 100px;
            height: 400px;
            margin-bottom: 50px;
            margin-top: 50px;
        }

        #heatmap {
            /* position: absolute; */
            /* top: 600px; */
            left: 10px;
            width: 100px;
            height: 800px;
            margin-bottom: 50px;
            margin-top: 50px;
        }


        .slice {
            font-size: 12pt;
            font-family: Verdana;
            fill: white;
            /*svg specific - instead of color*/
            font-weight: bold;
        }

        /*for line chart*/
        .axis path,
        .axis line {
            fill: none;
            stroke: black;
            shape-rendering: crispEdges;
            /*The shape-rendering property is an SVG attribute, used here to make sure our axis and its tick mark lines are pixel-perfect. */
        }

        .line {
            fill: none;
            /*stroke: steelblue;*/
            stroke-width: 3px;
        }

        .dot {
            /*fill: white;*/
            /*stroke: steelblue;*/
            stroke-width: 1.5px;
        }


        .axis text {
            font-family: Verdana;
            font-size: 11px;
        }

        .title {
            font-family: Verdana;
            font-size: 15px;
            margin-bottom: 5px;

        }

        .xAxis {
            font-family: verdana;
            font-size: 11px;
            fill: black;
        }

        .yAxis {
            font-family: verdana;
            font-size: 11px;
            fill: white;
        }


        table {
            border-collapse: collapse;
            border: 0px;
            font-family: Verdana;
            color: #5C5558;
            font-size: 12px;
            text-align: right;
        }

        td {
            padding-left: 10px;
        }

        #histogramTitle1 {
            font-family: Verdana;
            font-size: 14px;
            fill: lightgrey;
            text-anchor: middle;
        }

        #histogramTitle2 {
            font-family: Verdana;
            font-size: 72px;
            fill: grey;
            text-anchor: middle;

            /*font-style: italic;*/
        }

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
<body >
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

              <div class="col-lg-12">
                <div class="card">

                  <div class="card-table table-responsive">
                    <div id="mainWrapper">


                      <div id="graphs">
                        <div class="select-wrapper">
                          <label for="parameter-select">Select Parameter:</label>
                          <div class="custom-select">
                            <select id="parameter-select" onchange="updateChart()">
                              <option value="ecoli">Ecoli</option>
                              <option value="turbidity">Turbidity</option>
                              <option value="pH">pH</option>
                              <option value="sulphate">Sulphate</option>
                            </select>
                            <i class="fas fa-chevron-down"></i>
                          </div>
                        </div>
                        <div id="chart-container">
                          <h2 id="chart-title"></h2>
                          <div id="bar-chart"></div>
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
    <script src="<?= BASE ?>index.js?v=<?= microtime() ?>"></script>
    </body>
</html>