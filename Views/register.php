<h1>Register</h1>

<form action="" method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $model->email ?? '' ?>">
        <div class="invalid-feedback" style="display: block">
            <?php
            if(isset($model) && $model->hasError('email') )
                echo $model->errors['email'][0];
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" name="firstname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $model->firstname ?? '' ?>">
        <div class="invalid-feedback" style="display: block">
            <?php
            if(isset($model) && $model->hasError('firstname') )
                echo $model->errors['firstname'][0];
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Last Name</label>
        <input type="text" name="lastname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $model->firstname ?? '' ?>">
        <div class="invalid-feedback" style="display: block">
            <?php
            if(isset($model) && $model->hasError('lastname') )
                echo $model->errors['lastname'][0];
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password"  name="password" class="form-control" id="exampleInputPassword1">
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Password again</label>
        <input type="password"  name="confirmPassword" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>