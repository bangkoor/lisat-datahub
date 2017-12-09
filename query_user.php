<?php

$sessionUser = $_SESSION['user']; 
$query1 = mysqli_query($link, "SELECT user_id FROM lord_user WHERE username='".$sessionUser."'");
$query_user1 = mysqli_fetch_array($query1);
$query = mysqli_query($link, "SELECT * FROM lord_user as a, lord_user_contact as b WHERE a.user_id='".$query_user1['user_id']."' AND a.user_id=b.user_id");
$query_user = mysqli_fetch_array($query);
?>