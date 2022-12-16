//import firebase from "firebase/compat";

function desplegablePerfil() {
    document.getElementById("myDesplegablePerfil").classList.toggle("show");
}

window.onclick = function(e) {
    if (!e.target.matches('.dropbtn')) {
        var myDropdown = document.getElementById("myDesplegablePerfil");
        if (myDropdown.classList.contains('show')) {
            myDropdown.classList.remove('show');
        }
    }
}

async function onClickBLE() {

    try {
        console.log("Requesting device...");
        const device = await navigator.bluetooth.requestDevice({
            filters: [{services: ['2959a35e-cfb5-4f52-a028-531856a2547d'] }]
        });

        console.log("Connecting to GATT Server...");
        const server = await device.gatt.connect();

        console.log("Getting UUID Service...");
        const service = await server.getPrimaryService('2959a35e-cfb5-4f52-a028-531856a2547d');

        console.log("Getting characteristic...");
        const characteristic = await service.getCharacteristic('c1534b39-34b4-4bcd-99d8-b3e2a9b34902');

        //PRUEBA EVENT LISTENER -- WORKS
        //await characteristic.startNotifications();
        //characteristic.addEventListener('characteristicvaluechanged', handleCharacteristicValueChanged);
        //------------------

        //console.log("Getting descriptor...");
        //const descriptor = await characteristic.getDescriptor('8ee70684-3017-4f4f-aa42-3ad0370c816f');

        //const valueDesc = await descriptor.readValue();
        //const decoder = new TextDecoder('utf-8');
        //console.log(`User description: ${decoder.decode(valueDesc)}`);

        let valueChar = await characteristic.readValue();
        let codebar_readed = valueChar.getUint32(0, true).toString();
        console.log("Char: " + codebar_readed);

        let urlLocation = window.location;

        let params = new URLSearchParams(location.search);
        var contract = params.get('mreaded');
        if (contract == null) { //no hi ha variable a la url
            window.location.replace(urlLocation + "&mreaded=" + codebar_readed);
        } else {
            var href = new URL(urlLocation);
            href.searchParams.set('mreaded', codebar_readed);
            window.location.replace(href.toString());
        }
    } catch (error) {
        console.log(error);
    }
}

function handleCharacteristicValueChanged(event) {
    const value = event.target.value;
    const valueParsed = value.getUint32(0, true).toString();
    console.log('Received: ' + valueParsed);
    //document.write('Value scanned: ' + value.getUint32(0, true).toString());
    $('#motherboard').html('Value received: ' + valueParsed);
}

async function onClickBLErmvPill() {

    try {
        console.log("Requesting device...");
        const device = await navigator.bluetooth.requestDevice({
            filters: [{services: ['2959a35e-cfb5-4f52-a028-531856a2547d'] }]
        });

        console.log("Connecting to GATT Server...");
        const server = await device.gatt.connect();

        console.log("Getting UUID Service...");
        const service = await server.getPrimaryService('2959a35e-cfb5-4f52-a028-531856a2547d');

        console.log("Getting characteristic...");
        const characteristic = await service.getCharacteristic('c1534b39-34b4-4bcd-99d8-b3e2a9b34902');

        console.log("Getting descriptor...");
        const descriptor = await characteristic.getDescriptor('8ee70684-3017-4f4f-aa42-3ad0370c816f');

        const valueDesc = await descriptor.readValue();
        const decoder = new TextDecoder('utf-8');
        console.log(`User description: ${decoder.decode(valueDesc)}`);

        let valueChar = await characteristic.readValue();
        let codebar_readed = valueChar.getUint32(0, true).toString();
        console.log("Char: " + codebar_readed);

        let urlLocation = window.location;

        let params = new URLSearchParams(location.search);
        var contract = params.get('rmv_pill');
        if (contract == null) { //no hi ha variable a la url
            window.location.replace(urlLocation + "&rmv_pill=" + codebar_readed);
        } else {
            var href = new URL(urlLocation);
            href.searchParams.set('rmv_pill', codebar_readed);
            window.location.replace(href.toString());
        }
    } catch (error) {
        console.log(error);
    }
}

async function onClickBLEaddBox() {

    try {
        console.log("Requesting device...");
        const device = await navigator.bluetooth.requestDevice({
            filters: [{services: ['2959a35e-cfb5-4f52-a028-531856a2547d'] }]
        });

        console.log("Connecting to GATT Server...");
        const server = await device.gatt.connect();

        console.log("Getting UUID Service...");
        const service = await server.getPrimaryService('2959a35e-cfb5-4f52-a028-531856a2547d');

        console.log("Getting characteristic...");
        const characteristic = await service.getCharacteristic('c1534b39-34b4-4bcd-99d8-b3e2a9b34902');

        console.log("Getting descriptor...");
        const descriptor = await characteristic.getDescriptor('8ee70684-3017-4f4f-aa42-3ad0370c816f');

        const valueDesc = await descriptor.readValue();
        const decoder = new TextDecoder('utf-8');
        console.log(`User description: ${decoder.decode(valueDesc)}`);

        let valueChar = await characteristic.readValue();
        let codebar_readed = valueChar.getUint32(0, true).toString();
        console.log("Char: " + codebar_readed);

        let urlLocation = window.location;

        let params = new URLSearchParams(location.search);
        var contract = params.get('add_box');
        if (contract == null) { //no hi ha variable a la url
            window.location.replace(urlLocation + "&add_box=" + codebar_readed);
        } else {
            var href = new URL(urlLocation);
            href.searchParams.set('add_box', codebar_readed);
            window.location.replace(href.toString());
        }
    } catch (error) {
        console.log(error);
    }
}