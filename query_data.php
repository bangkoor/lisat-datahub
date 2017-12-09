<?php
$query = mysqli_query($link, "SELECT * FROM lord_data WHERE data_id='".$data_id."'");
$query_data = mysqli_fetch_array($query);
?>