<?php
session_start();
session_destroy();
header('Location:'.$server_root.'admin/login');