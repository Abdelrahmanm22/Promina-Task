<?php
namespace App\Trait;

trait AttachmentTrait{
    function saveAttach($file,$folderPath){
        $avatar_file_name = $file->getClientOriginalName();;
        $avatar_file_name =time().'_'. $avatar_file_name; // merg time + get original name +
        $file->move($folderPath,$avatar_file_name);
        return $avatar_file_name;
    }

}
?>
