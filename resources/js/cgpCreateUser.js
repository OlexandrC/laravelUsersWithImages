window.addEventListener("load", () => {
    bindFromEvent();
});

let bindFromEvent = () => {
    let userImageSaveButton = document.getElementById("userImageSaveButton");
    userImageSaveButton.addEventListener("click", function (e) {
        let controls = checkInputs();
        if (!controls) {
            showUserMassage('Please select an image, and fill in email or name and city.');
            return;
        }

        e.preventDefault();

        const formData = new FormData();
        formData.append("name", controls.name.value);
        formData.append("city", controls.city.value);
        formData.append("image", controls.image.files[0].name);
        if (controls.email.value !== "") {
            formData.append("email", controls.email.value);
        }

        fetch("/api/users", {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((data) => {
            showUserMassage('Data saved successfully!');
            console.log("Success:", data);
        })
        .catch((error) => {
            showUserMassage('Something went wrong!');
            console.error("Error:", error);
        });
    });
}


let checkInputs = function() {
    let userNameElement = document.getElementById("userName");
    let userCityElement = document.getElementById("userCity");
    let userImageElement = document.getElementById("userImage");
    let userEmailElement = document.getElementById("userEmail");

    if (!userNameElement || !userCityElement || !userImageElement) {
        return false;
    }

    if (userImageElement.files.length === 0 ) {
        return false;
    }


    if (userNameElement.value === "" ||
        userCityElement.value === "") {
        return false;
    }
    

    return {
        name: userNameElement, 
        city: userCityElement,
        image: userImageElement,
        email: userEmailElement,
    }
}


let showUserMassage = function(message)
{
    let userMessageOverlay = document.getElementById('userMessageOverlay');
    if (!userMessageOverlay) { 
        console.log("userMessageOverlay not found");
        return;
    }

    let userMessage = document.getElementById('userMessage');
    if (!userMessage) { 
        console.log("userMessage not found");
        return;
    }

    userMessageOverlay.style.display = "flex";
    userMessage.innerHTML = message;
}
