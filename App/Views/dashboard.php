<?php

include(__DIR__ . "/Auth/fetchAllUserType.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="stylesheet" href="dashboard.css">
</head>

<body>

<div class="dashboard">

    <header class="navbar">

        <a href="#" class="navbar__logo">
            <span class="logo-text">HomeHub</span>
        </a>

        <nav class="navbar__menu" aria-label="Primary">

            <button
                class="nav-item nav-item--active"
                type="button"
                aria-current="page"
                data-target="panel-dashboard">
                Dashboard
            </button>

            <button
                class="nav-item"
                type="button"
                data-target="panel-properties">
                All Properties
            </button>

            <button
                class="nav-item"
                type="button"
                data-target="panel-admins">
                All Admin
            </button>

            <button
                class="nav-item"
                type="button"
                data-target="panel-users">
                All Users
            </button>            

            
            <button
                class="nav-item"
                type="button"
                data-target="panel-approval">
                Approval
            </button>
            
            

        </nav>

        <div class="navbar__actions">            


            <button class="icon-btn" type="button" aria-label="Search">
                <img
                    src="../../magnifyingSearch-Icon.png"
                    alt=""
                    height="17"
                    width="17">
            </button>

            <button class="icon-btn" type="button" aria-label="Notifications">
                <img
                    src="../../notificationBell-icon.png"
                    alt=""
                    height="22"
                    width="34">
            </button>

            <div class="profile-dropdown" id="profileDropdown">

                <button
                    class="icon-btn"
                    type="button"
                    id="profileBtn"
                    aria-label="User profile"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <img
                        src="../../profileimage-icon.png"
                        alt="User profile"
                        height="25"
                        width="30">
                </button>

                <div class="dropdown-menu" id="profileMenu">
                    <a href="../Controller/adminRegController.php" target="#" class = "dropdown-item">                        
                        <label for="">Add Admin</label> 
                    </a>
                    <a href="#" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="../Controller/logoutController.php" class="dropdown-item logout">Logout</a>
                </div>

            </div>

        </div>

    </header>


    <main class="dashboard__content">

        <!-- Dashboard Panel -->

        <section
            class="dashboard__panel"
            id="panel-dashboard">            

        </section>


        <!-- Properties Panel -->        

        <section
            class="dashboard__panel"
            id="panel-properties"
            hidden>

            <div class="card">

                <div class="card-header">
                    <h3>Properties</h3>
                </div>

                <div class="card-body">

                    <div class="property-grid">

                        <?php
                        
                        $properties = getAll('properties');

                        if ($properties && mysqli_num_rows($properties) > 0) {

                            while ($property = mysqli_fetch_assoc($properties)) {
                                ?>

                                <div class="property-card">

                                    <img
                                        src="<?= htmlspecialchars($property['image'] ?? '../../placeholder-property.png') ?>.jpg"
                                        alt="<?= htmlspecialchars($property['Title'] ?? 'Property') ?>">

                                    <div class="property-card__body">

                                        <h4><?= htmlspecialchars($property['property_title'] ?? '') ?></h4>

                                        <p class="property-card__address">
                                            <?= htmlspecialchars($property['location'] ?? '') ?>
                                        </p>

                                        <p class="property-card__price">
                                            <?= htmlspecialchars($property['price'] ?? '') ?> BDT
                                        </p>

                                        <span class="status-badge status-badge--<?= strtolower(htmlspecialchars($property['approval_status'] ?? 'pending')) ?>">
                                            <?= htmlspecialchars($property['approval_status'] ?? 'Pending') ?>
                                        </span>

                                    </div>

                                </div>

                                <?php
                            }

                        } else {
                            ?>

                            <p>No properties found.</p>

                            <?php
                        }

                        ?>

                    </div>

                </div>

            </div>

        </section>


        <!-- Admin Panel -->

        <section
            class="dashboard__panel"
            id="panel-admins"
            hidden>

            <div class="card">

                <div class="card-header">
                    <h3>Admins</h3>
                </div>

                <div class="card-body">

                    <table class="table table-bordered">

                        <thead>

                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            $admins = getAll('admintable');

                            if ($admins && mysqli_num_rows($admins) > 0) {

                                while ($admin = mysqli_fetch_assoc($admins)) {
                                    ?>

                                    <tr>

                                        <td>
                                            <?= htmlspecialchars($admin['Name'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($admin['Email'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($admin['Password'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($admin['PhoneNumber'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($admin['Address'] ?? '') ?>
                                        </td>

                                    </tr>

                                    <?php
                                }

                            } else {
                                ?>

                                <tr>
                                    <td colspan="5">
                                        No admins found.
                                    </td>
                                </tr>

                                <?php
                            }

                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </section>


        <!-- Users Panel -->

        <section
            class="dashboard__panel"
            id="panel-message"
            hidden>

            <!-- All Users content -->

        </section>

        <section
            class="dashboard__panel"
            id="panel-users"
            hidden>
            <div class="card">
                <div class="card-header">
                    <h3>Users</h3>
                </div>

                <div class="card-body">

                    <table class="table table-bordered">

                        <thead>

                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            $users = getAll('login');

                            if ($users && mysqli_num_rows($users) > 0) {

                                while ($user = mysqli_fetch_assoc($users)) {
                                    ?>

                                    <tr>

                                        <td>
                                            <?= htmlspecialchars($user['name'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($user['age'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($user['gmail'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($user['gender'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($user['type'] ?? '') ?>
                                        </td>

                                    </tr>

                                    <?php
                                }

                            } else {
                                ?>

                                <tr>
                                    <td colspan="5">
                                        No users found.
                                    </td>
                                </tr>

                                <?php
                            }

                            ?>

                        </tbody>

                    </table>

            </div>                        

        </section>
        
        <!-- Approval Panel -->

        <section class="dashboard__panel" id="panel-approval" hidden>

            <div class="card">
                <div class="card-header">
                    <h3>Pending Approvals</h3>
                </div>

                <div class="card-body">
                    <div class="property-grid">

                        <?php
                        // getAll('propertytable') এর বদলে filtered query লাগবে
                        $pendingProperties = getWhere('properties', 'approval_status', 'Pending');

                        if ($pendingProperties && mysqli_num_rows($pendingProperties) > 0) {
                            while ($property = mysqli_fetch_assoc($pendingProperties)) {
                                ?>
                                <div class="property-card">

                                    <img src="<?= htmlspecialchars($property['image']) ?>.jpg" alt="Property">

                                    <div class="property-card__body">
                                        <p class="property-card__address">
                                            <?= htmlspecialchars($property['description']) ?>
                                        </p>
                                        <p class="property-card__price">
                                            <?= htmlspecialchars($property['property_size']) ?> sqft
                                        </p>

                                        <form method="POST" action="../Controller/propertyApprovalController.php" class="approval-actions">
                                            <input type="hidden" name="property_id" value="<?= htmlspecialchars($property['property_id']) ?>">
                                            <button type="submit" name="action" value="approve" class="btn-approve">Approve</button>
                                            <button type="submit" name="action" value="reject" class="btn-reject">Reject</button>
                                        </form>

                                    </div>

                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <p>No pending properties.</p>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>

        </section>

    </main>

</div>


<script>

const navItems = document.querySelectorAll('.nav-item');
const panels = document.querySelectorAll('.dashboard__panel');

navItems.forEach((item) => {

    item.addEventListener('click', () => {

        // Remove active state from all buttons
        navItems.forEach((el) => {
            el.classList.remove('nav-item--active');
            el.removeAttribute('aria-current');
        });

        // Add active state to clicked button
        item.classList.add('nav-item--active');
        item.setAttribute('aria-current', 'page');

        // Get target panel
        const targetId = item.dataset.target;

        // Show only selected panel
        panels.forEach((panel) => {
            panel.hidden = panel.id !== targetId;
        });

    });

});

const urlParams = new URLSearchParams(window.location.search);
const panelFromUrl = urlParams.get('panel');

if (panelFromUrl) {
    navItems.forEach((item) => {
        if (item.dataset.target === panelFromUrl) {
            item.click();
        }
    });
}


// Profile dropdown

const profileWrapper = document.getElementById('profileDropdown');
const profileBtn = document.getElementById('profileBtn');
const profileMenu = document.getElementById('profileMenu');

profileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const isOpen = profileMenu.classList.toggle('show');
    profileBtn.setAttribute('aria-expanded', isOpen);
});

document.addEventListener('click', (e) => {
    if (!profileWrapper.contains(e.target)) {
        profileMenu.classList.remove('show');
        profileBtn.setAttribute('aria-expanded', 'false');
    }
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        profileMenu.classList.remove('show');
        profileBtn.setAttribute('aria-expanded', 'false');
    }
});

</script>

</body>
</html>