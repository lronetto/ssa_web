function grafico_bat(vari,obj){
	var source =
	        {
	            datatype: "json",
	    datafields: [ 
	        { name: 'date'}, 
	        { name: 'val' }
	    ],
	    url: 'teste11.php?var='+vari
	};
	var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
	// prepare jqxChart settings
	var grafico_bateria = {
	    title: "Bateria",
	    description: "Grafico diario da tensao da bateria",
	    enableAnimations: true,
	    showLegend: true,
	    padding: { left: 5, top: 5, right: 25, bottom: 5 },
	    titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
	    source: dataAdapter,
	    xAxis: {
	        dataField: 'date',
	        type: 'date',
	        baseUnit: 'hour',
	        unitInterval: 1,
	        //minValue: 1,
	       // maxValue: 50,
	        
	    },
	    colorScheme: 'scheme04',
	    seriesGroups:
	        [
	            {
	                type: 'spline',
	                valueAxis:
	                {
	                    unitInterval: 0.05,
	                    minvalue: 0,
	                    padding: { left: 10 },
	                    title: { text: 'Tensao' },
	                    gridLines: { visible: true }
	                },
	                series: [
	                        { dataField: 'val', displayText: 'bateria' }
	                    ]
	            }
	        ]
	};
	 obj.jqxChart(grafico_bateria);
}