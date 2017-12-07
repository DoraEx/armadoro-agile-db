<?php ini_set('display_errors', 1);?>




<?php
function display_add_project_form() {
    $add_project_form = <<<MARKER
    <div class="container">
    <div class="row well">
        <div class="offset-md-2 col-md-8 toledo-dash well">
                    

        <form>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input">
            Check me out
          </label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>





        </div>
    </div>
</div>
MARKER;
    echo $add_project_form;
}
?>
