<?php
/*
    postcomment.php: a file used to post comments and replies.
*/
require "include/random.php";
if (!empty($_POST[$cmPathPrefix."content"]) && !empty($_COOKIE[$cmPathPrefix."sessionid"])) {
    $cmCommentId = cmfRandom(512, false, false);
    /*
The comment may be part of a root or a branch.
*Root: the root comment ID. This comment is the one where this comment, and the branch this comment is connected to, replied to.
*Branch: the branch comment ID this comment directly replies to.
A root is given 
    */
}

    