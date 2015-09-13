<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $script["name"] = "$Id: leer.inc.php 2132 2015-05-13 12:02:05Z werner.ammon@gmail.com $";
  $Script["desc"] = "short description";
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

    if ( $debugging["html_enable"] ) $debugging["ausgabe"] .= "[ ** ".$script["name"]." ** ]".$debugging["char"];

    if ( $cfg["startseite"]["right"] == "" || priv_check('', $cfg["startseite"]["right"]) ) {
    #if ( $cfg["startseite"]["right"] == "" || $rechte[$cfg["startseite"]["right"]] == -1 ) {

        ////////////////////////////////////////////////////////////////////
        // achtung: bei globalen funktionen, variablen nicht zuruecksetzen!
        // z.B. $ausgaben["form_error"],$ausgaben["inaccessible"]
        ////////////////////////////////////////////////////////////////////

        // page basics
        // ***

        // warnung ausgeben
        if ( get_cfg_var('register_globals') == 1 ) $debugging["ausgabe"] .= "Warnung: register_globals in der php.ini steht auf on, evtl werden interne Variablen ueberschrieben!".$debugging["char"];

        // path fuer die schaltflaechen anpassen
        if ( $cfg["startseite"]["iconpath"] == "" ) $cfg["startseite"]["iconpath"] = "/images/default/";

        // label bearbeitung aktivieren
        if ( isset($_GET["edit"]) ) {
            $specialvars["editlock"] = 0;
        } else {
            $specialvars["editlock"] = -1; 
        }

        // +++
        // page basics


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
        $hidedata["leer"][0] = "enable";
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
            $ausgaben["form_error"] = "";
        }

        // navigation erstellen
        if ( !isset($environment["parameter"][1]) ) $environment["parameter"][1] = null;
        $ausgaben["add"] = $cfg["startseite"]["basis"]."/add,".$environment["parameter"][1].",verify.html";
        
        $ausgaben["add_issue"] = $cfg["urls"]["issues"]."/add.html?publisher";
        #$mapping["navi"] = "leer";

        // hidden values
        #$ausgaben["form_hidden"] .= "";

        // was anzeigen
        #$mapping["main"] = eCRC($environment["ebene"]).".list";
        #$mapping["navi"] = "leer";

        // unzugaengliche #(marken) sichtbar machen
        if ( isset($_GET["edit"]) ) {
            $ausgaben["inaccessible"] = "inaccessible values:<br />";
            $ausgaben["inaccessible"] .= "# (error1) #(error1)<br />";
        } else {
            $ausgaben["inaccessible"] = "";
        }

        // wohin schicken
        #n/a

        // +++
        // page basics

    } else {
        header("Location: ".$pathvars["virtual"]."/");
    }

    if ( $debugging["html_enable"] ) $debugging["ausgabe"] .= "[ ++ ".$script["name"]." ++ ]".$debugging["char"];

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
