<?php
session_start();
?>
<?php
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            header("Location: menu.php?keyword=$keyword");
            exit();
        }
        ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>CaterServ - Catering Services Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
            body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .profile-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: slideIn 1s ease-in-out;
        }

        @keyframes slideIn {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .user-info {
    font-family: Arial, sans-serif;
    color: #333;
}

.user-info p {
    margin: 0 0 10px;
}

.user-info span {
    font-weight: bold;
}

.error-message {
    color: red;
    font-weight: bold;
}
@keyframes grow {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(1.1);
    }
}

.user-info p {
    margin: 0 0 10px;
    animation: grow 1s ease-in-out;
    text-align: center; /* Căn giữa dòng chữ */
    font-size: 30px;
}
        </style>
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid nav-bar">
            <div class="container">
                <nav class="navbar navbar-light navbar-expand-lg py-4">
                    <a href="index.php" class="navbar-brand">
                        <h1 class="text-primary fw-bold mb-0">Cater<span class="text-dark">Serv</span> </h1>
                    </a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="about.php" class="nav-item nav-link">About</a>
                            <!-- <a href="service.php" class="nav-item nav-link">Services</a> -->
                            <!-- <a href="event.php" class="nav-item nav-link">Events</a> -->
                            <a href="menu.php" class="nav-item nav-link">Menu</a>
                            <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu bg-light">
                                    <a href="book.php" class="dropdown-item">Booking</a>
                                    <a href="blog.php" class="dropdown-item">Our Blog</a>
                                    <a href="team.php" class="dropdown-item">Our Team</a>
                                    <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                                    <a href="404.php" class="dropdown-item">404 Page</a>
                                </div>
                            </div> -->
                            <a href="contact.php" class="nav-item nav-link ">Contact</a>
                        </div>
                        <button class="btn-search btn btn-primary btn-md-square me-4 rounded-circle d-none d-lg-inline-flex" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></button>

                        <div class="">
                            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                                <a href="menu.php" class="btn btn-primary py-2 px-4 d-none d-xl-inline-block rounded-pill">Cart</a>
                            <?php else: ?>
                                <a href="signup.php" class="btn btn-primary py-2 px-4 d-none d-xl-inline-block rounded-pill">Sign Up</a>
                            <?php endif; ?>
                            <img class="avatar" src="./img/menu-08.jpg" alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%;" data-bs-toggle="modal" data-bs-target="#userModal">
                        </div>
                        <!-- User Modal -->
                        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="userModalLabel">User Options</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                                            <a class="dropdown-item" href="profile.php">Profile</a>
                                            <a class="dropdown-item" href="orders.php">Orders</a>
                                            <a class="dropdown-item" href="logout.php">Logout</a>
                                        <?php else: ?>
                                        <a class="dropdown-item" href="signup.php">Sign Up</a>
                                        <a class="dropdown-item" href="login.php">Login</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <form action="index.php" method="post" class="input-group w-75 mx-auto d-flex">
                            <input type="search" name="keyword" class="form-control bg-transparent p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><button type="submit" style="border: none; background: none;"><i class="fa fa-search"></i></button></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->


        <!-- Hero Start -->
        <div class="container-fluid bg-light py-6 my-6 mt-0">
            <div class="container text-center animated bounceInDown">
                <h1 class="display-1 mb-4">Profile</h1>
                <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
                    <li class="breadcrumb-item"><a href="#">Contact</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">Profile</li>
                </ol>
            </div>
        </div>
        <!-- Hero End -->

        <?php

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Nếu chưa đăng nhập, chuyển hướng người dùng đến trang đăng nhập
    header("Location: login.php");
    exit;
}

// Kết nối đến cơ sở dữ liệu
require 'db_connect.php'; // Đảm bảo rằng bạn đã tạo file db_connect.php và có kết nối đến cơ sở dữ liệu

// Kiểm tra và sử dụng biến Session $_SESSION['userid']
if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
    // Truy vấn cơ sở dữ liệu để lấy thông tin của người dùng
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param('i', $_SESSION['userid']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra xem có bản ghi nào được trả về hay không
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Hiển thị thông tin người dùng
echo "<div class='user-info'>";
if (isset($_SESSION['editing'])) {
    echo "<form method='post'>";
    echo "<p>Username: <input type='text' name='username' value='" . htmlspecialchars($user['username'] ?? '') . "' /></p>";
    echo "<p>Email: <input type='text' name='email' value='" . htmlspecialchars($user['email'] ?? '') . "' /></p>";
    echo "<p>Phone Number: <input type='text' name='phone_number' value='" . htmlspecialchars($user['phone_number'] ?? '') . "' /></p>";
    echo "<p>Address: <input type='text' name='address' value='" . htmlspecialchars($user['address'] ?? '') . "' /></p>";
    echo "<button type='submit' name='update'>OK</button>";
    echo "</form>";
} else {
    echo "<p>Username: " . htmlspecialchars($user['username'] ?? '') . "</p>";
    echo "<p>Email: " . htmlspecialchars($user['email'] ?? '') . "</p>";
    echo "<p>Phone Number: " . htmlspecialchars($user['phone_number'] ?? '') . "</p>";
    echo "<p>Address: " . htmlspecialchars($user['address'] ?? '') . "</p>";
    echo "<button onclick='location.href=\"?edit=true\"'>Update</button>";
}
echo "</div>";

if (isset($_GET['edit'])) {
    $_SESSION['editing'] = true;
}
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Cập nhật thông tin người dùng trong database
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, phone_number = ?, address = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $username, $email, $phone_number, $address, $user['id']);
    $stmt->execute();
    unset($_SESSION['editing']);

    echo "<script>
        alert('Đổi thông tin thành công');
        window.location.href = 'index.php';
    </script>";
}

$stmt->close();

} else {
    // Biến Session không tồn tại hoặc không chính xác, bạn có thể chuyển hướng người dùng hoặc thực hiện các xử lý khác
    echo "Session không tồn tại hoặc không chính xác.";
}
}
$conn->close();
?>






        <!-- Footer Start -->
        <div class="container-fluid footer py-6 my-6 mb-0 bg-light wow bounceInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h1 class="text-primary">Cater<span class="text-dark">Serv</span></h1>
                            <p class="lh-lg mb-4">There cursus massa at urnaaculis estieSed aliquamellus vitae ultrs condmentum leo massamollis its estiegittis miristum.</p>
                            <div class="footer-icon d-flex">
                                <a class="btn btn-primary btn-sm-square me-2 rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-primary btn-sm-square me-2 rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a href="#" class="btn btn-primary btn-sm-square me-2 rounded-circle"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="btn btn-primary btn-sm-square rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="mb-4">Special Facilities</h4>
                            <div class="d-flex flex-column align-items-start">
                                <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Cheese Burger</a>
                                <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Sandwich</a>
                                <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Panner Burger</a>
                                <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Special Sweets</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="mb-4">Contact Us</h4>
                            <div class="d-flex flex-column align-items-start">
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i> 123 Street, New York, USA</p>
                                <p><i class="fa fa-phone-alt text-primary me-2"></i> (+012) 3456 7890 123</p>
                                <p><i class="fas fa-envelope text-primary me-2"></i> info@example.com</p>
                                <p><i class="fa fa-clock text-primary me-2"></i> 26/7 Hours Service</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="mb-4">Social Gallery</h4>
                            <div class="row g-2">
                                <div class="col-4">
                                     <img src="img/menu-01.jpg" class="img-fluid rounded-circle border border-primary p-2" alt="">
                                </div>
                                <div class="col-4">
                                     <img src="img/menu-02.jpg" class="img-fluid rounded-circle border border-primary p-2" alt="">
                                </div>
                                <div class="col-4">
                                     <img src="img/menu-03.jpg" class="img-fluid rounded-circle border border-primary p-2" alt="">
                                </div>
                                <div class="col-4">
                                     <img src="img/menu-04.jpg" class="img-fluid rounded-circle border border-primary p-2" alt="">
                                </div>
                                <div class="col-4">
                                     <img src="img/menu-05.jpg" class="img-fluid rounded-circle border border-primary p-2" alt="">
                                </div>
                                <div class="col-4">
                                     <img src="img/menu-06.jpg" class="img-fluid rounded-circle border border-primary p-2" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-md-square btn-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    </body>

</html>