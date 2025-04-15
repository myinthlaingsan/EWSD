<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;

Auth::check();

use Libs\Database\ActivityLogsTable;
use Libs\Database\MySQL;

$user_id = $auth->id ?? null;
$activityLogTable = new ActivityLogsTable(new MySQL);
// Extract file name from the request URI
$requestUri = $_SERVER['REQUEST_URI'];
$fileName = basename($requestUri);

// Log the page visit
$activityLogTable->logPageView(
  $user_id,
  $_SERVER['REQUEST_URI'],
  $_SERVER['HTTP_USER_AGENT'],
  $_SERVER['REMOTE_ADDR'],
  $fileName
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <!-- Font Awesome Link -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />

  <!-- Main CSS Link -->
  <link rel="stylesheet" href="../../Students/university.css" />

  <!-- Bootstrap CSS CDN LInk -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
</head>

<body>
  <!-- nav bar start -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand me-5 text-light" href="#">
        <h3>Riverstone University</h3>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title hearder1" id="offcanvasNavbarLabel">
            Riverstone University
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="navbar-nav offcanvas-body justify-content-lg-end mb-lg-0">
          <li class="nav-item me-5">
            <a
              class="nav-link"
              aria-current="page"
              href="./dashboard.php">Home</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" aria-current="page" href="viewselected.php">View Article</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" aria-current="page" href="#aboutus">Aboout</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" href="#contactpage">Contact Us</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
          <!-- <li class="nav-item">
                <a class="nav-link" href="../../Auth/design/register.php">
                    <i class="fa-solid me-2 fa-arrow-right-to-bracket"></i>
                    SignIn
                </a>
            </li> -->
          <li class="nav-item">
            <a class="nav-link" href="../../Auth/code/logout.php">
              <i class="fa-solid me-2 fa-arrow-right-to-bracket"></i>
              Logout
            </a>
          </li>
        </div>
      </div>
    </div>
  </nav>
  <!-- Nav bar end -->
  <?php if (isset($_SESSION['login_message'])): ?>
    <div class="alert alert-info">
      <?= $_SESSION['login_message'] ?>
    </div>
    <?php unset($_SESSION['login_message']); ?>
  <?php endif; ?>
  <!-- Home Page start -->
  <header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-lg-6 order-2 order-lg-1 align-content-center text-center">
          <h2 class="headertitle mb-3">Discover Your Path at Riverstone University:
            Where Education Meets Opportunity</h2>
          <p class="headertext text-center mb-5 w-75 m-auto">At Riverstone University, we believe in the transformative power of education.
            Our programs are designed to inspire creativity, foster critical thinking,
            and prepare students for the challenges of tomorrow.
            Whether you're pursuing undergraduate studies, graduate research, or professional development,
            Riverstone offers a vibrant community, world-class faculty, and state-of-the-art facilities
            to help you achieve your goals. Join us and take the first step toward a brighter future.
          </p>
          <a class="btn btn-primary rounded p-2 mb-5" href="#courselink">View Our Program</a>
        </div>
        <div class="col-12 col-lg-6 order-1 order-lg-2 align-content-md-center">
          <img class="img img-fluid mt-2 mt-lg-4 shadow-sm" src="../../Students/image/university.jpg" alt="headerimage">
        </div>
      </div>
    </div>
  </header>
  <!-- Home Page End -->

  <!-- Course start -->
  <section class="mt-5" id="courselink">
    <div class="container">
      <div class="row">
        <!-- course title -->
        <div class="col-12 text-center mb-3">
          <h4 class="aboutus">Featured Courses</h4>
          <h2>Education and Research at Riverstone</h2>
        </div>
        <!-- course card -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
            <div class="card h-100">
              <img src="../../Students/image/course1.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Bachelor of Science in Computer Science</h5>
                <p class="card-text"><b>Description</b>: Gain expertise in programming, AI, and software development for a thriving tech career.</p>
                <p class="card-text"><b>Duration</b>: 4 years (Full-time)</p>
                <p class="card-text"><b>Level</b>: Undergraduate</p>
                <div><button class="btn btn-primary float-end">Apply Now!</button></div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100">
              <img src="../../Students/image/course2.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Master of Business Administration (MBA)</h5>
                <p class="card-text"><b>Description</b>: Develop leadership and strategic skills for global business success.</p>
                <p class="card-text"><b>Duration</b>: 2 years (Full-time)</p>
                <p class="card-text"><b>Level</b>: Graduate</p>
                <div><button class="btn btn-primary float-end">Apply Now!</button></div>
              </div>

            </div>
          </div>

          <div class="col">
            <div class="card h-100">
              <img src="../../Students//image/course3.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Master of Arts in Psychology</h5>
                <p class="card-text"><b>Description</b>: Advanced training in clinical, cognitive, and developmental psychology.</p>
                <p class="card-text"><b>Duration</b>: 2 years (Full-time)</p>
                <p class="card-text"><b>Level</b>: Graduate</p>
                <div><button class="btn btn-primary float-end">Apply Now!</button></div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100">
              <img src="../../Students/image/course4.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Doctor of Philosophy (PhD) in Environmental Science</h5>
                <p class="card-text"><b>Description</b>: Research-focused program addressing global environmental challenges.</p>
                <p class="card-text"><b>Duration</b>: 4-6 years (Full-time)</p>
                <p class="card-text"><b>Level</b>: Doctoral</p>
                <div><button class="btn btn-primary float-end">Apply Now!</button></div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100">
              <img src="../../Students/image/course6.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Bachelor of Science in Data Science</h5>
                <p class="card-text"><b>Description</b>: Learn to analyze and interpret complex data for decision-making in tech, business, and research.</p>
                <p class="card-text"><b>Duration</b>: 4 years (Full-time)</p>
                <p class="card-text"><b>Level</b>: Undergraduate</p>
                <div><button class="btn btn-primary float-end">Apply Now!</button></div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100">
              <img src="../../Students/image/course7.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Bachelor of Engineering (BEng) in Mechanical Engineering</h5>
                <p class="card-text"><b>Description</b>: Design and innovate with a strong foundation in mechanical systems and technology.</p>
                <p class="card-text"><b>Duration</b>: 4 years (Full-time)</p>
                <p class="card-text"><b>Level</b>: Undergraduate</p>
                <div><button class="btn btn-primary float-end">Apply Now!</button></div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </section>
  <!-- Course end -->

  <!-- About start -->
  <section class="mt-5" id="aboutus">
    <div class="container">
      <div class="row">
        <!-- About title -->
        <div class="col-12 text-center mb-3">
          <h4 class="aboutus">About Us</h4>
          <h2>Riverstone University History</h2>
        </div>
        <!-- About text -->
        <div class="col-12 col-xxl-6">
          <img
            class="img img-fluid img-thumbnail rounded-2 aboutimage"
            src="../../Students/image/pexels-quang-vuong-724225078-31156602.jpg"
            alt="" />
        </div>
        <div class="col-12 col-xxl-6">
          <div class="row">
            <div class="col-12 col-lg-8 col-xl-7 col-xxl-12 p-xxl-0 p-4">
              <p class="abouttext">
                Riverstone University is a premier institution dedicated to
                academic excellence, innovation, and holistic student
                development. Located in the heart of Springfield, Illinois,
                our campus provides a vibrant and inclusive environment where
                students from diverse backgrounds can thrive. With a strong
                commitment to fostering critical thinking, creativity, and
                leadership, Riverstone University offers a wide range of
                undergraduate, graduate, and online programs designed to meet
                the evolving needs of today’s global society. Our
                distinguished faculty comprises industry experts and scholars
                who are passionate about mentoring students and guiding them
                toward success. State-of-the-art facilities, cutting-edge
                research opportunities, and a robust curriculum ensure that
                students are well-prepared for their future careers. At
                Riverstone, we believe in the power of education to transform
                lives and communities. Beyond academics, we emphasize the
                importance of extracurricular activities, community
                engagement, and personal growth. Our students are encouraged
                to participate in clubs, sports, and volunteer initiatives,
                fostering a well-rounded educational experience. Riverstone
                University is more than just a place to learn—it’s a place to
                grow, connect, and make a difference. Join us and become part
                of a legacy of excellence and innovation.
              </p>
            </div>
            <div class="col-12 col-lg-4 col-xl-5 col-xxl-12">
              <iframe
                class="border border-3 border-primary rounded-3 mt-lg-4"
                width="100%"
                height="315"
                src="https://www.youtube.com/embed/u08oxMNakW4?si=E7OKOkF1DmS7cQ4a"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--About End  -->

  <!-- Activity start -->
  <section class="mt-5">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center mb-2">
          <h4 class="aboutus">Activity Us</h4>
          <h2>Beyond the Classroom: Our Vibrant Campus Life</h2>
        </div>
        <!-- activity slide -->
        <div
          id="carouselExampleAutoplaying"
          class="carousel slide img-thumbnail"
          data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img
                src=".../../Students/image/activity1.jpg"
                class="activityslide d-block w-100"
                alt="..." />
            </div>
            <div class="carousel-item">
              <img
                src="../../Students/image/activity6.jpg"
                class="activityslide d-block w-100"
                alt="..." />
            </div>
            <div class="carousel-item">
              <img
                src="../../Students/image/activity7.jpg"
                class="activityslide d-block w-100"
                alt="..." />
            </div>
            <div class="carousel-item">
              <img
                src="../../Students/image/activity2.jpg"
                class="activityslide d-block w-100"
                alt="..." />
            </div>
            <div class="carousel-item">
              <img
                src="../../Students/image/activity3.jpg"
                class="activityslide d-block w-100"
                alt="..." />
            </div>
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span
              class="carousel-control-prev-icon"
              aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span
              class="carousel-control-next-icon"
              aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </section>
  <!-- Activity End -->

  <!-- our team start -->
  <section>
    <div class="container">
      <div class="row mt-4 justify-content-center">
        <div class="col-12 text-center mb-2">
          <h4 class="aboutus">Our Professors</h4>
          <h2>Dedicated to Your Success: Our Faculty</h2>
        </div>
        <div class="row text-center">
          <div class="col-12 professorimg">
            <img
              class="img img-fluid img-thumbnail"
              src="../../Students/image/professor1.jpg"
              alt="" />
          </div>
          <div class="col-12 professorimg">
            <img
              class="img img-fluid img-thumbnail"
              src="../../Students/image/professor2.jpg"
              alt="" />
          </div>
          <div class="col-12 professorimg">
            <img
              class="img img-fluid img-thumbnail"
              src="../../Students/image/professor3.jpg"
              alt="" />
          </div>
          <div class="col-12 professorimg">
            <img
              class="img img-fluid img-thumbnail"
              src="../../Students/image/professor4.jpg"
              alt="" />
          </div>
          <div class="col-12 professorimg">
            <img
              class="img img-fluid img-thumbnail"
              src="../../Students/image/professor10.jpg"
              alt="" />
          </div>
          <div class="col-12 professorimg">
            <img
              class="img img-fluid img-thumbnail"
              src="../../Students/image/professor6.jpg"
              alt="" />
          </div>
          <div class="col-12 professorimg">
            <img
              class="img img-fluid img-thumbnail"
              src="../../Students/image/professor9.jpg"
              alt="" />
          </div>
          <div class="col-12 professorimg">
            <img
              class="img img-fluid img-thumbnail"
              src="../../Students/image/professor8.jpg"
              alt="" />
          </div>
        </div>

        <div class="slidearrowicon">
          <!-- Next and previous buttons -->
          <a class="prev" onclick="plusSlides(-1)">
            <i class="fs-3 previcon fa-solid fa-circle-arrow-left"></i>
          </a>
          <a class="next" onclick="plusSlides(1)">
            <i class="fs-3 nexticon fa-solid fa-circle-arrow-right"></i>
          </a>
        </div>

        <div class="caption-container">
          <p id="caption"></p>
        </div>

        <!-- Thumbnail images -->
        <div class=" d-flex justify-content-center">
          <div class="smallprofessorimg">
            <img class="demo cursor img img-fluid img-thumbnail mx-2" src="../../Students/image/professor1.jpg" onclick="currentSlide(1)" alt="Dr. Emily Carter">
          </div>
          <div class="smallprofessorimg">
            <img class="demo cursor img img-fluid img-thumbnail mx-2" src="../../Students/image/professor2.jpg" onclick="currentSlide(2)" alt="Dr. Michael Reynolds">
          </div>
          <div class="smallprofessorimg">
            <img class="demo cursor img img-fluid img-thumbnail mx-2" src="../../Students/image/professor3.jpg" onclick="currentSlide(3)" alt="Dr. Sarah Thompson">
          </div>
          <div class="smallprofessorimg">
            <img class="demo cursor img img-fluid img-thumbnail mx-2" src="../../Students/image/professor4.jpg" onclick="currentSlide(4)" alt="Dr. Angela White">
          </div>
          <div class="smallprofessorimg">
            <img class="demo cursor img img-fluid img-thumbnail mx-2" src="../../Students/image/professor10.jpg" onclick="currentSlide(5)" alt="Dr. Sophia Bennett">
          </div>
          <div class="smallprofessorimg">
            <img class="demo cursor img img-fluid img-thumbnail mx-2" src="../../Students/image/professor6.jpg" onclick="currentSlide(6)" alt="Dr. Charlotte Lee
              ">
          </div>
          <div class="smallprofessorimg">
            <img class="demo cursor img img-fluid img-thumbnail mx-2" src="../../Students/image/professor9.jpg" onclick="currentSlide(7)" alt="Dr. Thomas Harris">
          </div>
          <div class="smallprofessorimg">
            <img class="demo cursor img img-fluid img-thumbnail mx-2" src="../../Students/image/professor8.jpg" onclick="currentSlide(8)" alt="Dr. Olivia Martinez">
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- Our team end -->

  <!-- Contact Us start -->
  <section id="contactpage" class="mt-5">
    <div class="container">
      <div class="row justify-content-center">
        <!-- contact title -->
        <div class="col-12 contactheader text-center mb-3">
          <h4>Contact Us</h4>
          <h2>Need Help?</h2>
        </div>
        <!-- contact details -->
        <div class="row justify-content-center">
          <div
            class="col-12 col-md-5 contactdiv rounded-4 shadow-sm text-center m-3">
            <h4 class="mt-5">
              <i class="fa-solid contacticon me-3 fa-map-location"></i>Address
            </h4>
            <h6>
              Riverstone University <br />
              456 Elm St, Springfield, IL 62704, USA
            </h6>
          </div>
          <div
            class="col-12 col-md-5 contactdiv rounded-4 shadow-sm text-center m-3">
            <h4 class="mt-5">
              <i
                class="fa-solid contacticon me-3 fa-envelope-circle-check"></i>Email
            </h4>
            <h6>info@riverstone.edu</h6>
          </div>
          <div
            class="col-12 col-md-5 contactdiv rounded-4 shadow-sm text-center m-3">
            <h4 class="mt-5">
              <i class="fa-solid contacticon me-3 fa-phone"></i>Call Us
            </h4>
            <h6>+1 (555) 123-4567</h6>
          </div>
          <div
            class="col-12 col-md-5 contactdiv rounded-4 shadow-sm text-center m-3">
            <h4 class="mt-5">
              <i class="fa-solid contacticon me-3 fa-globe"></i>Website
            </h4>
            <h6>www.riverstoneuniversity.edu</h6>
          </div>
        </div>
        <div class="row justify-content-center align-items-center">
          <!-- contact image -->
          <div class="col-12 col-md-4 my-3 text-center">
            <img
              class="img img-fluid w-75"
              src="../../Students/image/undraw_new-message_nl8w.svg"
              alt="" />
          </div>
          <!-- contact form -->
          <form class="col-12 col-md-7">
            <div class="my-3">
              <input
                class="form-control"
                placeholder="Enter your full name"
                type="text" />
            </div>
            <div class="my-3">
              <input
                class="form-control"
                placeholder="Enter your email address"
                type="email" />
            </div>
            <div class="my-3">
              <input
                class="form-control"
                placeholder="Enter the subject of your inquiry"
                type="text" />
            </div>
            <div class="my-3">
              <textarea
                class="form-control"
                placeholder="Type your message here ...."
                name=""
                id=""
                cols="30"
                rows="5"></textarea>
            </div>
            <div class="float-end mb-5">
              <input class="btn btn-primary" type="button" value="Submit" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact Us end -->

  <!-- footer start -->
  <footer>
    <div class="container-fluid">
      <div class="row text-light text-center justify-content-center">
        <div class="col-6 col-lg-2 p-lg-4 mt-sm-4">
          <h3><i class="fa-solid fa-location-dot"></i></h3>
          <h5>Address</h5>
          <h6>
            Riverstone University <br />
            456 Elm St, Springfield, IL 62704, USA
          </h6>
        </div>
        <div class="col-6 col-lg-2 p-lg-4 mt-sm-4">
          <h3><i class="fa-solid fa-square-phone"></i></h3>
          <h5>Call Us</h5>
          <h6>+1 (555) 123-4567</h6>
        </div>
        <div class="col-12 col-lg-3 p-lg-4 mt-4">
          <iframe
            class="footermap1 img img-fluid rounded"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3045.624315425934!2d-89.650847684609!3d39.781734979425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8875395a5b8f5b5f%3A0x1f1e5b5b5b5b5b5b!2s456%20Elm%20St%2C%20Springfield%2C%20IL%2062704%2C%20USA!5e0!3m2!1sen!2sus!4v1633024000000!5m2!1sen!2sus"
            style="border: 0"
            allowfullscreen=""
            loading="lazy">
          </iframe>
        </div>
        <div class="col-6 col-lg-2 p-lg-4 mt-sm-4">
          <h3><i class="fa-solid fa-envelope-open-text"></i></h3>
          <h5>Email</h5>
          <h6>info@riverstone.edu</h6>
        </div>
        <div class="col-6 col-lg-2 p-lg-4 mt-sm-4">
          <h3><i class="fa-regular fa-thumbs-up"></i></h3>
          <h5>Follow us</h5>
          <h6>
            <i class="me-1 fa-brands fa-facebook"></i>
            <i class="me-1 fa-brands fa-youtube"></i>
            <i class="me-1 fa-brands fa-x-twitter"></i>
            <i class="me-1 fa-brands fa-instagram"></i>
          </h6>
        </div>
        <div class="col-12 mb-4 mt-2">
          <iframe
            class="footermap2 img img-fluid rounded"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3045.624315425934!2d-89.650847684609!3d39.781734979425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8875395a5b8f5b5f%3A0x1f1e5b5b5b5b5b5b!2s456%20Elm%20St%2C%20Springfield%2C%20IL%2062704%2C%20USA!5e0!3m2!1sen!2sus!4v1633024000000!5m2!1sen!2sus"
            style="border: 0"
            allowfullscreen=""
            loading="lazy">
          </iframe>
        </div>
        <div class="col-12 my-3">
          <h6>Copyright © 2025 Riverstone University. All Rights reserved</h6>
          <h6>
            Designed by <b class="text-danger"> Error 404 Team Found </b>
          </h6>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer end -->
</body>
<!-- Main JS Link -->
<script src="../../Students/main.js"></script>

<!-- Bootstrap JS CDN Link -->
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"></script>

</html>