<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// "$Id: contented.cfg.php-dist 2074 2015-03-12 17:26:19Z werner.ammon@gmail.com $";
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

    $cfg["contented"] = array(
           "subdir" => "admin",
             "name" => "contented",
            "basis" => $pathvars["virtual"]."/admin/contented", # crc = -141347382 *
         "iconpath" => "", # leer: /images/default/; automatik: $pathvars["images"]
            #"debug" => True,
       "diff_engine"=> "phpdiff3",
      "history_rows"=> 15,
         "function" => array(
                     "edit" => array("makece"),
              "edit,shared" => array("filelist","phpdiff","menu_convert"),
                  "history" => "",
            "history,shared" => array("phpdiff3","phpdiff2","Diff","Render","Render_inline","Engine_native","menu_convert"),
              #"edit,shared" => array("sha","klo"),
              #"edit,global" => array("glo"),
                       ),

               "db" => array(
                     "leer" => array(
                          "entries" => "db_leer",
                              "key" => "id",
                            "order" => "sort, label",
                            "rows"  => 4,
                               ),
                     "file" => array(
                          "entries" => "site_file",
                              "key" => "fid",
                            "order" => "fid DESC",
                             "rows" => "10", // pro seite
                             "line" => "5", // pro zeile  (rows / line)
                          "newline" => "<br clear=\"all\" />",
                               ),
                       ),
 "revision_control" => true,
            "right" => $cfg["auth"]["ghost"]["contented"],
            #"tagjs" => "-141347382.modify.js-classic",
          "letters" => "",
            "tagjs" => "-141347382.modify.js-nextgen",
        "image_tag" => "img",
          "sel_tag" => array("o","True","l","Bildergalerie"), // array(size des zielbildes,thumbs in viewer(TRUE),Lightbox-Modus(l),defaultTitle)
             "tags" => array( // position (T=top, B=bottom), access key, no select, links, mitte, rechts, eingener tag
                   // block-elemente
                   "h1"     => array( "T", "1" ),
                   "h2"     => array( "T", "2" ),
                   "h3"     => array( "T", "3" ),
                   "h4"     => array( "" ),
                   "h5"     => array( "" ),
                   "h6"     => array( "" ),
                   "p"      => array( "T", "P" ),
                   "pre"    => array( "" ),
                   "div"    => array( "", "D", False, "=wert]" ),
                   "box"    => array( "T", "D", False, "=box]", "", "", "DIV" ),
                   "list"   => array( "", "L", False, "=1|a]", "\\n[*]" ),
                   "hr"     => array( "", "H", True ),
                   "table"  => array( "", "T", False, "]\\n[ROW]\\n[COL]", "" ,"\\n[\/COL]\\n[\/ROW]\\n" ),
                   "tab"    => array( "", "T" ),
                   "row"    => array( "", "R" ),
                   "col"    => array( "", "C", True ),
                   "center" => array( "" ),

                   // inline-elemente - logisch
                   "br"     => array( "", "N", True ),
                   "img"    => array( "", "I", False, "=", ";;0;b" ),
//                    "img"    => array( "", "I", False, "B=", ";;0;b", "B" ),
                   "link"   => array( "T", "L", False, "=http:\/\/]" ),

                   // inline-elemente - logische auszeichnugen
                   "acr"    => array( "B", "", False, "=bedeutung]" ),
                   "em"     => array( "" ),
                   "strong" => array( "" ),
                   "code"   => array( "B" ),
                   "cite"   => array( "" ),

                   // inline-elemente - physische auszeichnungen
                   "b"      => array( "T", "B" ),
                   "i"      => array( "T", "I" ),
                   "tt"     => array( "" ),
                   "u"      => array( "" ),
                   "s"      => array( "" ),
                   "st"     => array( "" ),
                   "big"    => array( "" ),
                   "small"  => array( "" ),
                   "sub"    => array( "" ),
                   "sup"    => array( "" ),

                   // ewebuki spezial
                   "e"      => array( "B", "E" ),
                   "!"      => array( "B" ),
                   "ank"    => array( "" ),
                   "email"  => array( "", "M", False, "=Adresse]" ),
                   "hs"     => array( "" ),
                   "hl"     => array( "", "_", True ),
                   "imgb"   => array( "", "X", False, "=image.typ;l|r;0;b;20;20;10]" ),
                   "sel"    => array( "", "S", False, "=1;b;;1:2;l]" ),
                   "in"     => array( "" ),
                   "m0"     => array( "B", "-" ),
                   "m1"     => array( "B", "=" ),
                   "m2"     => array( "B", "+" ),
                   "up"     => array( "B", "U" ),
                   "prev"   => array( "B", "<", True ),
                   "next"   => array( "B", ">", True ),
                   "quote"  => array( "" ),
                   "sp"     => array( "", "", True ),

                   "file"   => array( "T", "", True ),
                   "grp"    => array( "T", "", True ),

                   // deprecated (automatic don't work)
                   "int"    => array( "", "", "", "", "" ),
                       ),
        "default_label"     => "inhalt"
           );

////+///////+///////+///////+///////+///////+///////+///////////////////////////////////////////////////////////
?>