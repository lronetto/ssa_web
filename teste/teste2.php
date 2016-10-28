
<!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>jqxChart Spline Series Example</title>
	<meta name="description" content="jQuery Chart Spline Series." />				
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxchart.core.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxchart.rangeselector.js"></script>
    <script type="text/javascript" src="grafico.js"></script> 
    <script type="text/javascript">
        $(document).ready(function () {
            // prepare the data
            
            
            // setup the chart
            grafico_bat(173,$('#chartContainer'));
        });
    </script>
</head>
<body class='default'>
    <div id='chartContainer' style="width:100%; height:500px">
    </div>
</body>
</html>