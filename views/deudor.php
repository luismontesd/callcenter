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
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand">
    <img src="img/call-center.png" width="30" height="30" class="d-inline-block align-top no-seleccionable" alt="">
    Call Center
  </a>
  <span class="navbar-text no-seleccionable">
      BLANCA   ÁLVAREZ  ÁLVAREZ
    </span>
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cerrar sesión</button>
</nav>
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb no-seleccionable">
      <li class="breadcrumb-item" aria-current="page"><a href="index-call.html">Deudores</a></li>
      <li class="breadcrumb-item active " aria-current="page">nombre del deudor</li>
    </ol>
</nav>
<div class="tabla-d">
  <h3>Datos generales</h3>
  <table class="table  no-seleccionable" id="tabladeu" >
  <tbody v-for='item in list' v-if="item.ID == iduser">
    <tr  >
      <td scope="col" class="campdg">ID:</td>
      <td>{{item.ID}}</td>
    </tr>
    <tr>
      <td scope="col">Nombre:</td>
      <td>{{item.Nombre}}</td>
    </tr>
    <tr>
      <td scope="col">Región:</td>
      <td>{{item.Region}}</td>
      <tr>
    </tr>
    <tr>
      <td scope="col">Teléfono:</td>
      <td>{{ item.Telefono }} <span class="badge badge-secondary">Actual</span></td>
    </tr>
    <tr>
      <td scope="col">Estado:</td>
      <td>{{item.Estado}}</td>
    </tr>
    <tr>
      <td scope="col">RFC:</td>
      <td>{{item.RFC}}</td>
    </tr>
    <tr>
      <td scope="col">EstatusT:</td>
      <td>{{item.StatusT}}</td>
    </tr>
    <tr>
      <td scope="col">Sucursal:</td>
      <td>{{item.Sucursal}}<a href="mapa.html"><button class="btn btn-outline-success my-2 my-sm-0 isq" type="submit">Mapa</button></a></td>
    </tr>
    <tr>
      <td scope="col">Saldo:</td>
      <td>$ {{item.Saldo}}</td>
    </tr>
    <tr>
      <td scope="col">Saldo anterior:</td>
      <td>$ {{item.SaldoAnterior}}</td>
    </tr>
    <tr>
      <td scope="col">Moratorios:</td>
      <td>{{item.Moratorios}}</td>
    </tr>
    <tr>
      <td scope="col">Saldo total:</td>
      <td>$ {{item.SaldoTotal}}</td>
    </tr>
  </tbody>
</table>
</div>

<div class="ppagos">
  <h3>Plan de pagos</h3>
  <table class="table no-seleccionable" id="ppagos">
     <thead>
    <tr>
      <th scope="col" class="mt">Moto total</th>
      <th scope="col" class="plz">Plazo en meses</th>
      <th scope="col">Interes</th>
      <th scope="col" class="coment">Monto mensual</th>
      <th scope="col">Fecha</th>
    </tr>
  </thead>
  <tbody v-for='ppitem in list' v-if="ppitem.IdDeudor == iduser">
    <tr>
      <td>$ {{ppitem.Monto}}</td>
      <td>{{ppitem.Plazo}}</td>
      <td>16%</td>
      <td>$ {{montomensual(ppitem.Monto,ppitem.Plazo)}}</td>
      <td>{{ppitem.Fecha}}</td>
    </tr>
  </tbody>
  </table>
  <a href="planPago.php"><button class="btn btn-outline-success my-2 my-sm-0 btned" type="submit">Editar</button></a>
</div>
  <div class="tabla-com">
  <h3>Comentarios</h3>
  <div class="scroll tam-com">
  <table class="table no-seleccionable" id="coment">
     <thead>
    <tr>
      <th scope="col">Fecha</th>
      <th scope="col" class="coment">Comentario</th>
    </tr>
  </thead>
  <tbody v-for='item in list' v-if="item.IdDeudor == iduser">
    <tr>
      <td>{{item.Fecha}}</td>
      <td>{{item.Comentarios}}</td>
    </tr>
  </tbody>
</table>
</div>
  <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
  <button class="btn btn-outline-success my-2 my-sm-0 btned" type="submit">Agregar</button>
</div>
<div class="tabla-tel">
  <h3>Otros teléfonos</h3>
  <table class="table no-seleccionable" id="teluser">
  <tbody v-for='item in list' v-if="item.IdDeudor == iduser">
    <tr >
      <td>{{ item.Telefono }}</td>
      <td></td>
    </tr>
  </tbody>
</table>
  <input type="number" class="form-control" id=""  placeholder="Ingrese numero">
  <button class="btn btn-outline-success my-2 my-sm-0 btned" type="submit">Agregar</button>
</div>
<script>
var urlUsers='http://localhost:3003/index-call';
var urlUsersTel='http://localhost:3003/index-call-tel';
var urlUserppagos='http://localhost:3003/index-call-ppagos';
var urlUsercoment='http://localhost:3003/index-call-coment';
new Vue({
  el: '#tabladeu',
  created: function(){
    this.getUsers();
  },
  data:{
    list: [],
    iduser: <?php echo $_GET["id"];?>
  },
  methods: {
    getUsers: function(){
      this.$http.get(urlUsers).then(function(response){
        this.list = response.data;
      });
    },
    pasarvariable: function(valor){
      console.log(valor);
      location.href="deudor.php?id="+valor+"";
    }

  }
}); 
new Vue({
  el: '#teluser',
  created: function(){
    this.getUsers();
  },
  data:{
    list: [],
    iduser: <?php echo $_GET["id"];?>
  },
  methods: {
    getUsers: function(){
      this.$http.get(urlUsersTel).then(function(response){
        this.list = response.data;
      });
    }

  }
}); 
new Vue({
  el: '#ppagos',
  created: function(){
    this.getUsers();
  },
  data:{
    list: [],
    iduser: <?php echo $_GET["id"];?>
  },
  methods: {
    getUsers: function(){
      this.$http.get(urlUserppagos).then(function(response){
        this.list = response.data;
      });
    },
    montomensual: function(monto, plazo){
      return ((monto/plazo)*.16)
    }

  }
});
new Vue({
  el: '#coment',
  created: function(){
    this.getUsers();
  },
  data:{
    list: [],
    iduser: <?php echo $_GET["id"];?>
  },
  methods: {
    getUsers: function(){
      this.$http.get(urlUsercoment).then(function(response){
        this.list = response.data;
      });
    }

  }
});
</script>
</body>
</html>