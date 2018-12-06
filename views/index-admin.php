<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Call Center</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body  >
<div id="agente">
<div  v-for='item in list'v-if="item.IdAgente == idAgente">
<nav class="navbar navbar-light bg-light" >
  <a class="navbar-brand">
    <img src="img/call-center.png" width="30" height="30" class="d-inline-block align-top no-seleccionable" alt="">
    Call Center
  </a>
  <span class="navbar-text no-seleccionable">
      {{ item.Nombre }}
    </span>
    <a href="index.html" ><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cerrar sesión</button></a>
</nav>
<div class="tabla-dash">
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Clientes</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="100" ><span class="percent">1313</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Clientes atendido</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Cambio de plan</h4>
						<div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Agentes activos</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="33" ><span class="percent">33%</span></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		
			
			<div class="col-md-6">
				<div class="panel panel-default ">
					<div class="panel-heading">
						Agentes
            <table class="table table-hover no-seleccionable">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">RFC</th>
                  <th scope="col">Sucursal</th>
                  <th scope="col">Estado</th>
                  <th scope="col">EstatusT</th>
                </tr>
              </thead>
              <tbody id="tabladeu">
              <tr  v-for='item in list' v-on:click="pasarvariable(item.ID)">
                  <th scope="row" id="iddeu" v-bind:value="item.ID" >{{ item.ID }}</th>
                  <td>{{ item.Nombre }}</td>
                  <td>{{ item.Telefono }}</td>
                  <td>{{ item.RFC }}</td>
                  <td>{{ item.Sucursal }}</td>
                  <td>{{ item.Estado }}</td>
                  <td>{{ item.StatusT }}</td>
                </tr>
              </tbody>
            </table>
					</div>
				</div>
			</div><!--/.col-->
			
		</div><!--/.row-->
	</div>	<!--/.main-->
		
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.5.1/vue-resource.min.js"></script>

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
</body>
</html>