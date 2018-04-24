InstaWrapper
============

Parse instagram feed by url.

Example:

print_r(
    instaWrapper::getFeedByUrl("https://www.instagram.com/nasa/")
    );

Result:

Array
(
    [0] => Array
        (
            [id] => 1359758705717796496
            [code] => BLe1Vaqjd6Q
            [url] => https://www.instagram.com/p/BLe1Vaqjd6Q
            [timestamp] => 1476315890
            [date] => 13.10.2016 09:44:50
            [caption] => Cameras outside the space station captured views of Hurricane Nicole Oct. ....
            [owner_id] => 528817151
            [thumbnail_src] => https://scontent.cdninstagram.com/t51.2885-15/e15/c0.30.612.612/14736279_1561109027248611_8747941370758430720_n.jpg?ig_cache_key=MTM1OTc1ODcwNTcxNzc5NjQ5Ng%3D%3D.2.c
            [image_src] => https://scontent.cdninstagram.com/t51.2885-15/e15/14736279_1561109027248611_8747941370758430720_n.jpg?ig_cache_key=MTM1OTc1ODcwNTcxNzc5NjQ5Ng%3D%3D.2
            [is_video] => 1
            [dimensions] => Array
                (
                    [width] => 612
                    [height] => 673
                )

        )

....
)