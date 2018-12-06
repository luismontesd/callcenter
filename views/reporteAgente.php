<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Call Center</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
<div id="reporte" >
<div v-for='item in list' v-if="item.IdAgente == idAgente">
<nav class="navbar navbar-light bg-light oculto-impresion">
  <a class="navbar-brand">
    <img src="img/call-center.png" width="30" height="30" class="d-inline-block align-top no-seleccionable" alt="">
    Call Center
  </a>
  <span class="navbar-text no-seleccionable">
  {{item.Nombre}}
    </span>
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cerrar sesión</button>
</nav>

<div class="btn-bread oculto-impresion btn-imp" >
  <button class="btn btn-outline-success my-2 my-sm-0 " onclick="javascript:window.print()" type="submit">Imprimir reporte</button>
</div>
<div >
<div class="contreporte"  >
  <div class="rep-barra">
  <a class="navbar-brand">
    <img src="img/call-center.png" width="30" height="30" class="d-inline-block align-top no-seleccionable" alt="">
    Call Center
  </a>
</nav> 
  </div>
    <h1 class="esp-h1-rep">Reporte diario</h1>
    <h4>Fecha: {{Fecha}}</h4>
    <h4>Id Agente: {{item.IdAgente}}</h4>
    <h4>Nombre: {{item.Nombre}}</h4>
    <h4>Correo: {{item.Correo}}</h4>
    <div class="tabla-c idDeudas">
    <table class="table table-hover no-seleccionable ">
        <thead>
            <tr>
            <th scope="col">ID Capturasesion</th>
            <th scope="col">Fecha</th>
            <th scope="col">ID Deudor</th>
            <th scope="col">Id Plan de pago</th>
            <th scope="col">Id deudas</th>
            </tr>
        </thead>
        <tbody id="tabladeu">
        <tr  v-for='item in list'>
            <th scope="row" id="iddeu" v-bind:value="item.ID" >{{ item.IDcapturasesion }}</th>
            <td>{{ item.Fecha }}</td>
            <td>{{ item.IdDeudor }}</td>
            <td>{{ item.IdPlanPago }}</td>
            <td>{{ item.idDeudas }}</td>
            </tr>
        </tbody>
        </table>
    </div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.5.1/vue-resource.min.js"></script>
<script>

var urlReport='http://localhost:3003/reporte';

new Vue({
  el: '#reporte',
  created: function(){
    this.getReport();
  },
  data:{
    list: [],
    Fecha: '2018-12-06',
    idAgente: <?php echo $_GET["id"];?>
  },
  methods: {
    getReport: function(){
      this.$http.get(urlReport).then(function(response){
        this.list = response.data;
      });
    }
  }
});
</script>
</body>

</html>
