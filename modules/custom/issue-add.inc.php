<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// leer-add.inc.php v1 chaot
// leer - add funktion
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

echo "<pre>";
echo print_r($_POST,true)."\n";
    if ( $cfg["issue"]["right"] == "" || priv_check('', $cfg["issue"]["right"]) ) {
    #if ( $cfg["issue"]["right"] == "" || $rechte[$cfg["issue"]["right"]] == -1 ) {

        // page basics
        // ***

        #if ( count($_POST) == 0 ) {
        #} else {
            $form_values = $_POST;
        #}

        // form options holen
        $form_options = form_options("issue-edit");
// echo "<pre>".print_r($form_options,true)."</pre>";

        // form elememte bauen
        $element = array_merge(
                        form_elements( $cfg["comic_db"]["publisher"]["entries"], $form_values ),
                        form_elements( $cfg["comic_db"]["issue"]["entries"], $form_values )
                   );
// echo "<pre>".print_r($element,true)."</pre>";

        // form elemente erweitern
        $element["issue_number_range"] = preg_replace("/(name=\".+)(\")/U",'${1}_range${2}',$element["issue_number"]);
        $element["issue_number_range"] = preg_replace("/(value=\").+(\")/U",'${1}'.$form_values["issue_number_range"].'${2}',$element["issue_number_range"]);
        // $element["issue_number_range"] = $element["issue_number"];
        $element["extension2"] = null;

        krsort($element);

        // +++
        // page basics


        // page basics
        // ***

        // fehlermeldungen
        $ausgaben["form_error"] = null;

        // navigation erstellen
        if ( !isset($environment["parameter"][1]) ) $environment["parameter"][1] = null;
        $ausgaben["form_aktion"] = $cfg["issue"]["basis"]."/add,".$environment["parameter"][1].",verify.html";
        $ausgaben["form_break"] = $cfg["issue"]["basis"]."/list.html";

        // hidden values
        $ausgaben["form_hidden"] = null;

        // was anzeigen
        $mapping["main"] = "issue-add";
        #$mapping["navi"] = "leer";

        // unzugaengliche #(marken) sichtbar machen
        if ( isset($_GET["edit"]) ) {
            $ausgaben["inaccessible"] = "inaccessible values:<br />";
            $ausgaben["inaccessible"] .= "# (error_result) #(error_result)<br />";
            $ausgaben["inaccessible"] .= "# (error_dupe) #(error_dupe)<br />";
        } else {
            $ausgaben["inaccessible"] = null;
        }

        // wohin schicken
        #n/a

        // +++
        // page basics

        if ( !isset($environment["parameter"][2]) ) $environment["parameter"][2] = null;
        if ( isset($_POST["send"])
            || isset($_POST["extension1"])
            || isset($_POST["extension2"])
        ) {
echo "POST\n";
echo $ausgaben["form_error"]."\n";

            // form eigaben pr�fen
            form_errors( $form_options, $_POST );
            echo $ausgaben["form_error"]."\n";

            // evtl. zusaetzliche datensatz anlegen
            if ( !isset($ausgaben["form_error"]) ) {

                // Publisher-Handling
                $sql = "SELECT *
                          FROM ".$cfg["comic_db"]["publisher"]["entries"]."
                         WHERE ".$cfg["comic_db"]["publisher"]["name"]."='".$form_values["publisher"]."'";
                $result  = $db -> query($sql);
                if ( $db->num_rows($result) == 0 ) {
                    // Neuer Verlag -> hinzufügen
                    $sql = "INSERT INTO ".$cfg["comic_db"]["publisher"]["entries"]."
                                        (".$cfg["comic_db"]["publisher"]["name"].",
                                         ".$cfg["comic_db"]["publisher"]["creator"].",
                                         ".$cfg["comic_db"]["publisher"]["created"].")
                                 VALUES ('".$form_values["publisher"]."',
                                         '".$_SESSION["uid"]."',
                                         '".date("Y-m-d")."')";
                    // $result  = $db -> query($sql);
                    $publisher_id = $db->lastid();

                    // TODO: log-Datei ergänzen

echo "Neuer Verlag: ".$sql."\n".$id."\n";
                } else {
                    $data = $db -> fetch_array($result,1);
                    $publisher_id = $data[$cfg["comic_db"]["publisher"]["key"]];
echo "Bestehender Verlag: ".print_r($data,true)."\n".$id."\n";
                }

                if ( $error ) $ausgaben["form_error"] .= $db -> error("#(error_result)<br />");
                // +++
                // funktions bereich fuer erweiterungen
            }

            // datensatz anlegen
            if ( !isset($ausgaben["form_error"]) ) {

                // Dateitypen rausfinden
                $columns = $db->show_columns($cfg["comic_db"]["issue"]["entries"]);
                $field_type = array();
                foreach ($columns as $value) {
                    if ( strstr($value["Type"], "int") ) {
                        $field_type[$value["Field"]] = "int";
                    } elseif ( strstr($value["Type"], "char") || strstr($value["Type"], "text") ) {
                        $field_type[$value["Field"]] = "str";
                    } elseif ( strstr($value["Type"], "date") || strstr($value["Type"], "time") ) {
                        $field_type[$value["Field"]] = "date";
                    }
                }

                // Den Fall abfangen, das keine Nummer eingegeben wurde
                if ( $form_values["issue_number"] == "" ) {
                    $number = -666666;
                } else {
                    $number = $form_values["issue_number"];
                }

                // Nummern-Bereich ergänzen
                if ( $form_values["issue_number_range"] == "" ) {
                    $form_values["issue_number_range"] = $number;
                }


                $kick = array( "issue_number" );
                while ( $number <= $form_values["issue_number_range"] ) {
                    // SQL-Felder nullen
                    $sql_values = array();
                    // Alle Form-Values durchgehen
                    foreach ( $form_values as $key=>$value ) {
                        if ( !isset($field_type[$key]) ) continue;
                        if ( in_array($key, $kick) ) continue;


                        $sql_values["key"][$key] = $key;
                        if ( $field_type[$key] == "int" ) {
                            if ( $form_values[$key] == "" ) {
                                $sql_values["value"][$key] = "NULL";
                            } else {
                                $sql_values["value"][$key] = (int) $form_values[$key];
                            }
                        } elseif ( $field_type[$key] == "str" ) {
                            if ( $form_values[$key] == "" ) {
                                $sql_values["value"][$key] = "''";
                            } else {
                                $sql_values["value"][$key] = "'".$form_values[$key]."'";
                            }
                        } elseif ( $field_type[$key] == "date" ) {
                            if ( $form_values[$key] == "" ) {
                                $sql_values["value"][$key] = "NULL";
                            } else {
                                $sql_values["value"][$key] = "'".$form_values[$key]."'";
                            }
                        }

                    }
                    // Felder ergänzen: Nummer
                    if ( $number != -666666 ) {
                        $sql_values["key"]["issue_number"]   = "issue_number";
                        $sql_values["value"]["issue_number"] = "'".$number."'";
                    }
                    // Felder ergänzen: Publisher
                    $sql_values["key"]["issue_publisher"]   = "issue_publisher";
                    $sql_values["value"]["issue_publisher"] = $publisher_id;
                    // Felder ergänzen: Erstellt von
                    $sql_values["key"]["creator"]           = "creator";
                    $sql_values["value"]["creator"]         = $_SESSION["uid"];
                    // Felder ergänzen: Erstellt am
                    $sql_values["key"]["created"]           = "created";
                    $sql_values["value"]["created"]         = "'".date("Y-m-d")."'";
                    // SQL bauen
                    $sql = "INSERT INTO ".$cfg["comic_db"]["issue"]["entries"]."
                                        (".implode(",
                                         ",$sql_values["key"]).")
                                 VALUES (".implode(",
                                         ",$sql_values["value"]).")";
                    if ( $debugging["sql_enable"] ) $debugging["ausgabe"] .= "sql: ".$sql.$debugging["char"];
echo $sql."\n";
                    // Ausführen
                    // $result  = $db -> query($sql);

                    // TODO: log-Datei ergänzen

                    // Nummer weiterzählen
                    $number++;
                }
echo "hallo";
exit;
// echo "hallo: ".print_r($columns,true)."\n";
// echo "hallo: ".print_r($field_type,true)."\n";

                if ( $debugging["sql_enable"] ) $debugging["ausgabe"] .= "sql: ".$sql.$debugging["char"];
                // $result  = $db -> query($sql);
                // if ( !$result ) $ausgaben["form_error"] .= $db -> error("#(error_result)<br />");
                if ( !isset($header) ) $header = $cfg["issue"]["basis"]."/list.html";
            }

            // wenn es keine fehlermeldungen gab, die uri $header laden
            if ( !isset($ausgaben["form_error"]) ) {
                // header("Location: ".$header);
            }
        }
    } else {
        header("Location: ".$pathvars["virtual"]."/");
    }
echo "</pre>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
