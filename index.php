<?php 
    // SIGN UP
    require 'assets/header.php';
    require 'includes/db.php';
    $data = $_POST;

    $error = ''; 
    if(isset($data['do_signup'])){
        $errors = array();
        if(trim($data['login']) == ''){
            $errors[] = 'Fill login field';
        }
        if(trim($data['email']) == ''){
            $errors[] = 'Fill email field';
        }
        if($data['password'] == ''){
            $errors[] = 'Fill password field';
        }

        if(R::count('user', 'login = ?', array($data['login'])) > 0){
            $errors[] = 'User with such login already exists';
        }
        if(R::count('user', 'email = ?', array($data['email'])) > 0){
            $errors[] = 'User with such email already exists';
        }


        if(empty($errors)){
            $user = R::dispense('user');
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            R::store($user);
            $error = '<div class="alert alert-info" role="alert"> Successfully Signed Up! </div>' ;

        }else{
            $error = '<div class="alert alert-danger" role="alert">' . array_shift($errors) . '</div>' ;
        }
    }

    // LOG IN
    $error1 = ''; 
    if(isset($data['do_login'])){
        $errors1 = array();
        if(trim($data['login1']) == ''){
            $errors1[] = 'Fill login field';
        }
        if($data['password1'] == ''){
            $errors1[] = 'Fill password field';
        }
        if(empty($errors1)){
            $user1 = R::findOne('user' , 'login = ?', array($data['login1'])) ;

            if($user1){
                
                if(password_verify($data['password1'], $user1->password)){
                    $_SESSION['user'] = $user1;
                    header('Location: pages/main.php');
                }else{
                $error1 = '<div class="alert alert-danger" role="alert">User with such login or password not found</div>';
                }
            }else{
                $error1 = '<div class="alert alert-danger" role="alert">User with such login or password not found</div>';
            }

        }else{
            $error1 = '<div class="alert alert-danger" role="alert">' . array_shift($errors1) . '</div>' ;
        }
        
        

    }

?>

    <div class="container">
        <div class="section_one">
            <h1 class='headline' id='gradient'>Blokker.</h1>
        </div>
        <div class="section_two">
            <div class="left registration">
                <h3>Sign Up</h3>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <?php  echo $error; ?>
                    <div class="form-group">
                        <label>Login</label>
                        <input type="text" class="form-control" name='login' value='<?php echo @$data['login']; ?>'> 
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" name='email' value='<?php echo @$data['email']; ?>'> 
                    </div>
                    <div class="form-group">
                        <label >Password</label>
                          <input type="password" class="form-control" name='password' >
                    </div>
                    <button type="submit" class="btn btn-primary" name= 'do_signup'>Sign up</button>
                </form>

            </div>


            <div class="right registration">
                <h3>Log In</h3>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <?php  echo $error1; ?>
                    <div class="form-group">
                        <label>Login</label>
                        <input type="text" class="form-control" name='login1' > 
                    </div>
                    <div class="form-group">
                        <label >Password</label>
                          <input type="password" class="form-control" name='password1' >
                    </div>
                    <button type="submit" class="btn btn-primary" name= 'do_login'>Log In</button>
                </form>
            </div>
        </div>
    </div>

<?php require 'assets/footer.php' ?>
