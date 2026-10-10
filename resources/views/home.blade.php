<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Campus Crisis & Emergency Management System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #08264d;
            background: #ffffff;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* =========================
           NAVBAR
        ========================== */

        .navbar {
            height: 70px;
            background: #061f46;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 8%;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            position: relative;
            z-index: 20;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 390px;
        }

        .nav-logo-icon {
            width: 48px;
            height: 48px;
            border: 2px solid white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            background: rgba(255,255,255,0.08);
        }

        .nav-logo-text {
            line-height: 1.15;
        }

        .nav-logo-text strong {
            display: block;
            font-size: 16px;
        }

        .nav-logo-text small {
            display: block;
            font-size: 9px;
            margin-top: 4px;
            opacity: .85;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 34px;
            flex: 1;
            justify-content: center;
        }

        .nav-menu a {
            font-size: 13px;
            font-weight: 600;
            padding: 25px 0;
            position: relative;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: #ff3345;
        }

        .nav-menu a.active::after {
            content: "";
            position: absolute;
            height: 3px;
            background: #ff3345;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-icon {
            font-size: 20px;
        }

        .login-btn {
            border: 1px solid white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
        }

        .login-btn:hover {
            background: white;
            color: #06224b;
        }

        .emergency-btn {
            background: #f52d3d;
            color: white;
            border: none;
            padding: 11px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
        }

        .emergency-btn:hover {
            background: #d91d2e;
        }

        /* =========================
           HERO
        ========================== */

        .hero {
            min-height: 300px;
            position: relative;
            overflow: hidden;
            background: #08264d;
        }

        .hero-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(
                    90deg,
                    rgba(3, 29, 63, 0.97) 0%,
                    rgba(3, 29, 63, 0.92) 31%,
                    rgba(3, 29, 63, 0.48) 58%,
                    rgba(3, 29, 63, 0.08) 100%
                );
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1320px;
            margin: auto;
            min-height: 300px;
            padding: 40px 7%;
            display: flex;
            align-items: center;
        }

        .hero-text {
            max-width: 570px;
            color: white;
        }

        .hero-tag {
            display: inline-block;
            background: #f42d3e;
            color: white;
            font-size: 11px;
            font-weight: bold;
            padding: 7px 14px;
            border-radius: 20px;
            margin-bottom: 14px;
        }

        .hero-text h1 {
            font-size: 30px;
            line-height: 1.2;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .hero-text h1 span {
            color: #ff3345;
        }

        .hero-subtitle {
            font-size: 17px;
            margin-bottom: 12px;
        }

        .hero-description {
            font-size: 13px;
            line-height: 1.7;
            color: #e9f1fb;
            max-width: 540px;
            margin-bottom: 20px;
        }

        .hero-buttons {
            display: flex;
            gap: 14px;
        }

        .hero-primary {
            background: #f52d3d;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
        }

        .hero-secondary {
            border: 1px solid white;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
        }

        .hero-secondary:hover {
            background: white;
            color: #08264d;
        }

        /* =========================
           SECTION
        ========================== */

        .container {
            width: 84%;
            max-width: 1320px;
            margin: auto;
        }

        .section {
            padding: 35px 0;
        }

        .section-label {
            color: #ef3344;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .section-title {
            font-size: 21px;
            color: #08264d;
            margin-bottom: 22px;
        }

        /* =========================
           SERVICE CARDS
        ========================== */

        .service-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
        }

        .service-card {
            border: 1px solid #e0e7f0;
            border-radius: 10px;
            padding: 18px;
            background: white;
            box-shadow: 0 2px 8px rgba(10,40,80,.04);
            transition: .25s;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(10,40,80,.10);
        }

        .service-icon {
            width: 43px;
            height: 43px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            margin-bottom: 13px;
        }

        .red {
            background: #ffe4e7;
        }

        .orange {
            background: #fff0dc;
        }

        .blue {
            background: #e4efff;
        }

        .purple {
            background: #eee4ff;
        }

        .service-card h3 {
            font-size: 15px;
            margin-bottom: 9px;
            color: #08264d;
        }

        .service-card p {
            font-size: 12px;
            line-height: 1.55;
            color: #63748b;
            min-height: 55px;
        }

        .report-link {
            display: inline-block;
            margin-top: 12px;
            padding: 8px 14px;
            border-radius: 18px;
            font-size: 11px;
            color: white;
            font-weight: bold;
        }

        .report-red {
            background: #ef3041;
        }

        .report-orange {
            background: #f27b21;
        }

        .report-blue {
            background: #126ad7;
        }

        .report-purple {
            background: #7135d9;
        }

        /* =========================
           HOW IT WORKS
        ========================== */

        .how-section {
            background: #f4f8fc;
        }

        .how-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 50px;
            align-items: center;
        }

        .how-intro p {
            font-size: 13px;
            color: #63748b;
            line-height: 1.7;
            margin-bottom: 18px;
        }

        .learn-btn {
            display: inline-block;
            background: #082d5e;
            color: white;
            padding: 11px 20px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .step {
            text-align: center;
            position: relative;
        }

        .step-number {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            color: white;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .step:nth-child(1) .step-number {
            background: #ef3041;
        }

        .step:nth-child(2) .step-number {
            background: #126ad7;
        }

        .step:nth-child(3) .step-number {
            background: #1da56d;
        }

        .step-icon {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .step h3 {
            font-size: 14px;
            margin-bottom: 6px;
        }

        .step p {
            font-size: 11px;
            line-height: 1.5;
            color: #64758c;
        }

        /* =========================
           STATS
        ========================== */

        .stats-section {
            background:
                linear-gradient(
                    rgba(2, 31, 65, .94),
                    rgba(2, 31, 65, .94)
                ),
                url('{{ asset('campus.jpg') }}') center/cover;
            color: white;
            padding: 22px 0;
        }

        .stats-wrapper {
            display: grid;
            grid-template-columns: 1.5fr repeat(4, 1fr);
            align-items: center;
            gap: 25px;
        }

        .stats-intro h2 {
            font-size: 17px;
            margin-bottom: 5px;
        }

        .stats-intro p {
            font-size: 10px;
            color: #d4dfed;
        }

        .stat {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
        }

        .stat strong {
            display: block;
            font-size: 24px;
        }

        .stat span {
            font-size: 10px;
            color: #d9e5f2;
        }

        /* =========================
           FOOTER
        ========================== */

        footer {
            background: #031c3b;
            color: white;
        }

        .footer-main {
            padding: 25px 0;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.2fr 1fr;
            gap: 35px;
        }

        .footer-brand {
            display: flex;
            gap: 12px;
        }

        .footer-brand-icon {
            width: 42px;
            height: 42px;
            border: 2px solid white;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
        }

        .footer-brand strong {
            display: block;
            font-size: 12px;
            line-height: 1.3;
        }

        .footer-brand small {
            font-size: 8px;
            color: #b9c8da;
        }

        .footer-column h4 {
            font-size: 12px;
            margin-bottom: 12px;
        }

        .footer-column a,
        .footer-column p {
            display: block;
            color: #b8c6d8;
            font-size: 10px;
            line-height: 1.9;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.12);
            padding: 11px 0;
            display: flex;
            justify-content: space-between;
            color: #9caec5;
            font-size: 9px;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 1100px) {

            .navbar {
                padding: 0 4%;
            }

            .nav-logo {
                min-width: auto;
            }

            .nav-menu {
                gap: 16px;
            }

            .service-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-wrapper {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-intro {
                grid-column: span 2;
            }
        }

        @media (max-width: 800px) {

            .navbar {
                height: auto;
                padding: 14px 5%;
                flex-wrap: wrap;
                gap: 15px;
            }

            .nav-logo {
                width: 100%;
            }

            .nav-menu {
                order: 3;
                width: 100%;
                overflow-x: auto;
                justify-content: flex-start;
            }

            .nav-menu a {
                padding: 10px 0;
                white-space: nowrap;
            }

            .nav-actions {
                position: absolute;
                right: 5%;
                top: 18px;
            }

            .nav-actions .search-icon {
                display: none;
            }

            .login-btn {
                padding: 8px 12px;
            }

            .emergency-btn {
                padding: 8px 10px;
            }

            .hero-content {
                padding: 45px 6%;
            }

            .hero-text h1 {
                font-size: 25px;
            }

            .hero-overlay {
                background:
                    linear-gradient(
                        90deg,
                        rgba(3,29,63,.94),
                        rgba(3,29,63,.78)
                    );
            }

            .service-grid {
                grid-template-columns: 1fr;
            }

            .how-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .steps {
                grid-template-columns: 1fr;
            }

            .stats-wrapper {
                grid-template-columns: 1fr 1fr;
            }

            .stats-intro {
                grid-column: span 2;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 8px;
            }
        }

        @media (max-width: 500px) {

            .hero-buttons {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats-wrapper {
                grid-template-columns: 1fr;
            }

            .stats-intro {
                grid-column: span 1;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<!-- =========================
     NAVBAR
========================== -->

<header class="navbar">

    <a href="{{ url('/') }}" class="nav-logo">

        <div class="nav-logo-icon">
            🛡️
        </div>

        <div class="nav-logo-text">
            <strong>Campus Crisis &amp;</strong>
            <strong>Emergency Management System</strong>
            <small>Safe Campus, Secure Future</small>
        </div>

    </a>


    <nav class="nav-menu">

        <a href="{{ url('/') }}" class="active">
            Home
        </a>

        <a href="#about">
            About
        </a>

        <a href="#services">
            Emergency Services
        </a>

        <a href="#safety">
            Safety Guidelines
        </a>

        <a href="#contact">
            Contact
        </a>

    </nav>


    <div class="nav-actions">

        <span class="search-icon">
            🔍
        </span>

        <a href="{{ route('login') }}" class="login-btn">
            Login
        </a>

        <a href="{{ url('/emergency-reports/create') }}" class="emergency-btn">
            ⚠ Report Emergency
        </a>

    </div>

</header>


<!-- =========================
     HERO
========================== -->

<section class="hero">

    <img
        src="{{ asset('campus.jpg') }}"
        alt="Campus Building"
        class="hero-image"
    >

    <div class="hero-overlay"></div>

    <div class="hero-content">

        <div class="hero-text">

            <div class="hero-tag">
                CAMPUS SAFETY FIRST
            </div>

            <h1>
                CAMPUS CRISIS &amp;<br>
                <span>EMERGENCY</span> MANAGEMENT SYSTEM
            </h1>

            <div class="hero-subtitle">
                Smart Response. Safer Campus. Secure Future.
            </div>

            <p class="hero-description">
                A comprehensive system to report, manage and respond to campus
                emergencies. Ensuring the safety of students, faculty and staff — always.
            </p>

            <div class="hero-buttons">

                <a href="{{ url('/emergency-reports/create') }}" class="hero-primary">
                    ⚠ &nbsp; Report an Emergency
                </a>

                <a href="#services" class="hero-secondary">
                    Explore Safety Features &nbsp; →
                </a>

            </div>

        </div>

    </div>

</section>


<!-- =========================
     EMERGENCY SERVICES
========================== -->

<section class="section" id="services">

    <div class="container">

        <div class="section-label">
            EMERGENCY SERVICES
        </div>

        <h2 class="section-title">
            Quick Access to Emergency Services
        </h2>


        <div class="service-grid">

            <div class="service-card">

                <div class="service-icon red">
                    🩺
                </div>

                <h3>
                    Medical Emergency
                </h3>

                <p>
                    Medical assistance for health-related emergencies and injuries.
                </p>

                <a href="{{ url('/emergency-reports/create') }}"
                   class="report-link report-red">
                    Report Now &nbsp; →
                </a>

            </div>


            <div class="service-card">

                <div class="service-icon orange">
                    🔥
                </div>

                <h3>
                    Fire &amp; Safety
                </h3>

                <p>
                    Fire incidents, gas leaks and safety hazards.
                </p>

                <a href="{{ url('/emergency-reports/create') }}"
                   class="report-link report-orange">
                    Report Now &nbsp; →
                </a>

            </div>


            <div class="service-card">

                <div class="service-icon blue">
                    🛡️
                </div>

                <h3>
                    Security Incident
                </h3>

                <p>
                    Suspicious activity, threats or security concerns.
                </p>

                <a href="{{ url('/emergency-reports/create') }}"
                   class="report-link report-blue">
                    Report Now &nbsp; →
                </a>

            </div>


            <div class="service-card">

                <div class="service-icon purple">
                    ⚠️
                </div>

                <h3>
                    Campus Hazard
                </h3>

                <p>
                    Natural disasters, power failure, structural issues and other hazards.
                </p>

                <a href="{{ url('/emergency-reports/create') }}"
                   class="report-link report-purple">
                    Report Now &nbsp; →
                </a>

            </div>

        </div>

    </div>

</section>


<!-- =========================
     HOW IT WORKS
========================== -->

<section class="section how-section" id="about">

    <div class="container">

        <div class="how-grid">

            <div class="how-intro">

                <div class="section-label">
                    HOW IT WORKS
                </div>

                <h2 class="section-title">
                    From Report to Response
                </h2>

                <p>
                    Our system ensures a quick and organized response
                    to every emergency. Here's how it works:
                </p>

                <a href="#services" class="learn-btn">
                    Learn More &nbsp; →
                </a>

            </div>


            <div class="steps">

                <div class="step">

                    <div class="step-number">
                        1
                    </div>

                    <div class="step-icon">
                        🚨
                    </div>

                    <h3>
                        Report an Incident
                    </h3>

                    <p>
                        Submit a report with details like location,
                        type and severity.
                    </p>

                </div>


                <div class="step">

                    <div class="step-number">
                        2
                    </div>

                    <div class="step-icon">
                        👥
                    </div>

                    <h3>
                        Team Assignment
                    </h3>

                    <p>
                        The nearest and best-suited team is assigned
                        automatically.
                    </p>

                </div>


                <div class="step">

                    <div class="step-number">
                        3
                    </div>

                    <div class="step-icon">
                        ✅
                    </div>

                    <h3>
                        Track Response Status
                    </h3>

                    <p>
                        Monitor the progress until the issue is resolved.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================
     CAMPUS SAFETY OVERVIEW
========================== -->

<section class="stats-section">

    <div class="container">

        <div class="stats-wrapper">

            <div class="stats-intro">

                <div class="section-label">
                    CAMPUS SAFETY OVERVIEW
                </div>

                <h2>
                    Together for a Safer Campus
                </h2>

                <p>
                    Real-time monitoring. Faster response. A safer tomorrow.
                </p>

            </div>


            <div class="stat">

                <div class="stat-icon" style="background:#ef3041;">
                    🚨
                </div>

                <div>
                    <strong>28</strong>
                    <span>Total Incidents</span>
                </div>

            </div>


            <div class="stat">

                <div class="stat-icon" style="background:#159d68;">
                    ✓
                </div>

                <div>
                    <strong>21</strong>
                    <span>Resolved Cases</span>
                </div>

            </div>


            <div class="stat">

                <div class="stat-icon" style="background:#1672d8;">
                    👥
                </div>

                <div>
                    <strong>4</strong>
                    <span>Available Teams</span>
                </div>

            </div>


            <div class="stat">

                <div class="stat-icon" style="background:#7435d7;">
                    🏫
                </div>

                <div>
                    <strong>12</strong>
                    <span>Campus Buildings</span>
                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================
     FOOTER
========================== -->

<footer id="contact">

    <div class="footer-main">

        <div class="container">

            <div class="footer-grid">


                <div>

                    <div class="footer-brand">

                        <div class="footer-brand-icon">
                            🛡️
                        </div>

                        <div>

                            <strong>
                                Campus Crisis &amp;<br>
                                Emergency Management System
                            </strong>

                            <small>
                                Safe Campus, Secure Future
                            </small>

                        </div>

                    </div>

                </div>


                <div class="footer-column">

                    <h4>
                        Quick Links
                    </h4>

                    <a href="{{ url('/') }}">
                        Home
                    </a>

                    <a href="#about">
                        About
                    </a>

                    <a href="#services">
                        Emergency Services
                    </a>

                    <a href="#safety">
                        Safety Guidelines
                    </a>

                </div>


                <div class="footer-column">

                    <h4>
                        Support
                    </h4>

                    <a href="#contact">
                        Contact Us
                    </a>

                    <a href="#">
                        Emergency Numbers
                    </a>

                    <a href="#">
                        FAQs
                    </a>

                    <a href="#">
                        Help Desk
                    </a>

                </div>


                <div class="footer-column">

                    <h4>
                        Emergency Contact
                    </h4>

                    <p>
                        ☎ +92 300 1234567
                    </p>

                    <p>
                        (24/7 Support)
                    </p>

                    <p>
                        ✉ support@campusemergency.edu.pk
                    </p>

                </div>


                <div class="footer-column">

                    <h4>
                        Follow Us
                    </h4>

                    <p>
                        f &nbsp;&nbsp; ◎ &nbsp;&nbsp; 🐦 &nbsp;&nbsp; in &nbsp;&nbsp; ▶
                    </p>

                </div>


            </div>

        </div>

    </div>


    <div class="container">

        <div class="footer-bottom">

            <span>
                © 2025 Campus Crisis &amp; Emergency Management System. All rights reserved.
            </span>

            <span>
                Privacy Policy &nbsp; | &nbsp; Terms &amp; Conditions
            </span>

        </div>

    </div>

</footer>


</body>
</html>