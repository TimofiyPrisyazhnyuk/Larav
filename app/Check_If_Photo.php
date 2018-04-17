<?php

namespace App;

class Check_If_Photo
{

    /**
     * @param $model
     * @return bool|string
     */
    public static function CheckIfPhoto($model)
    {
        if (is_object($model) && $model->image != null) {
            $photoPatch = 'uploads/images/' . $model->image;
            if (!file_exists($photoPatch)) {
                return false;
            }
            return $photoPatch;
        }
        return false;
    }

}
