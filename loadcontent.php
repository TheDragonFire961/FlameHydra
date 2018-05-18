<?php
/*
    loadcontent.php: a file used as the primary load point for CSS.
    made with RethCommentsring. 
    Copyright (C) 2018 TheDragonFire961.
    This file is part of RethCommentsring.

    RethCommentsring is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    RethCommentsring is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with RethCommentsring.  If not, see <http://www.gnu.org/licenses/>.
*/
// Load settings
if (file_exists(dirname(__FILE__)."/settings/MachineSettings.php")) {
    require dirname(__FILE__)."/settings/MachineSettings.php";
} else {
    $cmNoMachineSettings = true;
}
// Override machine settings with user settings where possible
if (file_exists(dirname(__FILE__)."settings/UserSettings.php")) {
    require dirname(__FILE__)."settings/UserSettings.php";  
}
// Define $cmContentRequestType
$cmContentRequestType = null;

if (!empty($_GET["type"])) {
    $cmContentRequestType = $_GET["type"];
}
if ($cmContentRequestType !== "css" && $cmContentRequestType !== "js") {
    trigger_error("Invalid content type requested, must be either JavaScript or CSS", E_USER_WARNING);
}
$cmLoadedSkins = array();
if ($cmContentRequestType === "css") {
    $cmI = 0;
    $cmCheckSkins = scandir($cmServerScriptPath.'/skins');
    foreach($cmCheckSkins as $cmCheckSkinFile) {
        if ($cmCheckSkinFile !== '.' && $cmCheckSkinFile !== '..') {
            if (file_exists($cmServerScriptPath.'/skins/'.$cmCheckSkinFile.'/include.php')) {
                $cmLoadedSkins[$cmI] = $cmCheckSkinFile;
                $cmI++;
            }
        }
    }
}
function cmfCSSPublish(&$cmCSS) {
    header("Content-Type: text/css");
    echo $cmCSS;
}
if (!empty($cmDefaultSkin)) {
    if (in_array($cmDefaultSkin, $cmLoadedSkins)) {
        require $cmServerScriptPath.'/skins/'.$cmDefaultSkin.'/include.php';
    }
}