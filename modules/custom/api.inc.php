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

    if ( $cfg["api"]["right"] == "" || priv_check('', $cfg["api"]["right"]) ) {
        $debug  = "<pre>";
        $debug .= print_r($_GET,true)."\n";

        $path   = array_merge(array_filter(explode("/", $environment["ebene"]."/".$environment["kategorie"])));
        $debug .= "Url-Teile: ".print_r($path,true)."\n";

        if (in_array($path[1], array("json")) ) {
            $format = $path[1];
        } else {
            $format = "json";
        }

        $return_array = array();
        if ( $path[2] == "publisher" ) {

            if ( $_GET["q"].$_GET["term"] != "" ) {
                $where = "
                     WHERE ".$cfg["comic_db"]["publisher"]["name"]." LIKE '".$_GET["q"].$_GET["term"]."%'";
            } else {
                $where = "";
            }

            $sql = "SELECT *
                      FROM ".$cfg["comic_db"]["publisher"]["entries"].$where."
                  ORDER BY ".$cfg["comic_db"]["publisher"]["order"];
            $debug .= $sql."\n";
            $result = $db -> query($sql);
            while ( $data = $db -> fetch_array($result,1) ) {
                $return_array[] = array(
                    "id"        => $data[$cfg["comic_db"]["publisher"]["key"]],
                    "value"     => $data[$cfg["comic_db"]["publisher"]["name"]],
                    "label"     => $data[$cfg["comic_db"]["publisher"]["name"]],
                );
            }

        } elseif ( $path[2] == "title" ) {

            if ( $_GET["q"].$_GET["term"] != "" ) {
                $where = "
                     WHERE ".$cfg["comic_db"]["issue"]["title"]." LIKE '".$_GET["q"].$_GET["term"]."%'";
            } else {
                $where = "";
            }

            $sql = "SELECT *
                      FROM ".$cfg["comic_db"]["issue"]["entries"].$where."
                  ORDER BY ".$cfg["comic_db"]["issue"]["order"];
            $debug .= $sql."\n";
            $result = $db -> query($sql);
            while ( $data = $db -> fetch_array($result,1) ) {
                $return_array[] = array(
                    "id"        => $data[$cfg["comic_db"]["issue"]["title"]],
                    "value"     => $data[$cfg["comic_db"]["issue"]["title"]],
                    "label"     => $data[$cfg["comic_db"]["issue"]["title"]],
                );
            }

        }

        if ( $format == "json" ) {
            $return_value = json_encode($return_array);
        }


        $debug .= "<pre>";
        echo $return_value;
        if ( isset($_GET["debug"]) ) {
            echo $debug;
        }
        exit;

    } else {
        header("Location: ".$pathvars["virtual"]."/");
    }

    if ( $debugging["html_enable"] ) $debugging["ausgabe"] .= "[ ++ ".$script["name"]." ++ ]".$debugging["char"];

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
