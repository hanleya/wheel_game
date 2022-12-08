<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="home/home.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">    
    <title>Document</title>
</head>
<body>
    <div>
        <div class="formbox">
            <form id="join" method="post" action="lobby/to_lobby.php">
                <input id="name-join" name="name" class="name" type="text" placeholder="Name" required>
                <input id="code-join" name="code" class="code" type="text" placeholder="Lobby Code" required>
                <input name="action" value="join" type="hidden">
                <input id="btn-join" class="btn" type="submit" value="Join" maxlength="8">
            </form>
        </div>
        <div class="formbox">
            <form id="create" method="post" action="lobby/to_lobby.php">
                <input id="name-join" name="name" class="name" type="text" placeholder="Name" required>
                <input id="code-join" name="code" class="code" type="text" placeholder="Lobby Code" required>
                <input name="action" value="create" type="hidden">
                <input id="btn-create" class="btn" type="submit" value="Create" maxlength="8">
            </form>
        </div>
    </div>
</body>
</html>