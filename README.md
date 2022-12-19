# web_project_IoT
In this repository we find all the code related to the implementation of Edge. It is a web page where the stock of medicines of a user is shown.
The user can add or delete medications using the buttons found on the main screen.
By pressing these buttons, we connect with a NRF52-DK motherboard which sends us, through a characteristic, a barcode that simulates the barcode of a medicine.
This web page is made using php and javascript.
We have used a model view controller.
In the controller we carry out all the code to obtain data from the database, this data is sent to the view to print it on the screen and show it to the user.
In the view and controller home.php files we manage all the part of showing the medicines to the user. In the view and controller login.php files we manage all the user login part.
In the model, we find a css file where we style the page. We also found the functions.js file. In this file we manage the connection with the NRF52-DK motherboard, where we connect to it, we connect to its service identified by a UUID code, and we connect to the characteristic of this service from which we read the barcode that we receive.
