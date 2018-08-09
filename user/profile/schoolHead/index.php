<?php
	session_start();
	
	require('../../req/utility.php');
	if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
		redirect('../../../');
	}
	else {
		
	require_once(__DIR__.'/../../req/connect.php');
	require_once(__DIR__.'/../../req/utility.php');
		
	if(strcmp($_SESSION['type'], "headDelegate") != 0){
			redirect('../../index.php');
	}
		define('TNAME', 'details');
		$_SESSION['phone'] = '';
		$stmt= $pdo->prepare("SELECT phone FROM " . TNAME . " WHERE email = '" . $_SESSION['email']. "'");
		try {$stmt->execute();}catch(PDOException $e) {echo $e->getMessage();}
		$fetch = $stmt->fetch();
		$_SESSION['phone'] = $fetch['phone'];
		
		
		$stmt = $pdo->prepare("SELECT firstName, lastName, email from users WHERE headedBy = '" . $_SESSION['email'] . "'");
		try {
			$stmt->execute();
			$dels = $stmt->fetchAll();
			
			$det = '';
			foreach($dels as $d) {
				$det .= '<span>' . $d['firstName']. ' ' . $d['lastName'] . ' - ' . $d['email'] . '<br />';
			}
		}
		catch(PDOException $e) {
			$det = $e->getMessage();
		}		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>KMUN 2018</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="../../../img/logo_green.png" rel="icon">
  <link href="../../../img/apple-touch-icon.png" rel="apple-touch-icon">
	<!-- countdown -->
	<link rel = "Stylesheet" type ="text/css" href = "../../../css/countdown.css" >
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>

  <!-- Bootstrap CSS File -->
  <link href="../../../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="../../../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../../../lib/animate/animate.min.css" rel="stylesheet">
  <link href="../../../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="../../../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../../../lib/lightbox/css/lightbox.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../../css/normalize.min.css">
  <link rel="stylesheet" type="text/css" href="../../../css/hexagons.css">
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- Main Stylesheet File -->
  <link href="../../../css/style.css" rel="stylesheet">
<style >
		.panel .panel-body ul {
			list-style-type: none;
			padding:0px;
			border:0px;
			color : white;
			font-size:1.2em;
		}
	</style>
  <!-- =======================================================
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
	  <a href="#intro"><img src="../../../img/logoWhite.png" width=40px alt="" title="" /></a>
        <h1><a href="#intro" class="scrollto" >KMUN 2018</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Home</a></li>
          <li><a href="#" data-toggle="modal" data-target="#Details">Add Details</a></li>
		  <li><a href="#" data-toggle="modal" data-target="#Pref">Committee Preferences</a></li>
		  <li><a href="#" data-toggle="modal" data-target="#Del">Add Delegates</a></li>
		  <li><a href="#" data-toggle="modal" data-target="#Delegation">View Delegation</a></li>
			<li><a href= "../../logout.php">Logout</a></li>
        </ul>	
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <div class="carousel-item">
            <div class="carousel-background"><img src="../../../img/intro-carousel/det_pic.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
               <!-- <h2>KUMARANS MODEL UNITED NATION | 2018</h2> -->
				<div class="row">
					<div class = "container">
						<h3 id = "head" class="date-st">This July</a></h3>
						<p class="date2">5th, 6th and 7th</p>
					</div>
				
				<!--<div class="col-md-6 col-small-12 container">-->
				<div id = "container">
					<h1 id="head">Countdown</h1>
					<ul>
						<li><span id="days"></span>days</li>
						<li><span id="hours"></span>Hours</li>
						<li><span id="minutes"></span>Minutes</li>
						<li><span id="seconds" ></span>Seconds</li>
					</ul>
				</div>		
				</div>
				<a href="#!"  data-toggle="modal" data-target="#notif" class="btn-get-started scrollto">Notifications(1)</a>
										
		</div>
            </div>
           </div>

<div class="carousel-item  active">
            <div class="carousel-background"><img src="img/intro-carousel/background1.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
				 <h2>Hi, <?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?>	</h2>
					<div class="panel panel-default">
					<div class="panel-body">
					<ul>
						<li> Committee : Yet to be Assigned</li>
						<li> Portfolio : Yet to be Assigned</li>
						<li> Email-ID : <?php echo $_SESSION['email'];?></li>
						<li> Phone : <?php if(!empty( $_SESSION['phone'])) echo $_SESSION['phone'];?></li>
						<li> School : <?php echo $_SESSION['school'];?></li>
						<li> Payment : </li>
					</ul>
					</div>
					</div>

				 
                 <a href="#!"  data-toggle="modal" data-target="#notif" class="btn-get-started scrollto">Notifications(1)</a>
				 
              </div>
            </div>
          </div>




        </div>

        <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- #intro -->
  
    <main id="main">
  
	
    <!--==========================
      About Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header wow fadeInUp">
          <h3>What is KMUN</h3>
          <p>Kumarans Model United Nations is a three-day international relations simulation for
		  high school students aimed at educating participants about current events, international
		  relations, diplomacy and the United Nations agendas. At KMUN, delegates gain insight
		  into the workings of the United Nations and the dynamics of international relations
		  by assuming the roles of members of international bodies and national cabinets. During
		  the Summit, delegates will be able to appreciate importance of balancing national
		  interests with the needs of the international community, while also gaining an insight
		  into the powers and limitations of international negotiations. In addition to 
		  traditional committees, delegates also have the option to participate in specialised
		  crisis committees, where they must respond reflexively and creatively to international
		  crises in real-time. KMUN strives to foster a constructive forum for open dialogue on 
		  complex global issues through in-depth examination and resolution of pressing issues.
		  Delegates also learn to preserve their countries’ national policy while negotiating in
		  the face of other, sometimes conflicting, international policies.</p>
		  
		  <h3 id="prep">Preparation</h3>
        </header>
		 
        <div class="row">
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-analytics-outline"></i></div>
            <h4 class="title title2"><a href="https://drive.google.com/file/d/1F0PRmtq0b1RPENsQlJr3224ScYHawHs7/view?usp=sharing">Sample Position Paper</a></h4>
            <p class="description">For your reference, before drafting the position papers </p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-bookmarks-outline"></i></div>
            <h4 class="title title2"><a href="https://drive.google.com/folderview?id=1MiJdI-kMOdd_qKDcwFA6MrZSHyY3aVPI" target="_blank">Background Guides</a></h4>
            <p class="description">Download the Background Guides Here</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-paper-outline"></i></div>
            <h4 class="title title2"><a href="">Delegate Handbook</a></h4>
            <p class="description">Will be uploaded later</p>
          </div>
          <!--<div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
            <h4 class="title"><a href="">Background Guides</a></h4>
            <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-barcode-outline"></i></div>
            <h4 class="title"><a href="">Nemo Enim</a></h4>
            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-people-outline"></i></div>
            <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
            <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
          </div>-->

        </div>

      </div>
    </gen
    tion><!-- #about -->
    <!--==========================
      SecGen
    ============================-->
    <section id="call-to-action" class="wow fadeIn">
      <div class="container text-center">
        <h3>Secretary General's Message</h3>
        <p>On behalf of our dedicated Organising Committee and Executive Board, it is my honour to invite you to the eighth edition of KMUN. It is my great pleasure to serve as your Secretary General for this year’s Model United Nations. </p>
        <a class="cta-btn" href="sec-gen" data-toggle="modal" data-target="#sec-gen">Read More</a>
      </div>
    </section><!-- #SecGen -->
	
    
	  <!--==========================
	  
      Committees Section
    ============================ -->
    <section id="committees">
	
	<section id="skills">
      <div class="container">

        <header class="section-header">
          <h3>Committees</h3>
        </header>

        <div class="skills-content">

          <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="53.86" aria-valuemin="0" aria-valuemax="100">
              <span class="skill">Non-Crisis<i class="val">7</i></span>
            </div>
          </div>

          <div class="progress">
            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="46.154" aria-valuemin="0" aria-valuemax="100">
              <span class="skill">Crisis<i class="val">6</i></span>
            </div>
          </div>

        </div>

      </div>
    </section>

      <div class="container">

	<ul id="hexGrid">
      <li class="hex">
        <div class="hexIn">
          <a class="hexLink" href="#adhoc" data-toggle="modal" data-target="#adhoc">
            <img src="../../../img/10_aDHOC_TXT.png" alt="" />
            <h1>Sec Gen's AdHoc</h1>
            <p>Click to know more</p>
          </a>
        </div>
      </li>
      <li class="hex">
        <div class="hexIn">
          <a class="hexLink" href="#UNSC" data-toggle="modal" data-target="#UNSC">
           <img src="../../../img/7_UNSC_txt.png" alt="" />
            <h1>UNSC</h1>
            <p>Click to know more</p>
          </a>
        </div>
      </li>
      <li class="hex">
        <div class="hexIn">
			<a class="hexLink">
           <img src="../../../img/logo_green.png" width=140px alt="" />
            <h1>KMUN 2018</h1>
            <p>5th, 6th and 7th July</p>
          </a>
        </div>
      </li>
      <li class="hex">
        <div class="hexIn">
          <a class="hexLink" href="#UNODC" data-toggle="modal" data-target="#UNODC">
            <img src="../../../img/6_UNODC_TXT.png" alt="" />
            <h1>UNODC</h1>
            <p>Click to know more</p>
          </a>
        </div>
      </li>
      <li class="hex">
        <div class="hexIn">
          <a class="hexLink" href="#sect" data-toggle="modal" data-target="#sect">
            <img src="../../../img/1_Secretariat_TXT.png" alt="" />
            <h1>Secretariat</h1>
            <p>Click to know more</p>
          </a>	
        </div>
      </li>
      <li class="hex">
        <div class="hexIn">
          <a class="hexLink" href="#plan" data-toggle="modal" data-target="#plan">
            <img src="../../../img/8_planning_TXT.png" alt="" />
            <h1>Planning Commission</h1>
            <p>Click to know more</p>
          </a>
        </div>
      </li>
      
      <li class="hex">
        <div class="hexIn">
          <a class="hexLink" href="#WHO" data-toggle="modal" data-target="#WHO">
            <img src="../../../img/5_health_txt.png" alt="" />
            <h1>World Health Organisation</h1>
            <p>Click to know more</p>
          </a>
        </div>
      </li>
      <li class="hex">
        <div class="hexIn">
          <a class="hexLink" href="#IAEA" data-toggle="modal" data-target="#IAEA">
            <img src="../../../img/3_atomic_TXT.png" alt="" />
            <h1>IAEA</h1>
            <p>Click to know more</p>
          </a>
        </div>
      </li>
      <li class="hex">
        <div class="hexIn">
          <a class="hexLink" href="#WEF" data-toggle="modal" data-target="#WEF">
            <img src="../../../img/9_WEF_txt.png" alt="" />
            <h1>World Economic Forum</h1>
            <p>Click to know more</p>
          </a>
        </div>
      </li>
      <li class="hex" id = "hexBottom1">
        <div class="hexIn">
          <a class="hexLink" href="#SOCHUM" data-toggle="modal" data-target="#SOCHUM">
            <img src="../../../img/2_SOCHUM_TXT.png" alt="" />
            <h1>SOCHUM</h1>
            <p>Click to know more</p>
          </a>
        </div>
      </li>
      <li class="hex" id = "hexBottom2">
        <div class="hexIn">
          <a class="hexLink" href="#!=legal" data-toggle="modal" data-target="#legal">
           <img src="../../../img/4_legal_TXT.png" alt="" />
            <h1>UNGA 6 - Legal</h1>
            <p>Click to know more</p>
          </a>
        </div>
      </li>
      <li class="hex" id = "hexBottom3">
        <div class="hexIn">
          <a class="hexLink"  href="#ill" data-toggle="modal" data-target="#ill">
            <img src="../../../img/12_illuminati_txt.png" alt="" />
            <h1>Illuminati</h1>
            <p>Click to know more</p>
          </a>
        </div>
      </li>
      <li class="hex" id = "hexBottom4">
        <div class="hexIn">
          <a class="hexLink" href="jcci!" data-toggle="modal" data-target="#jcci">
            <img src="../../../img/11_JCC1_TXT.png" alt="" />
            <h1>JCC Internationale</h1>
            <p>Click to know more</p>
          </a>
        </div>
      </li>
      <li class="hex">
        <div class="hexIn">
          <a class="hexLink" href="#jccm" data-toggle="modal" data-target="#jccm">
			<img src="../../../img/11_JCC2_TXT.png" alt="" />
            <h1>JCC Mitteleuropa </h1>
            <p>Click to know more</p>
          </a>
        </div>
      </li
    </ul>		
   </div>
    </section><!-- committees -->



    <!--==========================
      schedule Section
    ============================-->
    <section id="schedule"  class="section-bg" >
      <div class="container">

        <header class="section-header">
          <h3 class="section-title">Our Schedule</h3>
        </header>

        <!--<div class="row">
          <div class="col-lg-12">
            <ul id="schedule-flters">
              <li data-filter=".filter-app" class="filter-active">Day 1</li>
              <li data-filter=".filter-card">Day 2</li>
              <li data-filter=".filter-web">Day 3</li>
            </ul>
          </div>
        </div>-->

        <div class="row schedule-container">

          <div class="col-lg-4 col-md-6 schedule-item filter-app wow fadeInUp">
            <div class="schedule-wrap">
              <figure>
                <img src="../../../img/Day1.jpeg" class="img-fluid" alt="">
                <a href="../../../img/Day1.jpeg" data-lightbox="schedule" data-title="Day 1" class="link-preview" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="schedule-info">
                <h4><a href="#">Day 1</a></h4>
                <p>5th July</p>
              </div>
            </div>
          </div>


          <div class="col-lg-4 col-md-6 schedule-item filter-app wow fadeInUp" data-wow-delay="0.2s">
            <div class="schedule-wrap">
              <figure>
                <img src="../../../img/Day2.jpeg" class="img-fluid" alt="">
                <a href="../../../img/Day2.jpeg" class="link-preview" data-lightbox="schedule" data-title="Day 2" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="schedule-info">
                <h4><a href="#">Day 2</a></h4>
                <p>6th July</p>
              </div>
            </div>
          </div>



          <div class="col-lg-4 col-md-6 schedule-item filter-app wow fadeInUp" data-wow-delay="0.2s">
            <div class="schedule-wrap">
              <figure>
                <img src="../../../img/Day3.jpeg" class="img-fluid" alt="">
                <a href="../../../img/Day3.jpeg" class="link-preview" data-lightbox="schedule" data-title="Day 3" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="schedule-info">
                <h4><a href="#">Day 3</a></h4>
                <p>7th July</p>
              </div>
            </div>
          </div>
	

        </div>

      </div>
    </section><!-- #schedule -->
	
	<!--==========================
      Facts Section
    ============================-->
    <section id="facts"  class="wow fadeIn">
      <div class="container">

        <header class="section-header">
          <h3>Facts</h3>
          <p>Facts are like cows. If you look them in the face long enough, they generally run away.</p>
        </header>

        <div class="row counters">

  				<div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">8</span>
            <p>Editions</p>
  				</div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">13</span>
            <p>Committees</p>
  				</div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">22</span>
            <p>Hours Of Munning</p>
  				</div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">540</span>
            <p>Delegates</p>
  				</div>

  			</div>

        <!--<div class="facts-img">
          <img src="../../../img/facts-img.png" alt="" class="img-fluid">
        </div>-->

      </div>
    </section><!-- #facts -->

    <!--==========================
      Clients Section
    ============================-->
    <!--<section id="clients" class="wow fadeInUp">
      <div class="container">

        <header class="section-header">
          <h3>Our Sponsors</h3>
        </header>

        <div class="owl-carousel clients-carousel">
          <img src="../../../img/clients/client-1.png" alt="">
          <img src="../../../img/clients/client-2.png" alt="">
        </div>

      </div>
    </section>--><!-- #clients -->

    <!--==========================
      Clients Section
    ============================-->
    <section id="testimonials" class="section-bg wow fadeInUp">
      <div class="container">

        <header class="section-header">
          <h3>Developers</h3>
        </header>

        <div class="owl-carousel testimonials-carousel">
			
			
          <div class="testimonial-item">
            <img src="../../../img/test-2.jpg" class="testimonial-img" alt="">
            <h3>Tanmai Harish</h3>
            <h4>NITK, Surathkal</h4>
          </div>
		    
	<div class="testimonial-item">
            <img src="../../../img/test1.jpg" class="testimonial-img" alt="">
            <h3>Gokul Kumar M</h3>
            <h4>BITS Pilani</h4>
            
          </div>     

        </div>

      </div>
    </section><!-- #testimonials -->

    <!--==========================
      Team Section
    ============================-->
    <section id="team">
      <div class="container">
        <div class="section-header wow fadeInUp">
          <h3>Team</h3>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-4 col-small-6 wow fadeInUp">
            <div class="member">
              <img src="../../../img/team1.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Prajwal Bharadwaj</h4>
                  <span>Secretary-General</span>
                  <div class="social">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-small-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="member">
              <img src="../../../img/team2.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Shreyas Ashok Kumar</h4>
                  <span>Under Secretary-General</span>
                  <div class="social">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-small-6 wow fadeInUp" data-wow-delay="0.2s">
            <div class="member">
              <img src="../../../img/team3.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Aayush Mohanan</h4>
                  <span>Under Secretary-General</span>
                  <div class="social">
                  </div>
                </div>
              </div>
            </div>
          </div>
		  
		  <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.2s">
            <div class="member">
              <img src="../../../img/kedi.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Krishna Datta</h4>
                  <span>Core Committee</span>
                  <div class="social">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.2s">
            <div class="member">
              <img src="../../../img/kini.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Sachin Kini</h4>
                  <span>Core Committee</span>
                  <div class="social">
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #team -->

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">
      <div class="container">

        <div class="section-header">
          <h3>Contact Us</h3>
          <!--<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>-->
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>Address: Survey No 44 – 50, Mallasandra Village Uttarahalli Hobli, Off Kanakapura Main Road, Bengaluru, Karnataka 560062</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p>Sec-Gen: <a href="tel:+919741060814">+91 97410 60814</a></p>
			  <p>Under Sec-Gen: <a href="tel:+919845324003">+91 98453 24003</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:support@kmun.in">support@kmun.in</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container-fluid">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-info">
            <h3>KMUN 2018</h3>
            <p>Kumarans Model United Nations is a three-day international relations simulation for
		  high school students aimed at educating participants about current events, international
		  relations, diplomacy and the United Nations agendas.</p>
          </div>

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="#home">Home</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#about">About</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">MUNSoc</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Press</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              Survey No 44 – 50, Mallasandra Village<br>
              Uttarahalli Hobli, Off Kanakapura Main<br>
              Road, Bengaluru, Karnataka 560062<br>
              <strong>Phone:</strong> +91 98453 240003<br>
              <strong>Email:</strong> support@kmun.in<br>
            </p>

            <div class="social-links">
              <a href="https://www.facebook.com/kumaransmun" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="https://www.instagram.com/kumaransmun/" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" target="_blank" class="flickr"><i class="fa fa-flickr"></i></a>
            </div>

          </div>

          <!--<div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae leg
			am multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit"  value="Subscribe">
            </form>
          </div>-->

        </div>
      </div>
    </div>
	
	
    <div class="container">
      <div class="copyright">
			© Gokul Kumar M and Tanmai Harish
      </div>
      <div class="credits">
        
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  
  <!--==========================
    Modals
  ============================-->
	 <div class="modal fade" id="adhoc" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">Sec Gen's Ad-Hoc</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >It is said that the night is the darkest before the dawn, Yet the dawn has given birth to a new age of darkness. The year is 2019 and the peace talks between North Korea and the US are a success. North Korea has had a complete role reversal, pioneering with their denuclearisation and disarmament program. But the failure of the Iran Nuclear deal has escalated tensions between the countries of the middle east. There are certain mysterious incidents occurring all over the world. Each and every leader of the world has trouble knocking on his and her door. But, the Secretary General has brought all of you, the leaders of the world, together to unite as one and save the world from impending threats. The Ad-Hoc crisis committee functions directly under the Secretary General of the United Nations and has absolute power. You, as a committee, have to adapt to any situation at hand, anticipate upcoming crises, and find solutions, all at a moments notice. Once you restore peace and stability to the world, the committee shall be disbanded.Are all these crises what they appear to be? Will your powers and technology come to your aid? Are you up for this daunting task at hand? The world needs you, because nuclear winter is coming...
					<div class="row">
					<div class="column">
					<img src="../../../img/Snapseed/ADHOC_C-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Akhil Kumar</b></h5>
					<h6 style ="text-align:center;">Chair</h6>
					</div>
              
					<div class="column">
					<img src="../../../img/Snapseed/ADHOC_VC.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Rahul K Balaji</b></h5>
					<h6 style ="text-align:center;">Vice Chair</h6>
					</div>
					
					<div class="column">
					<img src="../../../img/Snapseed/ADHOC_M-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Shaswat Ghosh</b></h5>
					<h6 style ="text-align:center;">Moderator</h6>
					</div>
				</div>
				</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="UNSC" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">UNSC</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >
The Security Council is one of the principal organs of the UN whose primary
responsibility is the maintenance of international peace and security by establishing
international sanctions, peacekeeping operations and authorization of military action.
The UNSC encompasses all those world issues that threaten peace and sovereignty.
Delegates hold in their hands the power to control chaos, and the responsibility to
prevent it. The SC is the power core of the UN, with the ability to pass binding
resolutions.<br></br>
<b>SENKAKU ISLANDS</b><br></br>
At the heart of the dispute are eight uninhabited islands and rocks in the East China Sea.
They are a vast stretch, from the North - East of Taiwan to the South - West of Onikawa,
Japan's southernmost prefecture, totalling 7 Square kilometers in area. Their importance
is due to its vast and rich fishing grounds, proximity to important shipping lanes and
potential oil and gas reserve. They are also in a strategically significant position, amid
rising competition between the US and China for military supremacy in the Asia-Pacific
region. Although they are presently controlled by Japan, Senkaku Islands have been the
home to centuries of territorial disputes between Japan and China.<br></br>
<b>ARCTIC MILITARIZATION</b><br></br>
The Arctic consists of the Arctic Region, with parts of Canada, United States, Greenland,
Norway, Sweden, Finland, Iceland, and the Russian Federation. The Arctic holds trillions
of barrels worth of oil (13% of global total), natural gas (30%) and other natural
resources, but weren't accessible due to the layers of thick ice. However with the global
climate changes, ice in the Arctic is melting rapidly, making these unexploited resources
accessible. Global warming has also seen the opening of new trade routes, which
dramatically decrease the distance between Russia and Europe, and other major Asian
markets like China, Japan, Korea and Taiwan.
				<div class="row">
					<div class="column">
					<img src="../../../img/Snapseed/UNSC_C-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Subhav Vardhan</b></h5>
					<h6 style ="text-align:center;">Chair</h6>
					</div>
              
					<div class="column">
					<img src="../../../img/Snapseed/UNSC_VC-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Nitish Bhatt</b></h5>
					<h6 style ="text-align:center;">Vice Chair</h6>
					</div>
					
					<div class="column">
					<img src="../../../img/Snapseed/UNSC_M-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Omkar</b></h5>
					<h6 style ="text-align:center;">Moderator</h6>
					</div>
				</div></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="SOCHUM" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">SOCHUM</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >

The United Nations Social, Humanitarian, and Cultural Committee (SOCHUM) is the Third Committee of the General Assembly, which was founded at the advent of the United Nations in 1945. It is tasked with the broad mandate surrounding social, humanitarian and human rights issues from around the world. The Committee focuses on questions relating to the advancement of women, the protection of children, indigenous issues, the treatment of refugees, the promotion of fundamental freedoms through the elimination of racism and racial discrimination, and the right to self- determination. SOCHUM works closely with other UN bodies in order to more effectively address the issues covered in its mandate. <br></br>


<b>Agenda 1: </b>Discussing Reproductive Rights, with emphasis on abortion and the use of contraceptives.<br></br>
 
Reproductive rights rest on the recognition of the basic right of all couples and individuals to decide freely and responsibly on the number, spacing and timing of their children and have the information and means to do so, and the right to attain the highest standard of sexual and reproductive health. They also include the right of all to make decisions concerning reproduction free of discrimination. Reproductive rights are associated with women's self-determination over their bodies and sexual lives, and are critical to gender equality and to the formation of democratic and just societies on a global scale.<br></br>
 
Today, abortion is a safe and minimally invasive procedure. And yet, abortion continues to be a highly contentious issue all over the world, due to its moral, ethical and religious undertones, despite the fact that countries with access to safe abortion services have higher levels of reproductive health.<br></br>
 
Women, all over the world, suffer discrimination because of their reproductive capacity, leading to restrictions on sexual autonomy and reproductive freedom. Only coordinated efforts can help in achieving these rights. <br></br>

     <b>Agenda 2: </b> Threats against the media with specific reference to media censorship, media bias and safety of journalists.<br></br>

Everyone has the right to freedom of opinion and expression; this right includes freedom to hold opinions without interference and to seek, receive and impart information and ideas through any media and regardless of frontiers.
Article 19, Universal Declaration of Human Rights

Censorship is the act of concealing, preventing or restricting information from spreading.
It is done for many reasons and in many ways. Countries and private organisations all over the world resort to censorship. It is considered by many as a violation to the freedom of speech and is accused to be the act of propagating lies. But more often than not comfortable lies are preferred over painful truths, and the risks taken by media professionals to bring out the truth are life threatening. <br></br>
Media professionals continue to face attacks, such as murder, abductions, harassment, intimidation and illegal arrest and detention. On the other hand, fake news stories discredit legitimate journalism and create an atmosphere of confusion.<br></br>

Today, the issues affecting media are multidimensional, in nature. They can be viewed from many perspectives but they need to be acknowledged. After all information is power, it is only right to ensure that this power is kept in check and used for the greater good.

<div class="row">
					<div class="column">
					<img src="../../../img/Snapseed/SOCHUM_C-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Yashaswini H</b></h5>
					<h6 style ="text-align:center;">Chair</h6>
					</div>
              
					<div class="column">
					<img src="../../../img/Snapseed/SOCHUM_VC-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Keshav G</b></h5>
					<h6 style ="text-align:center;">Vice Chair</h6>
					</div>
					
					<div class="column">
					<img src="../../../img/Snapseed/SOCHUM_M-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Mehul Dugar</b></h5>
					<h6 style ="text-align:center;">Moderator</h6>
					</div>
				</div>
</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="sect" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">Secretariat</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >
Every important organization requires a trustworthy right arm. A branch that can co-ordinate all the activities taking place. Central to the functioning of the United Nations is one of its 6 Principal Organs, the Secretariat. 
The United Nations is accountable for the resolution of a wide array of problems. Quite naturally, the functions of the Secretariat are also equally wide and diverse. They administer peacekeeping operations, survey social and economic trends and lay the groundwork for international agreements. In short, this is the apex committee of the United Nations, not just responsible to the functioning of only one organization, but responsible to the functioning of the World.<br></br>  
<b>Agenda 1:</b> Discussing the Role of Gender Equality in the United Nations<br></br>
Wage gap at workplaces, lack of representation of women in all sectors, women not being given a voice in the decision making process – one issue that seems to impact all of us is gender inequality and disparity. Even the most powerful organization in the world, the United Nations, cannot seem to elude this. In the upper echelons of the Secretariat, only 30 per cent of Directors are women. A lack of representation automatically implies a smaller, less significant voice in decision making, once again perpetuating the cycle of gender inequality. 
Right now, the UN seems to be facing what can only be described as an ‘equal representation crisis’. Finding a solution to this burning issue is of utmost importance if we are to get any closer to the dream of an egalitarian society. <br></br>
<b>Agenda2:</b> Regulating the Human Right Violations(HRVs) of Peacekeeping Forces and Drafting the Course of Action that follows such violations.<br></br>
Amidst chaos, terrorism, abuse and political instability, the civilian mass turns to men clad in blue helmets, bearing the crest of the United Nations, to show them the path of peace. But what if those very men become the source of violence? 
The Department of Peacekeeping Operations (DPKO) was established in 1992, under the Secretariat, charged with the planning and direction of UN peacekeeping operations. The outcry of countries victimized by peacekeeping forces questions the very intention and integrity behind a United Nations’ operation. This committee is now responsible to victims and civilians alike, for generations to come. To that end, we have been given a choice – Do we turn a blind eye to the mutilation of peace, or do we endeavor to preserve any semblance of it?

<div class="row">
					<div class="column">
					<img src="../../../img/Snapseed/SEC_C-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Akshaya Mohan</b></h5>
					<h6 style ="text-align:center;">Chair</h6>
					</div>
              
					<div class="column">
					<img src="../../../img/Snapseed/SEC_VC-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Namitha Iyer</b></h5>
					<h6 style ="text-align:center;">Vice Chair</h6>
					</div>
					
					<div class="column">
					<img src="../../../img/Snapseed/SEC_M-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Manav Somani</b></h5>
					<h6 style ="text-align:center;">Moderator</h6>
					</div>
				</div>
</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="adhoc" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">Ad-Hoc</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" ></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="WEF" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">WORLD ECONOMIC FORUM</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >The World Economic Forum is a global non-profit organisation aimed at “improving the state of the world by engaging business, political, academic, and other leaders of society to shape global, regional, and industry agendas".<br></br>

The year is 2025, and the place is Davos, Switzerland.The world is only just starting to fully realise the importance of alternative energy sources. Oil prices are staggering. An individual belonging to the Republican Party has been elected president of the United States who has taken a solemn promise of being shockingly shrewd and unemotional in policy making. <br></br>

The Bharatiya Janata Party has been elected as the ruling party of India for the third consecutive time. India now also has a much louder voice in the World Trade Organisation. And interestingly, there's a new corporate giant in town.<br></br>

 Worldwide Cannabis consumption is at an all-time high. There is panic in the East coast of Africa as citizens have fallen victim to a life-threatening virus.<br></br>

You, as influential people-heads of state, finance ministers, corporate heads, and religious leaders have the obligation to work together and solve the various economic crises the world faces.<br></br>
With the right to exercise your power and authority, you must now take on the responsibility of making harsh decisions that may lead the world into economic stability or subject it to cascading events of sheer disruption. You get to decide.

The World Economic Forum 2025 welcomes you into the realm of excitement and spontaneity that promises to keep you on your toes.
<div class="row">
					<div class="column">
					<img src="../../../img/Snapseed/WEF_C.jpg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Anarghya Murthy</b></h5>
					<h6 style ="text-align:center;">Chair</h6>
					</div>
              
					<div class="column">
					<img src="../../../img/Snapseed/WEF_VC-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Trisha Sudeep</b></h5>
					<h6 style ="text-align:center;">Vice Chair</h6>
					</div>
					
					<div class="column">
					<img src="../../../img/Snapseed/WEF_M-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Raghav Sharma</b></h5>
					<h6 style ="text-align:center;">Moderator</h6>
					</div>
				</div>
</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="ill" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">Illuminati</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >Do you think the Brexit happened because the “People” voted for it? Do you think 9/11 was an act of “Terror”? Do you think the Titanic sunk because of an “Iceberg”? Do you think Elon Musk “Cares” for the world? Do you think Jeff Bezos really wants to “Educate” the people? Do you really believe Mark Zuckerberg is “Human”? If you aren’t a regular susptable pawn in the game of the world , If you can see the deeper meaning in this life, If you seek to build a better tomorrow. A NEW WORLD. The Illuminati is the place for you.

After more than 3 centuries of existence, trillions of money spent, rivers of blood spilt their goal is still not in their grasp. A frustrated illuminati , torn by internal conflicts and childish bickering,
must come together to fulfill the dream of their Forefathers. But this long overdue meeting does not come in a time of peace and prosperity , but instead at an age of chaos , where the World is on the brink of Destruction.      

<div class="row">
					<div class="column">
					<img src="../../../img/Snapseed/ILL_C-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Rishi Raghavan</b></h5>
					<h6 style ="text-align:center;">Chair</h6>
					</div>
              
					<div class="column">
					<img src="../../../img/Snapseed/ILL_VC-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Venkat Prasad</b></h5>
					<h6 style ="text-align:center;">Vice Chair</h6>
					</div>
					
					<div class="column">
					<img src="../../../img/Snapseed/ILL_M-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Siddharth Biju</b></h5>
					<h6 style ="text-align:center;">Moderator</h6>
					</div>
				</div>
</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="IAEA" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">IAEA</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >“The splitting of the atom may lead to the unifying of the entire divided world.”

Post World War II, Nuclear Technology had begun to grow and develop at an exponential rate and the need was seen to establish an organisationfor cooperation in the nuclear field and which would seek to promote the safe, secure and peaceful use of nuclear technologies.<br></br>

Ever craved power? Good. But Nuclear Power is something that even the world's best leaders cannot handle. Presenting to you, the committee that is more important to the future of world peace than any other, where the level of debate is as explosive as a 200 megaton nuclear bomb, The International Atomic Energy Agency.<br></br>

<b>Agenda 1: </b>Review of the Nuclear Capacity of the DPRK, with special reference to the dismantling of its test sites and rehabilitation as well as proper disposal of nuclear waste in these regions. <br></br>

North Korea. Probably one of the most politically strained regions in the world. In light of recent developments, the scheduled June 12 summit between US President Donald Trump and North Korea’s Supreme Leader Kim Jong Un is one of the most awaited events in the world. Thus, through the discussion of the above agenda, we aim to pave the road to the future for the DPRK, in terms of the use of nuclear energy and “weapons” as well as help the countries of the world discover safer methods of disposal of nuclear waste. Since this agenda is extremely volatile as well as polarising in terms of bloc positions, it is all the more interesting and we at KMUN 2018 hope that you, delegates are up to the task of dealing with a topic of this stature.<br></br>

<b>Agenda 2: </b> Formulation of standards to reform the Treaty for the Non-Proliferation of Nuclear Weapons as well as the IAEA Safeguards in order to adapt them for the future.<br></br>

The IAEA, is more often than not considered to be the guardian of the Treaty for the Non-Proliferation of Nuclear Weapons. Everything in the world is changing but ironically change is the only constant. It is imperative for us as the members of the IAEA to adapt the NPT and our own safeguards to suit the future and delegates, it is up to you to decide how and when this will happen. Again a topic very polarising in terms of bloc positions and massively important to international peace, the Executive Board of the IAEA at KMUN 2018 will be eagerly waiting to see what course the discussion of this topic will take.

On that note we welcome you to the IAEA at KMUN 2018, where the future of world  peace now lies in your hands.
</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="plan" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">Planning Commission</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >It is the year 1966. The Third Five Year Plan has failed in many aspects and I, Indira Gandhi, am taking it up as a challenge to get India back on her feet. The devastating war with China as well as Pakistan, the death of two of our country’s Prime Ministers – Jawaharlal Nehru and Lal Bahadur Shastri, and the famine-like droughts have put our country’s citizens and their welfare in a desperate crisis. Neither our citizens nor our economy is able to survive this grave situation which is pushing us towards a Plan Holiday.<br></br>
As a newly elected council of experts in various fields, it is your duty to make decisions cautiously, as every single decision has the potential to shape the future of the world, let alone India. With the right decisions, we can develop into the nation my father and Mahatma Gandhi have dreamt of. My Principal Secretary-PN Haksar, Personal Secretary- RK Dhawan, and I urge the representatives of all divisions in the Planning Commission to gear up and get accustomed to the frantic pace of the committee.<br></br>
Will the nation survive? Will you survive?

<div class="row">
					<div class="column">
					<img src="../../../img/Snapseed/PC_C-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Shriya Shankar</b></h5>
					<h6 style ="text-align:center;">Chair</h6>
					</div>
              
					<div class="column">
					<img src="../../../img/Snapseed/PC_VC-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Hrishikesh Kannan</b></h5>
					<h6 style ="text-align:center;">Vice Chair</h6>
					</div>
					
					<div class="column">
					<img src="../../../img/Snapseed/PC_M-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Prerana Raju</b></h5>
					<h6 style ="text-align:center;">Moderator</h6>
					</div>
				</div>
</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="UNODC" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">UNODC</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >United Nations Office on Drugs and Crime (UNODC) is a global leader in the fight against illicit drugs and international crime. Established in 1997 through a merger between the United Nations Drug Control Programme and the Centre for International Crime Prevention, UNODC operates in all regions of the world through an extensive network of field offices. Using the three pillars of the UNODC work programme - field-based technical cooperation, research and analytical work, and normative work - the UNODC strives to implement the commitment to counter the world drug problem and to take concerted action against international terrorism.<br></br>

<b>Agenda 1:</b> Discussing the link between money laundering and human trafficking with special focus on human trafficking and migrant smuggling in Africa
Ms. Christine Toudic, Ambassador of France in Montenegro highlights the importance of this agenda, "Where deprivation of liberty no longer appears to be an effective threat, the targeting of financial assets seems more feared by smugglers." Migrant smuggling and human trafficking in Africa has wide-ranging transnational impact and is conducted through three major routes into Europe, the Gulf states and towards South Africa. The ability to prevent and detect money-laundering is a highly effective means of identifying human traffickers and smugglers, and is part of the holistic and integrated approach required to address this burgeoning and evolving organised crime.<br></br>

<b>Agenda 2:</b> Preventing the illicit production, trade and trafficking of opiates and their precursor chemicals with special focus on the Balkan and the Northern routes; addressing drug prevention, treatment and care.<br></br>
Afghanistan accounts for around 85% of global heroin and morphine exports supplying the 
European, Russian and Asian markets, through the Islamic Republic of Iran, Pakistan, and 
Central Asia. Addressing the production and trafficking of Afghan opiates has international
importance, especially keeping in mind the benefits drawn by al-Qaida, Taliban and its allies, 
Kurdistan Workers' Party etc. from the trafficking of opiates. These drug and crime 
challenges remain one of the central obstacles in the efforts to bring peace, stability, security 
and economic development to Afghanistan and the wider region. Hence, developing 
integrated multi-national measures that address and react to the dynamic economic stimuli 
and pressures on the demand and supply of the opiate market is of utmost importance.

<div class="row">
					<div class="column">
					<img src="../../../img/Snapseed/UNODC_C-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Aparna Gopalakrishnan</b></h5>
					<h6 style ="text-align:center;">Chair</h6>
					</div>
              
					<div class="column">
					<img src="../../../img/Snapseed/UNODC_VC-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Dhanush Srinath</b></h5>
					<h6 style ="text-align:center;">Vice Chair</h6>
					</div>
					
					<div class="column">
					<img src="../../../img/Snapseed/UNODC_M-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Janani Venkataramanan</b></h5>
					<h6 style ="text-align:center;">Moderator</h6>
					</div>
				</div>

</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="WHO" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">WHO</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >The World Health Organization is a specialized agency of the United Nations that is concerned with international health. WHO’s Constitution came into force on 7 April 1948 – a date we now celebrate every year as World Health Day.<br></br>
<b>Main Agenda:</b> Medical Black Market with special emphasis on illicit organ trade<br></br>
The main issue that we will be dealing with is illegal organ trade. Illegal organ trade is a rampant issue gaining momentum each passing day. Illegal organ trade occurs when organs are removed from the body for the purpose of commercial transactions.  It was estimated that 5% of all organ recipients had engaged in commercial organ transplants.<br></br>

<b>Optional Agenda:</b> Discussing the increase in counterfeit medicine, and its effect on the pharmaceutical market as well as general human health<br></br>
The optional agenda that we have this year deals with counterfeit medicine, a problem that is becoming more widespread in developing countries as we speak.Counterfeiting is no longer limited to just generic drugs combating conditions like hair fall or obesity, but is now a big market for the treatment of life-threatening conditions such as malaria, HIV/AIDS, and even cancer. Counterfeit pharmaceuticals are a $200 billion annual business, the largest segment of fraudulent goods sold worldwide every year!<br></br>
This clearly highlights the need of an international forum to deal with organ trade and counterfeit medicine and work towards an amicable solution.

<div class="row">
					<div class="column">
					<img src="../../../img/Snapseed/WHO_C-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Akshay Ashok</b></h5>
					<h6 style ="text-align:center;">Chair</h6>
					</div>
              
					<div class="column">
					<img src="../../../img/Snapseed/WHO_VC-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Srushti Jayaramu</b></h5>
					<h6 style ="text-align:center;">Vice Chair</h6>
					</div>
					
					<div class="column">
					<img src="../../../img/Snapseed/WHO_M-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Niveida Satish</b></h5>
					<h6 style ="text-align:center;">Moderator</h6>
					</div>
				</div>
</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	<div class="modal fade" id="sec-gen" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">Secretary-General's Message</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >
Greetings Delegates and Faculty Advisors<br></br>

On behalf of the Organising Committee and Executive Board, it is with great pleasure that I invite you to join us for the Eighth Edition of Kumarans Model United Nations. It is my great pleasure to serve as your Secretary General for this Model United Nations conference.<br></br>

Coming together is a beginning, keeping together is progress and working together is success. Alone we can do so little, together we can do so much more.<br></br>

Since its first edition with only one committee and 20 delegates, Kumarans MUN has grown to be one of the most anticipated MUNs in Bangalore with participation crossing 450 delegates in 10 committees in its last edition. This growth has been powered by the ideals for which Kumarans MUN stands i.e. nurturing upcoming delegates and refining delegates to ensure they bring the best out of themselves. These ideals have led to the growth of the quality of the conference. This year, Kumarans MUN returns with 13 exciting committees which will test the diplomatic skills of the student to its limit and a dais that will keep them on their toes.<br></br>

For all of us, KMUN is more than just another competition. It is a symbol. A symbol that we are moving towards a more tolerant world, a world that rewards ingenuity, hard work and diplomacy, rather than violence and corruption.
We are driven by a mission that works to shed light on the importance of critical thinking and the arts of diplomacy, collaboration and compromisation. We strive to inspire delegates to think critically about the world around them and take action beyond the committee room. I look forward to witnessing every delegate comprehend the complex ways of the world and skilfully form policies to move closer to a brighter future.<br></br>

As I have been a delegate myself, I understand the thrill that comes from a good debate and what a MUN needs to make a delegate want to come back, year after year. Rest assured, one will find all of that at Kumarans MUN. After attending this conference we sincerely hope that you walk away feeling satisfied having resolved world issues using your skills of thought, hard work and dedication and seeing it all pay off in the end. We are working to make sure that we give you such a MUN. I am certain that you will walk away from with memories that you will cherish for a long time to come.<br></br>

It is indeed my privilege to welcome you all to Kumarans Model United Nations 2018 and I look forward to seeing you this July.<br></br>

</p>
				<p class = "mes2">Prajwal Bharadwaj</p>
				<p class = "mes1">Secretary General</p>
                                <p class = "mes1">Kumarans Model United Nations 2018</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="legal" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">UNGA 6 - Legal</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >
Since the formation of the United Nations back in 1945, the General Assembly of the UN has been one of its principal organs. The General Assembly consists of six committees with varying functions. Of these, the sixth committee deals with legal matters.
GA 6- Legal is the primary forum for the discussion and consideration of legal questions in the General Assembly. This committee's main concern is the creation and application of international law.  All of the united nation's members are entitled to representation here. Every member of the committee is obligated to promote the improvement of public international law.  The sixth committee discusses issues regarding international relations, trade, terrorism, diplomacy, disputes among States, people, organizations, and their reflections towards law. Since this committee's first session was bought to order in 1948, it has worked to promote an understanding and development of international law with prominence towards fundamental human rights and freedoms.<br></br>

<b>Agenda 1: </b>Creation of an international framework dealing with the extradition of convicts among member states.<br></br>
The Model Law on Extradition (2004) is a bilateral/multilateral treaty between member states which contains provisions governing the extradition of persons present in the territory of the country adopting the law. It is important that the GA 6 review these set of laws and modify them where it is seen fit, and make new ones if necessary, while taking into account the current state of affairs of the world.<br></br>
<b>Agenda 2: </b>Formulation of UN approved strategy in dealing with secessionist tendencies and other movements for the right to self-determination, among member states.<br></br>
The GA 6 is the UN body that is primarily responsible for the discussion of various issues (w.r.t. terrorism, trade, diplomacy etc.) among the member states, and their possible solutions which hold firmly to fundamental human rights. Therefore, it is seen that issues that are related to the style of governance of people (i.e. secessionism and other movements for the right to self-determination)are an essential part of the discussions of the GA 6 as these issues are directly interlinked with suppression of the basic human rights.

<div class="row">
					<div class="column">
					<img src="../../../img/Snapseed/Legal_C-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Sreeram Warrier</b></h5>
					<h6 style ="text-align:center;">Chair</h6>
					</div>
              
					<!--<div class="column">
					<img src="../../../img/Snapseed/SEC_VC-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Namitha Iyer</b></h5>
					<h6 style ="text-align:center;">Vice Chair</h6>
					</div>
					
					<div class="column">
					<img src="../../../img/Snapseed/SEC_M-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Manav Somani</b></h5>
					<h6 style ="text-align:center;">Moderator</h6>
					</div>-->
				</div>
				
				</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="jcci" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">JCC Internationale</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >The incessant scribbling on paper. Constant, yet unpredictable crisis updates. Communiqués coming in and out the room. The atmosphere in a JCC is this intense because your enemy sits on the other side of the wall. If you don't think fast enough, your solutions might become irrelevant. Or worse , you might lose a war.<br></br>
					Historical this time, the JCC will commence as a post war committee, burdened with the consequences of Germany winning World War 1. With The Internationale on one side and the Mitteleuropa on the other, it will be in your hands, to effectively deal with civil unrest, economic instability, revolution, betrayal, defections and much more. What if the Bolsheviks failed to usurp power in Russia? What if the exiled Entente are not finished yet? What if there is another Hitler, waiting for an opportunity to rise? And what if, after all ,peace can be negotiated? This is your chance to rewrite history.<br></br>

<b>Welcome to the Syndicalist Internationale!</b><br></br>
Socialism is the only way forward, to ensure equality in our global society. The German Empire and her allies are a menace, threatening world peace with their selfish and callous motives. They strive for world domination. We, the Syndicalist Internationale, can stop them.<br></br>

Overthrow the monarchies!</br>
Give power to the worker!</br>
Come, join us, as we prevent global catastrophe!</br>

<div class="row">
					<div class="column">
					<img src="../../../img/Snapseed/JCCI_C-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Shayarneel Kundu</b></h5>
					<h6 style ="text-align:center;">Chair</h6>
					</div>
              
					<!--<div class="column">
					<img src="../../../img/Snapseed/JCCI_VC-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Namitha Iyer</b></h5>
					<h6 style ="text-align:center;">Vice Chair</h6>
					</div>-->
					
					<div class="column">
					<img src="../../../img/Snapseed/JCCI_M-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Rithvik P</b></h5>
					<h6 style ="text-align:center;">Moderator</h6>
					</div>
				</div>
</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<div class="modal fade" id="jccm" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">JCC Mitteleuropa </h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >The incessant scribbling on paper. Constant, yet unpredictable crisis updates. Communiqués coming in and out the room. The atmosphere in a JCC is this intense because your enemy sits on the other side of the wall. If you don't think fast enough, your solutions might become irrelevant. Or worse , you might lose a war.<br></br>
					Historical this time, the JCC will commence as a post war committee, burdened with the consequences of Germany winning World War 1. With The Internationale on one side and the Mitteleuropa on the other, it will be in your hands, to effectively deal with civil unrest, economic instability, revolution, betrayal, defections and much more. What if the Bolsheviks failed to usurp power in Russia? What if the exiled Entente are not finished yet? What if there is another Hitler, waiting for an opportunity to rise? And what if, after all ,peace can be negotiated? This is your chance to rewrite history<br></br>


<b>Welcome to Mitteleuropa!</b><br></br>
The socialistic (syndicalist) regime is a worm that has manifested throughout Europe. They are usurpers of power. They take away what is rightfully others’ and keep for themselves. A syndicalist regime will throw the world into chaos, and ruin any hope for global peace.<br></br>
The German Empire, along with her loyal allies are the only force that can stop this infection, and bring unimaginable greatness to all the world.<br></br>
We will emerge victorious as we did before!</br>
There will be no stopping us!</br>
There will be no stopping worldwide prosperity!</br>
Come, join us, the glorious Mitteleuropa!</br>

<div class="row">
					<div class="column">
					<img src="../../../img/Snapseed/JCCM_C-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Padmapriya Mohan</b></h5>
					<h6 style ="text-align:center;">Chair</h6>
					</div>
              
					<div class="column">
					<img src="../../../img/Snapseed/JCCM_VC-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Aakriti H</b></h5>
					<h6 style ="text-align:center;">Vice Chair</h6>
					</div>
					
					<div class="column">
					<img src="../../../img/Snapseed/JCCM_M-01.jpeg" class="img-fluid" alt="">
					<h5 style="text-align:center; margin-bottom:5px; margin-top:10px;"><b>Pratheek D</b></h5>
					<h6 style ="text-align:center;">Moderator</h6>
					</div>
				</div>

</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>

<div class="modal fade" id="Login" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">Login Form</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >
					<div class="wrapper">
						<form class="form-signin">       
							<h2 class="form-signin-heading">LOGIN</h2>
							<input type="text" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" />
							<input type="password" class="form-control" name="password" placeholder="Password" required=""/>     
							<p style ="padding-top:10px; padding-left:5px; margin-bottom:15px; "> Forgot Password?</p>
						    <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
						</form>
					</div>
					
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<!-- Add Details-->
	<div class="modal fade" id="Details" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">Add Details</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >
					<form class="form-horizontal" role="form">
	<div class="form-group">
		<label for="phone">Phone Number</label>
		<input class="form-control" type="tel" id = "phone" name="phone" value ="" placeholder="Your Phone No." maxlength= 10 />
	</div>
	<div class="form-group">
		<label for="numMuns">Number of MUNs attended</label>
		<input class="form-control" type="number" id = "numMuns" name="numMuns"  placeholder="No. of Muns" />
	</div>
	<div class="form-group">
		<label for="numAwards">Number of Awards won</label>
		<input class="form-control" type="number" id = "numAwards" name="numAwards"  placeholder="No. of Awards" />
	</div>
	<div class="form-group">
		<label for="numAwards">Tell us more about your experience</label>
		<textarea class="form-control" rows = "5" id = "info" name="exp"></textarea>
	</div>
	<input type="submit" class="btn btn-warning" value="Add" id ="submit-details"/>&nbsp&nbsp<span id = "error-details"></span>
</form>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<!-------------------------- Preferences -->
	<div class="modal fade" id="Pref" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">Committee Preferences</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >
					<form class="form-horizontal" role="form">
	<div class="form-group">
		<label for="committees1">Committee Preference 1:</label>
		<select class="form-control"  id="committees1" name="committees">
			<option value = "">Choose Committee</option>
			<option value = "Secretariat">Secretariat</option>
			<option value = "SOCHUM">SOCHUM</option>
			<option value = "Legal">Legal</option>
			<option value = "WHO">WHO</option>
			<option value = "UNODC">UNODC</option>
			<option value = "UNSC">UNSC</option>
			<option value = "IAEA">IAEA</option>
			<option value = "Planning Commission">Planning Commission</option>
			<option value = "WEF">WEF</option>
			<option value = "AD-Hoc">AD-Hoc</option>
			<option value = "JCC 1">JCC 1</option>
			<option value = "JCC 2">JCC 2</option>
			<option value = "Illuminati">Illuminati</option>
      </select>
	</div>
	<div class="form-group">
	<label for="sel1">Portfolio:</label>
		<select id="p1c1" class = "country form-control" name="country1" placeholder="country"></select>
		<select id="p1c2" class = "country form-control" name="country2" placeholder="country"></select>
		<select id="p1c3" class = "country form-control" name="country3" placeholder="country"></select>
  </div>
	  
	  
	  <div class="form-group">
		<label for="sel1">Committee Preference 2:</label>
		<select class="form-control"  id="committees2" name="committees">
			<option value = "">Choose Committee</option>
			<option value = "Secretariat">Secretariat</option>
			<option value = "SOCHUM">SOCHUM</option>
			<option value = "Legal">Legal</option>
			<option value = "WHO">WHO</option>
			<option value = "UNODC">UNODC</option>
			<option value = "UNSC">UNSC</option>
			<option value = "IAEA">IAEA</option>
			<option value = "Planning Commission">Planning Commission</option>
			<option value = "WEF">WEF</option>
			<option value = "AD-Hoc">AD-Hoc</option>
			<option value = "JCC 1">JCC 1</option>
			<option value = "JCC 2">JCC 2</option>
			<option value = "Illuminati">Illuminati</option>
      </select>
		</div>
		<div class="form-group">
			<label for="sel1">Portfolio:</label>
			<select id="p2c1" class = "country form-control" name="country1" placeholder="country"></select>
			<select id="p2c2" class = "country form-control" name="country2" placeholder="country"></select>
			<select id="p2c3" class = "country form-control" name="country3" placeholder="country"></select>
	  </div>
		  
		  
		  <div class="form-group">
				<label for="committees3">Committee Preference 3:</label>
				<select class="form-control"  id="committees3" name="committees">
					<option value = "">Choose Committee</option>
					<option value = "Secretariat">Secretariat</option>
					<option value = "SOCHUM">SOCHUM</option>
					<option value = "Legal">Legal</option>
					<option value = "WHO">WHO</option>
					<option value = "UNODC">UNODC</option>
					<option value = "UNSC">UNSC</option>
					<option value = "IAEA">IAEA</option>
					<option value = "Planning Commission">Planning Commission</option>
					<option value = "WEF">WEF</option>
					<option value = "AD-Hoc">AD-Hoc</option>
					<option value = "JCC 1">JCC 1</option>
					<option value = "JCC 2">JCC 2</option>
					<option value = "Illuminati">Illuminati</option>
				</select>
		</div>
		<div class="form-group">
		<label for="sel1">Portfolio:</label>
			<select id="p3c1" class = "country form-control" name="country1" placeholder="country"></select>
			<select id="p3c2" class = "country form-control" name="country2" placeholder="country"></select>
			<select id="p3c3" class = "country form-control" name="country3" placeholder="country"></select>
		  </div>
		<input type="submit" id = "submit-pref" class="btn btn-warning" value="Add" />&nbsp&nbsp<span id = "error-pref"></span>
	</form>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>
	
	<!-- Add Delegates-->
	<div class="modal fade" id="Del" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">Add Delegates</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" > Add entry as Name, e-mail (1 entry per line, press enter to add next entry)</p>
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label for="phone">Add Delegates</label>
							<textarea class="form-control" rows = "10" id = "delegateList" name="exp"></textarea><br />
							<input type="submit" id = "submit-delegate" class="btn btn-warning" value="Add" />&nbsp&nbsp<span id = "error-delegate"></span>
						</div>
					</form>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
			
			</div>
		</div>
	</div>
    </div>


  <div class="modal fade" id="notif" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">Notifications</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" >The payment details will be mailed later to the registered E-mail IDs.
					The registration fees will be Rs. 600 all inclusive per delegate.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>

<div class="modal fade" id="Delegation" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title mod-tit">Your Delegation</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p class="mod-con" ><?php if(!isset($det) || empty($det)) {echo '<span>You haven\'t added any delegates, click on the add delegates links to do so. If you did add them refresh this page and check or else contact us at support@kmun.in'; } 
					else {
						echo $det;
					}
					?></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    </div>

	<script>
		$('#submit-delegate').on('click', function(event) {
			
			event.preventDefault();
			
			var delegateList = $('#delegateList').val();
			
			if(delegateList === "") {
				$('#error-delegate').html('Can\'t be empty');
			}
			else {
				$('#submit-delegate').attr('value', 'processing');
				
				$.ajax({
					type: "POST",
					url: 'addDelegates.php',
					data: {delegateList: delegateList},
					success: function(result) {
						$('#error-delegate').html(result);
						$('#submit-delegate').attr('value', 'Add');
					}
				});
			}
		});
	</script>
  <!-- JavaScript Libraries -->
  <script src="../../../lib/jquery/jquery.min.js"></script>
  <script src="../../../lib/jquery/jquery-migrate.min.js"></script>
  <script src="../../../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../../lib/easing/easing.min.js"></script>
  <script src="../../../lib/superfish/hoverIntent.js"></script>
  <script src="../../../lib/superfish/superfish.min.js"></script>
  <script src="../../../lib/wow/wow.min.js"></script>
  <script src="../../../lib/waypoints/waypoints.min.js"></script>
  <script src="../../../lib/counterup/counterup.min.js"></script>
  <script src="../../../lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../../../lib/isotope/isotope.pkgd.min.js"></script>
  <script src="../../../lib/lightbox/js/lightbox.min.js"></script>
  <script src="../../../lib/touchSwipe/jquery.touchSwipe.min.js"></script>
  <!-- countdown-->
  <script src= "../../../js/countdown.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="../../../contactform/contactform.js"></script>
	<!-- sending details -->
	<script src="../send.js"></script>
	
  <!-- Template Main Javascript File -->
  <script src="../../../js/main.js"></script>

</body>
</html>
