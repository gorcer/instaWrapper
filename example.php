<?php
/**
 * Created by PhpStorm.
 * User: gorcer
 * Date: 13.10.16
 * Time: 9:47
 */

require_once "instaWrapper.php";

print_r(
    instaWrapper::getFeedByUrl("https://www.instagram.com/explore/tags/%D0%B1%D1%83%D1%85%D1%82%D0%B0%D0%B1%D0%B0%D0%B1%D0%BA%D0%B8%D0%BD%D0%B0/")
    );