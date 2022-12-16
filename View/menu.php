<div class="headerWeb" style="grid-area: Header">

    <h4 id="logo"> SMART MEDICINE BOX </h4>

    <div class="header-right">

        <div class="dropdown">

            <?php if(isset($_SESSION['user_id'])) : ?>

                <button class="dropbtn" onclick="desplegablePerfil()"> Profile </button>

                <div class="dropdown-content" id="myDesplegablePerfil">
                    <a href="index.php?action=Log-Out"> Log Out </a>
                </div>

            <?php endif ?>

            <?php if(!isset($_SESSION['user_id'])) : ?>

                <a href="index.php?action=Log-In">Iniciar sesion</a>

            <?php endif ?>

        </div>
    </div>
</div>

