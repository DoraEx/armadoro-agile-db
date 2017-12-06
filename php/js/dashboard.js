
// REMOVE COMMENT ON CLICK FOR BUTTON
// -   -    -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
// -   -    -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
function remove_comment(clicked_id) {

    var res = clicked_id.split(" ");
    post_to_remove_comment(res[0], res[1]);
    document.getElementById(clicked_id).parentElement.parentElement.style.visibility='hidden';
}

function post_to_remove_comment(in_emp_id, in_comment_id) {
    $.post("/procedure/remove_comment/index.php",
    {
      emp_id: in_emp_id,
      comment_id: in_comment_id
    },
    function(data,status){
        //alert("Data: " + data + "\nStatus: " + status);
    });
}
// -   -    -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -



// ITERATION BUTTON ON CLICK HANDLER
// -   -    -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
// -   -    -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
function iteration_button_onclick(clicked_id) {
    location.href = "/view/iteration";
}
// -   -    -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -