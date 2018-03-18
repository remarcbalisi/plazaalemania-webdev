<!-- Hello <?=$data['name']?> -->
<?php include_once '../app/views/header/adminheader.php' ?>

<div class="login-wrapper">
    <div class="login-title">
        <h1>Login</h1>
    </div>

    <?php if( !empty($data['error_msg']) ): ?>
        <p style="color:red"><?=$data['error_msg']?></p>
    <?php endif; ?>

    <form class="" action="<?php echo Globals::baseUrl(); ?>/public/adminhome/adduser" method="post">
        <label for="email">Email</label> <input type="text" name="email" value="" placeholder="Email">
        <label for="password">Password</label>
        <input type="password" name="password" value="" placeholder="Password">
    </form>
</div>

</body>
</html>
