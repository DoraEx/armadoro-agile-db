
function remove_comment(clicked_id)
{
    
    var res = clicked_id.split(" ");
    alert("about to post" + res[0] + "\nand: " + res[1]);
    post_to_remove_comment(res[0], res[1]);
}


function post_to_remove_comment(in_emp_id, in_comment_id) {
    alert("about to post" + in_emp_id + "\nand: " + in_comment_id);
    $.post("/procedure/remove_comment/index.php",
    {
      emp_id: in_emp_id,
      comment_id: in_comment_id
    },
    function(data,status){
        alert("Data: " + data + "\nStatus: " + status);
    });
}