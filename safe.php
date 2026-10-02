<?php

if (isset($_GET['Submit'])) {
    // Get input
    $id = $_GET['id'];

    // Secure database query using prepared statement
    $stmt = mysqli_prepare(
        $GLOBALS["___mysqli_ston"],
        "SELECT first_name, last_name FROM users WHERE user_id = ?"
    );

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $num = mysqli_num_rows($result);

    if ($num > 0) {
        $html .= '<pre>User ID exists in the database.</pre>';
    } else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        $html .= '<pre>User ID is MISSING from the database.</pre>';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($GLOBALS["___mysqli_ston"]);
}

?>
