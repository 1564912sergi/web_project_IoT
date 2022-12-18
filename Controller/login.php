<?php

include __DIR__.'/../View/login.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //data send by the user
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

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

        //let string_medicines = "";
        //let string_pills = "";
        let user = null;
        get(child(dbRef, 'users/patients/')).then((snapshot) => {
            if (snapshot.exists()) {
                Object.keys(snapshot.val()).forEach((key) => { //show all the lines of the database table users

                    //if password send by the user is in the database:
                    if ((`${snapshot.val()[key].credentials.email}` === "<?php echo $email ?>") &&
                        (`${snapshot.val()[key].credentials.password}` === "<?php echo $password ?>"))
                    {
                        user = key;
                    }

                });
            } else {
                console.log("No data available");
            }
        }).catch((error) => {
            console.error(error);
        });
    setTimeout(function() {
        window.location.replace("index.php?action=Home&user=" + user);
        //window.location.replace("index.php?action=Home&user=" + user + "&medicines=" + string_medicines);
    }, 3000);
    </script>

<?php

} //end if

?>






