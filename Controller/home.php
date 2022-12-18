<?php

if(isset($_SESSION['user_id']) && !isset($_SESSION['name_med']) && !isset($_GET['mreaded'])
    && !isset($_GET['rmv_pill']) && !isset($_GET['add_box']) && !isset($_GET['mpills'])) {

    ?>

    <script type="module">

        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
        import { getDatabase, ref, set, get, child } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-database.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyCX-UYV_jRURt6cqFGyOQdQ9I4nHvVJAuQ",
            authDomain: "medicine-smart-box.firebaseapp.com",
            databaseURL: "https://medicine-smart-box-default-rtdb.europe-west1.firebasedatabase.app",
            projectId: "medicine-smart-box",
            storageBucket: "medicine-smart-box.appspot.com",
            messagingSenderId: "567670754202",
            appId: "1:567670754202:web:3119c752d712996ac4c823"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const dbRef = ref(getDatabase(app));

        let usuario = "<?php echo $_SESSION['user_id']; ?>";
        let string_medicines = [];
        let string_capsules = [];
        let string_pills = [];
        let string_expiration_date = [];
        let id_medicines = [];

        get(child(dbRef, 'users/patients/' + usuario + '/drugs/')).then((snapshot) => {
            if (snapshot.exists()) {
                Object.keys(snapshot.val()).forEach((key) => { //show all the lines of the database table users

                    //string_medicines.push(key);
                    id_medicines.push(key);
                    string_pills.push(`${snapshot.val()[key].pills_left}`);
                    string_expiration_date.push(`${snapshot.val()[key].expiration_date}`);

                    get(child(dbRef, 'drugs/' + key + '/')).then((snapshot1) => {
                        if (snapshot1.exists()) {
                            string_medicines.push(snapshot1.val().name);
                            string_capsules.push(snapshot1.val().n_capsules);
                        } else {
                            console.log("No data available");
                        }
                    }).catch((error) => {
                        console.error(error);
                    });

                });
            } else {
                console.log("No data available");
            }
        }).catch((error) => {
            console.error(error);
        });
        setTimeout(function () {
            string_medicines = JSON.stringify(string_medicines);
            string_pills = JSON.stringify(string_pills);
            string_expiration_date = JSON.stringify(string_expiration_date);
            id_medicines = JSON.stringify(id_medicines);
            string_capsules = JSON.stringify(string_capsules);

            window.location.replace("index.php?action=Home&mname=" + string_medicines + "&mpills=" + string_pills + "&mdate=" + string_expiration_date + "&idmedicines=" + id_medicines + "&ncapsules=" + string_capsules);
        }, 3000);

    </script>
    <?php

}

if(isset($_GET['mname']) && isset($_GET['mpills']) && isset($_GET['mdate'])
    && !isset($_GET['mreaded']) && !isset($_GET['rmv_pill']) && !isset($_GET['add_box'])) {

    $names_medicines = json_decode(stripslashes($_GET['mname']));
    $pills_medicines = json_decode(stripslashes($_GET['mpills']));
    $date_medicines = json_decode(stripslashes($_GET['mdate']));
    $id_medicine = json_decode(stripslashes($_GET['idmedicines']));
    $n_capsules = json_decode(stripslashes($_GET['ncapsules']));

    $DIM = count($names_medicines);

    $_SESSION['name_med'] = $names_medicines;
    $_SESSION['pills_med'] = $pills_medicines;
    $_SESSION['date_med'] = $date_medicines;
    $_SESSION['dim'] = $DIM;
    $_SESSION['idmedicines'] = $id_medicine;
    $_SESSION['n_capsules'] = $n_capsules;
}


if (isset($_GET['mreaded']) || isset($_GET['rmv_pill']) || isset($_GET['add_box'])) {

    ?>

    <script type="module">

        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
        import { getDatabase, ref, set, get, child } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-database.js";

        const firebaseConfig = {
            apiKey: "AIzaSyCX-UYV_jRURt6cqFGyOQdQ9I4nHvVJAuQ",
            authDomain: "medicine-smart-box.firebaseapp.com",
            databaseURL: "https://medicine-smart-box-default-rtdb.europe-west1.firebasedatabase.app",
            projectId: "medicine-smart-box",
            storageBucket: "medicine-smart-box.appspot.com",
            messagingSenderId: "567670754202",
            appId: "1:567670754202:web:3119c752d712996ac4c823"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const db = getDatabase(app);
        const dbref = ref(getDatabase(app));

        var usuarioIdDelete = "<?php echo $_SESSION['user_id']; ?>"; //medicamento a añadir
        var stringIdMedicines = <?php echo $_GET['idmedicines']; ?>;
        var stringPills = <?php echo $_GET['mpills']; ?>;
        var string_ncapsules = <?php echo $_GET['ncapsules']; ?>;
        console.log(string_ncapsules);
        let params = new URLSearchParams(location.search);
        var boxRemoved = params.get('mreaded'); //medicamento a añadir
        var pillRemoved = params.get('rmv_pill');
        var boxAdded = params.get('add_box');

        //Delete Box
        if (boxRemoved != null && pillRemoved == null && boxAdded == null) {
            set(ref(db, 'users/patients/' + usuarioIdDelete + '/drugs/' + boxRemoved), null); //delete element
            console.log("box removed: " + boxRemoved);
        }

        //Delete one pill (if we delete the last pill, delete the box)
        if (boxRemoved == null && pillRemoved != null && boxAdded == null) {
            let pos = 0;
            for (let i = 0; i < stringIdMedicines.length; i++) {
                if (stringIdMedicines[i] == pillRemoved) {
                    pos = i;
                }
            }

            let newValue = stringPills[pos] -1;

            //remove one pill if are more pills
            if (newValue > 0) {
                set(ref(db, 'users/patients/' + usuarioIdDelete + '/drugs/' + pillRemoved + '/pills_left/'), newValue); //delete pill
            }

            //remove the box if is the last pills
            if (newValue == 0) {
                set(ref(db, 'users/patients/' + usuarioIdDelete + '/drugs/' + pillRemoved), null);
            }

            console.log("pill removed: " + pillRemoved);
        }

        //Add pills (if is the same box at the stock) or box
        if (boxRemoved == null && pillRemoved == null && boxAdded != null) {

            if (stringIdMedicines.includes(boxAdded)) { //if box is in the stock
                let pos = 0;
                for (let i = 0; i < stringIdMedicines.length; i++) {
                    if (stringIdMedicines[i] == boxAdded) {
                        pos = i;
                    }
                }

                let n_capsules = parseInt(string_ncapsules[pos], 10);
                let newValue = parseInt(stringPills[pos], 10) + n_capsules;
                set(ref(db, 'users/patients/' + usuarioIdDelete + '/drugs/' + boxAdded + '/pills_left/'), newValue.toString());
            } else { //new box in the stock

                var n_capsules = "";
                var m_name = "";
                var active_p = "";
                var preu = "";
                get(child(dbref, 'drugs/' + boxAdded + '/')).then((snapshot) => {
                    if (snapshot.exists()) {
                        n_capsules = snapshot.val().n_capsules;
                        m_name = snapshot.val().name;
                        active_p = snapshot.val().active_principle;
                        preu = snapshot.val().pvp;
                    } else {
                        console.log("No data available");
                    }
                }).catch((error) => {
                    console.error(error);
                });

                setTimeout(function () {
                    console.log(n_capsules);
                    set(ref(db, 'users/patients/' + usuarioIdDelete + '/drugs/' + boxAdded + '/'), {
                        active_principle: active_p,
                        date_logged_in: '20-05-2022 20:00 AM',
                        date_logged_out: '01-06-2022 20:00 PM',
                        expiration_date: '19-12-2022 20:00 PM',
                        name: m_name,
                        pills_left: n_capsules,
                        pvp: preu,
                    });
                }, 2000);
            }

            console.log("box added: " + boxAdded);
        }


    </script>

    <?php

    unset($_SESSION['name_med']);
    unset($_SESSION['pills_med']);
    unset($_SESSION['date_med']);
    unset($_SESSION['dim']);
    unset($_SESSION['idmedicines']);

    ?>
    <script>
        setTimeout(function () {
            window.location.replace("index.php?action=Home&user=" + "<?php echo $_SESSION['user_id']; ?>");
        }, 3000);
    </script>
    <?php
}


include __DIR__.'/../View/home.php';
