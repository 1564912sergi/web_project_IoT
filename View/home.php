<div style="grid-area: body">
    <br>

    <div id="buttonsPills">
        <button id="buttonBLE" onclick="onClickBLE()" > REMOVE BOX </button>
        <button id="buttonBLErmv" onclick="onClickBLErmvPill()" > REMOVE PILL </button>
        <button id="buttonBLEadd" onclick="onClickBLEaddBox()" > ADD BOX </button>
    </div>

    <br>

    <span id="motherboard"></span>
    <hr>
    <h1> MY MEDICINES: </h1>


    <?php

    if (isset($DIM)) {

        for ($i=0; $i < $DIM; $i++) {   ?>

            <div id="medicines">
                <a> <?php echo $names_medicines[$i] ?> </a>
                <div id="quantity">
                    <a> Pills: <?php echo $pills_medicines[$i] ?> </a>
                </div>
            </div>
            <hr>

    <?php
        }
    } else { ?>

        <p> LOADING... </p>

    <?php
    } ?>

</div>
