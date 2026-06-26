<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Sidebar Styling */
        .ts-sidebar {
            width: 230px;
            position: fixed;
            height: 100vh;
            left: 0;
            margin-top: -20px;
            background-color: rgb(4, 98, 193);
            color: #fff;
            padding-top: 20px;
            overflow-y: auto;
            margin-top: -30px;

        }

        /* Sidebar Menu */
        .ts-sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .ts-sidebar-menu li {
            padding: 12px 18px;
            font-size: 16px;
            border-bottom: 1px solid rgba(8, 253, 110, 0.7);
            position: relative;
        }

        /* Sidebar Links */
        .ts-sidebar-menu li a, 
        .ts-sidebar-menu li label {
            text-decoration: none;
            color: #fff;
            display: block;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        /* Hover Effect */
        .ts-sidebar-menu li a:hover, 
        .ts-sidebar-menu li label:hover {
            background-color: rgb(255, 193, 7);
            padding-left: 22px;
            color: #000;
            font-weight: bold;
        }

        /* Sidebar Icons */
        .ts-sidebar-menu li i {
            margin-right: 12px;
        }

        /* Active Link */
        .ts-sidebar-menu li a.active {
            background-color: rgb(255, 7, 118);
            font-weight: bold;
        }

        /* Hide Checkbox (For Click Toggle) */
        .toggle-menu {
            display: none;
        }

        /* Submenu Styling */
        .ts-sidebar-menu li ul {
            list-style: none;
            padding-left: 15px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        /* Show Submenu on Click */
        .toggle-menu:checked + label + ul {
            max-height: 200px;
        }

        /* Content Wrapper (Fix Alignment) */
        .content-wrapper {
            margin-left: 230px;
            padding: 20px;
            min-height: 100vh;
        }

        /* Responsive Sidebar */
        @media (max-width: 992px) {
            .ts-sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content-wrapper {
                margin-left: 0;
            }
        }

    </style>
</head>
<body>

<!-- Sidebar -->
<nav class="ts-sidebar">
    <ul class="ts-sidebar-menu">
        <li class="ts-label">Main</li>
        <li><a href="dashboard.php" class="active"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        
        <li>
            <input type="checkbox" id="toggle-bloodgroup" class="toggle-menu">
            <label for="toggle-bloodgroup"><i class="fa fa-tint"></i> Blood Group</label>
            <ul>
                <li><a href="add-bloodgroup.php">Add Blood Group</a></li>
                <li><a href="manage-bloodgroup.php">Manage Blood Group</a></li>
            </ul>
        </li>

        <li><a href="donor-list.php"><i class="fa fa-users"></i> Donor List</a></li>
        <li><a href="manage-conactusquery.php"><i class="fa fa-comments"></i> Manage Contactus Query</a></li>
        <li><a href="blood-requests.php"><i class="fa fa-heartbeat"></i> Blood Requests</a></li>
        <li><a href="add-donor.php"><i class="fa fa-heartbeat"></i> Add Donor</a></li>
        <li><a href="request-received-bydonar.php"><i class="fa fa-search"></i> Search Blood Request</a></li>
        <li><a href="search-donor.php"><i class="fa fa-search"></i> Search Donor</a></li>
        <li><a href="bloodunits.php"><i class="fa fa-search"></i> Blood Units</a></li>
        <li><a href="add-notice.php"><i class="fa fa-search"></i> Add Notice</a></li>
        <li><a href="view-feedback.php"><i class="fa fa-search"></i> View-Feedback</a></li>
        <li><a href="add_recipient.php"><i class="fa fa-search"></i> Add Recipient</a></li>
        <li><a href="recipient_list.php"><i class="fa fa-search"></i>Recipient List  </a></li>




    </ul>
</nav>
