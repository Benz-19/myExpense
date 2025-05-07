<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Core Css -->
    <!-- <link rel="stylesheet" href="./public/css/index.css"> -->
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
            /* Optional: light background */
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 12px 12px 10px rgba(176, 175, 175, 0.708);
            padding: 40px;
            max-width: 90%;
            width: 400px;
            background-color: white;
            border-radius: 10px;
        }

        /* Logo */
        .logo-cont img {
            width: 40px;
            height: auto;
        }

        .logo-cont {
            padding: 50px 0 30px;
        }

        /* Button Options */
        .options {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding-top: 10px;
        }

        /* Shared button styles */
        .login button,
        .sign-up button {
            width: 100%;
            height: 40px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            border-radius: 5px;
            font-size: 1rem;
            border: none;
        }

        .login {
            flex: 1;
            margin-right: 10px;
        }

        .login button {
            background-color: rgb(20, 203, 20);
        }

        .login button:hover {
            background-color: grey;
            transform: translateY(-10%);
        }

        .sign-up {
            flex: 1;
            margin-left: 10px;
        }

        .sign-up button {
            background-color: rgb(28, 28, 171);
        }

        .sign-up button:hover {
            background-color: grey;
            transform: translateY(-10%);
        }
    </style>
    <title>myExpense</title>
</head>

<body>
    <section class="main-container glass">
        <h1 style="text-align:center;font:bold;">MY EXPENSE TRACKER</h1>
        <div class="logo-cont">
            <img src="/public/images/logo (2).png" alt="">
        </div>
        <div class="options">
            <div class="login">
                <a href="/myExpense/login">
                    <button>Login</button>
                </a>
            </div>
            <div class="sign-up">
                <a href="/myExpense/sign-up">
                    <button>Sign up</button>
                </a>
            </div>
        </div>
    </section>
</body>

</html>
