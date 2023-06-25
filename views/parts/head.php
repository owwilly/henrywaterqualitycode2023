<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">

    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Qub Ads">
    <meta property="og:description" content="">
    <meta property="og:site_name" content="Qub Ads">
    <meta property="og:url" content="www.qubads.org">

    <title>Henry | Water Quality Analysis Data Visualization</title>
    <!-- CSS files -->
    <link href="<?= BASE ?>dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="<?= BASE ?>dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="<?= BASE ?>dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="<?= BASE ?>dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="<?= BASE ?>dist/css/demo.min.css" rel="stylesheet"/>

    <!-- ICONS -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE ?>dist/img/qubadslogo.png?v=<?= microtime() ?>">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  </head>

  <style>
        h3,
        .h3 {
          font-size: 30px;
        }

        .card .card-title {
          color: #3f51b5;
        }

        .newheader {
          color: #3f51b7;
          font-size: 20px;
          text-transform: uppercase;
          font-weight: 900;
        }

/* 
    Visualization Styles
 */
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

</style>

