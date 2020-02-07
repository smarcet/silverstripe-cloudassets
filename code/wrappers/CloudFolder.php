<?php
/**
 * Copyright 2020 OpenStack Foundation
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 **/

class CloudFolder extends Folder implements CloudAssetInterface
{

    public function Link()
    {
        $this->createLocalIfNeeded();
        return $this->CloudStatus == 'Live' ? $this->getCloudURL() : parent::Link();
    }

    public function RelativeLink()
    {
        $this->createLocalIfNeeded();
        return $this->CloudStatus == 'Live' ? $this->getCloudURL() : parent::RelativeLink();
    }

    public function getURL()
    {
        $this->createLocalIfNeeded();
        return $this->CloudStatus == 'Live' ? $this->getCloudURL() : parent::getURL();
    }

    public function getAbsoluteURL()
    {
        $this->createLocalIfNeeded();
        return $this->CloudStatus == 'Live' ? $this->getCloudURL() : parent::getAbsoluteURL();
    }

    public function getAbsoluteSize()
    {
        $this->createLocalIfNeeded();
        return $this->CloudStatus == 'Live' ? $this->CloudSize : parent::getAbsoluteSize();
    }

    public function exists()
    {
        $this->createLocalIfNeeded();
        return parent::exists();
    }
}
