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

const conn = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'callcenter',
    multipleStatements: true

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
        })
    }
})
    //console.log(correo, contrasena)
    //console.log(req.param('email'))
    /*res.send({
        correo: correo,
        contrasena: contrasena
    }) */
    /*var validar = "SELECT * FROM agente WHERE correo = '" + req.body.correo + "' AND password = '" + req.body.password + "'"
    //var query = "SELECT * FROM agente"
    conn.query(validar, function(err, results){
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
            }else{
                res.send({
                    "code": 200,
                    "message": "Inicio de sesion exitoso"
                });
                res.redirect("/deudores")
            }
        }
    })
})*/


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