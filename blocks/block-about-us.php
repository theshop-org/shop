<?php 
$title = get_field("title");
$words = explode(' ', $title);
$image = get_field('image_in_the_title');
$location_of_the_image_in_title = get_field('location_of_the_image_in_title');
$full_width_image = get_field('full_width_image');
$full_width_image_location = get_field('full_width_image_location');
$information = get_field('information');

?>
<div class="about-us">
    <div class="about-us__container">
        <?php if($title): ?>
            <div class="about-us__title">
                <div class="about-us__title--text">
                    <?php foreach($words as $key=>$word): ?>
                        <?php if($key < (count($words) - 2)): ?>
                            <?php echo $word; ?>
                        <?php endif ?>
                    <?php endforeach; ?>
                </div>
                <div class="about-us__title--bot">
                    <div class="about-us__title--text">
                        <?php 
                        echo $words[count($words) - 2] 
                        ?>
                    </div>
                    <div class="about-us__title--image">
                        <?php if(isset($image['url']) && $image['url']): ?>
                            <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
                        <?php endif; ?>
                        <span><?php echo $location_of_the_image_in_title ?></span>
                    </div>
                    <div class="about-us__title--text">
                        <?php
                        echo $words[count($words) - 1]
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="about-us__main">
            <span class="about-us__main--loc">
                <?php echo $full_width_image_location; ?>
            </span>
            <?php if(isset($full_width_image['url']) && $full_width_image['url']): ?>
                <img src="<?php echo $full_width_image['url'] ?>" alt="<?php echo $full_width_image['alt'] ?>">
            <?php endif; ?>
        </div>
        <div class="about-us__content">
            <?php if(!empty($information)): ?>
                <div class="about-us__content--first">
                    <div class="about-us__content--texts">
                        <h2 class="about-us__content--title" style="width: 50%">
                            <?php echo $information[0]['title'] ?>
                        </h2>
                        <p class="about-us__content--desc" style="width: 50%">
                            <?php echo $information[0]['description'] ?>
                        </p>
                    </div>
                    <div class="about-us__content--img">
                        <span class="about-us__content--loc">
                            <?php echo $information[0]['location'] ?>
                        </span>
                        <?php if(isset($information[0]['image']['url']) && $information[0]['image']['url']): ?>
                            <img src="<?php echo $information[0]['image']['url'] ?>" alt="<?php echo $information[0]['image']['alt'] ?>">
                        <?php endif; ?>
                    </div>
                </div>
                <?php if(isset($information[1])): ?>
                    <div  >
                        <div >
                            <p class="location-heading-second-image-section">Locations</p>
                            <div class="two-images-on-about-page-final">

                            <div >
                            <span class="about-us-first-image-desc-final">
                                <?php echo $information[1]['location'] ?>
                            </span>
                            <?php if(isset($information[1]['image']['url']) && $information[1]['image']['url']): ?>
                               
                                <img class="image-first-container-final" style="border-radius: unset" src="<?php echo $information[1]['image']['url'] ?>" alt="<?php echo $information[1]['image']['alt'] ?>">
                                
                            <?php endif; ?>
                            
                            </div>
                            <div >
                            <span class="about-us-second-image-desc-final">
                                <?php echo $information[1]['location'] ?>
                            </span>
                            <?php if(isset($information[1]['image']['url']) && $information[1]['image']['url']): ?>
                               
                                
                                <img class="image-first-container-final" style="border-radius: unset" src="<?php echo $information[1]['image_copy']['url'] ?>" alt="<?php echo $information[1]['image']['alt'] ?>">
                            <?php endif; ?>
                        </div>
                            </div>
                        <div class="about-us__content--texts">
                            <h2 class="about-us__content--title">
                                <?php echo $information[1]['title'] ?>
                            </h2>
                            <p class="about-us__content--desc">
                                <?php echo $information[1]['description'] ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($information[2])): ?>
                    <div class="about-us__content--third">
                        <div class="about-us__content--texts">
                            <h2 class="about-us__content--title">
                                <?php echo $information[2]['title'] ?>
                            </h2>
                            <p class="about-us__content--desc">
                                <?php echo $information[2]['description'] ?>
                            </p>
                        </div>
                        <div class="about-us__content--img">
                            <?php if(isset($information[2]['image']['url']) && $information[2]['image']['url']): ?>
                                <img src="<?php echo $information[2]['image']['url'] ?>" alt="<?php echo $information[2]['image']['alt'] ?>">
                            <?php endif; ?>
                            <span class="about-us__content--loc">
                                <?php echo $information[2]['location'] ?>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>