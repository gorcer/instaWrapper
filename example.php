<?php
/**
 * Created by PhpStorm.
 * User: gorcer
 * Date: 13.10.16
 * Time: 9:47
 */

require_once "instaWrapper.php";

print_r(
    instaWrapper::getFeedByUrl("https://www.instagram.com/nasa/")
    );