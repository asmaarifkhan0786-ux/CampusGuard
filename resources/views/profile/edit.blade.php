<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>My Profile - CampusGuard</title>

    <style>

        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #172033;
        }


        .header {
            background: #061d3b;
            color: white;
            padding: 22px 40px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }


        .brand {
            font-size: 22px;
            font-weight: 800;
        }


        .brand span {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #b9c9dc;
            margin-top: 4px;
        }


        .header-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }


        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;

            background: #ffffff;

            color: #061d3b;

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: 800;

            overflow: hidden;
        }


        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        .container {
            max-width: 1050px;
            margin: 40px auto;
            padding: 0 20px;
        }


        .back {
            display: inline-block;

            text-decoration: none;

            color: #1c5fa8;

            font-weight: 700;

            margin-bottom: 20px;
        }


        .title {
            margin-bottom: 25px;
        }


        .title h1 {
            margin: 0;
            font-size: 30px;
        }


        .title p {
            color: #6b7280;
            margin-top: 8px;
        }


        .card {
            background: white;

            border-radius: 16px;

            padding: 30px;

            box-shadow:
                0 8px 30px rgba(0, 0, 0, 0.07);
        }


        .profile-top {
            display: flex;
            align-items: center;

            gap: 20px;

            padding-bottom: 25px;
            margin-bottom: 25px;

            border-bottom: 1px solid #e5e7eb;
        }


        .photo-section {
            display: flex;
            align-items: center;
            gap: 18px;
        }


        .big-avatar {
            width: 100px;
            height: 100px;

            border-radius: 50%;

            background: #e8f0f9;

            color: #061d3b;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 32px;
            font-weight: 800;

            overflow: hidden;

            border: 4px solid #ffffff;

            box-shadow:
                0 3px 12px rgba(0,0,0,.12);
        }


        .big-avatar img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }


        .photo-info h2 {
            margin: 0 0 5px;
        }


        .photo-info p {
            margin: 0 0 12px;

            color: #6b7280;
        }


        .photo-button {
            display: inline-block;

            padding: 9px 14px;

            border-radius: 8px;

            background: #eaf2ff;

            color: #1769df;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;
        }


        .photo-button:hover {
            background: #dceaff;
        }


        .photo-input {
            display: none;
        }


        .photo-note {
            color: #7a8797;

            font-size: 12px;

            margin-top: 8px;
        }


        .grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 22px;
        }


        .field {
            display: flex;
            flex-direction: column;
        }


        .field.full {
            grid-column: 1 / -1;
        }


        label {
            font-weight: 700;

            margin-bottom: 8px;

            color: #26354a;
        }


        input {
            width: 100%;

            padding: 13px 14px;

            border: 1px solid #d5dce5;

            border-radius: 9px;

            font-size: 15px;

            outline: none;
        }


        input:focus {
            border-color: #1c5fa8;

            box-shadow:
                0 0 0 3px rgba(28, 95, 168, 0.1);
        }


        .password-title {
            grid-column: 1 / -1;

            margin-top: 12px;

            padding-top: 25px;

            border-top: 1px solid #e5e7eb;
        }


        .password-title h3 {
            margin: 0 0 5px;
        }


        .password-title p {
            margin: 0;

            color: #6b7280;

            font-size: 14px;
        }


        .actions {
            margin-top: 30px;

            display: flex;

            justify-content: flex-end;

            gap: 12px;
        }


        .btn {
            border: none;

            padding: 13px 22px;

            border-radius: 9px;

            font-size: 15px;

            font-weight: 700;

            cursor: pointer;

            text-decoration: none;
        }


        .btn-cancel {
            background: #eef1f5;

            color: #344054;
        }


        .btn-save {
            background: #061d3b;

            color: white;
        }


        .btn-save:hover {
            background: #0b315f;
        }


        .success {
            background: #e8f7ee;

            border: 1px solid #a8dfbd;

            color: #176b39;

            padding: 14px 16px;

            border-radius: 9px;

            margin-bottom: 20px;
        }


        .error {
            background: #fff0f0;

            border: 1px solid #f1b4b4;

            color: #a32929;

            padding: 14px 16px;

            border-radius: 9px;

            margin-bottom: 20px;
        }


        .error ul {
            margin: 5px 0 0 20px;
        }


        @media (max-width: 700px) {

            .header {
                padding: 18px 20px;
            }


            .grid {
                grid-template-columns: 1fr;
            }


            .field.full {
                grid-column: auto;
            }


            .password-title {
                grid-column: auto;
            }


            .card {
                padding: 20px;
            }


            .profile-top {
                align-items: flex-start;
            }


            .photo-section {
                flex-direction: column;
                align-items: flex-start;
            }


            .actions {
                flex-direction: column;
            }


            .btn {
                text-align: center;

                width: 100%;
            }

        }

    </style>

</head>


<body>


<header class="header">

    <div class="brand">

        🛡 Campus Crisis & Emergency Management

        <span>
            Safe Campus, Secure Future
        </span>

    </div>


    <div class="header-user">

        <div>

            <strong>
                {{ $user->name }}
            </strong>

            <div
                style="
                    font-size:12px;
                    color:#b9c9dc;
                "
            >
                {{ $user->email }}
            </div>

        </div>


        <div class="avatar">

            @if($user->profile_photo)

                <img
                    src="{{ asset('storage/' . $user->profile_photo) }}"
                    alt="Profile Photo"
                >

            @else

                {{ strtoupper(substr($user->name, 0, 1)) }}

            @endif

        </div>

    </div>

</header>


<div class="container">


    <a
        href="{{ route('dashboard') }}"
        class="back"
    >
        ← Back to Dashboard
    </a>


    <div class="title">

        <h1>
            My Profile
        </h1>

        <p>
            Manage and update your personal information.
        </p>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    {{-- ERRORS --}}
    @if($errors->any())

        <div class="error">

            <strong>
                Please fix the following errors:
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card">


        <form
            method="POST"
            action="{{ route('profile.update') }}"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            {{-- PROFILE PHOTO --}}
            <div class="profile-top">

                <div class="photo-section">


                    <div
                        class="big-avatar"
                        id="profilePreview"
                    >

                        @if($user->profile_photo)

                            <img
                                src="{{ asset('storage/' . $user->profile_photo) }}"
                                alt="Profile Photo"
                            >

                        @else

                            {{ strtoupper(substr($user->name, 0, 1)) }}

                        @endif

                    </div>


                    <div class="photo-info">

                        <h2>
                            {{ $user->name }}
                        </h2>

                        <p>
                            {{ $user->email }}
                        </p>


                        <label
                            for="profile_photo"
                            class="photo-button"
                        >
                            📷 Change Profile Photo
                        </label>


                        <input
                            type="file"
                            id="profile_photo"
                            name="profile_photo"
                            class="photo-input"
                            accept=".jpg,.jpeg,.png,.webp,image/*"
                        >


                        <div class="photo-note">
                            JPG, JPEG, PNG or WEBP • Maximum 2 MB
                        </div>

                    </div>

                </div>

            </div>


            {{-- PERSONAL INFORMATION --}}
            <div class="grid">


                {{-- NAME --}}
                <div class="field">

                    <label for="name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                    >

                </div>


                {{-- EMAIL --}}
                <div class="field">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                    >

                </div>


                {{-- PHONE --}}
                <div class="field">

                    <label for="phone">
                        Phone Number
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $user->phone ?? '') }}"
                        placeholder="+92 300 1234567"
                    >

                </div>


                {{-- DEPARTMENT --}}
                <div class="field">

                    <label for="department">
                        Department
                    </label>

                    <input
                        type="text"
                        id="department"
                        name="department"
                        value="{{ old('department', $user->department ?? '') }}"
                        placeholder="Department"
                    >

                </div>


                {{-- DESIGNATION --}}
                <div class="field full">

                    <label for="designation">
                        Designation
                    </label>

                    <input
                        type="text"
                        id="designation"
                        name="designation"
                        value="{{ old('designation', $user->designation ?? '') }}"
                        placeholder="Administrator"
                    >

                </div>


                {{-- PASSWORD --}}
                <div class="password-title">

                    <h3>
                        Change Password
                    </h3>

                    <p>
                        Leave these fields empty if you don't want
                        to change your password.
                    </p>

                </div>


                <div class="field">

                    <label for="password">
                        New Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="New password"
                    >

                </div>


                <div class="field">

                    <label for="password_confirmation">
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirm password"
                    >

                </div>

            </div>


            {{-- BUTTONS --}}
            <div class="actions">

                <a
                    href="{{ route('dashboard') }}"
                    class="btn btn-cancel"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="btn btn-save"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>


<script>

    const photoInput =
        document.getElementById('profile_photo');

    const profilePreview =
        document.getElementById('profilePreview');


    photoInput.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            return;
        }


        if (!file.type.startsWith('image/')) {

            alert('Please select an image file.');

            this.value = '';

            return;
        }


        if (file.size > 2 * 1024 * 1024) {

            alert('Profile picture must be less than 2 MB.');

            this.value = '';

            return;
        }


        const reader = new FileReader();


        reader.onload = function (event) {

            profilePreview.innerHTML = '';

            const image =
                document.createElement('img');

            image.src = event.target.result;

            image.alt = 'Profile Photo';

            profilePreview.appendChild(image);

        };


        reader.readAsDataURL(file);

    });

</script>


</body>

</html>