<br>
<br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active full-screen">
        <img src="<?php echo base_url('assets/img/22.png');?>" alt="Chania">
      </div>
      <div class="item  full-screen">
        <img src="<?php echo base_url('assets/img/33.png');?>" alt="Chania">
      </div>
      <div class="item  full-screen">
        <img src="<?php echo base_url('assets/img/44.png');?>" alt="Chania">
      </div>
      <div class="item  full-screen">
        <img src="<?php echo base_url('assets/img/55.png');?>" alt="Chania">
      </div>

      <!-- <div class="item full-screen">
        <img src="img_chania2.jpg" alt="Chania">
      </div>
          
      <div class="item full-screen">
        <img src="img_flower.jpg" alt="Flower">
      </div>
      
      <div class="item full-screen">
        <img src="img_flower2.jpg" alt="Flower">
      </div> -->
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>



<footer class="container-fluid text-center" style="background-color: 
black; padding-top: 10px; color: white;">
  <p>copyright Go wash 2017</p>
</footer>

<!-- <script>
    var $item = $('.carousel .item'); 
    var $wHeight = $(window).height();
    $item.eq(0).addClass('active');
    $item.height($wHeight); 
    $item.addClass('full-screen');

    $('.carousel img').each(function() {
      var $src = $(this).attr('src');
      var $color = $(this).attr('data-color');
      $(this).parent().css({
        'background-image' : 'url(' + $src + ')',
        'background-color' : $color
      });
      $(this).remove();
    });

    $(window).on('resize', function (){
      $wHeight = $(window).height();
      $item.height($wHeight);
    });

    $('.carousel').carousel({
      interval:6000,
      pause: "false"
    });
</script>
 -->