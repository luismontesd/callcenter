



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
<div class="bread-ind">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb no-seleccionable bread-tam">
      <li class="breadcrumb-item active " aria-current="page">Deudores</li>
    </ol>
  </nav>
</div>
  <div class="btn-bread" id="reporte">
  <button class="btn btn-outline-success my-2 my-sm-0 " v-on:click="greporte(item.IdAgente)" type="submit">Generar reporte</button>
  </div>
</div>
</div>
<div class="tabla-c">
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
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.5.1/vue-resource.min.js"></script>
<script>
var urlUsers='http://localhost:3003/index-call';
var urlAgente='http://localhost:3003/agente';
new Vue({
  el: '#agente',
  created: function(){
    this.getAgente();
  },
  data:{
    list: [],
    idAgente: <?php echo $_GET["idA"];?>
  },
  methods: {
    getAgente: function(){
      this.$http.get(urlAgente).then(function(response){
        this.list = response.data;
      });
    },
    greporte: function(valor){
      console.log(valor);
      location.href="reporteAgente.php?id="+valor+""
    }
  }
});
new Vue({
  el: '#tabladeu',
  created: function(){
    this.getUsers();
  },
  data:{
    list: [],
    idAgente: <?php echo $_GET["idA"];?>
  },
  methods: {
    getUsers: function(){
      this.$http.get(urlUsers).then(function(response){
        this.list = response.data;
      });
    },
    pasarvariable: function(valor){
      console.log(valor);
      location.href="deudor.php?id="+valor+"&idA="+this.idAgente;
    }

  }
});

</script>
</body>
</html>