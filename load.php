<?php
/*
    load.php: a file used as the primary load point for comment sections 
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

/  Entry point for Comments API.
/ Include with a "require "/usr/path/to/load.php"; in in the <head>, and a 
/ load_comments() in where you want the comments loaded. */

# Load settings
if (file_exists(dirname(__FILE__)."/settings/MachineSettings.php")) {
    require dirname(__FILE__)."/settings/MachineSettings.php";
} else {
    $cmNoMachineSettings = true;
}
# Override machine settings with user settings where possible
if (file_exists(dirname(__FILE__)."/settings/UserSettings.php")) {
    require dirname(__FILE__)."/settings/UserSettings.php";
}

# Load styles and scripts
echo '<link rel="stylesheet" type="text/css" href="'.$cmScriptPath.'loadcontent.php?contentype=css">';
echo '<script type="text/javascript" src='.$cmScriptPath.'loadcontent.php?contentype=javascript" defer="true"></script>';

require "commentsembed.php";
?>