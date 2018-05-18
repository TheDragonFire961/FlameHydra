<?php
/*
    dbindex.php: a file used to provide maximum compatabillity with other databases.

    This file is part of RethCommentsring Multi-DB Library.

    RethCommentsring Multi-DB Library is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    RethCommentsring Multi-DB Library is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with RethCommentsring.  If not, see <http://www.gnu.org/licenses/>.
*/
# Load settings
if (file_exists(dirname(__FILE__).'/settings/MachineSettings.php')) {
    require dirname(__FILE__).'/settings/MachineSettings.php';
}
if (!empty($_POST["username"]) && !empty($_POST["password"])) {
    
}
include dirname(__FILE__).'/include/random.php';
$random = cmfRandom(512, false, true, true);
echo password_hash($random, PASSWORD_ARGON2I);
if (password_verify($random)) {
    echo 'Valid!';
} else {
    echo 'Not valid!';
}
    