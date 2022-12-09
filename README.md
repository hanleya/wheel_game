# Introduction

&ensp; Wheel Game is a web-based multiplayer drawing game. Players can form lobbies with friends, draw using an in-page canvas, and share their drawings. Over the course of a typical game, players will be able to create a list of drawing prompts. Each player then gets randomly assigned one. The players are meant to create a drawing based on their given prompt, and will then be able to see the prompts and drawings of the other players in their lobby.


# Setup

&ensp; To run Wheel Game, you need a server with access to a MySQL database.

&ensp; In the docs folder, there is a setup.sql file. Run this file on your MySQL server. To allow the site to connect to the server, locate the config file at src/functions/db_config.php. Fill in the relevant information to $databasehost, $databaseuser, and $databasepassword. Leave $database as is.
  
&ensp; Now, upload the contents of the src folder to your server using an FTP. Once this has been done, the site should function correctly.


# API Documentation

### Query 1: Add Prompt
Request Type: GET
Request Format: functions/add_prompt.php?lobby={lid}&prompt={prompt}
Returned Data: JSON

&ensp; Adds an entry to the prompt table with the given prompt string to the given lobby.

### Query 2: Check Finished
Request Type: GET
Request Format: functions/check_finished.php?lobby={lid}
Returned Data: JSON

&ensp; Returns a JSON object with the field ready. If all players in the given lobby have is_ready = 2, ready will be true. It will be false otherwise.

### Query 3: Cleanup Round
Request Type: GET
Request Format: functions/cleanup_round.php?lobby={lid}
Returned Data: JSON

&ensp; Deletes the given lobby, any prompts and players associated with it, and removes stored images.

### Query 4: Get Players
Request Type: GET
Request Format: functions/get_players.php?lobby={lid}
Returned Data: JSON

&ensp; Gets a list of all players in the given lobby.

### Query 5: Get Prompts
Request Type: GET
Request Format: functions/get_prompts.php?lobby={lid}
Returned Data: JSON

&ensp; Gets a list of all prompts in the given lobby.

### Query 6: Next Picture
Request Type: GET
Request Format: functions/next_picture.php?lobby={lid}&n={n}
Returned Data: JSON

&ensp; Returns the address of the nth picture in the given lobby's folder.

### Query 7: Set Ready
Request Type: GET
Request Format: functions/get_players.php?lobby={lid}&player={pid}
Returned Data: JSON

&ensp; Sets the given player's is_ready to 1. If all players in the lobby have is_ready 1, returns true.

### Query 8: Setup Round
Request Type: GET
Request Format: functions/get_players.php?lobby={lid}
Returned Data: JSON

&ensp; Removes idle players from the lobby, and assigns prompts to players.

### Query 9: Upload Picture
Request Type: POST
Request Format: functions/upload_image.php?lobby={lid}
Returned Data: JSON

&ensp; Adds the supplied picture to the given lobby's pictures folder.
