<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Student Login | CampusGuard</title>

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
                    rgba(2, 29, 63, .94),
                    rgba(4, 46, 91, .78),
                    rgba(241, 246, 252, .55)
                ),
                url('https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=2000&q=85');

            background-size: cover;
            background-position: center;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1050px;

            display: grid;
            grid-template-columns: 1fr 1fr;

            border-radius: 24px;
            overflow: hidden;

            box-shadow:
                0 30px 80px rgba(0,0,0,.25);
        }

        .left {
            padding: 60px;

            color: white;

            background:
                linear-gradient(
                    rgba(2,28,62,.94),
                    rgba(3,43,86,.88)
                );

            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            width: 90px;
            height: 90px;

            border: 3px solid white;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 45px;

            margin-bottom: 25px;
        }

        .badge {
            background: #ed1c2f;

            padding: 8px 18px;

            border-radius: 30px;

            width: fit-content;

            font-size: 13px;
            font-weight: bold;

            margin-bottom: 20px;
        }

        .left h1 {
            font-size: 42px;
            line-height: 1.15;

            margin-bottom: 20px;
        }

        .red {
            color: #ff263b;
        }

        .left p {
            color: #d9e7f7;

            line-height: 1.7;

            font-size: 16px;
        }

        .right {
            background: rgba(255,255,255,.97);

            padding: 55px;

            display: flex;
            align-items: center;
        }

        .card {
            width: 100%;
        }

        .card h2 {
            text-align: center;

            color: #062c5c;

            font-size: 30px;

            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;

            color: #667085;

            margin-bottom: 30px;
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

        .form-group {
            margin-bottom: 20px;
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

            padding: 0 16px;

            font-size: 15px;

            outline: none;
        }

        input:focus {
            border-color: #0866d8;

            box-shadow:
                0 0 0 4px rgba(8,102,216,.08);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 22px;

            color: #667085;

            font-size: 14px;
        }

        .remember input {
            width: 16px;
            height: 16px;
        }

        .btn {
            width: 100%;

            height: 57px;

            border: none;

            border-radius: 10px;

            background: #06376f;

            color: white;

            font-size: 16px;

            font-weight: bold;

            cursor: pointer;

            transition: .2s;
        }

        .btn:hover {
            background: #052b57;
        }

        .create-account {
            text-align: center;

            margin-top: 22px;

            color: #667085;

            font-size: 14px;
        }

        .create-account a {
            color: #0866d8;

            text-decoration: none;

            font-weight: bold;
        }

        .admin-login {
            text-align: center;

            margin-top: 18px;
        }

        .admin-login a {
            color: #53657b;

            text-decoration: none;

            font-size: 14px;
        }

        .home {
            text-align: center;

            margin-top: 18px;
        }

        .home a {
            color: #53657b;

            text-decoration: none;

            font-size: 14px;
        }

        @media(max-width: 850px) {

            .login-wrapper {
                grid-template-columns: 1fr;
            }

            .left {
                padding: 40px 30px;
            }

            .right {
                padding: 40px 25px;
            }

        }

    </style>

</head>


<body>

<div class="login-wrapper">


    <!-- LEFT -->

    <div class="left">

        <div class="logo">
            🛡️
        </div>

        <div class="badge">
            STUDENT ACCESS
        </div>

        <h1>
            Campus Crisis &
            <span class="red">
                Emergency
            </span>
            Management System
        </h1>

        <p>
            Sign in to CampusGuard to quickly report
            emergencies, incidents and safety concerns
            across your campus.
        </p>

    </div>


    <!-- RIGHT -->

    <div class="right">

        <div class="card">

            <h2>
                Student Login
            </h2>

            <p class="subtitle">
                Sign in to report and track campus incidents
            </p>


            @if($errors->any())

                <div class="error">

                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            @if(session('success'))

                <div class="success">
                    {{ session('success') }}
                </div>

            @endif


            <form
                action="{{ route('student.login.submit') }}"
                method="POST"
            >

                @csrf


                <div class="form-group">

                    <label>
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                        autofocus
                    >

                </div>


                <div class="form-group">

                    <label>
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >

                </div>


                <label class="remember">

                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    Remember me

                </label>


                <button
                    type="submit"
                    class="btn"
                >
                    Student Login
                </button>

            </form>


            <div class="create-account">

                Don't have an account?

                <a href="{{ route('register') }}">
                    Create Account
                </a>

            </div>


            <div class="admin-login">

                <a href="{{ route('admin.login') }}">
                    Admin Login
                </a>

            </div>


            <div class="home">

                <a href="{{ route('home') }}">
                    ← Back to CampusGuard Home
                </a>

            </div>

        </div>

    </div>

</div>

</body>

</html>