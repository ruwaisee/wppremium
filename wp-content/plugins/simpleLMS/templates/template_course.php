<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <title><?php echo get_the_title();?></title>
   <?php wp_head();?>
 <?php 
   /*  Fetch value from database */
    global $wpdb;
    $ourdb      =   $wpdb->prefix."lms_course_details";
    $ID         =   get_the_id();
    $title      =   get_the_title();
    $subtitle   =   $wpdb->get_var("SELECT `subtitle` FROM `$ourdb` WHERE `ID` = '".$ID."'");
    $price   =   $wpdb->get_var("SELECT `price` FROM `$ourdb` WHERE `ID` = '".$ID."'");
    $video   =   $wpdb->get_var("SELECT `video` FROM `$ourdb` WHERE `ID` = '".$ID."'");
    $content   =   $wpdb->get_var("SELECT `content` FROM `$ourdb` WHERE `ID` = '".$ID."'");
   
   
    ?>
</head>

<body>
    <div class="">
    <section class="bg-blue-1">
        <div class="container">
            <div class="row">
                
                <div class="intro">
               
                    <div class="col-md-12 c-white">
                        <p class="fs--sm">HOME / COURSE / PERSONAL DEVELOPMENT / HAPPINESS / SOFT SKILLS / HARDNESS</p>
                        <h3 class="ff--roboto"><?php the_title(); ?></h3>
                        <div class="montserat flex">
                            <div class="c-orange">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            </div> <p class="ML--15"> (89 reviews)</p> 
                            <p><i class="fa fa-user ML--15 c-orange" ></i>  44.897 students Enrolled <i class="fa fa-clock-o ML--15 c-orange"></i> 6h36m</p>
                        </div>
                        <p><?php echo $subtitle; ?></p>
                    </div>
                </div><!--End intro -->
            </div><!--End row -->
                
        </div><!--End container -->
    </secton>
    <section class="ZX">
        <div class="container">
            <div class="row">
                <div class="video">
                <div class="col-md-8">
                    
                        <iframe width="100%" height="600" src="https://www.youtube.com/embed/<?php echo substr($video,32); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    
                </div>
                <div class="col-md-4 bg-white ">
                    <p class="c-blue center fs--xl">Watch for only $<?php echo $price; ?>/month with All Access Pass</p>
                    <button class="btn">Get Started</button>

                   
                    <div class="MT--15 fs--m">
                        <div class="flex MA">
                            <i class="fa fa-archive MTB" ></i><p class="MTB ML--0-5">Access to all courses </p>
                        </div>           
                        <div class="flex MA">
                            <i class="fa fa-database MTB" ></i><p class="MTB ML--0-5">  Profissional & Personal Development Courses </p>
                        </div>
                        <div class="flex MA">
                            <i class="fa fa-tablet MTB" ></i><p class="MTB ML--0-5">Watch anytime on any device  </p>
                        </div>
                        <div class="flex MA">
                            <i class="fa fa-graduation-cap MTB" ></i><p class="MTB ML--0-5">Certificate completion Enrolled  </p>
                        </div>
                        <div class="flex MA">
                            <i class="fa fa-info-circle MTB" ></i><p class="MTB ML--0-5">100% Money back  </p>
                        </div>
                    </div>
               
                    <hr>
                    <p class="center"><strong>Only want this coursed</strong> | Buy this course for $<?php echo $price; ?>.<br>  <a href="#">Click here</a></p>          
                </div><!--End DIV -->
                </div><!--End video -->
                <div class="instructor c-white">
                    <p CLASS="MT--35 fs--m">INSTRUCTOR</p>
                    
                    <div class="flex MA">
                       
                    <img src="<?php echo plugin_dir_url(__DIR__). 'assets/globe-book.jpg';?>" alt="" class="BR--50" width="20%">
                     </div>
                    <p class="MTB ML--0-5">The IPS PROJECT  </p>
                       
                        <div class="MT--15">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id nesciunt ratione doloremque, delectus consequuntur, corporis quo ducimus vel provident dolores repellendus maxime facere reprehenderit omnis molestiae facilis dignissimos vitae itaque.</p>
                    </div> 
                </div><!--End instructor -->
            </div><!--End row -->
        </div><!--End container -->                 
    </section>
    <section class="table_content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 course bg-white">
                    sdsdsdsdsd

                </div>
              
            </div>
        </div>
    </section>
 
    </div>
</body>
</html>
