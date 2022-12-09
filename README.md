# Introduction

&ensp; Wheel Game is a web-based multiplayer drawing game. Players can form lobbies with friends, draw using an in-page canvas, and share their drawings. Over the course of a typical game, players will be able to create a list of drawing prompts. Each player then gets randomly assigned one. The players are meant to create a drawing based on their given prompt, and will then be able to see the prompts and drawings of the other players in their lobby.


# Setup

&ensp; To run Wheel Game, you need a server with access to a MySQL database.

&ensp; In the docs folder, there is a setup.sql file. Run this file on your MySQL server. To allow the site to connect to the server, locate the config file at src/functions/db_config.php. Fill in the relevant information to $databasehost, $databaseuser, and $databasepassword. Leave $database as is.
  
&ensp; Now, upload the contents of the src folder to your server using an FTP. Once this has been done, the site should function correctly.


# API Documentation

&ensp;
