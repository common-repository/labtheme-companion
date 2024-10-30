jQuery(document).ready(function($) {

	$(document).on('keyup','.labtheme-search-icon',function() {
       	var value = $(this).val();
       	var matcher = new RegExp(value, 'gi');
       	$(this).siblings('.labtheme-font-awesome-list').find('li').show().not(function(){
           	return matcher.test($(this).find('svg').attr('data-icon'));
       	}).hide();
  	});

  	// ADD IMAGE LINK
    $('body').on('click','.labtheme-upload-button',function(e) {
        e.preventDefault();
        var clicked = $(this).closest('div');
        var custom_uploader = wp.media({
            title: 'Lab Image Uploader',
            // button: {
            //     text: 'Custom Button Text',
            // },
            multiple: false  // Set this to true to allow multiple files to be selected
            })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            var str = attachment.url.split('.').pop(); 
            var strarray = [ 'jpg', 'gif', 'png', 'jpeg' ]; 
            if( $.inArray( str, strarray ) != -1 ){
                clicked.find('.labtheme-screenshot').empty().hide().append('<img src="' + attachment.url + '"><a class="labtheme-remove-image"></a>').slideDown('fast');
            }else{
                clicked.find('.labtheme-screenshot').empty().hide().append('<small>'+labtheme_companion_uploader.msg+'</small>').slideDown('fast');    
            }
            
            clicked.find('.labtheme-upload').val(attachment.id).trigger('change');
            clicked.find('.labtheme-upload-button').val(labtheme_companion_uploader.change);
        }) 
        .open();
    });

    $('body').on('click','.labtheme-remove-image',function(e) {
        
        var selector = $(this).parent('div').parent('div');
        selector.find('.labtheme-upload').val('').trigger('change');
        selector.find('.labtheme-remove-image').hide();
        selector.find('.labtheme-screenshot').slideUp();
        selector.find('.labtheme-upload-button').val(labtheme_companion_uploader.upload);
        
        return false;
    });

    $('body').on('click', '.labtheme-contact-social-add:visible', function(e) {
        e.preventDefault();
        da = $(this).siblings('.labtheme-contact-sortable-links').attr('id');
        suffix = da.match(/\d+/);
        var maximum=0;
        $( '.labtheme-contact-social-icon-wrap:visible' ).each(function() {
            var value =  $(this).attr( 'data-id' );
            if(!isNaN(value))
            {
                value = parseInt(value);
                maximum = (value > maximum) ? value : maximum;
            }
        });
        var newinput = $('.labtheme-contact-social-template').clone();
        maximum++;
        newinput.find( '.labtheme-contact-social-length' ).attr('name','widget-labtheme_contact_social_links['+suffix+'][social]['+maximum+']');
        newinput.find( '.user-contact-social-profile' ).attr('name','widget-labtheme_contact_social_links['+suffix+'][social_profile]['+maximum+']');
        newinput.html(function(i, oldHTML) {
            return oldHTML.replace(/{{ind}}/g, maximum);
        });
        $(this).siblings('.labtheme-contact-sortable-links').find('.labtheme-contact-social-icon-holder').before(newinput.html()).trigger('change');
    });

     $('body').on('click', '#remove-icon-list', function(e) {
        e.preventDefault();
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
        });
    });
    
    $('body').on('click', '.del-labtheme-icon, .del-contact-labtheme-icon', function() {
        var con = confirm(sociconsmsg.msg);
        if (!con) {
            return false;
        }
        $(this).parent().fadeOut('slow', function() {
            $(this).remove();
            $('.labtheme-contact-social-add').focus().trigger('change');
            $('.labtheme-social-add').focus().trigger('change');
        });
        return;
    });


    $('body').on('click', '#add-faq:visible', function(e) {
        e.preventDefault();
        da = $(this).siblings('.widget-client-faq-repeater').attr('id');
        suffix = da.match(/\d+/);
        len=0;
        $( '.faqs-repeat:visible' ).each(function() {
            var value =  $(this).attr( 'data-id' );
            if(!isNaN(value))
            {
                value = parseInt(value);
                len = (value > len) ? value : len;
            }
        });
        len++;
        var newinput = $('.labtheme-faq-template').clone();
        newinput.html(function(i, oldHTML) {
            newinput.find( '.faqs-repeat' ).attr('data-id',len);
            newinput.find( '.question' ).attr('name','widget-labtheme_companion_faqs_widget['+suffix+'][question]['+len+']');
            newinput.find( '.answer' ).attr('name','widget-labtheme_companion_faqs_widget['+suffix+'][answer]['+len+']');
        });
        // $('.labtheme-faq-holder').before(newinput.html());
        $(this).siblings('.widget-client-faq-repeater').find('.labtheme-faq-holder').before(newinput.html());
        return $(this).focus().trigger('change');
    });

    $('body').on('click', '.cross', function(e) {
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
            if (in_customizer) {
                $('#add-logo').focus().trigger('change');
            }
        });
        return $(this).focus().trigger('change');
    });

    $('body').on('click', '#add-logo:visible', function(e) {
        e.preventDefault();
        da = $(this).siblings('.widget-client-logo-repeater').attr('id');
        suffix = da.match(/\d+/);
        len=0;
        $(this).siblings('.widget-client-logo-repeater').children( '.link-image-repeat:visible' ).each(function() {
            var value =  $(this).attr( 'data-id' );
            if(!isNaN(value))
            {
                value = parseInt(value);
                len = (value > len) ? value : len;
            }
        });
        
        len++;
        var newinput = $('.labtheme-client-logo-template').clone();
        newinput.html(function(i, oldHTML) {
            newinput.find( '.link-image-repeat' ).attr('data-id',len);
            newinput.find( '.featured-link' ).attr('name','widget-labtheme_client_logo_widget['+suffix+'][link]['+len+']');
            newinput.find( '.widget-upload .link' ).attr('name','widget-labtheme_client_logo_widget['+suffix+'][image]['+len+']');
        });
        $(this).siblings('.widget-client-logo-repeater').find('.labtheme-repeater-holder').before(newinput.html());
        return $(this).focus().trigger('change');
    });

    // set var
    var in_customizer = false;

    // check for wp.customize return boolean
    if (typeof wp !== 'undefined') {
        in_customizer = typeof wp.customize !== 'undefined' ? true : false;
    }
    $(document).on('click', '.labtheme-font-group li', function() {
        var id = $(this).parents('.widget').attr('id');
        $('#' + id).find('.labtheme-font-group li').removeClass();
        $('#' + id).find('.icon-receiver').siblings('a').remove('.labtheme-remove-icon');
        $(this).addClass('selected');
        var prefix = $(this).parents('.labtheme-font-awesome-list').find('.labtheme-font-group li.selected').children('svg').attr('data-prefix');
        var icon = $(this).parents('.labtheme-font-awesome-list').find('.labtheme-font-group li.selected').children('svg').attr('data-icon');
        var aa = prefix + ' fa-' + icon;
        $(this).parents('.labtheme-font-awesome-list').siblings('p').find('.hidden-icon-input').val(aa);
        $(this).parents('.labtheme-font-awesome-list').siblings('p').find('.icon-receiver').html('<i class="' + aa + '"></i>');
        $('#' + id).find('.icon-receiver').append('<a class="labtheme-remove-icon"></a>');

        if (in_customizer) {
            $('.hidden-icon-input').trigger('change');
        }
        
        $(this).focus().trigger('change');
    });

    /** Remove icon function */
    $(document).on('click', '.labtheme-remove-icon', function() {
        var id = $(this).parents('.widget').attr('id');
        $('#' + id).find('.labtheme-font-group li').removeClass();
        $('#' + id).find('.hidden-icon-input').val('');
        $('#' + id).find('.icon-receiver').html('<i class=""></i>').children('a').remove('.labtheme-remove-icon');
        if (in_customizer) {
            $('.hidden-icon-input').trigger('change');
        }
        return $('#' + id).find('.icon-receiver').trigger('change');
    });

    /** To add remove button if icon is selected in widget update event */
    $(document).on('widget-updated', function(e, widget) {
        // "widget" represents jQuery object of the affected widget's DOM element
        var $this = $('#' + widget[0].id).find('.yes');
            $this.append('<a class="labtheme-remove-icon"></a>');
    });

    labtheme_check_icon();

    /** function to check if icon is selected and saved when loading in widget.php */
    function labtheme_check_icon() {
        $('.icon-receiver').each(function() {
            // alert($(this).children('.svg-inline--fa').attr('class'));
            if($(this).hasClass('yes'))
            {
                $(this).append('<a class="labtheme-remove-icon"></a>');
            }
        });
    }

    // $('body').on('click', '.labtheme-social-add', function(e) {
    //     e.preventDefault();
    //     da = $(this).siblings('.labtheme-sortable-links').attr('id');
    //     suffix = da.match(/\d+/);
    //     var len = $('.companion-social-length:visible').length;
    //     len++;
    //     var newinput = $('.labtheme-social-template').clone();
    //     newinput.html(function(i, oldHTML) {
    //         newinput.find( '.companion-social-length' ).attr('name','widget-labtheme_social_links['+suffix+'][social]['+len+']');
    //     });

    //     $(this).siblings('.labtheme-sortable-links').find('.labtheme-social-icon-holder').before(newinput.html());
    //     $('ul.labtheme-sortable-links input').trigger('change');
    // });

    // Pricing add item
     $('body').on('click', '.labtheme-items-add', function(e) {
        e.preventDefault();
        // da = document.getElementsByClassName('labtheme-sortable-icons')[1].getAttribute("id");
        da = $(this).siblings('.labtheme-sortable-items').attr('id');
        suffix = da.match(/\d+/);
        var len = $('.items-length:visible').length;
        len++;
        var newinput = $('.labtheme-item-template').clone();
        newinput.html(function(i, oldHTML) {
            newinput.find( '.items-length' ).attr('name','widget-labtheme_pricing_table__widget['+suffix+'][items]['+len+']');
            // return oldHTML.replace(/{{indexes}}/g, len);
        });

        $(this).siblings('.labtheme-sortable-items').find('.labtheme-items-holder').before(newinput.html());
    });

     // Delete item
    $('body').on('click', '.del-icon', function() {
        var con = confirm(confirming.are_you_sure);
        if (!con) {
            return false;
        }
        $(this).parent().fadeOut('slow', function() {
            $(this).remove();
            $('.labtheme-social-add').focus().trigger('change');
        });

        return;
    });
    $('body').on('click', '.del-item', function() {
        var con = confirm(confirming.are_you_sure);
        if (!con) {
            return false;
        }
        $(this).parent().parent().fadeOut('slow', function() {
            $(this).remove();
            $('ul.labtheme-sortable-items input').trigger('change');
        });
    });

    $('body').on('click', '.labtheme-social-add', function(e) {
        e.preventDefault();
        da = $(this).siblings('.labtheme-sortable-links').attr('id');
        suffix = da.match(/\d+/);
        var maximum=0;
        $( '.labtheme-social-icon-wrap:visible' ).each(function() {
            var value =  $(this).attr( 'data-id' );
            if(!isNaN(value))
            {
                value = parseInt(value);
                maximum = (value > maximum) ? value : maximum;
            }
        });
        var newinput = $('.labtheme-social-template').clone();
        maximum++;
        newinput.find( '.labtheme-social-length' ).attr('name','widget-labtheme_social_links['+suffix+'][social]['+maximum+']');
        newinput.find( '.user-social-profile' ).attr('name','widget-labtheme_social_links['+suffix+'][social_profile]['+maximum+']');
        newinput.html(function(i, oldHTML) {
            return oldHTML.replace(/{{indexes}}/g, maximum);
        });

        $(this).siblings('.labtheme-sortable-links').find('.labtheme-social-icon-holder').before(newinput.html());
    });

    // script for skills widget
    $('body').on('click', '#add-skill:visible', function(e) {
        e.preventDefault();
        da = $(this).siblings('.widget-skills-repeater').attr('id');
        suffix = da.match(/\d+/);
        len=0;
        $( '.skills-repeat:visible' ).each(function() {
            var value =  $(this).attr( 'data-id' );
            if(!isNaN(value))
            {
                value = parseInt(value);
                len = (value > len) ? value : len;
            }
        });
        len++;
        var newinput = $('.labtheme-skills-template').clone();
        newinput.html(function(i, oldHTML) {
            newinput.find( '.skills-repeat' ).attr('data-id',len);
            newinput.find( '.skill_title' ).attr('name','widget-labtheme_skills_widget['+suffix+'][skill_title]['+len+']');
            newinput.find( '.skill_value' ).attr('name','widget-labtheme_skills_widget['+suffix+'][skill_value]['+len+']');
        });
        $('.labtheme-skill-holder').before(newinput.html());
        return $(this).focus().trigger('change');
    });
    $('body').on('click', '.skill-cross', function(e) {
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
            if (in_customizer) {
                $('#add-skill').focus().trigger('change');
            }
        });
        return $(this).focus().trigger('change');
    });

    $('body').on('click', '.labtheme-team-social-add', function(e) {
        e.preventDefault();
        var len = $('.team-social-length:visible').length;
        if(len > 0)
        {
            var arr = new Array();
            $('.team-social-length:visible').each(function() {
                arr.push($(this).parent('.labtheme-social-icon-wrap').attr('data-id'));
            });
            len = Math.max.apply(Math, arr);
        }
        len++;
        var newinput = $('.labtheme-social-team-template').clone();
        newinput.html(function(i, oldHTML) {
            return oldHTML.replace(/{{indexed}}/g, len);
        });
        $('.labtheme-social-icon-holder').before(newinput.html());
    });

     $('body').on('click', '.del-team-icon', function() {
        var con = confirm(confirming.are_you_sure);
        if (!con) {
            return false;
        }
        $(this).parent().fadeOut('slow', function() {
            $(this).remove();
        });
        if ($('.del-team-icon').length < 1) {
            $('.labtheme-team-social-add').removeAttr('disabled');
        }
    });

     $(document).on('blur','.social-profile',function(e) {
        e.preventDefault();
        $(this).siblings('.labtheme-icons-list').fadeOut('slow',function(){
            $(this).remove();
        });
    });

    $(document).on('focus','.team-social-profile',function() {
        // if($(this).val()=='')
        // {
            if( $(this).siblings('.labtheme-icons-list').length < 1 )
            {
                var $iconlist = $('.labtheme-icons-wrap').clone();
                $(this).after($iconlist.html());
                $(this).siblings('.labtheme-icons-list').fadeIn('slow');
            }
            
            if ( $(this).siblings('.labtheme-icons-list').find('#remove-icon-list').length < 1 )
            {
                var input = '<span id="remove-icon-list"><i class="fas fa-times"></i></span>';
                $(this).siblings('.labtheme-icons-list:visible').prepend(input);
            }
    });

    $(document).on('blur','.team-social-profile',function(e) {
        e.preventDefault();
        $(this).siblings('.labtheme-icons-list').fadeOut('slow',function(){
            $(this).remove();
        });
    });

     $(document).on('click','.labtheme-icons-list li',function(event) {
        var prefix = $(this).children('svg').attr('data-prefix');
        var icon = $(this).children('svg').attr('data-icon');
        var val = prefix + ' fa-' + icon;
        $(this).parent().siblings('.social-profile').attr('value', icon);
        $(this).parent().parent().siblings('.social-length').attr('value','https://'+icon+'.com');

        $(this).parent().siblings('.team-social-profile').attr('value', icon);
        $(this).parent().siblings('.team-social-length').attr('value','https://'+icon+'.com');

        $(this).siblings('.labtheme-icons-wrap-search').remove('slow');
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
        });
        
        $(this).parent().siblings('.social-length').trigger('change');
        $(this).parent().siblings('.social-profile').trigger('change');
        $(this).parent().siblings('.team-social-profile').trigger('change');
        $(this).parent().siblings('.team-social-length').trigger('change');
        event.preventDefault();
    });

    $('body').on('click', '#remove-icon-list', function(e) {
        e.preventDefault();
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
        });
    });
    
    $(document).on('keyup','.social-profile',function() {
        var value = $(this).val();
        var matcher = new RegExp(value, 'gi');
        $(this).siblings('.labtheme-icons-list').children('li').show().not(function(){
            return matcher.test($(this).find('svg').attr('data-icon'));
        }).hide();
    });

    $(document).on('keyup','.team-social-profile',function() {
        var value = $(this).val();
        var matcher = new RegExp(value, 'gi');
        $(this).siblings('.labtheme-icons-list').children('li').show().not(function(){
            return matcher.test($(this).find('svg').attr('data-icon'));
        }).hide();
    });

    $('body').on('click', '.labtheme-items-add', function(e) {
        e.preventDefault();
        // da = document.getElementsByClassName('labtheme-sortable-icons')[1].getAttribute("id");
        da = $(this).siblings('.labtheme-sortable-items').attr('id');
        suffix = da.match(/\d+/);
        var len = $('.items-length:visible').length;
        len++;
        var newinput = $('.labtheme-item-template').clone();
        newinput.html(function(i, oldHTML) {
            newinput.find( '.items-length' ).attr('name','widget-labtheme_pro_pricing_table__widget['+suffix+'][items]['+len+']');
            // return oldHTML.replace(/{{indexes}}/g, len);
        });

        $(this).siblings('.labtheme-sortable-items').find('.labtheme-items-holder').before(newinput.html());
    });


});