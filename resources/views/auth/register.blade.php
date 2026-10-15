<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account | CampusGuard</title>

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

        .register-wrapper {
            width: 100%;
            max-width: 1100px;

            display: grid;
            grid-template-columns: 1fr 1fr;

            border-radius: 24px;
            overflow: hidden;

            box-shadow: 0 30px 80px rgba(0,0,0,.25);
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

        .account-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;

            margin-bottom: 25px;
        }

        .account-option {
            border: 2px solid #d7e0ea;
            border-radius: 14px;

            padding: 20px 15px;

            text-align: center;

            cursor: pointer;

            transition: .2s ease;

            background: #ffffff;
        }

        .account-option:hover {
            border-color: #0866d8;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(8,102,216,.10);
        }

        .account-option.active {
            border-color: #0866d8;
            background: #f1f7ff;
        }

        .account-icon {
            font-size: 35px;
            margin-bottom: 8px;
        }

        .account-title {
            color: #062c5c;
            font-size: 17px;
            font-weight: bold;
        }

        .account-description {
            color: #667085;
            font-size: 12px;
            margin-top: 5px;
        }

        .form-group {
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

            padding: 0 16px;

            font-size: 15px;

            outline: none;
        }

        input:focus {
            border-color: #0866d8;

            box-shadow:
                0 0 0 4px rgba(8,102,216,.08);
        }

        .admin-note {
            background: #fff7e6;
            border: 1px solid #f2d28b;

            color: #795b16;

            padding: 12px 14px;

            border-radius: 10px;

            font-size: 13px;

            line-height: 1.5;

            margin-bottom: 18px;
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
        }

        .btn:hover {
            background: #052b57;
        }

        .bottom {
            text-align: center;

            margin-top: 22px;

            color: #667085;

            font-size: 14px;
        }

        .bottom a {
            color: #0866d8;

            text-decoration: none;

            font-weight: bold;
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

            .register-wrapper {
                grid-template-columns: 1fr;
            }

            .left {
                padding: 40px 30px;
            }

            .right {
                padding: 40px 25px;
            }

        }

        @media(max-width: 500px) {

            .account-options {
                grid-template-columns: 1fr;
            }

            .left h1 {
                font-size: 32px;
            }

        }

    </style>

</head>


<body>

<div class="register-wrapper">


    <!-- LEFT SIDE -->

    <div class="left">

        <div class="logo">
            🛡️
        </div>

        <div class="badge">
            CAMPUS SAFETY FIRST
        </div>

        <h1>
            Campus Crisis &
            <span class="red">
                Emergency
            </span>
            Management System
        </h1>

        <p>
            Create your CampusGuard account and become part
            of a safer, smarter and more secure campus community.
        </p>

    </div>


    <!-- RIGHT SIDE -->

    <div class="right">

        <div class="card">

            <h2>
                Create Account
            </h2>

            <p class="subtitle">
                Choose your account type to continue
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


            <!-- ACCOUNT TYPE -->

            <form
                action="{{ route('register.submit') }}"
                method="POST"
                id="registerForm"
            >

                @csrf

                <input
                    type="hidden"
                    name="account_type"
                    id="account_type"
                    value="{{ old('account_type', 'student') }}"
                >


                <div class="account-options">

                    <!-- STUDENT -->

                    <div
                        class="account-option active"
                        id="studentOption"
                        onclick="selectAccountType('student')"
                    >

                        <div class="account-icon">
                            👨‍🎓
                        </div>

                        <div class="account-title">
                            Student
                        </div>

                        <div class="account-description">
                            Report and track incidents
                        </div>

                    </div>


                    <!-- ADMIN -->

                    <div
                        class="account-option"
                        id="adminOption"
                        onclick="selectAccountType('admin')"
                    >

                        <div class="account-icon">
                            🛡️
                        </div>

                        <div class="account-title">
                            Admin
                        </div>

                        <div class="account-description">
                            Manage CampusGuard
                        </div>

                    </div>

                </div>


                <!-- ADMIN INFORMATION -->

                <div
                    id="adminNote"
                    class="admin-note"
                    style="display: none;"
                >

                    Admin access is restricted to authorized
                    CampusGuard administrators:
                    <strong>Mohid, Laiba, Asma and Bushra.</strong>

                </div>


                <!-- NAME -->

                <div class="form-group">

                    <label>
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter your full name"
                        required
                    >

                </div>


                <!-- EMAIL -->

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
                    >

                </div>


                <!-- PASSWORD -->

                <div class="form-group">

                    <label>
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Minimum 8 characters"
                        required
                    >

                </div>


                <!-- CONFIRM PASSWORD -->

                <div class="form-group">

                    <label>
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm your password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="btn"
                >
                    Create Student Account
                </button>

            </form>


            <div class="bottom">

                Already have an account?

                <a href="{{ route('login') }}">
                    Login
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


<script>

    function selectAccountType(type) {

        const accountType = document.getElementById('account_type');

        const studentOption = document.getElementById('studentOption');

        const adminOption = document.getElementById('adminOption');

        const adminNote = document.getElementById('adminNote');

        const button = document.querySelector('.btn');


        accountType.value = type;


        if (type === 'student') {

            studentOption.classList.add('active');

            adminOption.classList.remove('active');

            adminNote.style.display = 'none';

            button.innerText = 'Create Student Account';

        }


        if (type === 'admin') {

            adminOption.classList.add('active');

            studentOption.classList.remove('active');

            adminNote.style.display = 'block';

            button.innerText = 'Create Admin Account';

        }

    }


    // Keep selected option after validation error

    document.addEventListener('DOMContentLoaded', function () {

        const selectedType =
            document.getElementById('account_type').value;

        selectAccountType(selectedType);

    });

</script>


</body>

</html>