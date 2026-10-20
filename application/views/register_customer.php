<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create a Customer Account — Sun Son Solar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
:root {
	--ink: #0E1E2B;
	--gold: #F2A93B;
	--ember: #E2672E;
	--cloud: #FAF6EE;
	--slate: #3A4552;
	--slate-soft: #6B7684;
	--line: #E4DCC8;
	--success: #2E7D4F;
	--success-bg: #E8F4EC;
	--error: #B3402A;
	--error-bg: #FBEAE4;
	--font-display: 'Fraunces', 'Georgia', serif;
	--font-body: 'IBM Plex Sans', -apple-system, Segoe UI, sans-serif;
	--radius: 3px;
	--shadow: 0 10px 30px rgba(14, 30, 43, 0.12);
}

* { box-sizing: border-box; }
html, body { margin: 0; padding: 0; }
body { font-family: var(--font-body); color: var(--slate); background: var(--cloud); line-height: 1.55; -webkit-font-smoothing: antialiased; }
h1 { font-family: var(--font-display); color: var(--ink); margin: 0 0 0.4em; font-weight: 600; line-height: 1.15; font-size: clamp(1.9rem, 3.2vw, 2.7rem); }
p { margin: 0 0 1em; }
a { color: inherit; text-decoration: none; }

.wrap { max-width: 1120px; margin: 0 auto; padding: 0 24px; }

/* Nav */
.site-nav { background: #fff; border-bottom: 1px solid var(--line); }
.site-nav__inner { display: flex; align-items: center; justify-content: center; padding: 20px 24px; }
.brand { display: flex; align-items: center; gap: 10px; font-family: var(--font-display); font-weight: 600; font-size: 1.2rem; color: var(--ink); }
.brand__mark { width: 22px; height: 22px; border-radius: 50%; background: radial-gradient(circle at 35% 30%, var(--gold), var(--ember)); flex-shrink: 0; }

/* Button */
.btn { display: inline-flex; align-items: center; justify-content: center; font-family: var(--font-body); font-weight: 600; font-size: 0.95rem; padding: 0.75em 1.5em; border-radius: var(--radius); border: 1.5px solid transparent; cursor: pointer; transition: background 0.15s ease; }
.btn--solid { background: var(--ember); color: var(--cloud); }
.btn--solid:hover { background: #c85625; }
.btn--full { width: 100%; }

/* Alerts */
.alert { padding: 14px 18px; border-radius: var(--radius); margin: 20px 0; font-size: 0.92rem; }
.alert[hidden] { display: none; }
.alert--success { background: var(--success-bg); color: var(--success); border: 1px solid #BFE3CB; }
.alert--error { background: var(--error-bg); color: var(--error); border: 1px solid #EFC3B4; white-space: pre-line; }
.alert--error p { margin: 0; }

/* Form */
.form--grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px 20px; }
.form label { display: flex; flex-direction: column; gap: 6px; font-size: 0.88rem; font-weight: 600; color: var(--ink); }
.form .span-2 { grid-column: span 2; }
.form input, .form select { font-family: var(--font-body); font-size: 0.95rem; font-weight: 400; padding: 0.65em 0.8em; border: 1.5px solid var(--line); border-radius: var(--radius); background: #fff; color: var(--slate); }
.form input:focus, .form select:focus { outline: 2px solid var(--gold); outline-offset: 1px; border-color: var(--gold); }
.form input.is-invalid, .form select.is-invalid { border-color: var(--error); }

/* Auth card */
.auth-section { padding: 56px 0 80px; }
.auth-wrap { display: flex; justify-content: center; }
.auth-card { background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 36px; width: 100%; max-width: 420px; box-shadow: var(--shadow); }
.auth-card--wide { max-width: 640px; }
.auth-card__sub { color: var(--slate-soft); font-size: 0.9rem; }
.auth-card__foot { margin-top: 18px; margin-bottom: 0; font-size: 0.88rem; color: var(--slate-soft); }
.auth-card__foot a { color: var(--ember); font-weight: 600; }

@media (max-width: 640px) {
	.form--grid { grid-template-columns: 1fr; }
	.form .span-2 { grid-column: span 1; }
	.auth-card { padding: 24px; }
}
    </style>
</head>
<body>

<header class="site-nav">
    <div class="wrap site-nav__inner">
        <a href="<?= site_url('') ?>" class="brand">
            <span class="brand__mark" aria-hidden="true"></span>
            Sun Son Solar
        </a>
    </div>
</header>

<main>
    <section class="auth-section">
        <div class="wrap auth-wrap">
            <div class="auth-card auth-card--wide">
                <h1>Create a Customer Account</h1>
                <p class="auth-card__sub">Sign up to request quotes, track your installation, and view your system.</p>

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert--success"><?= html_escape($this->session->flashdata('success')) ?></div>
                <?php endif; ?>

                <?php $errs = strip_tags(validation_errors('', "\n")); ?>
                <div id="formMessage" class="alert alert--error" <?= $errs ? '' : 'hidden' ?>><?= html_escape(trim($errs)) ?></div>

                <form id="customerForm" class="form form--grid" method="post" action="<?= site_url('welcome/register_customer') ?>">
                    <label>First Name
                        <input type="text" name="first_name" value="<?= set_value('first_name') ?>" required>
                    </label>
                    <label>Last Name
                        <input type="text" name="last_name" value="<?= set_value('last_name') ?>" required>
                    </label>
                    <label>Middle Name
                        <input type="text" name="middle_name" value="<?= set_value('middle_name') ?>">
                    </label>
                    <label>Birthdate
                        <input type="date" name="birthdate" value="<?= set_value('birthdate') ?>" required>
                    </label>
                    <label>Gender
                        <select name="gender" required>
                            <option value="">Select…</option>
                            <option value="Female" <?= set_select('gender', 'Female') ?>>Female</option>
                            <option value="Male"   <?= set_select('gender', 'Male') ?>>Male</option>
                            <option value="Other"  <?= set_select('gender', 'Other') ?>>Other</option>
                        </select>
                    </label>
                    <label>Email
                        <input type="email" name="email" value="<?= set_value('email') ?>" required>
                    </label>
                    <label>Phone Number
                        <input type="tel" name="phone" value="<?= set_value('phone') ?>" required>
                    </label>
                    <label class="span-2">Address
                        <input type="text" name="address" value="<?= set_value('address') ?>" required>
                    </label>
                    <label class="span-2">Username
                        <input type="text" name="username" value="<?= set_value('username') ?>" required minlength="5">
                    </label>
                    <label>Password
                        <input type="password" name="password" required minlength="8">
                    </label>
                    <label>Confirm Password
                        <input type="password" name="confirm_password" required minlength="8">
                    </label>

                    <button type="submit" class="btn btn--solid btn--full span-2">Create Account</button>
                </form>

                <p class="auth-card__foot">Employee ka? <a href="<?= site_url('welcome/employee') ?>">Employee sign up dito</a></p>
            </div>
        </div>
    </section>
</main>

</body>
</html>
