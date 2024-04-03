
function init(id) {
    console.log("test")
    if (id) {
        updateDestinataire(document.querySelector("#\\3"+id.toString()));
    }
}

function updateScroll(){
    let element = document.querySelector(".messages");
    element.scrollTop = element.scrollHeight;
}


function updateDestinataire(e) {

    if (!e.classList.contains("activated")) {
        fetch('/conversation-change-event', {method: 'POST',body: JSON.stringify(
                {"destinataire": parseInt(e.id)}
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
        message.append(text);
        container.append(message);

        updateScroll()


        fetch('/send-message', {
            method: 'POST',
            body: JSON.stringify(
                {'message' : content}
            )
        }).then(r => {

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
            messagebox.append(text);
            container.append(messagebox);
        }

    })
    updateScroll();

}

function majMessage(data) {
    console.log("received")
    console.log(data)
    //updateMessage(data) // besoin de userid, messages[]
}

document.querySelector(".enter").addEventListener("keyup", event => {
    if (event.key === "Enter") {
        // event.preventDefault(); avoid refreshing
        throw_message()
    }
});
