<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// "$Id: site.cfg.php-dist 2029 2015-03-09 10:47:38Z werner.ammon@gmail.com $";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
    eWeBuKi - a easy website building kit
    Copyright (C)2001-2015 Werner Ammon ( wa<at>chaos.de )

    This script is a part of eWeBuKi

    eWeBuKi is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    eWeBuKi is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with eWeBuKi; If you did not, you may download a copy at:

    URL:  http://www.gnu.org/licenses/gpl.txt

    You may also request a copy from:

    Free Software Foundation, Inc.
    59 Temple Place, Suite 330
    Boston, MA 02111-1307
    USA

    You may contact the author/development team at:

    Chaos Networks
    c/o Werner Ammon
    Lerchenstr. 11c

    86343 Koenigsbrunn

    URL: http://www.chaos.de
*/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // zugangsdaten datenbank
    // depends on: $_SERVER["SERVER_NAME"], http.conf: UseCanonicalName On/Off
    $access["0"]["server"] = "ewebuki";
    $access["0"]["host"] = "";
    $access["0"]["db"] = "eWeBuKi";
    $access["0"]["user"] = "changeme";
    $access["0"]["pass"] = "changeme";

    if (file_exists(dirname(__FILE__)."/site.custom.cfg.php") ) {
        include dirname(__FILE__)."/site.custom.cfg.php";
    }

    $specialvars["postgres"] = 0; // postgres als datenbank verwenden

    // content variablen
    $specialvars["pagetitle"] = "Comicsammlung"; // globaler html seiten titel
    $specialvars["rootname"] = "Start"; // globaler root keks titel
    define ('SITETEXT','site_text'); // tabelle mit content
    $specialvars["available_languages"] = array("de","en"); // verfuegbare sprachen
    #$specialvars["convert_languages"] = array("ger" => "de","eng" => "en"); // sprachen konverter (setzen nur nach umbau)
    $specialvars["default_language"] = "de"; // entwickler sprache
    $specialvars["default_design"] = "custom"; // design bezeichnung
    $specialvars["default_template"] = "default1"; // basis name des default template
    $specialvars["menu_level0_start"] = 1; // erste zufall startseite
    $specialvars["menu_level0_end"] = 0; // letzte zufall startseite (0 = disable)
    $specialvars["old_contented"] = 0; // alten contented verwenden
    $specialvars["crc32"] = -1; // ablage des content mit crc32.tname
    $specialvars["crc32force"] = 0; // schreibt crc32 auf 64-bit systemen
    #$specialvars["wrapper_hide_debug"] = -1; // verhindert die debug-ausgabe des wrappers
    $specialvars["denyhtml"] = -1; // html im content verbieten
    $specialvars["denyspace"] = -1; // leerzeichen im content verbieten
    $specialvars["nosections"] = 0; // bearbeiten marke pro absatz verhindern
    $specialvars["newbrmode"] = -1; // \r\n wird nur noch innerhalb von [DIV und [P durch </ br> ersetzt
    $specialvars["newbrblock"] = ""; // \r\n -> </ br> verhindern (zur zeit nur DIV m�glich)
    $specialvars["w3c"] = "strict";
    $specialvars["404"]["enable"] = -1; // 404 fehlermeldungen aktivieren
    $specialvars["404"]["nochk"]["ebene"] = array("/cms","/admin","api","/issue"); // ebenen ohne 404 meldung
    $specialvars["404"]["nochk"]["kategorie"] = array("index","view"); // kategorien ohne 404 meldung
    $specialvars["security"]["enable"] = 0; // spezial recht auf content bearbeitung
    $specialvars["security"]["nochk"] = array("auth.logout","index","auth"); // templates die nur admin aendern darf
    #$specialvars["security"]["overwrite"] = "cms_admin"; // wer ist content admin
    $specialvars["security"]["new"] = -1;
    $specialvars["security"]["content"] = "edit;publish";
    #$specialvars["content_release"] = -1;
    $specialvars["stacked_eEd"] = 0;

    // debugging
    $debugging["error_display"] = "On";
    // $debugging["error_display"] = "Off";

    $debugging["error_reporting"] = E_ALL; // development
    $debugging["error_reporting"] = E_ALL & ~(E_DEPRECATED); // development, no notices
    #$debugging["error_reporting"] = E_ALL & ~(E_NOTICE|E_STRICT); //  development & !notices, !coding warnings
    #$debugging["error_reporting"] = E_ALL & ~(E_NOTICE|E_STRICT|E_DEPRECATED); // debian default

    #$debugging["html_enable"] = -1;
    #$debugging["sql_enable"] = -1;

    $debugging["html_enable"] = -1;
    $debugging["sql_enable"] = -1;

    $debugging["char"] = "<br \>";
    $debugging["head"] = "<pre>";
    $debugging["footer"] = "</pre>";
    #$debugging["char"] = "\n";
    #$debugging["head"] = "<!--";
    #$debugging["footer"] = "//-->";


    // ACHTUNG **************
    // Das Aktivieren dieser Funktion konvertiert den Content nach HTML.
    // Eine Konvertierung zurueck zu CMSTAG ist derzeit nicht moeglich.
    $specialvars["wysiwyg"] = ""; // composite, epoz unterstuetzung aktivieren
    // ACHTUNG **************

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
