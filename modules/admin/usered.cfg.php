<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// "$Id: usered.cfg.php-dist 2067 2015-03-11 16:06:42Z werner.ammon@gmail.com $";
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

    $cfg["usered"] = array(
           "subdir" => "admin",
             "name" => "usered",
            "basis" => $pathvars["virtual"]."/admin/usered", # crc = 210295197 *
         "iconpath" => "", # leer: /images/default/; automatik: $pathvars["images"]
            "color" => array(
                        "a" => "#eeeeee",
                        "b" => "#ffffff",
                       ),
         "function" => array(
                  "details" => "",
                      "add" => "",
                     "edit" => "",
                   "delete" => "",
                       ),
               "db" => array(
                     "user" => array(
                          "entries" => "auth_user",
                              "key" => "uid",
                            "login" => "username",
                         "forename" => "vorname",
                          "surname" => "nachname",
                            "email" => "email",
                            "order" => "username, nachname, vorname",
                            "rows"  => 10,
                     ),
                    "right" => array(
                          "entries" => "auth_right",
                              "key" => "rid",
                             "user" => "uid",
                            "level" => "lid",
                     ),
                    "level" => array(
                          "entries" => "auth_level",
                              "key" => "lid",
                            "level" => "level",
                     ),
                  "special" => array(
                          "entries" => "auth_special",
                              "key" => "lid",
                             "user" => "suid",
                            "tname" => "stname",
                     ),
              ),
            "right" => $cfg["auth"]["menu"]["usered"][1],
    );

////+///////+///////+///////+///////+///////+///////+///////////////////////////////////////////////////////////
?>