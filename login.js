const express = require('express')
const app = express()
const morgan = morgan()
const mysql = require('mysql')
const routes = require('./routes')
const http = require('http')
const path = require('path')

var path = __dirname + '/views/';

const conn = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    database: 'callcenter'
})

app.use(morgan('combined'))

//Inicio de sesion
app.post("/login", (req, res) => {
    var correo = req.body.email
    var contrasena = req.body.password
    var query = "SELECT * FROM agentes WHERE correo = '" + correo + "' AND contrasena = '" + password + "'"
    conn.query(query, function(err,res){
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
        res.redirect("/deudores")
    })
})

//Cerrar sesion


app.listen(3003, ( )=>{
    console.log("Listening on 3003")
})