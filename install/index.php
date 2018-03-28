<?php
/*
    input.php: the installer for RethCommentsring.
    Copyright (C) 2018 TheDragonFire961.
    This file is part of RethCommentsring.

    RethCommentsring is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    any later version.

    RethCommentsring is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with RethCommentsring.  If not, see <http://www.gnu.org/licenses/>.
*/
// Get the installer stage.
if (!empty($_GET["page"])) {
    $cminInstallerStage = $_GET["page"];
} else {
    $cminInstallerStage = "lang";
}
if (!empty($_GET["submit"])) {
    $cminSubmit = true;
} else {
    $cminSubmit = false;
}
// Install RethCommentsring
if ($cminInstallerStage === "install") {
    // Tables that will be created:
    // *users(user, userid, email, passwordhash, blockstatus, creation, website, fburl, twurl, instagramurl, yturl, snapshoturl, tumblrurl, description, gender)
    // *sessions(sessionid, userid, creation, expiry)
    // *globalcomments(commentid, contents, creation, commentpath, root, branch)
}
// Get the language from GET, if possible
if (!empty($_GET["lang"])) {
    $cminInstallerLanguage = $_GET["lang"];
// Otherwise, get it from a cookie
} if (!empty($_COOKIE["installlang"])) {
    $cminInstallerLanguage = $_COOKIE["installlang"];
// Otherwise, set the language to the default, EN-US
} else {
    $cminInstallerLanguage = "en-us";
}
// Handle submits
if ($cminInstallerStage === "lang" && $cminSubmit === true && !empty($_POST["installlang"])) {
    setcookie("installlang", $_POST["installlang"], strtotime('2 hours'), '/');
    header("Location: ?page=welcome&lang=".$_POST["installlang"]); 
}
if (!empty($_GET["ignorednt"]) && $cminSubmit === true) {
    setcookie("ignorednt", true, strtotime('2 hours'), '/');
}
if ($cminInstallerStage === "database" && $cminSubmit === true && !empty($_POST["databasetype"])) {
    setcookie("databasetype", $_POST["databasetype"], strtotime('2 hours'), '/');
    if ($_POST["databasetype"] === "mysqli") {
        if (!empty($_POST["databasename"]) && !empty($_POST["databaseserver"]) && !empty($_POST["databaseserverport"]) && !empty($_POST["databasename"]) && !empty($_POST["databaseprefix"]) && !empty($_POST["databasename"]) && !empty($_POST["databasepassword"])) { 
            setcookie("databaseserver", $_POST["databaseserver"], strtotime('2 hours'), '/');
            setcookie("databaseserverport", $_POST["databaseserverport"], strtotime('2 hours'), '/');
            setcookie("databasename", $_POST["databasename"], strtotime('2 hours'), '/');
            setcookie("databaseprefix", $_POST["databaseprefix"], strtotime('2 hours'), '/');
            setcookie("databaseusername", $_POST["databaseusername"], strtotime('2 hours'), '/');
            setcookie("databasepassword", $_POST["databasepassword"], strtotime('2 hours'), '/');
            header("Location: index.php?page=settings");
        } else {
            header("Location: index.php?page=database&type=mysqli");
        }
    } if ($_POST["databasetype"] === "mysqli") {
        if (!empty($_POST["databasename"]) && !empty($_POST["databaseserver"]) && !empty($_POST["databaseport"]) && !empty($_POST["databasename"]) && !empty($_POST["databasename"])) { 
            setcookie("databaseserver", $_POST["databaseserver"], strtotime('2 hours'), '/');
            setcookie("databaseport", $_POST["databaseport"], strtotime('2 hours'), '/');
            setcookie("databasename", $_POST["databasename"], strtotime('2 hours'), '/');
            if (!empty($_POST["databaseprefix"])) {
                setcookie("databaseprefix", $_POST["databaseprefix"], strtotime('2 hours'), '/');
            }
            setcookie("databaseusername", $_POST["databaseusername"], strtotime('2 hours'), '/');
            if (!empty($_POST["databasepassword"])) {
                setcookie("databasepassword", $_POST["databasepassword"], strtotime('2 hours'), '/');
            }
            header("Location: index.php?page=settings");
        } else {
            header("Location: index.php?page=database&type=mysqli");
        }
    } else if ($_POST["databasetype"] === "sqlite") {
        if (!empty($_POST["databasefile"])) {
            setcookie("databasefile", $_POST["databasefile"], strtotime('2 hours'), '/');
            if (!empty($_POST["databaseprefix"])) {
                setcookie("databaseprefix", $_POST["databaseprefix"], strtotime('2 hours'), '/');
            } 
            if (!empty($_POST["databasefilewebroot"])) {
                setcookie("databasefilewebroot", $_POST["databasefilewebroot"], strtotime('2 hours'), '/');
            } 
            header("Location: index.php?page=settings");
        } else {
            header("Location: index.php?page=database&type=sqlite");
        }
    } 
}

// Get the path this software is installed to.
$cminIndexPhpPath = realpath("../");

// END OF PRE-HTML PHP CODE //
?>
<!DOCTYPE html>
 <html lang="<?php echo $cminInstallerLanguage;?>">
  <head>
   <meta charset="UTF-8">
   <meta name="robots" content="noindex">
   <title>Install RethCommentsring</title>
   <link rel="stylesheet" type="text/css" href="installtheme.css">
  </head>
  <body> 
   <div class="main-wrapper">
    <h1 class="header">Install RethCommentsring</h1>
    <div class="main-content">
     <?php
// Pages for the installer.
// Language select 
if ($cminInstallerStage === "lang") {
    echo '<form action="index.php?page=lang&amp;submit=1" method="post">';
    echo '<div id="installer-language">Installer language</div>';
    echo '<select name="installlang">';
    echo '<optgroup label="English (EN)">';
    echo '<option value="en-au">Australian English (EN-AU)</option>';
    echo '<option value="en-ca">Canadian English (EN-CA)</option>'; 
    echo '<option value="en-gb">British English (EN-GB)</option>';
    echo '<option value="en-us" selected="true">US English (EN-US)</option>';
    echo '</optgroup>';
    echo '</select>';
    echo '<div id="submit-button"><button type="submit" class="button green">Submit</button></div>';
// Welcome to RethCommentsring
} else if ($cminInstallerStage === "welcome") {
    if ($cminInstallerLanguage === "en-au" || $cminInstallerLanguage === "en-ca" || $cminInstallerLanguage === "en-gb" || $cminInstallerLanguage === "en-us") {
        echo '<h2 class="header">Welcome to RethCommentsring!</h2>';
        echo 'RethCommentsring is a PHP application used to provide an interactive, responsive comments space.<br>It is recommended that you set up TLS/SSL encryption or disable web access before using the installer, as it relies on sending confidential information like passwords. For help setting up SSL, see documentation for: <a href="https://httpd.apache.org/docs/2.4/ssl/ssl_howto.html">Apache</a>, <a href="https://docs.microsoft.com/en-us/iis/manage/configuring-security/how-to-set-up-ssl-on-iis">IIS</a>, <a href="http://nginx.org/en/docs/http/configuring_https_servers.html">NGINX</a>';
        echo '<h3 class="header">Licence</h3>';
        echo '<h4 class="header">Free software</h4>';
        echo '<div id="licence-explanation">';
        echo '<p>This software is powered by RethCommentsring, copyright &copy; 2018 TheDragonFire961.</p>';
        echo '<p>RethCommentsring is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or any later version.</p>';
        echo '<p>RethCommentsring is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.</p>';
        echo '<p>You should have received a copy of the GNU General Public License along with RethCommentsring.  If not, see &lt;<a href="http://www.gnu.org/licenses/">http://www.gnu.org/licenses/</a>&gt;.';
        echo '</div>';
        echo '<h3 class="header">Environmental checks</h3>';
        echo '<h4 class="header">Server information</h4>';
        echo '<div id="check-meta-environment-params">The following is information regarding the server.</div>';
        echo '<table class="requirements-table">';
        echo '<tr>';
        echo '<th>Information</th>';
        echo '<th>Result</th>';
        echo '<tr>';
        echo '<td>File directory</td>';
        echo '<td>'.$cminIndexPhpPath.'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Server URL</td>';
        echo '<td>'.$_SERVER["SERVER_ADDR"].'</td>';
        echo '</tr>';
        echo '</table>';
        echo '<h4>Required - all</h4>';
        echo '<div id="check-required-environment-params">These must all pass (be presented in GREEN) if you want to install RethCommentsring. If they fail (are in RED), you will need to follow the instructions provided to make it pass.</div>';
        echo '<table class="requirements-table">';
        echo '<tr>';
        echo '<th>Requirement</th>';
        echo '<th>Result</th>';
        echo '<tr>';
        echo '<td>File '.$cminIndexPhpPath.'/settings/MachineSettings.php is writeable</td>';
        if (is_writable($cminIndexPhpPath.'/settings/MachineSettings.php')) {
            echo '<td><span class="check-pass">Passed - Writeable</span></td>';
            $cminRequiredCheck = true;
        } else {
            echo '<td><span class="check-fail">Failed - file does not exist or is non-writeable</span></td>';
            $cminRequiredCheck = false;
        }
        echo '</tr>';
        echo '<tr>';
        echo '<td>At least one skin is present</td>';
        $cminCheckSkins = scandir($cminIndexPhpPath.'/skins');
        foreach($cminCheckSkins as $cminCheckSkinFile) {
            if ($cminCheckSkinFile !== '.' && $cminCheckSkinFile !== '..') {
                if (file_exists($cminIndexPhpPath.'/skins/'.$cminCheckSkinFile.'/include.php')) {
                    $cminSkinIsPresent = true;
                }
            }
        }
        if (!empty($cminSkinIsPresent)) {
            echo '<td><span class="check-pass">Passed - Skin include.php detected, cannot verify syntax further</span></td>';
            $cminRequiredCheck = true;
        } else {
            echo '<td><span class="check-fail">Failed - No skins detected.</span></td>';
            $cminRequiredCheck = false;
        }
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '<h4 class="header">Required - Database</h4>';
        echo '<div id="check-database-environment-params">At least one of the below databases must be installed. If two or more are installed, you should pick ONE for use with RethCommentsring.</div>';
        echo '<table class="requirements-table">';
        echo '<tr>';
        echo '<th>Requirement</th>';
        echo '<th>Result</th>';
        echo '<tr>';
        echo '<td>MySQLi extension (MySQL/MariaDB/Percona Server for MySQL)</td>';
        if (extension_loaded("mysqli")) {
            echo '<td><span class="check-pass">Installed - Only the extension has been checked.</span><div class="small">Please note that you will also need to install a MySQL, MariaDB or Percona Server for MySQL server, either on this server or a separate one.</div></td>';
            $cminDatabaseCheck = true;
        } else {
            echo '<td><span class="check-fail">Not installed (<a href="http://www.php.net/manual/en/mysqli.installation.php">Install instructions</a>)</span><div class="small">Please note that you will also need to install a MySQLi, MariaDB or Percona Server for MySQL server, either on this server or a separate one.</div></td>';
        } 
        echo '</tr>';
        echo '<tr>';
        echo '<td>SQLite3</td>';
        if (extension_loaded("sqlite3")) {
            $cminSQLite3Version = SQLite3::version();
            echo '<td><span class="check-pass">Installed - Version '.$cminSQLite3Version['versionString'].' (VersionNumber '.$cminSQLite3Version['versionNumber'].')</span></td>';
            $cminDatabaseCheck = true;
        } else {
            if (extension_loaded("sqlite")) {
                echo '<td><span class="check-fail">Outdated - Original SQLite or SQLite2 installed, SQLite3 required (<a href="http://www.php.net/manual/en/sqlite3.installation.php">Install instructions</a>)</span><div class="small">Please note that the original SQLite and SQLite2 cannot be used with RethCommentsring.</div></td>';    
            } else {
                echo '<td><span class="check-fail">Not installed (<a href="http://www.php.net/manual/en/sqlite3.installation.php">Install instructions</a>)</span><div class="small">Please note that the original SQLite and SQLite2 cannot be used with RethCommentsring.</div></td>';
            }
        }
        echo '</table>';
        echo '<h4 class="header">Required - Random byte generation</h4>';
        echo '<div id="check-randombytes-environment-params">At least one of the below requirements should be met.</div>';
        echo '<table class="requirements-table">';
        echo '<tr>';
        echo '<th>Requirement</th>';
        echo '<th>Result</th>';
        echo '<tr>';
        echo '<td>OpenSSL <wbr>(<code title="Function used to provide random byte generation." class="help">openssl_random_pseudo_bytes&#40;&#41;</code>)</td>';
        if (extension_loaded("openssl")) {
            echo '<td><span class="check-pass">Installed - Only the extension has been checked.</span><div class="small">Please note that SSL/TLS encryption must be configured separately. Installation of this extension does NOT grant SSL/TLS encryption; it grants the <code>openssl_random_pseudo_bytes&#40;&#41;</code> function without configuration.</div></td>';
            $cminRandomBytesGenerationCheck = true;
        } else {
            echo '<td><span class="check-fail">Not installed (<a href="http://www.php.net/manual/en/openssl.installation.php">Install instructions</a>)</span><div class="small">Please note that SSL/TLS encryption must be configured separately. Installation of this extension does NOT grant SSL/TLS encryption; it grants the <code>openssl_psuedo_random_bytes&#40;&#41;</code> function without configuration.</div></td>';
        } 
        echo '</tr>';
        echo '<tr>';
        echo '<td>PHP 7.0 or later <wbr>(<code title="Function used to provide random byte generation." class="help">random_bytes&#40;&#41;</code>))</td>';
        if (!defined('PHP_VERSION_ID')) {
            $version = explode('.', PHP_VERSION);
            define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
        }
        if (PHP_VERSION_ID >= 70000) {
            echo '<td><span class="check-pass">Passed (PHP version '.phpversion().', version ID '.PHP_VERSION_ID.')</span></td>';
            $cminRandomBytesGenerationCheck = true;
        } else {
            echo '<td><span class="check-fail">Failed (PHP version '.phpversion().', version ID '.PHP_VERSION_ID.')</span></td>';
        }
        echo '</table>';
        echo '<h4 class="header">Optional</h4>';
        echo '<div id="check-optional-environment-params">The following requirements are recommended to be met, as they provide improvements for RethCommentsring, but you may still run RethCommentsring without them.</div>';
        echo '<table class="requirements-table">';
        echo '<tr>';
        echo '<th>Requirement</th>';
        echo '<th>Result</th>';
        echo '<tr>';
        echo '<td>OpenSSL</td>';
        if (extension_loaded("openssl")) {
            echo '<td><span class="check-pass">Installed - Only the extension has been checked.</span><div class="small">Please note that SSL/TLS encryption must be configured separately. Installation of this extension does NOT grant SSL/TLS encryption.</div></td>';
            $cminOptionalCheck = true;
        } else {
            echo '<td><span class="check-fail">Not installed (<a href="http://www.php.net/manual/en/openssl.installation.php">Install instructions</a>)</span><div class="small">Please note that SSL/TLS encryption must be configured separately. Installation of this extension does NOT grant SSL/TLS encryption.</div></td>';
            $cminOptionalCheck = false;
        } 
        echo '</tr>';
        echo '<tr>';
        echo '<td>PHP 7.0 or later</td>';
        if (!defined('PHP_VERSION_ID')) {
            $version = explode('.', PHP_VERSION);
            define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
        }
        if (PHP_VERSION_ID >= 70000) {
            echo '<td><span class="check-pass">Passed (PHP version '.phpversion().', version ID '.PHP_VERSION_ID.')</span></td>';
            $cminOptionalCheck = true;
        } else {
            echo '<td><span class="check-fail">Failed (PHP version '.phpversion().', version ID '.PHP_VERSION_ID.')</span></td>';
            $cminOptionalCheck = false;
        }
        echo '</tr>';
        echo '<tr>';
        echo '<td>intl extension</td>';
        if (extension_loaded("intl")) {
            echo '<td><span class="check-pass">Installed</span></td>';
            $cminOptionalCheck = true;
        } else {
            echo '<td><span class="check-fail">Not installed (<a href="http://www.php.net/manual/en/fileinfo.installation.php">Install instructions</a>)</td>';
            $cminOptionalCheck = false;
        } 
        echo '</tr>';
        echo '<tr>';
        echo '<td>fileinfo extension</td>';
        if (extension_loaded("fileinfo")) {
            echo '<td><span class="check-pass">Installed</span></td>';
            $cminOptionalCheck = true;
        } else {
            echo '<td><span class="check-fail">Not installed - File uploads will be disabled. (<a href="http://www.php.net/manual/en/fileinfo.installation.php">Install instructions</a>)</span></td>';
            $cminOptionalCheck = false;
        } 
        echo '</tr>';
        echo '<tr>';
        echo '<td>GD extension</td>';
        if (extension_loaded("gd")) {
            echo '<td><span class="check-pass">Installed</span></td>';
            $cminOptionalCheck = true;
        } else {
            echo '<td><span class="check-fail">Not installed - File uploads will be disabled. (<a href="http://www.php.net/manual/en/gd.installation.php">Install instructions</a>)</span></td>';
            $cminOptionalCheck = false;
        } 
        echo '</tr>';
        echo '</table>';
        echo '<p class="center">';
        if (!empty($cminRequiredCheck) && $cminRequiredCheck === true && !empty($cminDatabaseCheck) && !empty($cminRandomBytesGenerationCheck)) {
            if (!empty($cminOptionalCheck) && $cminOptionalCheck === false) {
                echo '<div class="check-fail">One or more optional features are missing, but you may install RethCommentsring anyway.</div>';
            }
            echo '<a href="index.php?page=lang" class="button red">Previous</a> | ';
            echo '<a href="index.php?page=database" class="button green">Next</a>';
        } else {
            echo '<p class="check-fail center">You cannot proceed with the installation because one or more required checks failed.</p>';
            echo '<p class="center"><a href="index.php?page=lang" class="button red">Previous</a></p>';
        }
        echo '</p>';
    }
} else if ($cminInstallerStage === "database") {
    if ($cminInstallerLanguage === "en-au" || $cminInstallerLanguage === "en-ca" || $cminInstallerLanguage === "en-gb" || $cminInstallerLanguage === "en-us") {
        echo '<h2 class="header">Database Setup</h2>';
        echo 'RethCommentsring supports the following databases:';
        echo '<ul>';
        echo '<li>MySQL is a popular client-server type database. It is supported using the MySQLi extension, which also supports MariaDB and Percona Server for MySQL.</li>';
        echo '<li>SQLite is a lightweight local database. It is supported through the SQLite3 extension.</li>';
        echo '</ul>';
        echo '<form action="index.php?page=database&submit=1" method="post">';
        if (extension_loaded("mysqli")) {
            echo '<input type="radio" name="databasetype" value="mysqli" onclick="cminShowDatabaseNext('."'mysqli'".');"';
            if (!empty($_GET["type"]) && $_GET["type"] === "mysqli") {
                echo ' checked="checked"';
            }
            echo '> MySQLi/MariaDB/Percona Server for MySQL<br>';
        } 
        if (extension_loaded("sqlite3")) {
            echo '<input type="radio" name="databasetype" value="sqlite" onclick="cminShowDatabaseNext('."'sqlite'".');"';
            if (!empty($_GET["type"]) && $_GET["type"] === "sqlite") {
                echo ' checked="checked"';
            }
            echo '> SQLite3<br>';
        }
        echo '<div id="database-params">';
        if (!empty($_GET["type"]) && $_GET["type"] === "mysqli") {
            echo 'Database server name<br><input type="text" class="input-box" name="databaseserver" value="localhost"><br>';
            echo 'Database server port<br><input type="text" class="input-box" name="databaseport" value="3306"><br>';
            echo 'Database name<br><input class="input-box" type="text" name="databasename" value="rethcommentsring"><br>';
            echo 'Database table prefix<br><input type="text" class="input-box" name="databaseprefix" value="rethcommentsring_"><br>';
            echo 'Database username<br><input type="text" class="input-box" name="databaseusername" value="root"><br>';
            echo 'Database password<br><input type="password" class="input-box" name="databasepassword"><br>';
        } else if (!empty($_GET["type"]) && $_GET["type"] === "sqlite") {
            echo 'Database file<br><input type="text" class="input-box" name="databasefile" value=""><br>';
            echo 'Database table prefix<br><input class="input-box" type="text" name="databaseprefix" value="rethcommentsring_"><br>';
            echo 'Database file is in web root <input type="checkbox" name="databasefilewebroot"><br>';
        }
        echo '</div>';
        echo '<p class="center"><a href="index.php?page=welcome" class="button red">Previous</a>';
        echo '<span style="display:none;" id="database-next"> | <button type="submit" class="button green">Next</button></span><noscript> | <button type="submit" class="button green">Next</button></noscript></p>';
        echo '<script type="text/javascript">';
        echo 'function cminShowDatabaseNext(databasetype) {';
        echo '    document.getElementById("database-next").style.display = "inline";';
        echo '    document.getElementById("database-params").style.display = "block";';
        echo '    if (databasetype === "mysqli") {';
        echo '        document.getElementById("database-params").innerHTML = '."'".'Database server name<br><input type="text" class="input-box" name="databaseserver" value="localhost"><br>'."'".';';
        echo '        document.getElementById("database-params").innerHTML += '."'".'Database server port<br><input type="text" class="input-box" name="databaseport" value="3306"><br>'."'".';';
        echo '        document.getElementById("database-params").innerHTML += '."'".'Database name<br><input class="input-box" type="text" name="databasename" value="rethcommentsring"><br>'."'".';';
        echo '        document.getElementById("database-params").innerHTML += '."'".'Database table prefix<br><input type="text" class="input-box" name="databaseprefix" value="rethcommentsring_"><br>'."'".';';
        echo '        document.getElementById("database-params").innerHTML += '."'".'Database username<br><input type="text" class="input-box" name="databaseusername" value="root"><br>'."'".';';
        echo '        document.getElementById("database-params").innerHTML += '."'".'Database password<br><input type="password" class="input-box" name="databasepassword"><br>'."'".';';
        echo '    }';
        echo '    if (databasetype === "sqlite") {';
        echo '        document.getElementById("database-params").innerHTML = '."'".'Database file<br><input type="text" class="input-box" name="databasefile" value=""><br>'."'".';';
        echo '        document.getElementById("database-params").innerHTML += '."'".'Database table prefix<br><input class="input-box" type="text" name="databaseprefix" value="rethcommentsring_"><br>'."'".';';
        echo '        document.getElementById("database-params").innerHTML += '."'".'Database file is in web root <input type="checkbox" name="databasefilewebroot"><br>'."'".';';
        echo '    }';
        echo '}';
        if (!empty($_GET["type"])) {
            echo 'document.getElementById("database-next").style.display = "inline"';
        }
        echo '</script></form>';
    }
} else if ($cminInstallerStage === "settings") {
    if ($cminInstallerLanguage === "en-au" || $cminInstallerLanguage === "en-ca" || $cminInstallerLanguage === "en-gb" || $cminInstallerLanguage === "en-us") {
        echo '<h2 class="header">New Sysop account credentials</h2>';
        echo '<div>Enter the credentials for the initial sysop account to be created alongside the installation of RethCommentsring.</div>';
        echo '<div id="sysop-name-label">Name</div><input type="text" class="input-box" name="sysop-username">';
        echo '<div id="sysop-password-label">Password</div><input type="text" class="input-box" name="sysop-password">';
        echo '<div id="sysop-email-label">Name</div><input type="text" class="input-box" name="sysop-email">';
        echo '<h2 class="header">RethCommentsring Settings</h2>';
        echo '<form action="index.php?page=settings&submit=1" method="post">';
        echo '<h3 class="header">Enable file uploads</h3>';
        if (!extension_loaded("fileinfo") || !extension_loaded("gd")) {
            echo '<span class="check-fail">You cannot enable file uploads because either (or both) the fileinfo and GD extensions are missing.</span>';
        } else {
            echo 'Enable file uploads <input type="checkbox" checked="checked" name="enableuploads">';
            echo '<div id="upload-settings">';
            echo 'File directory<br><input type="text" class="input-box" name="uploadsdirectory">';
        }
    }
} else {
    if (!empty($cminInstallerLanguage)) {
        if ($cminInstallerLanguage === "en-au" || $cminInstallerLanguage === "en-ca" || $cminInstallerLanguage === "en-gb" || $cminInstallerLanguage === "en-us") {
            echo "<h2>No such stage</h2>";
            if ($cminInstallerLanguage === "en-au" || $cminInstallerLanguage === "en-gb") {
                echo 'The stage given in the URL was not recognised.';
            } else {
                echo 'The stage given in the URL was not recognized.';
            }
            echo '<p class="center"><a href="index.php?page=welcome" class="button red">Return</a></p>';
        } else {
            echo "<h2>No such stage</h2>";
            echo 'The stage given in the URL was not recognized.';
            echo '<p class="center"><a href="index.php?page=welcome" class="button red">Return</a></p>';
        }
    } else {
        echo "<h2>No such stage</h2>";
        echo 'The stage given in the URL was not recognized.';
        echo '<p class="center"><a href="index.php?page=lang" class="button red">Return</a></p>';
    }
}
     ?>
     <?php
if (!empty($_SERVER["HTTP_DNT"]) && $_SERVER["HTTP_DNT"] === "1" && empty($_GET["ignorednt"]) && empty($_COOKIE["ignorednt"])) {
    echo '<div class="check-fail small">It appears you have set a preference expressing that you do not want to be tracked. Please note that this installer requires the use of cookies (tracking) to save important installer data. By proceeding you accept that you do want to be checked. To disable this warning, add <code>?ignorednt=1&submit=1</code> (if there isn&#39;t already a question mark in the URL) or <code>&amp;ignorednt=1&ampsubmit=1;</code> (if there is already a question mark in the URL) to the URL. (Please note this does set a cookie set to expire 2 hours after it has been set. To disable this warning <b>for this page only</b>, remove <code>&amp;submit=1</code>, so you&#39;re only placing <code>?ignorednt=1</code> or <code>&amp;ignorednt=1</code>.)</div>';
}
     ?>
   </div>
  </div>
 </body>