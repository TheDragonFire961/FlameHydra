<?php
/*
    version.php a file used to list installed software.
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
require "include/version.php";
require $cmServerScriptPath.'/include/layout.php';
cmfCreateHTML('HTML5', 'strict', true);
$cmPrepare = $sklGeneric;
$cmVersion = '';
$cmVersion .= '<h1 class="cm-header">Version</h1>'.PHP_EOL;
$cmVersion .= '<h2 class="cm-header">Licence</h2>'.PHP_EOL;
$cmVersion .= '<p>RethCommentsring is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or any later version.</p>'.PHP_EOL;
$cmVersion .= '<p>RethCommentsring is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.</p>'.PHP_EOL;
$cmVersion .= '<p>You should have received a copy of the GNU General Public License along with RethCommentsring.  If not, see &lt;<a href="http://www.gnu.org/licenses/">http://www.gnu.org/licenses/</a>&gt;.'.PHP_EOL;
$cmVersion .= '<h2>Installed software</h2>'.PHP_EOL;
$cmVersion .= 'RethCommentsring: '.$cmRethCommentsringVersionString.'<br>'.PHP_EOL;
$cmVersion .= 'PHP: '.PHP_VERSION.'<br>'.PHP_EOL;
$cmVersion .=
$cmPrepare = str_replace('$1',$cmVersion,$sklGeneric);
echo $cmPrepare;
?>

    