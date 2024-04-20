<?php

  session_start();

  if (!isset($_SESSION['username'])){

      // session_unset();
      // session_destroy();
      // session_regenerate_id();
      header("Location:login");

  }

    require_once("database/database.php");

    $countDirecteurNationale = 0;
    $countDirecteurLocale = 0;

?>

<!DOCTYPE html>
<html lang="fr">

  
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>JCI Bénin</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery/">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="assets/images/favicon.svg" />

    <!-- *************
			************ Common Css Files *************
		************ -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="assets/fonts/bootstrap/bootstrap-icons.css" />

    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/main.min.css" />

    <!-- *************
			************ Vendor Css Files *************
		************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="assets/vendor/overlay-scroll/OverlayScrollbars.min.css" />

    <!-- Inclure SweetAlert via un lien CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
  </head>

  <body>

    <!-- Loading wrapper start -->
    <!-- <div id="loading-wrapper">
      <div class="spinner">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
        <div class="line4"></div>
        <div class="line5"></div>
        <div class="line6"></div>
      </div>
    </div> -->
    <!-- Loading wrapper end -->

    <!-- Page wrapper start -->
    <div class="page-wrapper">

      <!-- Page header starts -->
      <div class="page-header">

        <!-- Sidebar brand starts -->
        <div class="brand">
          <a href="ajout" class="logo">
            <img src="assets/images/logo.png" class="d-none d-md-block me-4" alt="JCI BENIN CENTER" />
            <img src="assets/images/logo-sm.svg" class="d-block d-md-none me-4" alt="JCI BENIN CENTER" />
          </a>
        </div>
        <!-- Sidebar brand ends -->

        <div class="toggle-sidebar" id="toggle-sidebar">
          <i class="bi bi-list"></i>
        </div>

        <!-- Header actions ccontainer start -->
        <div class="header-actions-container">

          <!-- Search container start -->
          <div class="search-container me-4 d-xl-block d-lg-none">

            <!-- <form method="post">
                 Search input group start 
                <input type="text" class="form-control" placeholder="Recherche" name="recherche"/>
                 Search input group end 
            </form> -->

          </div>
          <!-- Search container end -->


          <!-- Header profile start -->
          <div class="header-profile d-flex align-items-center">
            <div class="dropdown">
              <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                <span class="user-name d-none d-md-block">Admin Candide</span>
                <span class="avatar">
                  <img src="assets/images/user7.png" alt="User Avatar" />
                  <span class="status online"></span>
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
                <div class="header-profile-actions">
                  <a href="disconnect">Déconnexion</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Header profile end -->

        </div>
        <!-- Header actions ccontainer end -->

      </div>
      <!-- Page header ends -->

      <!-- Main container start -->
      <div class="main-container">

        <!-- Sidebar wrapper start -->
        <nav class="sidebar-wrapper">

          <!-- Sidebar menu starts -->
          <div class="sidebar-menu">
            <div class="sidebarMenuScroll">
              <ul>

                <!-- Nouveaux -->

                <!-- Ajout de membre -->

                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-collection"></i>
                    <span class="menu-text">Ajout de membre</span>
                    <!-- <span class="badge red">15</span> -->
                  </a>
                  <div class="sidebar-submenu">
                    <ul>

                        <li>
                            <a href="ajout">Inscription</a>
                        </li>
                        <li>
                            <a href="directeurnationale">Comité Directeur Nationale</a>
                        </li>
                        <li>
                            <a href="directeurlocal">Comité Directeur locale</a>
                        </li>
                        <li>
                            <a href="institutionnationale">Institution Nationale</a>
                        </li>
                      
                    </ul>
                  </div>
                </li>

                <!-- Liste des membres -->

                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-collection"></i>
                    <span class="menu-text">Liste des membres</span>
                    <!-- <span class="badge red">15</span> -->
                  </a>
                  <div class="sidebar-submenu">
                    <ul>

                        <li>
                            <a href="list-member">Membres</a>
                        </li>
                        <li>
                            <a href="list-postulant">Postulants</a>
                        </li>
                        <li>
                            <a href="list-comdirectnational">Comité Directeur National</a>
                        </li>
                        <li>
                            <a href="list-comdirectlocal">Comité Directeur Local</a>
                        </li>
                        <li>
                            <a href="list-institutionnationale">Institution Nationale</a>
                        </li>
                      
                    </ul>
                  </div>
                </li>

                <!-- Anciens -->

                <!-- <li class="active-page-link">
                  <a href="index">
                    <i class="bi bi-house"></i>
                    <span class="menu-text">Analytics</span>
                  </a>
                </li>
                <li>
                  <a href="widgets.html">
                    <i class="bi bi-box"></i>
                    <span class="menu-text">Widgets</span>
                  </a>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-collection"></i>
                    <span class="menu-text">UI Elements</span>
                    <span class="badge red">15</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="accordions.html">Accordions</a>
                      </li>
                      <li>
                        <a href="alerts.html">Alerts</a>
                      </li>
                      <li>
                        <a href="buttons.html">Buttons</a>
                      </li>
                      <li>
                        <a href="badges.html">Badges</a>
                      </li>
                      <li>
                        <a href="cards.html">Cards</a>
                      </li>
                      <li>
                        <a href="advanced-cards.html">Advanced Cards</a>
                      </li>
                      <li>
                        <a href="carousel.html">Carousel</a>
                      </li>
                      <li>
                        <a href="dropdowns.html">Dropdowns</a>
                      </li>
                      <li>
                        <a href="icons.html">Icons</a>
                      </li>
                      <li>
                        <a href="list-items.html">List Items</a>
                      </li>
                      <li>
                        <a href="modals.html">Modals</a>
                      </li>
                      <li>
                        <a href="offcanvas.html">Off Canvas</a>
                      </li>
                      <li>
                        <a href="placeholders.html">Placeholders</a>
                      </li>
                      <li>
                        <a href="progress.html">Progress Bars</a>
                      </li>
                      <li>
                        <a href="spinners.html">Spinners</a>
                      </li>
                      <li>
                        <a href="tabs.html">Tabs</a>
                      </li>
                      <li>
                        <a href="tooltips.html">Tooltips</a>
                      </li>
                      <li>
                        <a href="typography.html">Typography</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-stickies"></i>
                    <span class="menu-text">Pages</span>
                    <span class="badge blue">8</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="support.html">Support</a>
                      </li>
                      <li>
                        <a href="create-invoice.html">Create Invoice</a>
                      </li>
                      <li>
                        <a href="view-invoice.html">View Invoice</a>
                      </li>
                      <li>
                        <a href="invoice-list.html">Invoice List</a>
                      </li>
                      <li>
                        <a href="subscribers.html">Subscribers</a>
                      </li>
                      <li>
                        <a href="contacts.html">Contacts</a>
                      </li>
                      <li>
                        <a href="pricing.html">Pricing</a>
                      </li>
                      <li>
                        <a href="profile.html">Profile</a>
                      </li>
                      <li>
                        <a href="account-settings.html">Account Settings</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-calendar4"></i>
                    <span class="menu-text">Events</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="events.html">Events List</a>
                      </li>
                      <li>
                        <a href="calendar.html">Daygrid</a>
                      </li>
                      <li>
                        <a href="calendar-draggable.html">External Draggable</a>
                      </li>
                      <li>
                        <a href="calendar-google.html">Google Calendar</a>
                      </li>
                      <li>
                        <a href="calendar-list-view.html">List View</a>
                      </li>
                      <li>
                        <a href="calendar-selectable.html">Selectable</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-columns-gap"></i>
                    <span class="menu-text">Forms</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="form-inputs.html">Form Inputs</a>
                      </li>
                      <li>
                        <a href="form-checkbox-radio.html">Checkbox &amp; Radio</a>
                      </li>
                      <li>
                        <a href="form-file-input.html">File Input</a>
                      </li>
                      <li>
                        <a href="form-validations.html">Validations</a>
                      </li>
                      <li>
                        <a href="bs-select.html">Bootstrap Select</a>
                      </li>
                      <li>
                        <a href="date-time-pickers.html">Date Time Pickers</a>
                      </li>
                      <li>
                        <a href="input-mask.html">Input Masks</a>
                      </li>
                      <li>
                        <a href="input-tags.html">Input Tags</a>
                      </li>
                      <li>
                        <a href="summernote.html">Summernote</a>
                      </li>
                      <li>
                        <a href="form-layouts.html">Form Layouts</a>
                      </li>
                      <li>
                        <a href="form-layout2.html">Form Layout 2</a>
                      </li>
                      <li>
                        <a href="form-layout3.html">Form Layout 3</a>
                      </li>
                      <li>
                        <a href="form-layout4.html">Form Layout Horizontal</a>
                      </li>
                      <li>
                        <a href="form-layout5.html">Form Layout Tabs</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-window-split"></i>
                    <span class="menu-text">Tables</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="tables.html">Tables</a>
                      </li>
                      <li>
                        <a href="data-tables.html">Data Tables</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-map"></i>
                    <span class="menu-text">Graphs &amp; Maps</span>
                    <span class="badge green">15</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="apex.html">Apex</a>
                      </li>
                      <li>
                        <a href="morris.html">Morris</a>
                      </li>
                      <li>
                        <a href="maps.html">Maps</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-layout-sidebar"></i>
                    <span class="menu-text">Layouts</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="layout.html">Default Layout</a>
                      </li>
                      <li>
                        <a href="layout-grid.html">Grid Layout</a>
                      </li>
                      <li>
                        <a href="layout-mega-menu.html">Mega Menu</a>
                      </li>
                      <li>
                        <a href="layout-full-screen.html">Full Screen</a>
                      </li>
                      <li>
                        <a href="hero-header.html">Hero Header</a>
                      </li>
                      <li>
                        <a href="layout-datepicker.html">Layout Datepicker</a>
                      </li>
                      <li>
                        <a href="layout-welcome.html">Welcome Layout</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-upc-scan"></i>
                    <span class="menu-text">Authentication</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="login.html">Login</a>
                      </li>
                      <li>
                        <a href="signup.html">Signup</a>
                      </li>
                      <li>
                        <a href="forgot-password.html">Forgot Password</a>
                      </li>
                      <li>
                        <a href="error.html">Error</a>
                      </li>
                      <li>
                        <a href="maintenance.html">Maintenance</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a href="support.html">
                    <i class="bi bi-code-square"></i>
                    <span class="menu-text">Support</span>
                  </a>
                </li> -->
              </ul>
            </div>
          </div>
          <!-- Sidebar menu ends -->

        </nav>
        <!-- Sidebar wrapper end -->