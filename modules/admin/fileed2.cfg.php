<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// "$Id: fileed2.cfg.php-dist 2064 2015-03-11 13:45:45Z guenther.morhart@googlemail.com $";
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

    $cfg["fileed"] = array(
           "subdir" => "admin",
             "name" => "fileed2",
            "basis" => $pathvars["virtual"]."/admin/fileed",
         "iconpath" => "", // leer: /images/default/; automatik: $pathvars["images"]
       "ajax-modus" => True,
         #"function" => array("describe", "list", "note", "preview", "select"),
         "function" => array(
                     "list" => "", // array( "function_name" ),
              "list,shared" => array("filelist"),
                      "add" => array( "thumbnail", "resize", "arrange", "compilationlist","group_permit" ),
               "add,shared" => array( "zip_handling", "file_validate" ),
                     "edit" => array( "resize", "arrange", "file_check", "compilationlist","group_permit" ),
              "edit,shared" => array( "zip_handling", "file_validate", "menu_convert" ),
                   "resize" => array( "resize", "arrange", "file_check", "compilationlist" ),
            "resize,shared" => array( "zip_handling", "file_validate" ),
                   "crop" => array( "resize", "arrange", "file_check", "compilationlist" ),
            "crop,shared" => array( "zip_handling", "file_validate" ),
                   "delete" => array( "file_check","group_permit", "compilationlist" ),
                   "upload" => array( "resize", "compilationlist" ),
            "upload,shared" => array( "zip_handling", "file_validate" ),
                     #"used" => "",
                  "collect" => array( "compilationlist" ),
           "collect,shared" => array( "filelist", "menu_convert" ),
              "compilation" => array( "compilationlist" ),
       "compilation,shared" => array( "filelist", "menu_convert" ),
                       ),
               "db" => array(
                     "file" => array(
                          "entries" => "site_file",
                              "key" => "fid",
                            "order" => "fid DESC",
                             "rows" => "10", // pro seite
                             "line" => "5", //  pro zeile  (rows / line)
                          "newline" => "<br clear=\"all\" />",
                             "user" => "fuid",
                        #"grant_grp" => "fgroups", // dort steht, welche gruppen das bild editiern koennen
                               ),
                     "lang" => array(
                            #"entries" => "site_file_lang",
                               ),
                     "user" => array(
                          "entries" => "auth_user",
                              "key" => "uid",
                          "surname" => "nachname",
                         "forename" => "vorname",
                            "email" => "email",
                               ),
                  "content" => array(
                          "entries" => "site_text",
                          "content" => "content",
                             "path" => "ebene, kategorie, tname, status, version"
                               ),
                    "multi" => array(
                           "change" => False,
                          "entries" => "db_adrd",
                            "field" => "addbase",
                            "where" => "addbase != ''",
                               ),
                       ),
     "zip_handling" => array(
             "sektions" => array(
                     "unterschrift" => "funder",
                     "beschreibung" => "fdesc",
                               )
                       ),
           "upload" => array(
                   "inputs" => 5,
                       ),
      "compilation" => array(
                    "items" => "3",
                     "rows" => "3",
                 "selektor" => "5",
           "sel_pics_w_sel" => -1, // wenn die selection ausgewaehlt wird werden auch alle bilder ausgewaehlt
            #"blocked_used" => true, // duerfen benutzte gruppierungen bearbeitet werden
                       ),
           "filter" => array(
                        "0" => array("Meine", "Gruppe", "Alle"),
                        "1" => array("Bilder", "Dokumente", "Archive", "Markierte Bilder"),
                       ),
             "tabs" => array( // beschriftung,  link,  anordung (L/R), url-muster
                       #"0" => array("g(all_files)", "list,,,all.html" , "L", "/list[,0-9]*[all]*\.html/i"),
                       #"1" => array("g(sel_files)", "list,,,sel.html", "L", "/list[,0-9]*,sel.*\.html/i"),
                        "2" => array("g(all_files)", "list,,,.html", "L", "/list/i"),
                        "3" => array("g(fileupload)", "upload.html", "R", "/upload[,0-9]*.html/"),
                        "4" => array("g(filecompilation)", "compilation.html", "R", "/compilation[,0-9]*.html/"),
                       ),
     #"default_view" => "symbols", // standardansicht im fileed-list
     #"replace_used" => true, // duerfen benutzte dateien ausgetauscht werden
      #"delete_used" => true, // duerfen benutzte dateien in historischen Versionen geloescht werden
      #"dummy_regex" => array("#p[0-9]+,[0-9]+#"), // regex, muster fuer fhit-sperre
         "no_dummy" => "admin", // noetiges recht um den fhit komplett zu bearbeiten
     #"delete_admin" => "admin", // darf alle bilder löschen auch in aktuellen Versionen
            "right" => $cfg["auth"]["menu"]["fileed"][1],
         "restrict" => array(), // z.B. array("delete", "edit")
        #"su_groups" => array(1), // beinhaltet die ids der gruppen, die alle bilder bearbeiten koennen
    );

////+///////+///////+///////+///////+///////+///////+///////////////////////////////////////////////////////////
?>