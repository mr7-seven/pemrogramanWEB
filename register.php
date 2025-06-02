<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="formRegister">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" id="username" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" id="password" class="form-control" required minlength="6">
  </div>

  <div class="mb-3">
    <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
    <input type="password" id="confirmPassword" class="form-control" required minlength="6">
  </div>

  <button type="submit" class="btn btn-primary">Register</button>
</form>

<div id="registerMessage" class="mt-3"></div>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $('#formRegister').on('submit', async function(e) {
  e.preventDefault();

  const username = $('#username').val().trim();
  const password = $('#password').val();
  const confirmPassword = $('#confirmPassword').val();

  if (password !== confirmPassword) {
    $('#registerMessage').text('Password dan konfirmasi password tidak cocok!').addClass('text-danger');
    return;
  }

  const data = { username, password };

  try {
    const response = await fetch('reg.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });

    const result = await response.json();

    if (result.status) {
      $('#registerMessage').text('Registrasi berhasil! Silakan login.').removeClass('text-danger').addClass('text-success');
      $('#formRegister')[0].reset();
    } else {
      $('#registerMessage').text('Registrasi gagal: ' + result.pesan).addClass('text-danger');
    }
  } catch (error) {
    $('#registerMessage').text('Terjadi kesalahan saat menghubungi server.').addClass('text-danger');
  }
});

</script>
</body>
</html>