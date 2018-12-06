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

//reporte
app.get('/reporte', function(req,res){
    var query = "SELECT caps.*, pp.*, ag.* FROM capturasesion caps,planpago pp, agente ag WHERE caps.IdDeudor = pp.IdDeudor and caps.IdAgente = ag.IdAgente AND caps.Fecha= '2015-12-07';"
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
//Cerrar sesion

app.listen(3003, ( ) => {
    console.log("Listening on 3003")
})