<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Forgot Password | CampusGuard</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;

            min-height: 100vh;

            background:
                linear-gradient(
                    90deg,
                    rgba(2,29,63,.95),
                    rgba(4,46,91,.80)
                ),
                url('https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=2000&q=85');

            background-size: cover;
            background-position: center;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 20px;
        }


        .card {
            width: 100%;
            max-width: 500px;

            background: white;

            padding: 45px;

            border-radius: 22px;

            box-shadow:
                0 30px 80px rgba(0,0,0,.25);
        }


        .logo {
            width: 85px;
            height: 85px;

            background: #eef5fb;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 42px;

            margin: 0 auto 20px;
        }


        h1 {
            text-align: center;

            color: #062c5c;

            font-size: 28px;

            margin-bottom: 10px;
        }


        .subtitle {
            text-align: center;

            color: #667085;

            line-height: 1.6;

            margin-bottom: 25px;
        }


        .success {
            background: #e8f8ef;
            color: #18794e;

            padding: 13px;

            border-radius: 10px;

            margin-bottom: 18px;
        }


        .error {
            background: #fff0f1;
            color: #c5222d;

            padding: 13px;

            border-radius: 10px;

            margin-bottom: 18px;
        }


        label {
            display: block;

            color: #23344d;

            font-weight: 600;

            font-size: 14px;

            margin-bottom: 8px;
        }


        input {
            width: 100%;

            height: 55px;

            border: 1px solid #d7e0ea;

            border-radius: 10px;

            padding: 0 15px;

            font-size: 15px;

            outline: none;

            margin-bottom: 18px;
        }


        input:focus {
            border-color: #0866d8;
        }


        button {
            width: 100%;

            height: 55px;

            border: none;

            border-radius: 10px;

            background: #06376f;

            color: white;

            font-size: 16px;

            font-weight: bold;

            cursor: pointer;
        }


        .back {
            text-align: center;

            margin-top: 20px;
        }


        .back a {
            color: #0866d8;

            text-decoration: none;

            font-weight: 600;
        }

    </style>

</head>


<body>

<div class="card">

    <div class="logo">
        🛡️
    </div>


    <h1>
        Forgot Password?
    </h1>


    <p class="subtitle">
        Enter your registered email address to find your
        CampusGuard account.
    </p>


    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    @if($errors->any())

        <div class="error">

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif


    <form
        action="{{ route('password.email') }}"
        method="POST"
    >

        @csrf

        <label>
            Email Address
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Enter your email"
            required
        >


        <button type="submit">
            Find My Account
        </button>

    </form>


    <div class="back">

        <a href="{{ route('login') }}">
            ← Back to Login
        </a>

    </div>

</div>

</body>

</html>