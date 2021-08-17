***user/_form.php

<div class="container">
    <header>
        <h1>Login</h1>
    </header>

    <form action="index.php?action=connect" method="post">
        <div>
            <label for="username">User Name</label>
            <input type="text" name="username" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <input type="submit">
        </div>
        
    </form>
</div>

<div class="container">
    <header>
        <h1>Register</h1>
    </header>

    <form action="#" method="post">
        <div>
            <label for="username">User Name</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <input type="submit">
        </div>
        
    </form>
</div>

