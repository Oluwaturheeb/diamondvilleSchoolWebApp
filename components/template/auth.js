var config = {
    apiKey: "AIzaSyAMmorKmXgilWoNAoAmAcB4jcRYNTX27Ak",
    authDomain: "amatnow.com",
    databaseURL: "https://matnow-default-rtdb.firebaseio.com",
    projectId: "matnow",
    storageBucket: "matnow.appspot.com",
    messagingSenderId: "669264691830",
    appId: "1:669264691830:web:5ea9bb33eddbdf2d92d557",
    measurementId: "G-5XJSE5C8T5"
};

firebase.initializeApp(config);

window.recaptchaVerifier = new firebase.auth.recaptchaVerifier('captcha', {
    size: 'normal',
    callback: res => {
        submitPhoneNumber();
    }
});

function submitPhoneNumber() {
    var num = '+2348121001052';
    var captcha = window.recaptchaVerifier;
    
    firebase.auth().signInWithPhoneNumber(num, captcha)
    .then(confirmationResult => {
        window.confirmationResult = confirmationResult;
    })
    .catch (error => {
        console.log(error)
    });
}

function code () {
    var code = 111111;
    confirmationResult.confirm(code)
    .then(res => {
        var user =result.user
        console.log(user)
    })
    .catch (err => {
        console.log(err);
    });
}

firebase.auth().onAuthStateChanged(function(user) {
    if (user) console.log(user);
    else console.log("USER NOT LOGGED IN");
});
