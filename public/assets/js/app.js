import {getTable} from "./getTable.js";
import {createComment} from "./createComment.js";

const container = document.querySelector('.feedback-wrapper');
const form = document.querySelector('.add-comment');

fetch('/api/get.php')
    .then(response => response.json())
    .then(data => {
        container.append(getTable(data));
    });


form.addEventListener('submit', (e) => {
    e.preventDefault();

    const tbody = document.querySelector('tbody');

    createComment(e.target, tbody);
})

