<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// "$Id: grouped.cfg.php-dist 2065 2015-03-11 16:03:08Z werner.ammon@gmail.com $";
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
////+///////+///////+///////+///////+///////+///////+///////////////////////////////////////////////////////////

    // content umschaltung verhindern
    $specialvars["dynlock"] = True;

    $cfg["grouped"] = array(
           "subdir" => "admin",
             "name" => "grouped",
            "basis" => $pathvars["virtual"]."/admin/grouped", crc = -102562964 *
         "iconpath" => "", # leer: /images/default/; automatik: $pathvars["images"]
            "color" => array(
                        "a" => "#eeeeee",
                        "b" => "#ffffff",
                       ),
         "function" => array(
                      "add" => "",
                     "edit" => "",
                   "delete" => "",
                  "details" => "",
                       ),
               "db" => array(
                     "user" => array(
                        "entries" => "auth_user",
                            "key" => "uid",
                          "order" => "username",
                               ),
                    "group" => array(
                        "entries" => "auth_group",
                            "key" => "gid",
                           "desc" => "beschreibung",
                          "order" => "ggroup",
                          "rows" => 10
                              ),
                    "member"=> array(
                        "entries" => "auth_member",
                        "user"    => "uid",
                        "group"   => "gid"
                               )
                       ),
            "right" => $cfg["auth"]["menu"]["grouped"][1],
    );

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>