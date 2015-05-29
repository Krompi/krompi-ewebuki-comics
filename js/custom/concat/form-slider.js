(function ( $ ) {
 
    $.fn.formSlider1 = function( options ) {
 
        // This is the easiest way to have default options.
        settings = $.extend({
            // These are the defaults.
            hallo: "1",
            welt: "2",
            wrapClass: "fs-wrap",
            itemClass: "fs-item"
        }, options );
        
        obj = this;
 
//        console.log(settings.hallo);
        _init(this, settings);
//        console.log(settings.winWidth);

        return {
            move: function(val) {
                _move(val);
            }
        }
 
    };
    
    function _init() {
//        console.log(settings.welt);
        
        settings.winWidth = $(obj).outerWidth();
        
        $(obj).find('.' + settings.wrapClass).css('width',settings.winWidth*3 + 'px')
                                             .css('marginLeft',settings.winWidth*(-1) + 'px')
                                             .append('<div class="' + settings.itemClass + '"></div>')
                                             .prepend('<div class="' + settings.itemClass + '"></div>');
        
        $(obj).find('.' + settings.itemClass).each(function(i){
            $(this).addClass('fs-pos-' + i).css('float','left').css('minHeight','3px');
        });
        
        _move(1);
        
    };
    
    function _move(pos) {
        
        console.log('Move-Position: ' + pos);
        
        $(obj).find('.' + settings.itemClass).each(function(i) {
//            console.log(i);
            
            if ( i == (pos - 1) || i == pos || i == (pos + 1) ) {
                $(this).css('width',settings.winWidth);
            } else {
                $(this).css('width','0');
            }
            
        })
        
        
    }
    
 
}( jQuery ));

(function( $ ){

    var methods = {
        
        init : function(options) {
            settings = $.extend({
                // These are the defaults.
                hallo: "1",
                welt: "2",
                wrapClass: "fs-wrap",
                itemClass: "fs-item"
            }, options );
            
            fsWindow = this;
            
            // Fenster-Breite feststellen
            settings.winWidth   = $(fsWindow).outerWidth();
            // Anzahl der Elemente
            settings.countItems = $(fsWindow).find('.' + settings.itemClass).length;
            
            
            
            console.log(settings);

            $(fsWindow).find('.' + settings.wrapClass)
                       .css('width',settings.winWidth*3 + 'px')
                       .css('marginLeft',settings.winWidth*(-1) + 'px')
                       .append('<div class="' + settings.itemClass + '"></div>')
                       .prepend('<div class="' + settings.itemClass + '"></div>');


            $(fsWindow).find('.' + settings.itemClass).each(function(i){
                
                $(this).attr('data-pos',i)
                       .addClass('fs-pos-' + i)
                       .css('float','left')
                       .css('minHeight','3px');
            });
            
            methods.move(1);
            
        },
        
        prev : function() {
            
            if ( settings.position > 1 ) {
                methods.move(settings.position-1);
            }
            
        },
        
        next : function() {
            
            if ( settings.position < settings.countItems ) {
                methods.move(settings.position+1);
            }
            
        },
        
        move : function(pos) {
            
            console.log('Move-Position: ' + pos);
            console.log(settings);

            if ( $.isNumeric(pos) ) {
                
                if ( pos >= 1 && pos <= settings.countItems ) {
                    
                    settings.position = pos;
        
                    $(fsWindow).find('.' + settings.itemClass).each(function(i) {
            //            console.log(i);


                        if ( i == (pos - 1) || i == pos || i == (pos + 1) ) {
                            $(this).css('width',settings.winWidth);
                        } else {
                            $(this).css('width','0');
                        }

                    })
                    
                }
                
            }
            
        },
        
        show : function( ) {
            console.log( 'function show()' )
            methods.update('blub');
        },// IS
        
        hide : function( ) {  },// GOOD
        update : function( parameter ) { 
            console.log( 'function update(' + parameter + ')' )
        }// !!!
    };

    $.fn.formSlider = function(methodOrOptions) {
        if ( methods[methodOrOptions] ) {
            return methods[ methodOrOptions ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof methodOrOptions === 'object' || ! methodOrOptions ) {
            // Default to "init"
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  methodOrOptions + ' does not exist on jQuery.tooltip' );
        }    
    };


})( jQuery );