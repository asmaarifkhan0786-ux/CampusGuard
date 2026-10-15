<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Emergency Report') | CampusGuard</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f3f6fb;
            color: #172b4d;
            min-height: 100vh;
        }

        .topbar {
            background: #061d3d;
            color: white;
            padding: 18px 6%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            border-radius: 12px;
            background: #0b55b7;
            display: grid;
            place-items: center;
            font-size: 23px;
        }

        .brand h1 {
            font-size: 18px;
            font-weight: 800;
        }

        .brand p {
            font-size: 11px;
            color: #cbd8eb;
            margin-top: 4px;
        }

        .logout-form button {
            background: transparent;
            color: white;
            border: 1px solid #7890af;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .logout-form button:hover {
            background: #17375f;
        }

        .page {
            max-width: 950px;
            margin: 38px auto;
            padding: 0 20px 40px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome .eyebrow {
            color: #0b55b7;
            text-transform: uppercase;
            letter-spacing: 1.4px;
            font-size: 11px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .welcome h2 {
            color: #061d3d;
            font-size: 30px;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #687891;
            line-height: 1.7;
            font-size: 14px;
        }

        .form-card {
            background: white;
            border: 1px solid #e2e9f2;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(6, 29, 61, .05);
        }

        .form-heading {
            border-bottom: 1px solid #e8edf4;
            padding-bottom: 20px;
            margin-bottom: 24px;
        }

        .form-heading h3 {
            font-size: 18px;
            color: #061d3d;
            margin-bottom: 7px;
        }

        .form-heading p {
            font-size: 13px;
            color: #718096;
            line-height: 1.6;
        }

        .form-content {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .field {
            min-width: 0;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 9px;
            color: #263a57;
            font-size: 13px;
            font-weight: 700;
        }

        .required {
            color: #f32336;
        }

        input, select, textarea {
            width: 100%;
            border: 1px solid #d8e1ed;
            border-radius: 9px;
            padding: 12px 13px;
            background: #fff;
            color: #172b4d;
            font-family: inherit;
            font-size: 13px;
            outline: none;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #0b55b7;
            box-shadow: 0 0 0 3px rgba(11, 85, 183, .10);
        }

        textarea {
            min-height: 135px;
            resize: vertical;
        }

        .hint {
            color: #7b899d;
            font-size: 11px;
            line-height: 1.6;
            margin-top: 7px;
        }

        .error {
            color: #d82032;
            font-size: 12px;
            margin-top: 7px;
        }

        .alert {
            border-radius: 9px;
            padding: 13px 15px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.6;
        }

        .alert-success {
            background: #e8f8ef;
            border: 1px solid #b7e7ca;
            color: #176b3a;
        }

        .alert-error {
            background: #fff0f0;
            border: 1px solid #f5c4c7;
            color: #a71d2a;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #e8edf4;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border-radius: 9px;
            padding: 12px 19px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-cancel {
            color: #53657e;
            background: white;
            border: 1px solid #d8e1ed;
        }

        .btn-submit {
            color: white;
            background: #0b55b7;
            border: 1px solid #0b55b7;
        }

        .btn-submit:hover {
            background: #084590;
        }

        .footer {
            text-align: center;
            color: #8190a5;
            font-size: 11px;
            padding: 0 20px 25px;
        }

        @media (max-width: 600px) {
            .topbar {
                padding: 16px 20px;
            }

            .brand h1 {
                font-size: 15px;
            }

            .page {
                margin-top: 25px;
                padding: 0 14px 30px;
            }

            .welcome h2 {
                font-size: 25px;
            }

            .form-card {
                padding: 20px 16px;
            }

            .form-content {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .field.full {
                grid-column: auto;
            }

            .actions {
                flex-direction: column-reverse;
            }

            .actions .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <header class="topbar">
        <div class="brand">
            <div class="brand-icon">🛡️</div>
            <div>
                <h1>CampusGuard</h1>
                <p>Safe Campus, Secure Future</p>
            </div>
        </div>

        <form class="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Sign Out</button>
        </form>
    </header>

    <main class="page">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                Please correct the errors below and try again.
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        CampusGuard · Campus Crisis & Emergency Management System
    </footer>

</body>
</html>