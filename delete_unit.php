<?php
    include "../user/connection.php";
    $id = $_GET["id"];

    mysqli_query($link, "DELETE FROM units
                        WHERE id = $id") or die(mysqli_error($link));

?>

<script type="text/javascript">
    window.location="add_new_unit.php";
</script>