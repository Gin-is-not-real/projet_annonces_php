<div class="container  login-form-container">
    <header>
        <h1>Register</h1>
        <div id="demo-information" style="font-size: 0.6em;width: 80%;margin: 0 auto;">*This site being a <strong>demonstration site</strong>, your account and your ads will be <strong>deleted</strong> in ** hours. If you try contact a sender, <strong>you</strong> will receive your email.</div>
    </header>

    <div class="content">
        <form action="index.php?action=register" method="post">
            <div>
                <label for="username">User Name</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label for="pass">Password</label>
                <input type="password" name="pass" required>
            </div>

            <div>
                <input type="hidden" name="atbt">
                <input type="submit">
            </div>
        </form>
    </div>

</div>