<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Call Center</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.5.1/vue-resource.min.js"></script>
<body>
<nav class="navbar navbar-light bg-light" id="agente">
  <a class="navbar-brand">
    <img src="img/call-center.png" width="30" height="30" class="d-inline-block align-top no-seleccionable" alt="">
    Call Center
  </a>
  <span class="navbar-text no-seleccionable"v-for='item in list'v-if="item.IdAgente == idAgente">
      {{item.Nombre}}
    </span>
    <a href="index.html" ><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cerrar sesión</button></a>
</nav>
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb no-seleccionable">
      <li class="breadcrumb-item" aria-current="page">Deudores</li>
      <li class="breadcrumb-item " aria-current="page">nombre del deudor</li>
      <li class="breadcrumb-item active " aria-current="page">Plan de pagos</li>
    </ol>
</nav>
<div class="tabla-c" id="tablapp" >
  <div class="contpp" v-for='item in list' v-if="item.IdDeudor == iduser">
  <h4>Monto total</h4><h5>$ {{item.Monto}}</h5>
  <h4>Plazo</h4>
  <select class="form-control" v-model="selected">
  <option value="1">1 mes</option>
  <option value="2">2 meses</option>
  <option value="3">3 meses</option>
  <option value="4">4 meses</option>
  <option value="5">5 meses</option>
  <option value="6">6 meses</option>
  <option value="7">7 meses</option>
  <option value="8">8 meses</option>
  <option value="9">9 meses</option>
  <option value="10">10 meses</option>
  <option value="11">11 meses</option>
  <option value="12">12 meses</option>
  </select>
  <h4>Interes</h4><h5>16%</h5>
  <h4>Monto mensual</h4><h5>$ {{montomensual(item.Monto)}}</h5>
  <button class="btn btn-outline-success my-2 my-sm-0 isq" type="submit" v-on:click="pasarvariable(item.IdDeudor)">Guardar</button>
</div>
</div>
<script>
var urlUserppagos='http://localhost:3003/index-call-ppagos';
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
    }
  }
});
new Vue({
  el: '#tablapp',
  created: function(){
    this.getpp();
  },
  data:{
    list: [],
    iduser: <?php echo $_GET["id"];?>,
    selected: '1',
    idAgente: <?php echo $_GET["idA"];?>
  },
  methods: {
    getpp: function(){
      this.$http.get(urlUserppagos).then(function(response){
        this.list = response.data;
      });
    },
    montomensual: function(monto){
      return ((monto/this.selected)*.16)
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