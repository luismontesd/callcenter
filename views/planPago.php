<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Call Center</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

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
      <li class="breadcrumb-item" aria-current="page">Deudores</li>
      <li class="breadcrumb-item " aria-current="page">nombre del deudor</li>
      <li class="breadcrumb-item active " aria-current="page">Plan de pagos</li>
    </ol>
</nav>
<div class="tabla-c">
  <div class="contpp">
  <h4>Monto total</h4><h5>$ 9999999</h5>
  <h4>Plazo</h4>
  <select class="form-control">
  <option>1 mes</option>
  <option>2 meses</option>
  <option>3 meses</option>
  <option>4 meses</option>
  <option>5 meses</option>
  <option>6 meses</option>
  <option>7 meses</option>
  <option>8 meses</option>
  <option>9 meses</option>
  <option>10 meses</option>
  <option>11 meses</option>
  <option>12 meses</option>
  </select>
  <h4>Interes</h4><h5>16%</h5>
  <h4>Monto mensual</h4><h5>$ 999</h5>
  <button class="btn btn-outline-success my-2 my-sm-0 isq" type="submit">Guardar</button>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>

</body>
</html>