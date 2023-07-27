<h2>Welcome Home</h2>

<?php if($errors): ?>

    <ul>
        <?php foreach($errors as $error): ?>
        
            <li> <?php echo $error; ?> </li>    
        
        <?php endforeach; ?>
    </ul>

<?php endif; ?>

<br>

<h2>Welcome you are login successfully</>

<br>

<hr/>

<h2>Logout</h2>
<p>Are you sure you want to logout?</p>
<a href="<?= URL::site('auth/logout') ?>">Logout</a>


