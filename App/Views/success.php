<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>User Created Successfully</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #DDD9D1;

            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .success-container {

            width: 400px;

            padding: 40px;

            background: white;

            text-align: center;

            border-radius: 10px;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .success-icon {

            width: 70px;
            height: 70px;

            margin: 0 auto 20px;

            border-radius: 50%;

            background: #28a745;

            color: white;

            display: flex;

            justify-content: center;
            align-items: center;

            font-size: 40px;
        }

        h1 {

            color: #28a745;

            margin-bottom: 15px;
        }

        p {

            color: #555;

            margin-bottom: 25px;
        }

        .back-button {

            display: inline-block;

            padding: 12px 25px;

            background: #000000;

            color: white;

            text-decoration: none;

            border-radius: 5px;
        }

        .back-button:hover {

            background: #000000;
        }

    </style>

</head>


<body>

    <div class="success-container">

        <div class="success-icon">
            ✓
        </div>

        <h1>
            User Created Successfully!
        </h1>

        <p>
            The user has been created successfully.
        </p>

        <a href="addAdmin.php"
           class="back-button">

            Create Another User

        </a>

    </div>

</body>

</html>

