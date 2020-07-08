export function createComment(form_Element, parent) {
    const form = new FormData(form_Element);

    fetch('/api/add.php', {
        method: 'POST',
        body: form
    })
        .then(response => response.json())
        .then(data => {

            const tr = document.createElement('tr');
            const td = tr.insertCell();
            td.textContent = data.name;

            const td1 = tr.insertCell();
            td1.textContent = data.comment;

            const td2 = tr.insertCell();
            td2.textContent = data.date;
            parent.append(tr);
        })
}