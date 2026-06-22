<div class="login-header">

    <div class="header-top">

        <div class="company-logo">
            <i class="fas fa-building"></i>
        </div>

        <div class="company-divider"></div>

        <h1 class="company-title">
            PT MAJU JAYA
        </h1>

    </div>

    <p class="company-subtitle">
        Silakan login untuk melanjutkan
    </p>

</div>
<div class="card">

    <div class="card-body">

        <div class="m-sm-4">

            <?= form_open('login') ?>

            <div class="mb-3">

                <label class="form-label">
                    <strong>Username</strong>
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>

                    <input
                        class="form-control form-control-lg"
                        type="text"
                        name="username"
                        placeholder="Masukkan username"
                        required
                        autofocus>

                </div>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    <strong>Password</strong>
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>

                    <input
                        class="form-control form-control-lg"
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required>

                    <span
                        class="input-group-text"
                        onclick="togglePassword()">

                        <i
                            id="eyeIcon"
                            class="fas fa-eye">
                        </i>

                    </span>

                </div>

            </div>

            <div class="d-grid mt-4">

                <button
                    type="submit"
                    class="btn btn-primary btn-lg btn-login">

                    <i class="fas fa-sign-in-alt me-2"></i>
                    Login

                </button>

            </div>

            <?= form_close() ?>

        </div>

    </div>

</div>