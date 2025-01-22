<?php
include('connect.php');
include('header.php');
$user_id = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>event management system</title>
</head>

<body>



    <sectio id="team" class="team section light-background">

        <!-- Section Title -->
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <br>
            <h2>Latest Events</h2>
            <p><span>New Events</span> <span class="description-title"></span></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member">
                        <div class="member-img">
                            <!-- Check if the image is loading -->
                            <img src="assets/img/event/ashes.jpg" class="img-fluid" alt="Ashes Band Event">
                        </div>
                        <div class="member-info">
                            <h4>Ashes Band</h4>
                            <p>The band Ashes is known for its unique style and powerful lyrics that resonate deeply with fans, making them a standout act in the music scene.</p>
                           <?php 
                                if(!$user_id) {
                                    // Show button only if user is not logged in
                                    echo '<a href="register.php"><button>Book Now</button></a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member">
                        <div class="member-img">
                            <!-- Check if the image is loading -->
                            <img src="assets/img/event/convention.jpg" class="img-fluid" alt="Era Convention Hall">
                        </div>
                        <div class="member-info">
                            <h4>Era Convention Hall</h4>
                            <p>Welcome to Era Convention Hall, the perfect venue for your special events, conferences, and gatherings.</p>
                            <?php 
                                if(!$user_id) {
                                    // Show button only if user is not logged in
                                    echo '<a href="register.php"><button>Book Now</button></a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member">
                        <div class="member-img">
                            <!-- Check if the image is loading -->
                            <img src="assets/img/event/criket.jpg" class="img-fluid" alt="Cricket Tournament Booking">
                        </div>
                        <div class="member-info">
                            <h4>Cricket Tournament Booking</h4>
                            <p>Welcome to Cricket Tournament, where the thrill of cricket meets the excitement of competition! Whether you are a player, a team manager, or a passionate fan, this event offers an unforgettable experience filled with action-packed matches and unforgettable moments.</p>
                            <?php 
                                if(!$user_id) {
                                    // Show button only if user is not logged in
                                    echo '<a href="register.php"><button>Book Now</button></a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member">
                        <div class="member-img">
                            <!-- Check if the image is loading -->
                            <img src="assets/img/event/footbal.jpg" class="img-fluid" alt="Football Tournament Booking">
                        </div>
                        <div class="member-info">
                            <h4>Football Tournament Booking</h4>
                            <p>Join us at the Football Tournament for an action-packed sporting experience! Whether you are a player or a fan, this tournament promises high-energy matches and a competitive atmosphere.</p>
                            <?php 
                                if(!$user_id) {
                                    // Show button only if user is not logged in
                                    echo '<a href="register.php"><button>Book Now</button></a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        </section>
        <?php
        include('footer.php');
        ?>
</body>

</html>