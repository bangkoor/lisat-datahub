<?php
session_start();
session_destroy();
 
echo '<script language="javascript">alert("Anda berhasil keluar!"); document.location="login";</script>';
?>