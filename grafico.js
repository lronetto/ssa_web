function grafico_bat(vari,tipo,obj,titulo,nome,unidade){
	if(tipo==1){
		var baseuni='minute';
		var uniint=7;
		var hora=1;
		}
	
	if(tipo==2){
		var baseuni='hour';
		var uniint=2;
		var hora=12;
		var interval=0.5;
	}
	if(tipo==3){
		var baseuni='hour';
		var uniint=4;
		var hora=24;
		var interval=0.5;
	}
	if(tipo==4){
		var baseuni='day';
		var uniint=7;
		var hora=7;
	}
	if(tipo==5){
		var baseuni='day';
		var uniint=1;
		var hora=30;
	}
	if(tipo==6){
		var baseuni='minute';
		var uniint=7;
		var hora=2;
		}
	if(tipo==7){
		var baseuni='minute';
		var uniint=7;
		var hora=6;
		}
	var source =
	        {
	            datatype: "json",
	    datafields: [ 
	        { name: 'date'}, 
	        { name: 'val' }
	    ],
	    url: 'var_func.php?act=graf&tipo='+tipo+'&hora='+hora+'&var='+vari
	};
	
	var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
	// prepare jqxChart settings
	var grafico_bateria = {
	    title: titulo,
	   // description: "Grafico diario da tensao da bateria",
	    enableAnimations: true,
	    showLegend: true,
	    padding: { left: 5, top: 5, right: 25, bottom: 5 },
	    titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
	    source: dataAdapter,
	    xAxis: {
	        dataField: 'date',
	        type: 'date',
	        baseUnit: baseuni,
	        /*formatFunction: function (value) {
                var date = new Date(value);
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                var h = date.getHours();
                var min = date.getMinutes();
                var seg = date.getSeconds();
                return d+'/'+(m + 1) + "/" + y+'<br>'+(h+1)+':'+min+':'+seg;
            }*/
	       // unitInterval: uniint 
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
	                    //unitInterval: interval,
	                    minvalue: 0,
	                    padding: { left: 10 },
	                    title: { text: unidade },
	                    gridLines: { visible: true }
	                },
	                series: [
	                        { dataField: 'val', displayText: nome }
	                    ]
	            }
	        ]
	};
	 obj.jqxChart(grafico_bateria);
	 return 'var_func.php?act=graf&tipo='+tipo+'&hora='+hora+'&var='+vari;
}
function grafico2(var1,var2,tipo,obj,titulo,unidade,nome1,nome2,loader){
	loader.jqxLoader({  width: 100, height: 60, imagePosition: 'top', autoOpen: true });
	if(tipo==1){
		var baseuni='minute';
		var uniint=7;
		var hora=1;
		}
	
	if(tipo==2){
		var baseuni='hour';
		var uniint=2;
		var hora=12;
		var interval=0.5;
	}
	if(tipo==3){
		var baseuni='hour';
		var uniint=4;
		var hora=24;
		var interval=0.5;
	}
	if(tipo==4){
		var baseuni='day';
		var uniint=7;
		var hora=7;
	}
	if(tipo==5){
		var baseuni='day';
		var uniint=1;
		var hora=30;
	}
	if(tipo==6){
		var baseuni='minute';
		var uniint=7;
		var hora=2;
		}
	if(tipo==7){
		var baseuni='minute';
		var uniint=7;
		var hora=6;
		}
	var source =
	        {
	            datatype: "json",
	    datafields: [ 
	        { name: 'date'}, 
	        { name: 'val1' },
	        { name: 'val2' }
	    ],
	    url: 'var_func.php?act=graf1&tipo='+tipo+'&hora='+hora+'&var1='+var1+'&var2='+var2
	};
	
	var dataAdapter = new $.jqx.dataAdapter(source, { 
		async: false, 
		autoBind: true, 
		loadError: function (xhr, status, error) { 
			alert('Error loading "' + source.url + '" : ' + error); },
		loadComplete: function () { loader.jqxLoader('close'); }
			});
	// prepare jqxChart settings
	//alert("teste");
	var grafico_bateria = {
	    title: titulo,
	   // description: "Grafico diario da tensao da bateria",
	    enableAnimations: true,
	    showLegend: true,
	    padding: { left: 5, top: 5, right: 25, bottom: 5 },
	    titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
	    source: dataAdapter,
	    xAxis: {
	        dataField: 'date',
	        type: 'date',
	        baseUnit: baseuni
	        /*formatFunction: function (value) {
                var date = new Date(value);
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                var h = date.getHours();
                var min = date.getMinutes();
                var seg = date.getSeconds();
                return d+'/'+(m + 1) + "/" + y+'<br>'+(h+1)+':'+min+':'+seg;
            }*/
	       // unitInterval: uniint 
	        //minValue: 1,
	       // maxValue: 50,
	    },
	    colorScheme: 'scheme04',
	    seriesGroups:
	        [
	            {
	                type: 'line',
	                valueAxis:
	                {
	                    //unitInterval: interval,
	                    minvalue: 0,
	                    padding: { left: 10 },
	                    title: { text: unidade },
	                    gridLines: { visible: true }
	                },
	                series: [
	                        { dataField: 'val1', displayText: nome1 },
	                        { dataField: 'val2', displayText: nome2 }
	                    ]
	            }
	        ]
	};
	 obj.jqxChart(grafico_bateria);
	 //return 'var_func.php?act=graf&tipo='+tipo+'&hora='+hora+'&var='+var1;
}