<?php if (!Auth::instance()->logged_in()): ?> 



<form action="<?= URL::site('auth/home') ?>" method="POST">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
    </div>
    <div>
        <input type="submit" value="Login">
    </div>
</form>

<?php else: ?>
    <!-- Display a message or redirect to a different page -->
    <p>You are already logged in.</p>
<?php endif; ?>