<?php
require_once("../../classes/cls.config.php"); 

$dir    = UPL_FILES;

//$files1 = scandir($dir);
$files1 = scandir_rec($dir);

function scandir_rec($root, $sub = '')
{
    $file = array();
    // if root is a file
    if (is_file($root)) {
        $file[] = basename($root);
        //echo '<li>' . basename($root) . '</li>';
        return $file;
    }

    if (!is_dir($root)) {
        return;
    }

    $dirs = scandir($root);
    
    foreach ($dirs as $dir) {
        
        if ($dir == '.' || $dir == '..') {
            continue;
        }
        
        $parent = ($sub <> '') ? $sub . '/' : '';

        $path   = $root . '/' .  $dir;
        
        if (is_file($path)) {
            array_push($file, $parent . $dir);
            
        } 
        elseif (is_dir($path)) {            
            
            $dir_sub = scandir_rec($path, $parent.$dir); // <--- then recursion
            
            foreach ($dir_sub as $dir_sub_file) {
                array_push($file, $dir_sub_file);
            }
            
        }
    }
    
    return $file;
}

echo json_encode($files1); 
?>
