import { doShortcodesFromLocalstorage } from "../utils.js";

export default async function generate() {

    // Get input text from contract_filename input
    const contract_filename = document.querySelector("#contract_filename").value;

    const html = addSlashes(document.querySelector(".editor-container .ql-editor").innerHTML);
    const idFromUrlParam = getUrlParam('id');
    // Prepare POST request
    const postData = {
        id: idFromUrlParam,
        html,
        name: contract_filename
    };

    const response = await fetch("/save_contract.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(postData)
    });

    const result = await response.json();
    console.log(result.message);
    window.location.href = "/my_contracts.php";

}

const addSlashes = (str) => {
    return str
        .replace(/'/g, "\\'")
}

function getUrlParam(param) {
    const params = new URLSearchParams(window.location.search);
    return params.get(param);
}