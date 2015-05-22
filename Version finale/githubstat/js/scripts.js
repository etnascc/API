jQuery("#my_menu").load("./js/ressources/menu.html #top_menu");
jQuery("#my_footer").load("./js/ressources/footer.html #down_menu");

function change_background() {
    $('body').css("background", "url(img/background_underground.jpg) no-repeat center center"); 
    $('body').css("webkit-background-size", "cover");
}

function my_function() {
    var f_name = document.getElementById("nom").value;
    var name = document.getElementById("prenom").value;
    var corp = document.getElementById("societe").value;
    var email = document.getElementById("mail").value;
    var msg = document.getElementById("message").value;
    var phone = document.getElementById("tel").value;
    var web = document.getElementById("web").value;

    if (validation(email, msg, phone) && f_name !== '' && name !== '')
        alert('Nom: ' + f_name + '\nPrenom: ' + name + '\nSociété: ' + corp +
                '\nTéléphone: ' + phone + '\nemail: ' + email + '\nSite: ' + web
                + '\nmessage : '+ msg);
}

function validation(email, msg, phone) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var phoneReg = /^\+\d{11}/;

    if (!(email).match(emailReg)) {
        alert("Adresse email invalide !");
        return false;
    }
    else
    {
        if (msg === '')
        {
            alert("Le message est vide !");
            return false;
        }
        else
        {
            if (!(phone).match(phoneReg))
            {
                alert("numero non valide !");
                return false;
            }
            else
                return true;
        }
    }
}