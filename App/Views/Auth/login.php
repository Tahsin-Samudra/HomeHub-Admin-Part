<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HomeHub — Sign in or Register</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./style.css">
</head>
<body>

  <div class="auth-shell">

    <!-- Visual panel -->
    <aside class="visual-panel">
      <div class="brand">
          <img src="../../../homeEvening.jpg" alt="a home at night">                    
      </div>

        <div class="visual-copy">
          <p class="eyebrow">Property management, simplified</p>
          <h1>A key<br>for every<br>address.</h1>
          <p class="sub">List, browse, and close on properties in one place — built for buyers, sellers, and admins alike.</p>
        </div>

        <div class="key-mark" aria-hidden="true">
          <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="60" cy="100" r="34" stroke="#F7F5F1" stroke-width="1.2" opacity="0.35"/>
            <path d="M92 100h96M150 100v26M170 100v18" stroke="#F7F5F1" stroke-width="1.2" opacity="0.35"/>
          </svg>
        </div>
    </aside>

    <!-- Form panel -->
    <main class="form-panel">

      <input type="radio" name="mode" id="mode-login" class="mode-toggle" checked>
      <input type="radio" name="mode" id="mode-register" class="mode-toggle">

      <div class="form-panel-inner">        

        <!-- LOGIN -->
        <section class="pane pane-login">
          <h2>Welcome back</h2>
          <p class="pane-sub">Sign in to manage your listings and visits.</p>

          <?php if (isset($_GET['error'])): ?>
            <div class="form-alert"><?php echo htmlspecialchars($_GET['error']); ?></div>
          <?php endif; ?>

          <form action="../../Controller/loginController.php" method="POST" novalidate>
            <div class="field">
              <label for="login-email">Email address</label>
              <input type="email" id="login-email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="field">
              <label for="login-password">Password</label>
              <input type="password" id="login-password" name="password" placeholder="••••••••" required>
            </div>

            <div class="field-row">
              <label class="checkbox">
                <input type="checkbox" name="remember">
                <span>Remember me</span>
              </label>
              <a href="#" class="link-muted">Forgot password?</a>
            </div>

            <button type="submit" class="btn-primary" name = "sub">Sign in</button>
          </form>

          <div class="divider"><span>or continue with</span></div>

          <div class="oauth-row">
            <button type="button" class="btn-oauth">
              <svg width="16" height="16" viewBox="0 0 18 18"><path fill="#4285F4" d="M17.64 9.2c0-.64-.06-1.25-.16-1.84H9v3.48h4.84a4.14 4.14 0 0 1-1.8 2.72v2.26h2.9c1.7-1.57 2.7-3.88 2.7-6.62z"/><path fill="#34A853" d="M9 18c2.43 0 4.47-.8 5.96-2.18l-2.9-2.26c-.8.54-1.84.86-3.06.86-2.35 0-4.34-1.59-5.05-3.72H.9v2.33A9 9 0 0 0 9 18z"/><path fill="#FBBC05" d="M3.95 10.7A5.4 5.4 0 0 1 3.66 9c0-.59.1-1.17.29-1.7V4.97H.9A9 9 0 0 0 0 9c0 1.45.35 2.83.9 4.03z"/><path fill="#EA4335" d="M9 3.58c1.32 0 2.5.46 3.44 1.35l2.58-2.58C13.46.9 11.43 0 9 0A9 9 0 0 0 .9 4.97l3.05 2.33C4.66 5.17 6.65 3.58 9 3.58z"/></svg>
              Google
            </button>
            <button type="button" class="btn-oauth">
              <svg width="16" height="16" viewBox="0 0 24 24"><path fill="#1877F2" d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.79-4.7 4.53-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.96.93-1.96 1.89v2.26h3.33l-.53 3.49h-2.8V24C19.61 23.1 24 18.1 24 12.07z"/></svg>
              Facebook
            </button>
          </div>
        </section>        
        

        <p class="switch-line switch-line-login">
          Don't have an account? <label for="mode-register">Register</label>
        </p>
        <p class="switch-line switch-line-register">
          Already have an account? <label for="mode-login">Sign in</label>
        </p>

      </div>
    </main>

  </div>

</body>
</html>