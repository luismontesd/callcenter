const express = require('express')
const app = express()
//const morgan = morgan()
const mysql = require('mysql')
const routes = require('./routes')
//const http = require('http')
const path = require('path')

//var path = __dirname + '/views/';

const conn = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    database: 'callcenter'
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
app.post("/loginAgent", function(req, res){
    var correo = req.body.email
    var contrasena = req.body.password
    //var query = "SELECT * FROM agentes WHERE correo = '" + correo + "' AND contrasena = '" + password + "'"
    var query = "SELECT * FROM agente"
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
        }
        //res.redirect("/deudores")
    })
})

//Cerrar sesion
//bsdkhfkjahffkjashdkjhasdkjhaskdjhaskjh

app.listen(3003, ( ) => {
    console.log("Listening on 3003")
})

//index-call
app.get('/tablaindexcall', function(req,res){
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