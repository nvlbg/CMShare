<?php
class Image
{

    public static function makeThumb($src, $dest_folder, $desired_width)
    {
        
        //$imageType = substr(strrchr($src,'.'),1);

        //if($imageType == 'jpg')
        //{
        //    $imageType = 'jpeg';
        //}

        //$imageCreateFrom = 'imagecreatefrom' . $imageType;

        $file_name = explode('/', $src);
        $file_name = $file_name[count($file_name) - 1];

        $dest_folder .= $dest_folder[strlen($dest_folder) - 1] != '/' ? '/' : '';
        $dest_folder .= $desired_width . '_' . $file_name;

        $source_image = imagecreatefromstring(file_get_contents($src));
        $virtual_image = imagecreatetruecolor($desired_width, $desired_width);

        $x = isset($_GET['x']) ? (int) $_GET['x'] : 0;
        $y = isset($_GET['y']) ? (int) $_GET['y'] : 0;
        $w = isset($_GET['w']) ? (int) $_GET['w'] : imagesx($source_image);
        $h = isset($_GET['h']) ? (int) $_GET['h'] : imagesy($source_image);

        imagecopyresized($virtual_image, $source_image, 0, 0, $x, $y, $desired_width, $desired_width, $w, $h);

        imagejpeg($virtual_image, $dest_folder, 100);
    }

}