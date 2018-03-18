<?php include_once '../app/views/header/loginheader.php' ?>

<div class="login-form">
    <form action="<?php echo Globals::baseUrl(); ?>/public/adminlogin/login" method="POST">
      <div class="imgcontainer">
        <img src="<?php echo Globals::baseUrl(); ?>/public/img/logos/plazaalemanialogo.png" alt="Avatar" class="avatar">
      </div>

      <div class="container">


          <?php if( !empty($data['status']) ): ?>
              <?php if( $data['status'] == 406 ): ?>
                  <p style="color:red"><?=$data['message']?></p>
              <?php endif; ?>
          <?php endif; ?>


        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit">Login</button>
        <!-- <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label> -->
      </div>

      <!-- <div class="container" style="background-color:#f1f1f1">
        <button type="button" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div> -->
    </form>

</div>

</body>
</html>
