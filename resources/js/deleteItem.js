const deleteModalDiv = document.getElementById("deleteModalDiv");
const deleteButtons = document.querySelectorAll(".deleteButton");
const cancelDelete = document.getElementById("cancelDelete");
const deleteConfirm = document.getElementById("deleteConfirm");

cancelDelete.addEventListener("click", () => {
    toggleDeleteForm();
});

function toggleDeleteForm() {
    if (deleteModalDiv.classList.contains("hidden")) {
        deleteModalDiv.classList.remove("hidden");
        deleteModalDiv.classList.add("flex");
    } else {
        deleteModalDiv.classList.add("hidden");
        deleteModalDiv.classList.remove("flex");
    }
}

deleteButtons.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        const id = btn.getAttribute("data-id");
        const deleteForm = document.querySelector(".deleteForm");
        deleteForm.action = `${deleteRouteBaseUrl}/${id}`;
        toggleDeleteForm();
        deleteConfirm.addEventListener("click", (e) => {
            e.preventDefault();
            deleteItem(id);
        });
    });
});

function deleteItem(id) {
    fetch(`${deleteRouteBaseUrl}/${id}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    }).then((response) => {
        if (response.ok) {
            if (deleteConfirm.getAttribute("data-form") == "show") {
                window.location.href = deleteRouteBaseUrl;
            } else {
                document.getElementById(`item-${id}`).remove();
                toggleDeleteForm();
            }
        }
    });
}
