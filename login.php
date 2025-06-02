<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Signin Template · Bootstrap v5.3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <!-- Custom styles for this template -->

    <style>
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 400px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        h1 {
            text-align: center;
            padding: 10px;
            color: azure;
            background: #20e0e3;
            background: radial-gradient(circle, rgba(32, 224, 227, 1) 35%, rgba(76, 45, 253, 1) 88%);
        }
    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">


    <main class="form-signin w-100 m-auto">
        <h1>PEMROGRAMAN BERBASIS WEB</h1>
        <form id="login-form">
            <img class="mb-4" src="../assets/img/poliban-removebg-preview.png" alt="" width="80" style="display: block; margin:auto;">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="username" placeholder="username">
                <label for="username">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" placeholder="Password">
                <label for="password">Password</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="checkDefault">
                <label class="form-check-label" for="checkDefault">
                    Remember me
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2025</p>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $('#login-form').on('submit', async function(e) {
            e.preventDefault();

            const data = {
                username: $('#username').val(),
                password: $('#password').val()
            };

            try {
                const response = await fetch('auth.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.status) {
                    alert('Login berhasil!');
                    // Arahkan ke halaman lain (misal dashboard)
                    window.location.href = 'dashboard.php';
                } else {
                    alert('Login gagal: ' + result.pesan);
                }
            } catch (err) {
                console.error('Kesalahan saat login:', err);
                alert('Terjadi kesalahan saat menghubungi server.');
            }
        });
    </script>

</body>

</html>