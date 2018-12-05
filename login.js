const express = require('express')
const app = express()
//const morgan = morgan()
const mysql = require('mysql')
const routes = require('./routes')
const http = require('http')
const path = require('path')
const bodyParser = require('body-parser')

//var path = __dirname + '/views/';

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

const conn = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    database: 'callcenterdb'
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

app.post('/loginAdmin', function(req,res){
    var correo = req.body.email
    var contrasena = req.body.password

    var query = "SELECT * FROM agente WHERE nombres"
})

//Inicio de sesion
/*app.post("/login", function(req, res){
    var correo = req.body.email
    var contrasena = req.body.password
    //var query = "SELECT * FROM agentes WHERE correo = '" + correo + "' AND contrasena = '" + password + "'"
    var query = "SELECT * FROM agentes WHERE correo = '" + correo + "' AND contrasena = '" + contrasena + "'"
    conn.query(query, function(err){
        if(err){
            res.send({
                "code": 400,
                "message": "Error"
            })
        }else{
            res.send({
                "code": 200,
                "message": "Inicio de sesion exitoso"
            })
            res.redirect('/index-call')
        }
        //res.redirect("/deudores")
    })
    res.send(JSON.stringify(req.body))
})*/

app.post("/login", function (req, res) {
    var username = req.body.username;
    var password = req.body.password;
    var qry = "SELECT * FROM agentes WHERE nombre ='" + username + "' AND password = '" + password + "'";
    con.query(qry, function (error, results) {
        if (error) {
            res.send({
                "code": 400,
                "message": "Ha ocurrido un error en el servidor :("
            });
        }
        else {
            if (results.length > 0) {
                res.send({
                    "code": 200,
                    "message": "Inicio de sesión correcto"
                });
            } else {
                res.send({
                    "code": 204,
                    "message": "Datos incorrectos"
                });
            }
        }
    });
});

//index-call
app.get('/index-call', function(req,res){
    var query = "SELECT * FROM deudores"
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

app.get('/index-call:id',function(req,res){
    //var id = 
    var nombre = [req.params.body]
    var query = "SELECT * FROM deudores WHERE nombre = ?'" + nombre + "'"
    conn.query(query, function(err,res){
        if(err){
            res.send({
                "Message": "Error al realizar la consulta"
            })
        }else{
            console.log("Repuesta exitosa")
            res.send(results)
        }
    })
})

//Cerrar sesion


//Puerto
app.listen(3003, ( ) => {
    console.log("Listening on 3003")
})