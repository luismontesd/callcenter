const fs = require('fs');

module.exports = {
    addPlayerPage: (req, res) => {
        res.render('add-player.ejs', {
            title: "Welcome to Socka | Add a new player"
            ,message: ''
        });
    },
    addPlayer: (req, res) => {
        //if (!req.files) {
        //    return res.status(400).send("No files were uploaded.");
        //}

        let message = '';
        let first_name = req.body.first_name;
        let last_name = req.body.last_name;
        let position = req.body.position;
        let number = req.body.number;
        let username = req.body.username;
        //let uploadedFile = req.files.image;
        //let image_name = uploadedFile.name;
        //let fileExtension = uploadedFile.mimetype.split('/')[1];
        //image_name = username + '.' + fileExtension;

        let usernameQuery = "SELECT * FROM `usuarios` WHERE nombre = '" + username + "'";

        db.query(usernameQuery, (err, result) => {
            if (err) {
                return res.status(500).send(err);
            }
            if (result.length > 0) {
                message = 'El nombre de usuario ya existe';
                res.render('add-player.ejs', {
                    message,
                    //title: "Welcome to Socka | Add a new player"
                });
            } else {

                let query = "INSERT INTO usuarios (nombre, apellidos) VALUES ('" + first_name + "', '" + last_name + "')";
                db.query(query, (err, result) => {
                    if(err){
                        return res.status(500).send(err);
                    }
                    res.redirect('/');
                })
            }
        });
    },
    editPlayerPage: (req, res) => {
        let playerId = req.params.id;
        let query = "SELECT * FROM `usuarios` WHERE id = '" + playerId + "' ";
        db.query(query, (err, result) => {
            if (err) {
                return res.status(500).send(err);
            }
            res.render('edit-player.ejs', {
                title: "Editar"
                ,player: result[0]
                ,message: ''
            });
        });
    },
    editPlayer: (req, res) => {
        let playerId = req.params.id;
        let first_name = req.body.first_name;
        let last_name = req.body.last_name;
        let position = req.body.position;
        let number = req.body.number;

        let query = "UPDATE `usuarios` SET `nombre` = '" + first_name + "', `apellidos` = '" + last_name + "'";
        db.query(query, (err, result) => {
            if (err) {
                return res.status(500).send(err);
            }
            res.redirect('/');
        });
    },
    deletePlayer: (req, res) => {
        let playerId = req.params.id;
        //let getImageQuery = 'SELECT image from `usuarios` WHERE id = "' + playerId + '"';
        let deleteUserQuery = 'DELETE FROM usuarios WHERE id = "' + playerId + '"';
    }
};
