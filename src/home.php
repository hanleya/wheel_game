<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form id="join" method="post" action="lobby/to_lobby.php">
            <input id="name-join" name="name" class="name" type="text">
            <input id="code-join" name="code" class="code" type="text">
            <input name="action" value="join" type="hidden">
            <input id="btn-join" class="btn" type="submit" value="Join" maxlength="8"></button>
        </form>
        <form id="create" method="post" action="lobby/to_lobby.php">
            <input id="name-join" name="name" class="name" type="text">
            <input id="code-create" name="code" class="code" type="text">
            <input name="action" value="create" type="hidden">
            <input id="btn-create" class="btn" type="submit" value="Create" maxlength="8"></button>
        </form>
    </div>
</body>
</html>