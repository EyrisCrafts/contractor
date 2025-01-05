import Quill from "https://cdn.skypack.dev/pin/quill@v1.3.7-AhkYF0UBjqu955pdu0pJ/mode=imports,min/optimized/quill.js"
// 📙 Package Documentation: https://www.skypack.dev/view/quill
// https://quilljs.com/docs/quickstart/


Quill.register("modules/htmlEditButton", htmlEditButton)
// https://github.com/benwinding/quill-html-edit-button/
import htmlEditButton from "https://cdn.skypack.dev/pin/quill-html-edit-button@v2.2.12-bQePZLc6oeJp4TdDNJk2/mode=imports,min/optimized/quill-html-edit-button.js"
//  📙 Package Documentation: https://www.skypack.dev/view/quill-html-edit-button


import editorSettings from "./editor-settings.js"

import {showToolbar} from "./ios-keyboard-bug.js"

export default function editor(selector) {
    const staticContractHtmlFile = 'data/contract-content.html';
    const editor = new Quill(selector, editorSettings);

    // iOS keyboard bug fixes
    window.addEventListener("scroll", showToolbar);
    editor.on('selection-change', function (range, oldRange) {
        if (range === null && oldRange !== null) {
            showToolbar();
        }
    });

    // Quill Autosave
    const Delta = Quill.import('delta');
    let change = new Delta();

    editor.on('text-change', function (delta) {
        change = change.compose(delta);
    });

    // Save periodically
    setInterval(function () {
        if (change.length() > 0) {
            localStorage.setItem("contract_html", JSON.stringify(editor.getContents()));
            change = new Delta();
        }
    }, 10 * 1000);

    // Save when Ctrl|CMD + S is pressed
    document.addEventListener('keydown', (e) => {
        if (e.key?.toLowerCase() === 's' && e.metaKey) {
            e.preventDefault();
            if (change.length() > 0) {
                localStorage.setItem("contract_html", JSON.stringify(editor.getContents()));
                change = new Delta();
            }
        }
    });

    // Check for unsaved data
    window.onbeforeunload = function () {
        if (change.length() > 0) {
            localStorage.setItem("contract_html", JSON.stringify(editor.getContents()));
            change = new Delta();
        }
    };

    // Load contract HTML
    console.log("Loading contract_html...");
    const contractName = getUrlParam('id'); // Get the 'name' param from the URL
    if (contractName) {
        console.log(`Loading contract for: ${contractName}`);
        getHtmlFromServer(editor, contractName);
    } else {
        console.log("No contract name provided. Loading static file.");
        getHtmlFromFile(editor, staticContractHtmlFile);
    }
}

// Function to fetch the HTML for a specific contract from the server
function getHtmlFromServer(editor, contractName) {
    fetch('/get_contract.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: contractName })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch contract data from server');
            }
            return response.json();
        })
        .then(data => {
            if (data.html) {
                const delta = editor.clipboard.convert(data.html);
                editor.setContents(delta, "silent");
                // input field of contract name contract_filename
                const contractName =  document.querySelector("#contract_filename")
                contractName.value = data.name
                localStorage.setItem("contract_html", JSON.stringify(delta));
            } else {
                throw new Error('Invalid response format: Missing "html" property');
            }
        })
        .catch(error => {
            console.error('Error loading contract:', error);
            alert('Error loading the contract. Loading static content instead.');
            getHtmlFromFile(editor, 'data/contract-content.html');
        });
}

// Function to fetch static HTML file
function getHtmlFromFile(editor, contractHtmlFile) {
    fetch(contractHtmlFile)
        .then(response => response.text())
        .then(data => {
            const delta = editor.clipboard.convert(data);
            editor.setContents(delta, "silent");
            localStorage.setItem("contract_html", JSON.stringify(delta));
        })
        .catch(error => {
            console.error('Error loading static content:', error);
            alert('Error loading static content.');
        });
}

// Helper function to get URL parameters
function getUrlParam(param) {
    const params = new URLSearchParams(window.location.search);
    return params.get(param);
}


// Helper functions

// this is needed because contract.php needs single quotes escaped (\')
const stripSlashes = (str) => {
    return str
        .replace(/\\'/g, '\'')
        // .replace(/\"/g, '"')
        // .replace(/\\\\/g, '\\')
        // .replace(/\\0/g, '\0')
}

// detect empty html tags (eg: <p><br></p>)
const isEmpty = (htmlString) => {
    const parser = new DOMParser();
    const { textContent } = parser.parseFromString(htmlString, "text/html").documentElement;
    return !textContent.trim();
}

// https://github.com/quilljs/quill/issues/163#issuecomment-561341501
function isQuillEmpty(quill) {
    if ((quill.getContents()['ops'] || []).length !== 1) { return false }
    return quill.getText().trim().length === 0
}
