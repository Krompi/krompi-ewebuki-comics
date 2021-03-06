<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// "$Id: prived.cfg.php-dist 2066 2015-03-11 16:03:53Z werner.ammon@gmail.com $";
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

    $cfg["prived"] = array(
           "subdir" => "admin",
             "name" => "prived",
            "basis" => $pathvars["virtual"]."/admin/prived", # crc = 754611962 *
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
              #"edit,shared" => array("shared1", "shared2"),
              #"edit,global" => array("global1", "global2"),
                       ),
               "db" => array(
                     "priv" => array(
                          "entries" => "auth_priv",
                              "key" => "pid",
                            "order" => "priv",
                            "rows"  => 5,
                     ),
          "content" => array(
                          "entries" => "auth_content",
                            "group" => "gid",
                             "priv" => "pid",
                     ),
            "group" => array(
                          "entries" => "auth_group",
                              "key" => "gid",
                     ),
              ),
            "right" => $cfg["auth"]["menu"]["prived"][1],
    );

////+///////+///////+///////+///////+///////+///////+///////////////////////////////////////////////////////////
?>