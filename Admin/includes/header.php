<!doctype html>
<html lang="en" class="no-js">

<head>
</head>

<body>
<style>
	/* Navbar Styling */
.brand {
    background:rgb(5, 122, 239); /* Dark background */
    color: white;
    padding: 0px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    top: -10px;
    width: 100%;
    z-index: 1000;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        margin-right: 270px; /* or whatever your sidebar width is */

}

/* Brand Logo */
.brand a {
    font-size: 22px;
    font-weight: bold;
    color: white;
    text-decoration: none;
}

/* Menu Button (for mobile) */
.menu-btn {
    display: none;
    font-size: 22px;
    cursor: pointer;
}

/* Profile Navigation */
.ts-profile-nav {
    list-style: none;
    display: flex;
    align-items: center;
}

.ts-profile-nav li {
    position: relative;
}

/* Profile Dropdown */
.ts-profile-nav .ts-account > a {
    color: white;
    text-decoration: none;
    padding: 10px 15px;
    display: flex;
    align-items: center;
}

.ts-profile-nav .ts-account a img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    margin-right: 8px;
}

/* Dropdown List */
.ts-profile-nav .ts-account ul {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    list-style: none;
    padding: 10px 0;
    width: 150px;
    display: none;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

/* Show Dropdown on Hover */
.ts-profile-nav .ts-account:hover ul {
    display: block;
}

/* Dropdown Links */
.ts-profile-nav .ts-account ul li {
    padding: 10px;
    text-align: center;
}

.ts-profile-nav .ts-account ul li a {
    color: #333;
    text-decoration: none;
    display: block;
}

.ts-profile-nav .ts-account ul li a:hover {
    background: #f4f4f4;
}

/* Responsive Design */
@media (max-width: 768px) {
    .menu-btn {
        display: block;
        color: white;
    }

    .ts-profile-nav {
        display: none;
    }

    .ts-profile-nav.show {
        display: flex;
        flex-direction: column;
        background:rgb(7, 120, 233);
        position: auto;
        top: 6px;
        right: 0;
        width: 100px;
        border-radius: 5px;
    }

    .ts-profile-nav.show li {
        padding: 1px;
        text-align: left;
    }
}
.back-to-home-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #007bff; /* Bootstrap primary */
    color: white;
    border: none;
    border-radius: 50px;
    padding: 12px 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s;
}

.back-to-home-btn:hover {
    background-color: #0056b3;
}


	</style>

	<div class="brand clearfix">
	<a href="dashboard.php" style="font-size: 20px; padding-top:1%; color:#fff">BloodBank Management System </a>  
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			
			<li class="ts-account">
				<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
				<ul><li><a href="profile.php">Profile</a></li>
					<li><a href="change-password.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
<a href="../index.php" class="btn btn-primary back-to-home-btn">Back to Home</a>
