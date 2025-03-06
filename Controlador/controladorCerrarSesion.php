<?php
session_unset();
session_destroy();
header("Location: ../Vista/index.html");
?>