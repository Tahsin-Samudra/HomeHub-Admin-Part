<?php

include(__DIR__ . "/Auth/fetchAllAdmin.php");

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
                data-target="panel-message">
                All Users
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
                    src=""
                    alt=""
                    height="18"
                    width="18">
            </button>

            <button class="icon-btn" type="button" aria-label="Settings">
                <img
                    src=""
                    alt=""
                    height="20"
                    width="20">
            </button>

            <div class="avatar">
                <img
                    src=""
                    alt="User profile"
                    height="20"
                    width="20">
            </div>

        </div>

    </header>


    <main class="dashboard__content">

        <!-- Dashboard Panel -->

        <section
            class="dashboard__panel"
            id="panel-dashboard">

            <div>
                Dang! You have successfully logged in.
                Welcome to the dashboard.
            </div>

        </section>


        <!-- Properties Panel -->

        <section
            class="dashboard__panel"
            id="panel-properties"
            hidden>

            <!-- All Properties content -->

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

</script>

</body>
</html>