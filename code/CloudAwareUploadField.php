<?php

/**
 * Class CloudAwareUploadField
 */
class CloudAwareUploadField extends UploadField
{
    /**
     * Gets the foreign class that needs to be created, or 'File' as default if there
     * is no relationship, or it cannot be determined.
     *
     * @param $default Default value to return if no value could be calculated
     * @return string Foreign class name.
     */
    public function getRelationAutosetClass($default = 'File') {

        // Don't autodetermine relation if no relationship between parent record
        if(!$this->relationAutoSetting) return $default;

        // Check record and name
        $name = $this->getName();
        $record = $this->getRecord();
        if(empty($name) || empty($record)) {
            return $default;
        } else {
            $class = $record->getRelationClass($name);
            if(!empty($class)){
                $class = CloudAssets::inst()->getWrapperClass($class);
            }
            return empty($class) ? $default : $class;
        }
    }
}