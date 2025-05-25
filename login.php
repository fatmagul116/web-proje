<?php
session_start();

// Sabit kullanıcı bilgileri
// Bu değişkenler, fonksiyonun dışından erişilebilir olmalı.
$fixedEmail = "g231210048@gmail.com";
$fixedPassword = "g231210048"; // Gerçek uygulamalarda şifreleri asla bu şekilde saklamayın!

// Log in a user (now checks against fixed credentials)
function loginUser($email, $password) {
    // Global değişkenlere erişmek için 'global' anahtar kelimesini kullan
    // Ya da doğrudan fonksiyon dışındaki değişkenlere erişilebilir olmaları için fonksiyona parametre olarak geçirme.
    // En temiz yol, fonksiyonun dışından sabit değerleri kullanmasıdır.
    global $fixedEmail, $fixedPassword; // Global değişkenleri fonksiyon içinde kullanmak için

    // Girilen email ve şifre sabit bilgilerle eşleşiyor mu kontrol et
    if ($email === $fixedEmail && $password === $fixedPassword) {
        $_SESSION["email"] = $email; // Oturum değişkenini ayarla
        return true;
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Login logic
    if (isset($_POST["login"])) {
        if (!empty($email) && !empty($password)) {
            // loginUser fonksiyonunu çağırırken sadece gönderilen e-posta ve şifreyi ilet.
            // Sabit bilgiler zaten fonksiyonun içinde 'global' ile erişilebilir.
            if (loginUser($email, $password)) {
                // Başarılı giriş durumunda welcome.html'e yönlendirme
                header("Location: welcome.html");
                exit;
            } else {
                $loginError = "Hatalı e-posta veya şifre."; // Hata mesajı
            }
        } else {
            $loginError = "E-posta ve şifre gerekli."; // Hata mesajı
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Me and Myself</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="hakkımda.html">Hakkımda</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="ozgecmisim.html">Özgeçmişim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ilgiAlanlarim.html">İlgi Alanlarım</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sehrim.html">Şehrim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="iletisim.html">İletişim</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        <div class="form-box login active">
            <?php if (isset($loginError)) { echo "<p style='color: red; text-align: center;'>$loginError</p>"; } ?>
            <h1>Login</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="login" value="1">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label>E-mail</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Şifre</label>
                </div>
                <button type="submit" class="btn">Login</button>
              
                <footer class="footer">
                    <p>&copy; 2025 Fatmagül Kurt</p>
                </footer>
            </form>
        </div>
    </div>
    <script src="login.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script>
        // Client-side JS remains the same as it doesn't handle login logic anymore
    </script>
</body>
</html>
