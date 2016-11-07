<?php
/**
 * Created by PhpStorm.
 * User: programmer
 * Date: 09.10.2015
 * Time: 10:57
 */

namespace common\modules\file_manager\models;


class FilesLists extends FilesListsBase
{
    /*
     * This method is invoked before deleting a record.
     */
    public function beforeDelete(){
        $files = $this->getFiles()->all();
        foreach($files as $file)
            $file->delete();

        return parent::beforeDelete();
    }
}