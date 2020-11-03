<?php

session_start();
session_unset();
session_destroy();
header("Location: /systemsAnalysisTeamProject/webFiles/home.php");