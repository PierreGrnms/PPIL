
function init(id) {
    if (id) {
        updateDestinataire(document.querySelector("#\\3"+id.toString()));
    }
}

function updateScroll(){
    let element = document.querySelector(".messages");
    element.scrollTop = element.scrollHeight;
}


function updateDestinataire(e) {

    fetch('/conversation-change-event', {method: 'POST',body: JSON.stringify(
            {"destinataire": parseInt(e.id)} // DOIT ETRE LE DEST
        )}).then(r => {
        return r.json()
    }).then(data => {
        document.querySelector(".messages").innerHTML = "";
        updateMessage(data);
        for (let child of e.parentNode.children) {
            child.classList.remove('activated')
        }
        e.classList.add('activated')
        document.querySelector('#destinataire-courant').innerText = e.children[1].innerText;
        document.querySelector('#messager').disabled = false;
    }).catch(e => {
        console.log('error' + e);
    })



}


function throw_message() {
    input = document.querySelector(".enter")
    content = input.value
    if (content.trim() !== "") {
        input.value = "";

        container = document.querySelector(".messages");
        message = document.createElement("div");
        text = document.createElement("p");

        message.classList.add("messageR");

        text.innerHTML = content;
        message.appendChild(text);
        container.appendChild(message);

        updateScroll()

        fetch('/send-message', {
            method: 'POST',
            body: JSON.stringify(
                {'message' : content}
            )
        }).catch(e => {
            console.log('error' + e);
        })
    }
}

function updateMessage(data) {
    let user = data['user'];
    let container = document.querySelector(".messages");

    data['messages'].forEach(message => {
        if (message.text !== "") {
            let messagebox = document.createElement("div");
            let text = document.createElement("p");

            if (message[1] === user) {
                messagebox.classList.add("messageR");
            } else {
                messagebox.classList.add("messageL");
            }

            text.innerHTML = message.text;
            messagebox.appendChild(text);
            container.appendChild(messagebox);
        }

    })
    updateScroll();

}

function majMessage(data1) {

    if (document.querySelector("#\\3"+data1.sourceId.toString())) {
        let e=document.querySelector("#\\3"+data1.sourceId.toString());
        updateDestinataire(e);
    } else {
        fetch('/createSession', {method: 'POST', body: JSON.stringify(
                {"dest": parseInt(data1.sourceId)}
            )}).then(r => {
            location.href = 'conversation'
        }).catch(e => {
            console.log('error' + e);
        })
    }
}

document.querySelector(".enter").addEventListener("keyup", event => {
    if (event.key === "Enter") {
        throw_message()
    }
});
