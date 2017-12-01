<?php require('login.php');?>
<!-- HEADER INCLUDE -->
<?php include('../template/header.php');?>

<!-- Login Form -->
<div class="container">
    <div class="row justify-content-center">
        <form action="" method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password"/>
            </div>
            <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
        </form>
    </div>
</div>

<?php include('../template/footer.php');?>