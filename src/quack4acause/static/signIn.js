function onSignIn(googleUser) {
    var id_token = googleUser.getAuthResponse().id_token;
    console.log(id_token);
    var tokenElement = document.getElementById("token");
    tokenElement.value = id_token;

    console.log(tokenElement.value);

    document.getElementById("loginForm").submit();
}

function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        console.log('User signed out.');
    });
}
