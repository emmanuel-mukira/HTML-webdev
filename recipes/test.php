<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="process_order.php" method="post">
        <hr>
        <div>
        <input id="input1" type="text" name="shirts" size="2" /> Shirts x $3.50
        </div>
        <div>
        <input id="input2" type="text" name="trouser" size="2" /> Trouser x $40.00
        </div>
        <div>Shipping: <br />
        <label><input id="input4" type="radio" name="shipping" value="regular" /> Regular ($7)</label>
        <br />
        <label><input id="input5" type="radio" name="shipping" value="express" /> Express ($9)</label>
        </div>
        <div>
        <label><input id="input3" type="checkbox" name="donation" /> Donate $5 extra?</label>
        </div>
        <div><input id="input6" type="submit" value="Buy" /></div>
        </form>
       <ul>
        <li><a href="#home" title="Nairobi University">Nairobi University</a></li>
        </ul> 
</body>
</html>