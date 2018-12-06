const express = require('express')
const app = express()
//const morgan = morgan()
const mysql = require('mysql')
const routes = require('./routes')
//const http = require('http')
const path = require('path')
const bodyParser = require('body-parser')

app.use(bodyParser.json()); // support json encoded bodies
app.use(bodyParser.urlencoded({ extended: true })); 

//var path = __dirname + '/views/';

/*const conn = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'callcenterdb',

})*/

const conn = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'bdcall',

})

//app.use(morgan('combined'))

app.get('/', function(req,res){
    var query = "SELECT * FROM clientes"
    conn.query(query, function(err,results){
        if(err){
            res.send({
                "Message": "Error"
            })
        }else{
            console.log("Respuesta exitosa")
            res.send(results)
        }
    })
})

//Inicio de sesion
app.post("/loginAgent", function(req, res){
    var correo = req.body.correo
    var contrasena = req.body.password

    if(conn){
        var validar = "SELECT * FROM agente WHERE correo = '" + req.body.correo + "' AND password = '" + req.body.password + "'"
        
        conn.query(validar, function(err,results){
            if(err){
                res.send({
                    "code": 400,
                    "message": "Error"
                });
            }else {
                if (results.length > 0) {
                    res.send({
                        "code": 200,
                        "message": "Inicio de sesión correcto"
                    });
                    //res.redirect('/deudores')
                }else{
                    res.send({
                        "code": 204,
                        "message": "Datos incorrectos"
                    });
                }
            }
            console.log(validar)
        })
        return validar
        //console.log(validar)
    }
})

//index-call
app.get('/index-call', function(req,res){
    var query = "SELECT dor.*, das.* FROM deudores dor, deudas das WHERE dor.ID = das.IdDeudor;"
    conn.query(query, function(err,results){
        if(err){
            res.send({
                "Message": "Error"
            })
        }else{
            console.log("Respuesta exitosa")
            res.send(results)
        }
    })
})

//index-call telefoonos
app.get('/index-call-tel', function(req,res){
    var query = "SELECT * FROM histtelefono"
    conn.query(query, function(err,results){
        if(err){
            res.send({
                "Message": "Error"
            })
        }else{
            console.log("Respuesta exitosa")
            res.send(results)
        }
    })
})

//index-call planpagos
app.get('/index-call-ppagos', function(req,res){
    var query = "SELECT * FROM planpago"
    conn.query(query, function(err,results){
        if(err){
            res.send({
                "Message": "Error"
            })
        }else{
            console.log("Respuesta exitosa")
            res.send(results)
        }
    })
})

//index-call comentarios
app.get('/index-call-coment', function(req,res){
    var query = "SELECT * FROM  capturasesion"
    conn.query(query, function(err,results){
        if(err){
            res.send({
                "Message": "Error"
            })
        }else{
            console.log("Respuesta exitosa")
            res.send(results)
        }
    })
})

//Datos sesion
app.get('/sesion', function(req,res){
    var correo = req.body.correo
    var password = req.body.password
    var consulta = "SELECT id FROM agente WHERE correo LIKE '" + correo + "' AND password LIKE '" + password + "'"
    conn.query(consulta, function(err, results){
        if(err){
            res.send({
                "Message": "Error"
            })
        }else{
            res.send({
                "id": consulta
            })
            console.log("Respuesta exitosa")
        }
    })
    
})
//Sesiones
/*var sesion = new Vue({
    el: '#vueapp',
    data: {
      email: '',
      password: '',
      regs: []
        },
    methods: {
  
      reloadList: function() {
           this.$http.get('data.php').then(function(response){
                  this.regs = response.body;
                }, function(){
                  alert('Error!');
                });
          },
  
      login: function() {
          this.$http.post('data.php',{ 
              email: this.email, 
              password: this.password 
              }).then(function(response){
                      this.regs = response.body;
                  this.email="";
                  this.password="";
                        });
          }
  
      },
    created: function() {
      this.reloadList();
      }
  });*/

app.listen(3003, ( ) => {
    console.log("Listening on 3003")
})