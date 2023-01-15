<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">
            Sportcenter
        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/categories">sportapparaat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">contact</a>
                </li>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']->role == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/home">beheer</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a class="nav-link" href="/logout">uitloggen
                            (<?php echo $_SESSION['user']->first_name . " " . $_SESSION['user']->last_name; ?>)
                        </a>
                    <?php else: ?>                    
                    <a class="nav-link" href="/login">inloggen</a>
                    <?php endif; ?>
                </li>
                <?php if (!isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link"  href="/register">registreren</a>
                    </li>
                <?php endif; ?>                    
            </ul>
        </div>
    </div>
</nav>