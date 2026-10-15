<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $loginType === 'student' ? 'Student Login' : 'Admin Login' }}
        | CampusGuard
    </title>

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

            padding: 35px;
        }

        .main-wrapper {
            width: 100%;
            max-width: 1450px;
            min-height: 750px;

            display: grid;
            grid-template-columns: 1.05fr .95fr;

            border-radius: 24px;
            overflow: hidden;

            box-shadow: 0 30px 80px rgba(0, 0, 0, .25);
        }

        /* LEFT */

        .left-side {
            color: white;
            padding: 70px 70px;

            background:
                linear-gradient(
                    rgba(2, 28, 62, .90),
                    rgba(3, 43, 86, .82)
                );

            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            width: 105px;
            height: 105px;
            border: 3px solid white;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 52px;
            margin-bottom: 35px;

            background: rgba(255,255,255,.08);
        }

        .small-title {
            display: inline-block;
            background: #ed1c2f;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 22px;
            width: fit-content;
        }

        .left-side h1 {
            font-size: 52px;
            line-height: 1.12;
            margin-bottom: 22px;
        }

        .red {
            color: #ff263b;
        }

        .tagline {
            font-size: 20px;
            letter-spacing: 2px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .description {
            max-width: 600px;
            color: #d9e7f7;
            line-height: 1.7;
            font-size: 16px;
        }

        .features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            margin-top: 55px;
        }

        .feature {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,.45);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 24px;
            background: rgba(255,255,255,.08);
        }

        .feature h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .feature p {
            font-size: 13px;
            color: #cbd9e9;
        }

        .bottom-text {
            margin-top: 55px;
            font-size: 22px;
            font-style: italic;
            color: #fff;
        }

        /* RIGHT */

        .right-side {
            background: rgba(255,255,255,.97);

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 50px;
        }

        .login-card {
            width: 100%;
            max-width: 530px;
        }

        .brand-logo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: #eef5fb;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 45px;
        }

        .login-card h2 {
            text-align: center;
            color: #062c5c;
            font-size: 30px;
            margin-bottom: 10px;
        }

        .login-card .subtitle {
            text-align: center;
            color: #667085;
            line-height: 1.5;
            margin-bottom: 32px;
        }

        .success {
            background: #e8f8ef;
            color: #18794e;
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .error {
            background: #fff0f1;
            color: #c5222d;
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #23344d;
            font-weight: 600;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper span {
            position: absolute;
            left: 17px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 19px;
            color: #667085;
        }

        .input-wrapper input {
            width: 100%;
            height: 58px;
            border: 1px solid #d7e0ea;
            border-radius: 11px;
            padding: 0 48px;
            outline: none;
            font-size: 15px;
            color: #1c2c40;
            transition: .2s;
            background: #fbfdff;
        }

        .input-wrapper input:focus {
            border-color: #0866d8;
            box-shadow: 0 0 0 4px rgba(8,102,216,.08);
        }

        .password-toggle {
            position: absolute !important;
            left: auto !important;
            right: 16px;
            cursor: pointer;
            font-size: 17px !important;
        }

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 8px 0 25px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #667085;
            font-size: 14px;
        }

        .remember input {
            width: 17px;
            height: 17px;
        }

        .forgot {
            color: #1167c9;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            height: 58px;
            border: none;
            border-radius: 11px;
            background: #06376f;
            color: white;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .login-btn:hover {
            background: #052b57;
            transform: translateY(-1px);
        }

        .create-account {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 5px;
            color: #667085;
            font-size: 14px;
        }

        .create-account a {
            color: #0866d8;
            text-decoration: none;
            font-weight: 700;
            margin-left: 5px;
        }

        .create-account a:hover {
            text-decoration: underline;
        }

        .or {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 25px 0;
            color: #8a96a6;
            font-size: 13px;
        }

        .or::before,
        .or::after {
            content: "";
            height: 1px;
            background: #dce3eb;
            flex: 1;
        }

        .role-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .role-btn {
            height: 55px;
            border: 1.5px solid #2271ce;
            border-radius: 10px;
            color: #0866d8;
            background: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            font-weight: 700;
            font-size: 14px;
            transition: .2s;
        }

        .role-btn:hover {
            background: #edf6ff;
        }

        .security {
            text-align: center;
            margin-top: 28px;
            color: #8290a3;
            font-size: 13px;
        }

        .back-home {
            text-align: center;
            margin-top: 18px;
        }

        .back-home a {
            color: #53657b;
            text-decoration: none;
            font-size: 14px;
        }

        @media(max-width: 950px) {

            body {
                padding: 15px;
            }

            .main-wrapper {
                grid-template-columns: 1fr;
            }

            .left-side {
                padding: 45px 30px;
            }

            .left-side h1 {
                font-size: 38px;
            }

            .right-side {
                padding: 40px 25px;
            }
        }

        @media(max-width: 550px) {

            .features {
                grid-template-columns: 1fr;
            }

            .role-buttons {
                grid-template-columns: 1fr;
            }

            .login-options {
                gap: 15px;
                flex-direction: column;
                align-items: flex-start;
            }
        }

    </style>
</head>

<body>

<div class="main-wrapper">

    <!-- LEFT SIDE -->

    <div class="left-side">

        <div class="logo">
            🛡️
        </div>

        <div class="small-title">
            CAMPUS SAFETY FIRST
        </div>

        <h1>
            Campus Crisis &amp;<br>
            <span class="red">Emergency</span>
            Management System
        </h1>

        <div class="tagline">
            SMART RESPONSE. SAFER CAMPUS. SECURE FUTURE.
        </div>

        <p class="description">
            A comprehensive system to report, manage and respond
            to campus emergencies. Ensuring the safety of students,
            faculty and staff — always.
        </p>

        <div class="features">

            <div class="feature">
                <div class="feature-icon">🛡️</div>

                <div>
                    <h3>Quick Response</h3>
                    <p>Immediate action for emergencies</p>
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">👥</div>

                <div>
                    <h3>Better Coordination</h3>
                    <p>Connects teams &amp; resources</p>
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">📍</div>

                <div>
                    <h3>Safe Campus</h3>
                    <p>Monitors &amp; manages incidents</p>
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">📊</div>

                <div>
                    <h3>Data Driven</h3>
                    <p>Reports &amp; analytics for improvement</p>
                </div>
            </div>

        </div>

        <div class="bottom-text">
            Together for a Safer Campus
        </div>

    </div>


    <!-- RIGHT SIDE -->

    <div class="right-side">

        <div class="login-card">

            <div class="brand-logo">
                🛡️
            </div>

            <h2>
                Campus Crisis &amp;
                <span class="red">Emergency</span>
                Management System
            </h2>

            <p class="subtitle">

                @if($loginType === 'student')

                    Student access portal.

                @else

                    Authorized administrator access portal.

                @endif

            </p>


            <!-- SUCCESS MESSAGE -->

            @if(session('success'))

                <div class="success">
                    {{ session('success') }}
                </div>

            @endif


            <!-- ERROR MESSAGE -->

            @if($errors->any())

                <div class="error">

                    @foreach($errors->all() as $error)

                        <div>{{ $error }}</div>

                    @endforeach

                </div>

            @endif


            <!-- LOGIN FORM -->

            <form action="{{ route('login.submit') }}" method="POST">

                @csrf

                <input
                    type="hidden"
                    name="login_type"
                    value="{{ $loginType }}"
                >


                <!-- EMAIL -->

                <div class="form-group">

                    <label>
                        Email Address
                    </label>

                    <div class="input-wrapper">

                        <span>👤</span>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            required
                            autofocus
                        >

                    </div>

                </div>


                <!-- PASSWORD -->

                <div class="form-group">

                    <label>
                        Password
                    </label>

                    <div class="input-wrapper">

                        <span>🔒</span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                        >

                        <span
                            class="password-toggle"
                            onclick="togglePassword()"
                        >
                            👁
                        </span>

                    </div>

                </div>


                <!-- OPTIONS -->

                <div class="login-options">

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >

                        Remember Me

                    </label>

                    <a
                        href="{{ route('password.request') }}"
                        class="forgot"
                    >
                        Forgot Password?
                    </a>

                </div>


                <!-- LOGIN BUTTON -->

                <button
                    type="submit"
                    class="login-btn"
                >

                    ➜ &nbsp;

                    @if($loginType === 'student')

                        Student Login

                    @else

                        Admin Login

                    @endif

                </button>

            </form>


            <!-- CREATE STUDENT ACCOUNT -->

            @if($loginType === 'student')

                <div class="create-account">

                    <span>
                        Don't have an account?
                    </span>

                    <a href="{{ route('register') }}">
                        Create Account
                    </a>

                </div>

            @endif


            <!-- SWITCH LOGIN -->

            <div class="or">
                OR
            </div>


            <div class="role-buttons">

                <a
                    href="{{ route('student.login') }}"
                    class="role-btn"
                >
                    🛡️ Student Login
                </a>

                <a
                    href="{{ route('admin.login') }}"
                    class="role-btn"
                >
                    👤 Admin Login
                </a>

            </div>


            <div class="security">

                🔒 Secure Access | CampusGuard

            </div>


            <div class="back-home">

                <a href="{{ route('home') }}">
                    ← Back to CampusGuard Home
                </a>

            </div>

        </div>

    </div>

</div>


<script>

function togglePassword()
{
    const password = document.getElementById('password');

    if (password.type === 'password') {

        password.type = 'text';

    } else {

        password.type = 'password';

    }
}

</script>

</body>
</html>