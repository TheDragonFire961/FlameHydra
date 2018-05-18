<?php
/*
    commentsembed.php: a file used as the primary load point for comment sections 
    made with RethCommentsring. 
    Copyright (C) 2018 Ethan Nguyen.
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
# Comments loader for RethCommentsring.

# Load settings
if (file_exists(dirname(__FILE__)."/settings/MachineSettings.php")) {
    require dirname(__FILE__)."/settings/MachineSettings.php";
} else {
    $cmNoMachineSettings = true;
}
# Override machine settings with user settings where possible
if (file_exists(dirname(__FILE__)."settings/UserSettings.php")) {
    require dirname(__FILE__)."settings/UserSettings.php";  
}
require 'include/dbindex.php';

global $cmCommentsPathInternal;

function load_comments($cmCommentsPath = null) {
    # If no Machine Settings were found
    if (!empty($cmNoMachineSettings)) {
        echo '<div id="cm-content-wrapper" style="width:600px;">';
        echo '<h2>MachineSettings.php not found</h2>';
        echo '<div>Please set up RethCommentsring first.</div>';
    } else { 
        if (!empty($cmCommentsPath)) {
            $cmCommentsPathInternal;
            $cmCommentsPathInternal = $cmCommentsPath;
        } else {
            $cmCommentsPathInternal;
            $cmCommentsPathInternal = basename($_SERVER["REQUEST_URI"]);
        } 
        echo $cmCommentsPathInternal;
        # Ask the DB whether the comments path exists.
        $cmDBTypeGet = getDBType();
        if ($cmDBTypeGet === "sqlite") {
            initializeSQLite();
            $check = $db->prepare("SELECT comments");
        }
    }
}
?>