export function getTable(data) {
    const table = document.createElement('table');
    const tbody = document.createElement('tbody');
    const thead = document.createElement('thead');


    const tr = thead.insertRow();

    const th = document.createElement('th')
    th.textContent = 'Name';

    const th1 = document.createElement('th')
    th1.textContent = 'Comment';

    const th2 = document.createElement('th')
    th2.textContent = 'Date';

    tr.append(th, th1, th2);


    data.forEach(item => {

        let tr = tbody.insertRow();
        let td = tr.insertCell();
        td.textContent = `${item.name}`;

        let td1 = tr.insertCell();
        td1.textContent = `${item.comment}`;

        let td2 = tr.insertCell();
        td2.textContent = `${item.date}`;

    })
    table.classList.add('review-table');
    table.append(thead, tbody);

    return table;
}