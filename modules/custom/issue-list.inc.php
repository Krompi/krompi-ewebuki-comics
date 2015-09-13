<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// leer-list.inc.php v1 chaot
// leer - list funktion
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

    if ( $cfg["issue"]["right"] == "" || priv_check('', $cfg["issue"]["right"]) ) {
    #if ( $cfg["issue"]["right"] == "" || $rechte[$cfg["issue"]["right"]] == -1 ) {

        // funktions bereich
        // ***

        ### put your code here ###

        $sql = "SELECT *
                  FROM ".$cfg["comic_db"]["publisher"]["entries"]."
              ORDER BY ".$cfg["comic_db"]["publisher"]["order"];
        if ( $debugging["sql_enable"] ) $debugging["ausgabe"] .= "sql: ".$sql.$debugging["char"];
        $result = $db -> query($sql);
        while ( $data = $db -> fetch_array($result,1) ) {
            $dataloop["publisher"][] = array(
                "id"        => $data[$cfg["comic_db"]["publisher"]["key"]],
                "name"      => $data[$cfg["comic_db"]["publisher"]["name"]],
                "add_issue" => $cfg["urls"]["issues"]."/add.html?publisher=".$data[$cfg["comic_db"]["publisher"]["key"]],
            );
        }
        
        // +++
        // funktions bereich


        // page basics
        // ***

        // fehlermeldungen
        if ( isset($_GET["error"]) ) {
            if ( $_GET["error"] == 1 ) {
                $ausgaben["form_error"] = "#(error1)";
            }
        } else {
            $ausgaben["form_error"] = null;
        }

        // navigation erstellen
        $ausgaben["link_new"] = $cfg["issue"]["basis"]."/add.html";

        // hidden values
        #$ausgaben["form_hidden"] = null;

        // was anzeigen
        $cfg["issue"]["path"] = str_replace($pathvars["virtual"],null,$cfg["issue"]["basis"]);
        $mapping["main"] = "issue-list";
        #$mapping["navi"] = "leer";

        // unzugaengliche #(marken) sichtbar machen
        if ( isset($_GET["edit"]) ) {
            $ausgaben["inaccessible"] = "inaccessible values:<br />";
            $ausgaben["inaccessible"] .= "# (error1) #(error1)<br />";
            $ausgaben["inaccessible"] .= "# (edittitel) #(edittitel)<br />";
            $ausgaben["inaccessible"] .= "# (deletetitel) #(deletetitel)<br />";
        } else {
            $ausgaben["inaccessible"] = null;
        }

        // wohin schicken
        #n/a

        // +++
        // page basics

    } else {
        header("Location: ".$pathvars["virtual"]."/");
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
