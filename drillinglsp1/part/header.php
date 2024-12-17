<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/drillinglsp1/bootstrap1/css/bootstrap.min.css">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: blue;
            color: white;
            padding: 10px 20px;
        }

        .header a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        /* .header a:hover {
            text-decoration: underline;
        } */

        .welcome {
            text-align: center;
            margin: 20px 0;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>PT.CAHYANI</div>
        <div>
            <a href="http://localhost/drillinglsp1/dashboard.php">Dashboard</a>
            <a href="http://localhost/drillinglsp1/views/inventory.php">Inventory</a>
            <a href="http://localhost/drillinglsp1/views/vendor.php">Vendor</a>
            <a href="http://localhost/drillinglsp1/views/gudang.php">Gudang</a>
            <a href="http://localhost/drillinglsp1/logout.php">Logout</a>
        </div>
    </div>
    <div class="welcome">Welcome to Admin</div>
</body>
</html>
