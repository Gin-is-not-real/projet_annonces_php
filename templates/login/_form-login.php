<div class="container login-form-container">
    <header>
        <h1>Login</h1>
    </header>


    <div class="content">
        <form action="index.php?action=login" method="post">
            <div>
                <label for="username">User Name</label>
                <input type="text" name="username" required>
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