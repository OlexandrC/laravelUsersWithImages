window.addEventListener("load", () => {
    loadUsers();
});

function loadUsers() {
    fetch("/api/users")
        .then((response) => response.json())
        .then((data) => {

            let loader = document.getElementById("loaderAnimation");
            if (loader) {
                loader.remove();
            }

            let table = document
                .getElementById("usersTable")
                .getElementsByTagName("tbody")[0];

            for(let user of data) {
                const row = table.insertRow();
                let cellName = row.insertCell();
                cellName.textContent = user.name;
                applyStyleToCell(cellName);

                let cellCity = row.insertCell();
                cellCity.textContent = user.city;
                applyStyleToCell(cellCity);

                let cellImagesCount = row.insertCell();
                cellImagesCount.textContent = user.images_count;
                applyStyleToCell(cellImagesCount);

                let cellEmail = row.insertCell();
                cellEmail.textContent = user.email;
                applyStyleToCell(cellEmail);
            }
        });

}

let applyStyleToCell = function(cell) {
    cell.classList.add("border-r");
    cell.classList.add("border-gray-300");
}