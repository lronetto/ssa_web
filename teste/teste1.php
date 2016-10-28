<!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>jqxChart Column Series with Logarithmic Axis</title>
    <meta name="description" content="jqxChart - javascript chart Column Series with Logarithmic Axis." />
    <meta name="keywords" content="jqwidgets charts, jquery charts, javascript charts, ajax charts, graphs, plots, line charts, bar charts, pie charts, javascript plots, ajax plots" />	
    <link rel="stylesheet" href="../js/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="../js/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqxchart.core.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'date'},//, type: 'date'},
                    { name: 'val'}
                ],
                url: 'teste11.php',
				cache: false
            };
	 var dataAdapter = new $.jqx.dataAdapter(source,
		{
			autoBind: true,
			async: false,
			downloadComplete: function () { },
			loadComplete: function () { },
			loadError: function () { }
		});
            var settings = {
			title: "Orders by Date",
			showLegend: true,
			padding: { left: 5, top: 5, right: 5, bottom: 5 },
			titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
			source: dataAdapter,
			categoryAxis:
				{
					text: 'Category Axis',
					textRotationAngle: 0,
					//dataField: 'date',
					//formatFunction: function (value) {
					//	return $.jqx.dataFormat.formatdate(value, 'yyy/MM/dd');
					//},
					showTickMarks: true,
					tickMarksInterval: Math.round(dataAdapter.records.length / 6),
					tickMarksColor: '#888888',
					unitInterval: Math.round(dataAdapter.records.length / 6),
					showGridLines: true,
					gridLinesInterval: Math.round(dataAdapter.records.length / 3),
					gridLinesColor: '#888888',
					axisSize: 'auto'                    
				},
			colorScheme: 'scheme05',
			seriesGroups:
				[
					{
						type: 'line',
						valueAxis:
						{
							displayValueAxis: true,
							description: 'Quantity',
							//descriptionClass: 'css-class-name',
							axisSize: 'auto',
							tickMarksColor: '#888888',
							unitInterval: 20,
							minValue: 0,
							maxValue: 100                          
						},
						series: [
								{ dataField: 'val', displayText: 'Quantity' }
						  ]
					}
				]
		};
		// setup the chart
		$('#chart').jqxChart(settings);
	});
</script>
</head>
<body style="background:white;">
    <div id='chart' style="width:850px; height: 500px;"/>
</body>
</html>
