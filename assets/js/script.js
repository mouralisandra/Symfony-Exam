document.querySelectorAll("td").forEach((el) =>
    el.addEventListener("click", () => {
        el.classList.toggle("highlight");
    })
);