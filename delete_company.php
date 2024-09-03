<?php
    include "../user/connection.php";
    $id = $_GET["id"];

    mysqli_query($link, "DELETE FROM company_name
                        WHERE id = $id") or die(mysqli_error($link));

?>

<script type="text/javascript">
    window.location="add_new_company.php";
</script>