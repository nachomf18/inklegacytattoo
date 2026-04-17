const id = new URLSearchParams(window.location.search).get("id");

if (id) {
    document.querySelector("select").value = id;
}

const emailInput = document.getElementById("email");
emailInput.addEventListener("input", () =>  {
    const placeholder = emailInput.nextElementSibling;
    if (emailInput.value !== "") {
        placeholder.style.transform = "translateY(-70px)";
        placeholder.style.color = "var(--old-gold)";
        placeholder.style.fontSize = "16px";
        placeholder.style.transition = "all 0.3s ease-in-out";
    } else {
        placeholder.style.transform = "translateY(-45px)";
        placeholder.style.fontSize = "18px";
        placeholder.style.color = "rgba(13, 13, 13, 0.5)";
        placeholder.style.transition = "all 0.3s ease-in-out";
    }
});