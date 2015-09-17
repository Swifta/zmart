<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>  
<script type="text/javascript">
	$(document).ready(function(){
	    
   	 $('.submit-link1')
                               .click(function(e){ 
								   
                                       var cat = $(this).attr('id').replace('samples-','').split('-');
                                       $('input[name="c"]').val(cat[0]);
                                       $('input[name="m_c"]').val(cat[1]);
                                       $('input[name="c_t"]').val('<?php echo base64_encode("sub"); ?>');
                                       
                                       e.preventDefault();
                                      $(this).closest('form').submit();
                                               
   });
  
    });
</script>
     
<div id="home_page_margin_top" class="contianer_outer">
<div class="contianer_inner">
    <div class="contianer">
       
            <div class="content_abou_common">
      <div class="pro_top5">
       <div class="common_ner_commont1">
           <div class="common_ner_commont">
                       <h2><?php echo $this->Lang['AL_CAT']; ?></h2> 
                        </div>
                      
                        </div>   


</div>	
			<form action="<?php echo PATH; ?>">
                <div class="categry_for_all">
                    <div id="container" class="super-list variable-sizes clearfix">
                        
					<?php if($this->category_list){ foreach ($this->category_list as $d) { ?>                                             
                    <div class="art_two_cart element">
                        <h3> <?php echo ucfirst($d->category_name); ?></h3>
                         <?php if(count($this->categeory_list) > 0){ ?>
                         <?php foreach ($this->categeory_list as $s) { ?>
		                <?php if($d->category_id == $s->main_category_id){ $type = "products"; ?>
		                <?php if( $s->type == 2){
                                        $catetype = base64_encode("sub");
                                 }
                                 if( $s->type == 3){
                                        $catetype = base64_encode("sec");
                                 }
                                 if( $s->type == 4){
                                        $catetype = base64_encode("third");
                                 } ?>
		                <p><a style="cursor:pointer; "class="submit-link1" onclick="filtercategory('<?php echo $s->category_url; ?>','<?php echo $type; ?>','<?php echo $catetype; ?>');" title="<?php echo ucfirst($s->category_name); ?>"><?php echo ucfirst($s->category_name); ?></a></p>
                            <?php } ?>
                        <?php  } ?>
                    <?php } ?>
                    </div>                                        
                    <?php } } ?>
                </div>
                </div>
                <input type="hidden" name="c" />
                <input type="hidden" name="c_t" />
                <input type="hidden" name="m_c">
                <p><input type="submit" style="display:none;"> </p>
                </form>
        </div>
    </div>
</div>
    <!-- Isotope script start -->
        <script src="<?php echo PATH; ?>/themes/<?php echo THEME_NAME; ?>/js/jquery.isotope.min.js"></script>
        <script>
          $(function(){
            var $container = $('#container');
            $container.isotope({
              masonry: {
                columnWidth: 1
              },
              sortBy: 'number',
              getSortData: {
                number: function( $elem ) {
                  var number = $elem.hasClass('element') ? 
                    $elem.find('.number').text() :
                    $elem.attr('data-number');
                  return parseInt( number, 10 );
                },
                alphabetical: function( $elem ) {
                  var name = $elem.find('.name'),
                      itemText = name.length ? name : $elem;
                  return itemText.text();
                }
              }
            });
            var $optionSets = $('#options .option-set'),
                $optionLinks = $optionSets.find('a');
            $optionLinks.click(function(){
              var $this = $(this);
              // don't proceed if already selected
              if ( $this.hasClass('selected') ) {
                return false;
              }
              var $optionSet = $this.parents('.option-set');
              $optionSet.find('.selected').removeClass('selected');
              $this.addClass('selected');
              // make option object dynamically, i.e. { filter: '.my-filter-class' }
              var options = {},
                  key = $optionSet.attr('data-option-key'),
                  value = $this.attr('data-option-value');
              // parse 'false' as false boolean
              value = value === 'false' ? false : value;
              options[ key ] = value;
              if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
                // changes in layout modes need extra logic
                changeLayoutMode( $this, options )
              } else {
                // otherwise, apply new options
                $container.isotope( options );
              }
              return false;
            });
            // Sites using Isotope markup
            var $sites = $('#sites'),
                $sitesTitle = $('<h2 class="loading"><img src="http://i.imgur.com/qkKy8.gif" />Loading sites using Isotope</h2>'),
                $sitesList = $('<ul class="clearfix"></ul>');
            $sites.append( $sitesTitle ).append( $sitesList );
            $sitesList.isotope({
              layoutMode: 'cellsByRow',
              cellsByRow: {
                columnWidth: 290,
                rowHeight: 400
              }
            });
            var ajaxError = function(){
              $sitesTitle.removeClass('loading').addClass('error')
                .text('Could not load sites using Isotope :(');
            };

            // dynamically load sites using Isotope from Zootool
            $.getJSON('http://zootool.com/api/users/items/?username=desandro' +
                '&apikey=8b604e5d4841c2cd976241dd90d319d7' +
                '&tag=bestofisotope&callback=?')
              .error( ajaxError )
              .success(function( data ){

                // proceed only if we have data
                if ( !data || !data.length ) {
                  ajaxError();
                  return;
                }
                var items = [],
                    item, datum;

                /*for ( var i=0, len = data.length; i < len; i++ ) {
                  datum = data[i];
                  item = '<li><a href="' + datum.url + '">'
                    + '<img src="' + datum.image.replace('/l.', '/m.') + '" />'
                    + '<b>' + datum.title + '</b>'
                    + '</a></li>';
                  items.push( item );
                }*/

                var $items = $( items.join('') )
                  .addClass('example');

                // set random number for each item
                $items.each(function(){
                  $(this).attr('data-number', ~~( Math.random() * 100 + 15 ));
                });

                $items.imagesLoaded(function(){
                  $sitesTitle.removeClass('loading').text('Sites using Isotope');
                  $container.append( $items );
                  $items.each(function(){
                    var $this = $(this),
                        itemHeight = Math.ceil( $this.height() / 120 ) * 120 - 10;
                    $this.height( itemHeight );
                  });
                  $container.isotope( 'insert', $items );
                });

              });


          });
        </script>
        <!-- Isotope script end -->
