<?php

// Root path
$serverRoot = $_SERVER['DOCUMENT_ROOT'];

// Developer information
$dev_name = "Waleed";
$dev_email = "krafiki143@gmail.com";
$dev_app_password = "epdhedelibfhvcno"; 
$correct_pin = "12345";
// $DEV_SIGNATURE = "data:image/png;base64," . base64_encode(file_get_contents($serverRoot . '/signature.png'));
// $DEV_SIGNATURE = '<img id="dev_signature" src="' . $DEV_SIGNATURE . '" >';
$DEV_TIMESTAMP  = 'December 29, 2024 at 8:43:03 PM GMT+2';
$DEV_IP_ADDRESS = '192.168.0.1';
$devTimeOffset = -120; // dev timestamp offset for timezones

// Email sent when admin sends the contract
$EMAIL_SUBJECT_INITIAL_FOR_CONTRACT_SIGNING = "Contract Notification";
$EMAIL_BODY_INITIAL_FOR_CONTRACT_SIGNING = "<p>Thank you for signing up with us. You can go ahead and sign the contract at [CONTRACT_PATH]</p>";

$Contracts = [
    [
        "name" => "Botox",
        "html" => '<h1>Contract of Botox</h1>
  <p>This Contract is made for Botox and entered into as of the date set forth below by and between <strong> Alice Williams </strong> (hereinafter referred to as "Developer") and <strong id="client-name-display"> [Client Name] </strong> (hereinafter referred to as "Client").</p>
  <h2>I. Agreement of parties</h2>
  <p>Client hereby hires Developer to rebuild the current website <strong> bobswebsite.com, </strong> for the estimated total price of <strong> $PRICE. </strong> Developer agrees to provide quality service and to answer to Client\'s requests in a timely manner.</p><p>The payment plan is outlined in section VII of this contract.</p><h2>II. TERM</h2><p>This contract shall commence upon the first payment, as outlined in the payment plan and shall remain effective until the services are completed and delivered.</p><h2>III. Legal matters and copyrights</h2><p>Client hereby guarantees to Developer that any elements of text, graphics, photos, trademarks or other artwork that Client provides for inclusion in the website are either owned by them or that they have the permission to use them.</p><p>Upon receipt of the final payment, the following copyright assignment shall automatically occur:</p><ol><li>Client will own the graphics, virtual elements, text content, photographs, and other data provided, unless someone else owns them.</li><li>Developer owns the HTML markup, CSS and other code and they license it to Client for use on only this project. Developer can reserve the right to display, with Client\'s consent, the work as part of the portfolio.</li></ol><h2>IV. Modifications</h2><p>This contract may be modified by the parties in writing. All notices under this contract must be transmitted in writing by email and will only be effective upon confirmation of receipt.</p><h2>V. Termination</h2><p>Either party may terminate this contract at any time, effective immediately upon notice or mutual agreement.</p><p>In the event of termination, Developer shall be compensated for services performed through the date of termination in one of the following amounts, whichever is greater, together with any additional costs incurred trough and up to the date of cancellation:</p><ol><li class="ql-indent-1">any advanced payment,</li><li class="ql-indent-1">a prorated portion of the fees due, or</li><li class="ql-indent-1">hourly fees for work performed by Developer at the time of the termination.</li></ol><h2>VI. Force majeure</h2><p>Developer shall not be deemed in breach of this contract if they are unable to complete the services or any portion of them due to fire, earthquake, war, labor dispute, illness, internet breaches, or any other technical issues that are beyond their control. In the event of a <em> force majeure, </em> Developer shall give notice to Client of their inability to perform or of any delay in completing the services and shall propose revisions to the schedule for completion.</p><h2>VII. Payment plan</h2><p>Payments shall be made as follows:</p><ul><li>50% of total estimated fee will be required to commence work, after this contract has been approved and signed by both parties.</li><li>50% upon project closure.</li></ul><p>Any extra time required outside the project services mentioned in section I of this contract, will be billed at a rate of <strong> $FEE </strong> per hour.</p>'
    ],
    [
        "name" => "Laser",
        "html" => '<h1>Contract of Laser</h1>
  <p>This Contract is made for Laser and entered into as of the date set forth below by and between <strong> Alice Williams </strong> (hereinafter referred to as "Developer") and <strong id="client-name-display"> [Client Name] </strong> (hereinafter referred to as "Client").</p>
  <h2>I. Agreement of parties</h2>
  <p>Client hereby hires Developer to rebuild the current website <strong> bobswebsite.com, </strong> for the estimated total price of <strong> $PRICE. </strong> Developer agrees to provide quality service and to answer to Client\'s requests in a timely manner.</p><p>The payment plan is outlined in section VII of this contract.</p><h2>II. TERM</h2><p>This contract shall commence upon the first payment, as outlined in the payment plan and shall remain effective until the services are completed and delivered.</p><h2>III. Legal matters and copyrights</h2><p>Client hereby guarantees to Developer that any elements of text, graphics, photos, trademarks or other artwork that Client provides for inclusion in the website are either owned by them or that they have the permission to use them.</p><p>Upon receipt of the final payment, the following copyright assignment shall automatically occur:</p><ol><li>Client will own the graphics, virtual elements, text content, photographs, and other data provided, unless someone else owns them.</li><li>Developer owns the HTML markup, CSS and other code and they license it to Client for use on only this project. Developer can reserve the right to display, with Client\'s consent, the work as part of the portfolio.</li></ol><h2>IV. Modifications</h2><p>This contract may be modified by the parties in writing. All notices under this contract must be transmitted in writing by email and will only be effective upon confirmation of receipt.</p><h2>V. Termination</h2><p>Either party may terminate this contract at any time, effective immediately upon notice or mutual agreement.</p><p>In the event of termination, Developer shall be compensated for services performed through the date of termination in one of the following amounts, whichever is greater, together with any additional costs incurred trough and up to the date of cancellation:</p><ol><li class="ql-indent-1">any advanced payment,</li><li class="ql-indent-1">a prorated portion of the fees due, or</li><li class="ql-indent-1">hourly fees for work performed by Developer at the time of the termination.</li></ol><h2>VI. Force majeure</h2><p>Developer shall not be deemed in breach of this contract if they are unable to complete the services or any portion of them due to fire, earthquake, war, labor dispute, illness, internet breaches, or any other technical issues that are beyond their control. In the event of a <em> force majeure, </em> Developer shall give notice to Client of their inability to perform or of any delay in completing the services and shall propose revisions to the schedule for completion.</p><h2>VII. Payment plan</h2><p>Payments shall be made as follows:</p><ul><li>50% of total estimated fee will be required to commence work, after this contract has been approved and signed by both parties.</li><li>50% upon project closure.</li></ul><p>Any extra time required outside the project services mentioned in section I of this contract, will be billed at a rate of <strong> $FEE </strong> per hour.</p>'
    ],
    [
        "name" => "Filler",
        "html" => '<h1>Contract of Filler</h1>
  <p>This Contract is made for Filler and entered into as of the date set forth below by and between <strong> Alice Williams </strong> (hereinafter referred to as "Developer") and <strong id="client-name-display"> [Client Name] </strong> (hereinafter referred to as "Client").</p>
  <h2>I. Agreement of parties</h2>
  <p>Client hereby hires Developer to rebuild the current website <strong> bobswebsite.com, </strong> for the estimated total price of <strong> $PRICE. </strong> Developer agrees to provide quality service and to answer to Client\'s requests in a timely manner.</p><p>The payment plan is outlined in section VII of this contract.</p><h2>II. TERM</h2><p>This contract shall commence upon the first payment, as outlined in the payment plan and shall remain effective until the services are completed and delivered.</p><h2>III. Legal matters and copyrights</h2><p>Client hereby guarantees to Developer that any elements of text, graphics, photos, trademarks or other artwork that Client provides for inclusion in the website are either owned by them or that they have the permission to use them.</p><p>Upon receipt of the final payment, the following copyright assignment shall automatically occur:</p><ol><li>Client will own the graphics, virtual elements, text content, photographs, and other data provided, unless someone else owns them.</li><li>Developer owns the HTML markup, CSS and other code and they license it to Client for use on only this project. Developer can reserve the right to display, with Client\'s consent, the work as part of the portfolio.</li></ol><h2>IV. Modifications</h2><p>This contract may be modified by the parties in writing. All notices under this contract must be transmitted in writing by email and will only be effective upon confirmation of receipt.</p><h2>V. Termination</h2><p>Either party may terminate this contract at any time, effective immediately upon notice or mutual agreement.</p><p>In the event of termination, Developer shall be compensated for services performed through the date of termination in one of the following amounts, whichever is greater, together with any additional costs incurred trough and up to the date of cancellation:</p><ol><li class="ql-indent-1">any advanced payment,</li><li class="ql-indent-1">a prorated portion of the fees due, or</li><li class="ql-indent-1">hourly fees for work performed by Developer at the time of the termination.</li></ol><h2>VI. Force majeure</h2><p>Developer shall not be deemed in breach of this contract if they are unable to complete the services or any portion of them due to fire, earthquake, war, labor dispute, illness, internet breaches, or any other technical issues that are beyond their control. In the event of a <em> force majeure, </em> Developer shall give notice to Client of their inability to perform or of any delay in completing the services and shall propose revisions to the schedule for completion.</p><h2>VII. Payment plan</h2><p>Payments shall be made as follows:</p><ul><li>50% of total estimated fee will be required to commence work, after this contract has been approved and signed by both parties.</li><li>50% upon project closure.</li></ul><p>Any extra time required outside the project services mentioned in section I of this contract, will be billed at a rate of <strong> $FEE </strong> per hour.</p>'
    ],
];


$FOOTER_UNSIGNED = '
  <div id="ui-unsigned">  
    <form method="post" class="noprint" id="signature_form">
        <div id="signature-container">
            <div id="canvas-container">
                <canvas id="signature-pad" class="signature-pad" width="188" height="58.66"></canvas>
            </div>
        </div>
    
        <div class="animate slide">
            <div class="no-print margin-top invert-colors flexi | to-go | animate slide">
                <button id="reset" title="Clear Signature" type="button" class="icon-button button warning">
                    <span class="hide-medium">Clear</span>
                    <span class="icon">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em"
                            width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.454,19.028h-7.01l6.62-6.63a2.935,2.935,0,0,0,.87-2.09,2.844,2.844,0,0,0-.87-2.05l-3.42-3.44a2.93,2.93,0,0,0-4.13.01L3.934,13.4a2.946,2.946,0,0,0,0,4.14l1.48,1.49H3.554a.5.5,0,0,0,0,1h16.9A.5.5,0,0,0,20.454,19.028Zm-7.24-13.5a1.956,1.956,0,0,1,2.73,0l3.42,3.44a1.868,1.868,0,0,1,.57,1.35,1.93,1.93,0,0,1-.57,1.37l-5.64,5.64-6.15-6.16Zm-1.19,13.5h-5.2l-2.18-2.2a1.931,1.931,0,0,1,0-2.72l2.23-2.23,6.15,6.15Z"></path>
                        </svg>
                    </span>
                </button>
    
                <button id="show-modal-qr" type="button" class="open-button | icon-button button">
                    <span class="hide-small">Sign on mobile</span>
                    <span class="icon">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" viewBox="0 0 16 16" height="1em"
                            width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 1h-4v4h4v-4zM6 0v0 6h-6v-6h6zM2 2h2v2h-2zM15 1h-4v4h4v-4zM16 0v0 6h-6v-6h6zM12 2h2v2h-2zM5 11h-4v4h4v-4zM6 10v0 6h-6v-6h6zM2 12h2v2h-2zM7 0h1v1h-1zM8 1h1v1h-1zM7 2h1v1h-1zM8 3h1v1h-1zM7 4h1v1h-1zM8 5h1v1h-1zM7 6h1v1h-1zM7 8h1v1h-1zM8 9h1v1h-1zM7 10h1v1h-1zM8 11h1v1h-1zM7 12h1v1h-1zM8 13h1v1h-1zM7 14h1v1h-1zM8 15h1v1h-1zM15 8h1v1h-1zM1 8h1v1h-1zM2 7h1v1h-1zM0 7h1v1h-1zM4 7h1v1h-1zM5 8h1v1h-1zM6 7h1v1h-1zM9 8h1v1h-1zM10 7h1v1h-1zM11 8h1v1h-1zM12 7h1v1h-1zM13 8h1v1h-1zM14 7h1v1h-1zM15 10h1v1h-1zM9 10h1v1h-1zM10 9h1v1h-1zM11 10h1v1h-1zM13 10h1v1h-1zM14 9h1v1h-1zM15 12h1v1h-1zM9 12h1v1h-1zM10 11h1v1h-1zM12 11h1v1h-1zM13 12h1v1h-1zM14 11h1v1h-1zM15 14h1v1h-1zM10 13h1v1h-1zM11 14h1v1h-1zM12 13h1v1h-1zM13 14h1v1h-1zM10 15h1v1h-1zM12 15h1v1h-1zM14 15h1v1h-1z">
                            </path>
                        </svg>
                    </span>
                </button>
    
                <button id="submit-btn" disabled 
                    style="margin-inline-start: auto;"
                    type="submit" class="icon-button button success">
                    <span>Sign</span>
                    <span class="icon">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em"
                            width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path fill="none" stroke-width="2" d="M2,12 L22,12 M13,3 L22,12 L13,21"></path>
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    
        <div class="flow" style="max-width: 330px; margin-inline-start: auto;">
            <h2 class="margin-top loading-signed hidden | animate slide" style="color: var(--clr-green-500); font-weight: 700;">Saving contract…</h2>
            <small class="loading-signed hidden | animate slide delay-16"
                style="font-family: \'Open Sans\'; font-weight: 600; color: var(--clr-blue-700);">
                This shouldn\'t take more than a minute.
            </small>
        </div>
    
        <input type="hidden" id="client_signature" name="client_signature" />
    </form>
    
    
    <dialog class="modal flow" id="modal-qr">
        <div class="qr-code-container">
            <button id="close-modal-qr" class="close-button button" aria-label="close" type="button"></button>
            <canvas id="qr-code"></canvas>
        </div>
    </dialog>
  </div><!--.ui-unsigned-->
  </div> <!-- #content -->
  <script id="contract_script_unsigned" type="module">
  import SignaturePad from "https://cdn.skypack.dev/pin/signature_pad@v4.1.3-nYxPKR50YjQN4V2vbxta/mode=imports,min/optimized/signature_pad.js"
  // 📙 Package Documentation: https://www.skypack.dev/view/signature_pad
  
  signature("#signature-pad")
  
  function signature(selector) {
  
      if (!document.querySelector(selector)) return
  
      const canvas = document.querySelector(selector)
  
      // https://github.com/szimek/signature_pad#options
      const clientSignaturePad = new SignaturePad(canvas, {
          penColor: "hsl(200, 100%, 30%)",
          minDistance: 2,
      })
  
      resizeCanvas()
  
      if (localStorage.getItem("client_signature")) {
          document.querySelector("#submit-btn").disabled = false
          // document.querySelector("#reset").disabled = false
      }
  
  
      // event listeners
  
      // save signature to localStorage on change
      clientSignaturePad.addEventListener("afterUpdateStroke", () => {
          let data = clientSignaturePad.toDataURL("image/png")
  
          document.querySelector("#client_signature").value = data
          localStorage.setItem("client_signature", data)
  
          // ! probably remove these:
          document.querySelector("#submit-btn").disabled = false
          // document.querySelector("#reset").disabled = false
      })
  
      // button to reset signature
      document.querySelector("#reset")?.addEventListener("click", (e) => {
          clientSignaturePad.clear()
          localStorage.removeItem("client_signature")
          document.querySelector("#client_signature").value = null
          document.querySelector("#submit-btn").disabled = true
          // document.querySelector("#reset").disabled = true
      })
  
      // form submit
      document.querySelector("#signature_form").addEventListener("submit", (e) => {
          // e.preventDefault();
          e.target.querySelector(".to-go").classList.add("gone")
  
          e.target.querySelectorAll(".loading-signed").forEach((el) => {
              el.classList.remove("hidden")
          })
  
          e.target.querySelector("#canvas-container").classList.add("just-signed")
  
          e.target.querySelector(".to-go").addEventListener(\'transitionend\', (e) => {
              e.target.classList.add("hidden")
          })
  
          let otherElements = document.querySelectorAll("#content > *:not(#ui-unsigned, #dev_signature)")
          otherElements.forEach(element => {
              // element.style.cssText = `opacity: .5;`
              element.style.opacity = "0.5"
          })
  
      })
      
      window.onresize = resizeCanvas
  
  
      // needed for retina displays
      function resizeCanvas() {
          const ratio = Math.max(window.devicePixelRatio || 1, 1)
          canvas.width = canvas.offsetWidth * ratio
          canvas.height = canvas.offsetHeight * ratio
          canvas.getContext("2d").scale(ratio, ratio)
  
          let data = localStorage.getItem("client_signature");
          if (data) {
              // console.log(data)
              clientSignaturePad.fromDataURL(data)
              // disableResetButtonIfSignatureIsEmpty(data)
              document.querySelector("#client_signature").value = data
          }
      }
  
  }
  </script>
  <script id="qr_code_script" type="module">
  import QRious from "https://cdn.skypack.dev/pin/qrious@v4.0.2-vbPhILY2CQRjQ1N29BGh/mode=imports,min/optimized/qrious.js";
  // 📙 Package Documentation:  https://www.skypack.dev/view/qrious
  
  qrCode("#qr-code")
  
  export default function qrCode(selector) {
      
      if (!document.querySelector(selector)) return
      
      const canvas = document.querySelector(selector)
  
      let qr = new QRious({
          element: canvas,
          value: window.location.href,
          foreground: "hsl(200, 30%, 20%)",
          padding: 0,
          size: 500,
      })
  
      // event listeners
  
      const modal = document.querySelector("#modal-qr")
      const openModal = document.querySelector("#show-modal-qr")
      const closeModal = document.querySelector("#close-modal-qr")
  
      openModal?.addEventListener("click", (e) => {
          if (modal?.open === false)
              modal.showModal()
      })
  
      closeModal?.addEventListener("click", (e) => {
          modal?.close()
      })
  
      // close modal when click events happen outside of it
      modal?.addEventListener("click", (e) => {
          const rect = modal.getBoundingClientRect()
          if (
              e.clientY < rect.top ||
              e.clientY > rect.bottom ||
              e.clientX < rect.left ||
              e.clientX > rect.right
          ) {
              modal.close()
          }
      })
  }
  
  </script>
  </body>
  </html>';




$CONTRACT_STYLES = '<link rel="preconnect" href="https://cdn.skypack.dev">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <style>@import url(https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700,400italic) ;@import url(https://fonts.googleapis.com/css?family=Arapey) ;@import url(https://fonts.googleapis.com/css2?family=Open+Sans:wdth,wght@75,600;100,400;100,600;100,700;100,800) ;@layer reset, accessibility, animated-entrances, forms;@layer from-quill-editor, from-quill-editor-overrides;@layer utility;@layer signatures, buttons;@layer modal;@layer contract-typography;@layer reset{@media print{.noprint{display:none!important}}}@layer reset{*,:after,:before{box-sizing:border-box}body,figure,h1,h2,h3,h4,h5,p,picture{margin:0}h1,h2,h3,h4,h5,h6{font-weight:400}img,picture{display:block;height:auto;max-width:100%}button,input,select,textarea{font:inherit}}@layer colors{:root{--clr-light-hsl:20 80% 98%;--clr-dark-hsl:200 20% 25%;--clr-darker-hsl:200 59% 22%;--clr-primary-hsl:200 75% 30%;--clr-danger-hsl:20 100% 30%;--clr-success-hsl:165 75% 30%;--clr-warning-hsl:36 100% 30%;--clr-blue-500:#136086;--clr-blue-600:#105070;--clr-blue-700:#0d4059;--clr-red-500:#863913;--clr-red-600:#703010;--clr-red-700:#59260d;--clr-green-500:#138669;--clr-green-600:#107058;--clr-green-700:#0d5946;--clr-brown-500:#865813;--clr-brown-600:#704910;--clr-brown-700:#593b0d;--clr-blue-desaturated-500:#395360;--clr-blue-desaturated-600:#263740;--clr-blue-desaturated-700:#131c20;--clr-red-desaturated-500:#604639;--clr-red-desaturated-600:#402f26;--clr-red-desaturated-700:#201713;--clr-green-desaturated-500:#396056;--clr-green-desaturated-600:#264039;--clr-green-desaturated-700:#13201d;--clr-brown-desaturated-500:#605039;--clr-brown-desaturated-600:#403626;--clr-brown-desaturated-700:#201b13}}@layer from-quill-editor{.ql-editor blockquote,.ql-editor h1,.ql-editor h2,.ql-editor h3,.ql-editor h4,.ql-editor h5,.ql-editor h6,.ql-editor ol,.ql-editor p,.ql-editor pre,.ql-editor ul{counter-reset:list-1 list-2 list-3 list-4 list-5 list-6 list-7 list-8 list-9}.ql-editor ol,.ql-editor ul{padding-left:1.5em}.ql-editor ol>li,.ql-editor ul>li{list-style-type:none}.ql-editor ul>li:before{content:"\2022"}.ql-editor li:before{display:inline-block;white-space:nowrap;width:1.2em}.ql-editor li:not(.ql-direction-rtl):before{margin-left:-1.5em;margin-right:.3em;text-align:right}.ql-editor li.ql-direction-rtl:before{margin-left:.3em;margin-right:-1.5em}.ql-editor ol li:not(.ql-direction-rtl),.ql-editor ul li:not(.ql-direction-rtl){padding-left:1.5em}.ql-editor ol li.ql-direction-rtl,.ql-editor ul li.ql-direction-rtl{padding-right:1.5em}.ql-editor ol li{counter-increment:list-0;counter-reset:list-1 list-2 list-3 list-4 list-5 list-6 list-7 list-8 list-9}.ql-editor ol li:before{content:counter(list-0,decimal) ". "}.ql-editor ol li.ql-indent-1{counter-increment:list-1}.ql-editor ol li.ql-indent-1:before{content:counter(list-1,lower-alpha) ". "}.ql-editor ol li.ql-indent-1{counter-reset:list-2 list-3 list-4 list-5 list-6 list-7 list-8 list-9}.ql-editor ol li.ql-indent-2{counter-increment:list-2}.ql-editor ol li.ql-indent-2:before{content:counter(list-2,lower-roman) ". "}.ql-editor ol li.ql-indent-2{counter-reset:list-3 list-4 list-5 list-6 list-7 list-8 list-9}.ql-editor ol li.ql-indent-3{counter-increment:list-3}.ql-editor ol li.ql-indent-3:before{content:counter(list-3,decimal) ". "}.ql-editor ol li.ql-indent-3{counter-reset:list-4 list-5 list-6 list-7 list-8 list-9}.ql-editor ol li.ql-indent-4{counter-increment:list-4}.ql-editor ol li.ql-indent-4:before{content:counter(list-4,lower-alpha) ". "}.ql-editor ol li.ql-indent-4{counter-reset:list-5 list-6 list-7 list-8 list-9}.ql-editor ol li.ql-indent-5{counter-increment:list-5}.ql-editor ol li.ql-indent-5:before{content:counter(list-5,lower-roman) ". "}.ql-editor ol li.ql-indent-5{counter-reset:list-6 list-7 list-8 list-9}.ql-editor ol li.ql-indent-6{counter-increment:list-6}.ql-editor ol li.ql-indent-6:before{content:counter(list-6,decimal) ". "}.ql-editor ol li.ql-indent-6{counter-reset:list-7 list-8 list-9}.ql-editor ol li.ql-indent-7{counter-increment:list-7}.ql-editor ol li.ql-indent-7:before{content:counter(list-7,lower-alpha) ". "}.ql-editor ol li.ql-indent-7{counter-reset:list-8 list-9}.ql-editor ol li.ql-indent-8{counter-increment:list-8}.ql-editor ol li.ql-indent-8:before{content:counter(list-8,lower-roman) ". "}.ql-editor ol li.ql-indent-8{counter-reset:list-9}.ql-editor ol li.ql-indent-9{counter-increment:list-9}.ql-editor ol li.ql-indent-9:before{content:counter(list-9,decimal) ". "}.ql-editor .ql-indent-1:not(.ql-direction-rtl){padding-left:3em}.ql-editor li.ql-indent-1:not(.ql-direction-rtl){padding-left:4.5em}.ql-editor .ql-indent-1.ql-direction-rtl.ql-align-right{padding-right:3em}.ql-editor li.ql-indent-1.ql-direction-rtl.ql-align-right{padding-right:4.5em}.ql-editor .ql-indent-2:not(.ql-direction-rtl){padding-left:6em}.ql-editor li.ql-indent-2:not(.ql-direction-rtl){padding-left:7.5em}.ql-editor .ql-indent-2.ql-direction-rtl.ql-align-right{padding-right:6em}.ql-editor li.ql-indent-2.ql-direction-rtl.ql-align-right{padding-right:7.5em}.ql-editor .ql-indent-3:not(.ql-direction-rtl){padding-left:9em}.ql-editor li.ql-indent-3:not(.ql-direction-rtl){padding-left:10.5em}.ql-editor .ql-indent-3.ql-direction-rtl.ql-align-right{padding-right:9em}.ql-editor li.ql-indent-3.ql-direction-rtl.ql-align-right{padding-right:10.5em}.ql-editor .ql-indent-4:not(.ql-direction-rtl){padding-left:12em}.ql-editor li.ql-indent-4:not(.ql-direction-rtl){padding-left:13.5em}.ql-editor .ql-indent-4.ql-direction-rtl.ql-align-right{padding-right:12em}.ql-editor li.ql-indent-4.ql-direction-rtl.ql-align-right{padding-right:13.5em}.ql-editor .ql-indent-5:not(.ql-direction-rtl){padding-left:15em}.ql-editor li.ql-indent-5:not(.ql-direction-rtl){padding-left:16.5em}.ql-editor .ql-indent-5.ql-direction-rtl.ql-align-right{padding-right:15em}.ql-editor li.ql-indent-5.ql-direction-rtl.ql-align-right{padding-right:16.5em}.ql-editor .ql-indent-6:not(.ql-direction-rtl){padding-left:18em}.ql-editor li.ql-indent-6:not(.ql-direction-rtl){padding-left:19.5em}.ql-editor .ql-indent-6.ql-direction-rtl.ql-align-right{padding-right:18em}.ql-editor li.ql-indent-6.ql-direction-rtl.ql-align-right{padding-right:19.5em}.ql-editor .ql-indent-7:not(.ql-direction-rtl){padding-left:21em}.ql-editor li.ql-indent-7:not(.ql-direction-rtl){padding-left:22.5em}.ql-editor .ql-indent-7.ql-direction-rtl.ql-align-right{padding-right:21em}.ql-editor li.ql-indent-7.ql-direction-rtl.ql-align-right{padding-right:22.5em}.ql-editor .ql-indent-8:not(.ql-direction-rtl){padding-left:24em}.ql-editor li.ql-indent-8:not(.ql-direction-rtl){padding-left:25.5em}.ql-editor .ql-indent-8.ql-direction-rtl.ql-align-right{padding-right:24em}.ql-editor li.ql-indent-8.ql-direction-rtl.ql-align-right{padding-right:25.5em}.ql-editor .ql-indent-9:not(.ql-direction-rtl){padding-left:27em}.ql-editor li.ql-indent-9:not(.ql-direction-rtl){padding-left:28.5em}.ql-editor .ql-indent-9.ql-direction-rtl.ql-align-right{padding-right:27em}.ql-editor li.ql-indent-9.ql-direction-rtl.ql-align-right{padding-right:28.5em}.ql-editor .ql-align-center{text-align:center}.ql-editor .ql-align-justify{text-align:justify}.ql-editor .ql-align-right{text-align:right}}@layer from-quill-editor-overrides{.ql-editor{padding-block:1.5rem;padding-inline:2rem;padding-inline:clamp(.5rem,2.5vw,3rem);padding-inline:clamp(20px,5vw,35px)}.ql-editor>:where(:not(:first-child)){margin-block-start:var(--flow-space,1.5rem)}.ql-editor :where(ul,ol)>:where(:not(:first-child)){margin-block-start:.25rem}.ql-editor :is(ol,ul){padding:0}.ql-editor>p+:is(ul,ol){margin-block-start:.25rem}}@layer accessibility{:where(:focus-visible){outline:3px solid #000;outline-offset:3px}.sr-only{clip:rect(0,0,0,0);border:0;height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;white-space:nowrap;width:1px}.skip-to-content{background-color:hsl(var(--clr-darker-hsl));border-radius:8px;color:hsl(var(--clr-light-hsl));display:block;left:0;margin-inline:auto;margin:0 auto!important;max-width:max-content;opacity:0;outline-offset:1px;padding:.5em 1em;position:fixed;right:0;text-decoration:none;top:1.5rem;transform:translateY(calc(-100% - 5rem - 1px));transition:transform .25s ease-in;z-index:9999}.skip-to-content:hover{background-color:hsl(var(--clr-light-hsl));color:hsl(var(--clr-darker-hsl))}.skip-to-content:focus{opacity:1;transform:translateY(0)}}@layer accessibility{@media (prefers-reduced-motion:reduce){*,:after,:before{animation-duration:.1ms!important;animation-iteration-count:1!important;scroll-behavior:auto!important;transition-duration:auto!important}.animate{animation:none!important}}}@layer buttons{.button,.ql-html-buttonCancel,.ql-html-buttonOk{align-items:center;appearance:none;-webkit-appearance:none;-moz-appearance:none;background:var(--clr-500);border:none;border-radius:8px;color:#fff;cursor:pointer;display:flex;font-family:Open Sans,sans-serif;font-size:16px;font-weight:400;gap:0;justify-content:center;letter-spacing:.025em;line-height:26px;margin:0;max-width:max-content;overflow:hidden;padding:10px 35px;padding-inline:clamp(20px,5vw,35px);padding-inline:clamp(20px,2vw,35px);text-decoration:none;transition:outline .4s cubic-bezier(.22,1,.36,1);-webkit-user-select:none;user-select:none}.button:hover:not([disabled]),.ql-html-buttonCancel:hover:not([disabled]),.ql-html-buttonOk:hover:not([disabled]){background:var(--clr-600)}.button:active:not([disabled]),.ql-html-buttonCancel:active:not([disabled]),.ql-html-buttonOk:active:not([disabled]){background:var(--clr-700);transform:translate(2px 3px);transform:scale(.975);transition:transform .3s cubic-bezier(.22,1,.36,1),outline .4s cubic-bezier(.22,1,.36,1),background-color .2s linear}.button[disabled],.ql-html-buttonCancel[disabled],.ql-html-buttonOk[disabled]{cursor:default;filter:grayscale(.75) contrast(.75) brightness(.96);transition:all .4s cubic-bezier(.22,1,.36,1)}.button.icon-button{gap:0;padding:0;place-self:center}.button.icon-button>*{align-items:center;align-items:space-evenly;display:inline-flex;display:flex;gap:.5ex;height:100%;justify-content:center;padding:10px 35px;padding-inline:clamp(20px,2.5vw,35px);padding-inline:clamp(20px,min(2.5vw,1.5em),35px)}.button.icon-button .icon{background-color:transparent;background-color:rgba(0,0,0,.16);font-size:1.5em;padding-inline:clamp(20px,min(2.5vw,1.5em),24px)}.button.icon-button .icon.small-padding{padding-inline:10px}.button,.ql-html-buttonCancel,.ql-html-buttonOk{--clr-500:var(--clr-blue-desaturated-500);--clr-600:var(--clr-blue-desaturated-600);--clr-700:var(--clr-blue-desaturated-700)}.button.primary,.ql-html-buttonOk{--clr-500:var(--clr-blue-500);--clr-600:var(--clr-blue-600);--clr-700:var(--clr-blue-700)}.button.danger{--clr-500:var(--clr-red-500);--clr-600:var(--clr-red-600);--clr-700:var(--clr-red-700)}.button.success{--clr-500:var(--clr-green-desaturated-500);--clr-600:var(--clr-green-desaturated-600);--clr-700:var(--clr-green-desaturated-700)}.button.warning,.ql-html-buttonCancel{--clr-500:var(--clr-red-desaturated-500);--clr-600:var(--clr-red-desaturated-600);--clr-700:var(--clr-red-desaturated-700)}.invert-colors .button{background:var(--clr-600);border:1px solid hsla(0,0%,100%,.1);filter:invert(1) hue-rotate(180deg);outline-color:#fff}.invert-colors .button:hover:not([disabled]){background:var(--clr-700)}.invert-colors .button:active:not([disabled]){background:var(--clr-500)}.invert-colors .button[disabled]{cursor:default;filter:grayscale(.75) contrast(.75) brightness(.96) invert(1) hue-rotate(180deg)}.invert-colors .button>*{background-color:rgba(0,0,0,.16)}.invert-colors .button .icon{background-color:transparent;border-inline-start:1px solid hsla(0,0%,100%,.05)}}@layer utility{.flexi{align-items:center;display:flex;flex-wrap:wrap;gap:clamp(20px,5vw,35px);justify-content:flex-start}.flow>:where(:not(:first-child)){margin-block-start:var(--flow-space,1em)}.hidden{display:none!important}@media (max-width:30em){.hide-small{display:none!important}}@media (max-width:50em){.hide-medium{display:none!important}}.sr-only{clip:rect(0,0,0,0);border:0;height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;white-space:nowrap;width:1px}.border-top{border-top:1px solid hsl(var(--clr-primary-hsl)/.25);margin-block-start:2rem;padding-block-start:2.5rem}.margin-top{margin-block-start:3rem}.d-block{display:blok}}@layer forms{:where(input:is([type=text],[type=email],[type=password]),textarea){appearance:none;background-color:hsl(var(--clr-light-hsl)/.6);border:1.5px solid hsl(var(--clr-dark-hsl)/.5);border-radius:.25rem;box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06);color:hsl(var(--clr-dark-hsl)/1);font-size:1rem;mix-blend-mode:luminosity;outline-offset:0;outline-width:1.5px;padding-block:.35rem;padding-inline:.75rem;position:relative;transition:all .3s cubic-bezier(.22,1,.36,1)}:where(input:is([type=text],[type=email],[type=password]),textarea):focus{background-color:hsl(var(--clr-light-hsl)/1);border:1.5px solid hsl(var(--clr-darker-hsl)/.8);color:hsl(var(--clr-darker-hsl)/1)}:where(input:is([type=text],[type=email],[type=password]),textarea)::placeholder{color:hsl(var(--clr-dark-hsl)/.75)}:where(input:is([type=text],[type=email],[type=password]),textarea):focus::placeholder{color:hsl(var(--clr-dark-hsl)/.75)}label{color:var(--clr-blue-desaturated-700);font-weight:600;letter-spacing:-.0175em}label:has(svg){align-items:center;column-gap:.25em;display:flex;justify-content:center}label:has(svg) svg{color:var(--clr-blue-700);height:1.5rem;width:1.5rem}}@layer contract-typography{:root{--step--2:clamp(0.56rem,calc(0.8rem - 0.51vw),0.69rem);--step--1:clamp(0.75rem,calc(0.9rem - 0.32vw),0.83rem);--step-0:clamp(1.00rem,1rem,1.00rem);--step-1:clamp(1.20rem,calc(1.1rem + 0.51vw),1.33rem);--step-2:clamp(1.44rem,calc(1.18rem + 1.3vw),1.78rem);--step-3:clamp(1.73rem,calc(1.23rem + 2.47vw),2.37rem);--step-4:clamp(2.07rem,calc(1.24rem + 4.18vw),3.16rem);--step-5:clamp(2.49rem,calc(1.16rem + 6.63vw),4.21rem)}#content{background:#fff;margin:2rem 2rem 6rem;margin-inline:0;margin-inline:auto;max-width:calc(100% - 2rem);max-width:100%;padding:0 2em;padding-inline:2rem;width:clamp(10rem,60rem,80rem);width:52em;width:210mm}#content,#main{font-family:Libre Baskerville,serif;font-size:var(--step-0);line-height:1.5;line-height:1.75}h2,h3,h4,h5,h6{margin-block-start:1.75em}h1{border-style:solid;border-width:3px 0 1px;font-family:Arapey,serif;font-size:var(--step-2);font-weight:400;letter-spacing:.15em;margin-block-end:2.5rem;margin-block-start:1rem;padding:.5em 0;position:relative;text-align:center}h1,h2{line-height:1.2em;text-transform:uppercase}h2{font-family:Open Sans Condensed,sans-serif;font-family:Open Sans,sans-serif;font-size:var(--step-1);font-variation-settings:"wdth" 75;font-weight:600;letter-spacing:.025em}h3,h4,h5,h6{font-weight:700}}@layer signatures{.compiled-signatures{display:flex;flex-wrap:wrap;gap:2rem;justify-content:space-around}.compiled-signature{align-items:start;display:grid;font-size:.75em;max-width:min(50%,330px);max-width:clamp(calc(50% - 2rem),348px,100%);min-width:300px;min-width:200px}.compiled-signature img{background:#fff;border:1px solid rgba(3,33,48,.25);margin-block:.15rem}#dev_signature,#hk{display:block;max-width:min(333px,100%);max-width:min(370px,100%)}#dev_signature[src=null]{display:none}.date-ip{font-family:Open Sans Condensed,sans-serif;font-family:Open Sans,sans-serif;font-size:1.2em;font-variation-settings:"wdth" 75;font-weight:400;letter-spacing:.025em;line-height:1.2em}#ui-unsigned{margin:0}#ui-signed{clear:both}#content>:not(#ui-unsigned,#dev_signature){transition:opacity .3s ease-out}#signature-container{display:grid;gap:1.5rem;place-items:start}@media (min-width:40rem){#signature-container{place-items:end}}#canvas-container{aspect-ratio:188/58.66;background:#fff;isolation:isolate;max-width:100%;position:relative;transition:max-width .4s cubic-bezier(.22,1,.36,1),margin .6s ease-in-out;-webkit-user-select:none;user-select:none;width:100%}#canvas-container:before{border-bottom:2px solid #61594f;content:"";display:block;height:0;inset:70% 7.5% 0 7.5%;opacity:.95;pointer-events:none;position:absolute;z-index:-1}}@layer signatures{@media (max-width:40em){#canvas-container{aspect-ratio:200/80}}}@layer signatures{#generator-signature-pad,#signature-pad{border:2px dashed rgba(3,33,48,.75);box-shadow:inset 0 0 5px 1px #ddd;height:100%;left:0;position:absolute;top:0;width:100%}#signature-controls{align-items:flex-start;display:flex;flex-direction:row;gap:1.5rem;justify-content:center;width:100%}.loading-signed{align-items:center;justify-content:center}@media (min-width:40rem){.loading-signed{justify-content:center}}.loading-signed:not(.hidden){display:flex}.to-go{opacity:1;transform:none;transition:all .2s cubic-bezier(.26,.53,.74,1.48),scale 1s ease-out}.to-go.gone{opacity:0;transform:translateY(-20px)}#canvas-container.just-signed{max-width:333px}@media (min-width:40rem){#canvas-container.just-signed{margin-top:calc(-330px - 2rem)}}#canvas-container.just-signed #signature-pad{border:1px dashed rgba(3,33,48,.25);box-shadow:inset 0 0 2px 1px hsla(0,0%,87%,.25)}#canvas-container.just-signed:before{opacity:0}}@layer modal{.modal{--shadow-color:200 3% 15%;--shadow-strength:5%;--shadow-6:0 -1px 2px 0 hsl(var(--shadow-color)/calc(var(--shadow-strength) + 2%)),0 3px 2px -2px hsl(var(--shadow-color)/calc(var(--shadow-strength) + 3%)),0 7px 5px -2px hsl(var(--shadow-color)/calc(var(--shadow-strength) + 3%)),0 12px 10px -2px hsl(var(--shadow-color)/calc(var(--shadow-strength) + 4%)),0 22px 18px -2px hsl(var(--shadow-color)/calc(var(--shadow-strength) + 5%)),0 41px 33px -2px hsl(var(--shadow-color)/calc(var(--shadow-strength) + 6%)),0 100px 80px -2px hsl(var(--shadow-color)/calc(var(--shadow-strength) + 7%));border:3px solid hsl(var(--shadow-color));border-radius:1.5rem;box-shadow:var(--shadow-6);margin-block-start:auto;max-width:calc(100% - 1rem);padding:0;position:fixed;z-index:999}.modal::backdrop{-webkit-backdrop-filter:blur(4px);backdrop-filter:blur(4px);background-image:linear-gradient(132deg,rgba(31,39,41,.6),rgba(35,41,47,.6));cursor:pointer}.close-button{border-radius:50%;height:32px;margin:1rem 0 0;max-width:32px;padding:0;position:relative;vertical-align:top;width:32px}.close-button:active{background-color:#000;transition:none}.close-button:before{height:2px;width:50%}.close-button:after{height:50%;width:2px}.close-button:after,.close-button:before{background-color:currentColor;content:"";display:block;left:50%;position:absolute;top:50%;transform:translateX(-50%) translateY(-50%) rotate(45deg);transform-origin:center center}.qr-code-container{display:grid;gap:1rem;justify-items:end;margin-block-end:3.5rem;margin-inline:1rem}#generator-qr-code,#qr-code{display:block;image-rendering:pixelated;margin:auto;max-width:90%;width:min(500px,90vw)}}@layer animated-entrances{@media (prefers-reduced-motion:reduce){.animate{animation:none!important}}}@layer animated-entrances{.delay-1{animation-delay:.6s}.delay-2{animation-delay:.7s}.delay-3{animation-delay:.8s}.delay-4{animation-delay:.9s}.delay-5{animation-delay:1s}.delay-6{animation-delay:1.1s}.delay-7{animation-delay:1.2s}.delay-8{animation-delay:1.3s}.delay-9{animation-delay:1.4s}.delay-10{animation-delay:1.5s}.delay-11{animation-delay:1.6s}.delay-12{animation-delay:1.7s}.delay-13{animation-delay:1.8s}.delay-14{animation-delay:1.9s}.delay-15{animation-delay:2s}.delay-16{animation-delay:2.1s}:where(.animate){animation-delay:.5s;animation-duration:.75s;animation-fill-mode:backwards;animation-name:animate-fade;animation-timing-function:cubic-bezier(.26,.53,.74,1.48)}:where(.animate).fade{animation-name:animate-fade;animation-timing-function:ease}:where(.animate).pop{animation-name:animate-pop}:where(.animate).blur{animation-name:animate-blur;animation-timing-function:ease}:where(.animate).glow{animation-name:animate-glow;animation-timing-function:ease}:where(.animate).grow{animation-name:animate-grow}:where(.animate).splat{animation-name:animate-splat}:where(.animate).roll{animation-name:animate-roll}:where(.animate).flip{animation-name:animate-flip;perspective:1000px;transform-style:preserve-3d}:where(.animate).spin{animation-name:animate-spin;perspective:1000px;transform-style:preserve-3d}:where(.animate).slide{animation-name:animate-slide}:where(.animate).drop{animation-name:animate-drop;animation-timing-function:cubic-bezier(.77,.14,.91,1.25)}:where(.animate).drop-up{animation-name:animate-drop-up;animation-timing-function:cubic-bezier(.77,.14,.91,1.25)}}@layer animated-entrances{@media screen{@keyframes animate-fade{0%{opacity:0}to{opacity:1}}@keyframes animate-pop{0%{opacity:0;transform:scale(.5)}to{opacity:1;transform:scale(1)}}@keyframes animate-blur{0%{filter:blur(15px);opacity:0}to{filter:blur(0);opacity:1}}@keyframes animate-glow{0%{filter:brightness(3) saturate(3);opacity:0;transform:scale(.8)}to{filter:brightness(1) saturate(1);opacity:1;transform:scale(1)}}@keyframes animate-grow{0%{opacity:0;transform:scaleY(0);visibility:hidden}to{opacity:1;transform:scale(1)}}@keyframes animate-splat{0%{opacity:0;transform:scale(0) rotate(20deg) translateY(-30px)}70%{opacity:1;transform:scale(1.1) rotate(15deg)}85%{opacity:1;transform:scale(1.1) rotate(15deg) translateY(-10px)}to{opacity:1;transform:scale(1) rotate(0) translate(0)}}@keyframes animate-roll{0%{opacity:0;transform:scale(0) rotate(1turn)}to{opacity:1;transform:scale(1) rotate(0deg)}}@keyframes animate-flip{0%{opacity:0;transform:rotateX(-120deg) scale(.9)}to{opacity:1;transform:rotateX(0deg) scale(1)}}@keyframes animate-spin{0%{opacity:0;transform:rotateY(-120deg) scale(.9)}to{opacity:1;transform:rotateY(0deg) scale(1)}}@keyframes animate-slide{0%{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translate(0)}}@keyframes animate-drop{0%{opacity:0;transform:translateY(-300px) scale(.9,1.1)}95%{opacity:1;transform:translate(0) scale(.9,1.1)}96%{opacity:1;transform:translate(10px) scale(1.2,.9)}97%{opacity:1;transform:translate(-10px) scale(1.2,.9)}98%{opacity:1;transform:translate(5px) scale(1.1,.9)}99%{opacity:1;transform:translate(-5px) scale(1.1,.9)}to{opacity:1;transform:translate(0) scale(1)}}@keyframes animate-drop-up{0%{opacity:0;transform:translateY(300px) scale(.9,1.1)}95%{opacity:1;transform:translate(0) scale(.9,1.1)}96%{opacity:1;transform:translate(-10px) scale(1.2,.9)}97%{opacity:1;transform:translate(10px) scale(1.2,.9)}98%{opacity:1;transform:translate(-5px) scale(1.1,.9)}99%{opacity:1;transform:translate(5px) scale(1.1,.9)}to{opacity:1;transform:translate(0) scale(1)}}}}details{--clr-500:var(--clr-blue-500);--clr-600:var(--clr-blue-600);--clr-700:var(--clr-blue-700);--clr-500-desaturated:var(--clr-blue-desaturated-500);--clr-600-desaturated:var(--clr-blue-desaturated-600);--clr-700-desaturated:var(--clr-blue-desaturated-700);max-height:1.5em;overflow:hidden;transition:all .4s ease-in-out}details[open]{max-height:90vh}details[open] summary{padding-block-end:.5em}details.danger{--clr-primary-hsl:var(--clr-danger-hsl);--clr-500:var(--clr-red-500);--clr-600:var(--clr-red-600);--clr-700:var(--clr-red-700);--clr-500-desaturated:var(--clr-red-desaturated-500);--clr-600-desaturated:var(--clr-red-desaturated-600);--clr-700-desaturated:var(--clr-red-desaturated-700)}details.success{--clr-primary-hsl:var(--clr-success-hsl);--clr-500:var(--clr-green-500);--clr-600:var(--clr-green-600);--clr-700:var(--clr-green-700);--clr-500-desaturated:var(--clr-green-desaturated-500);--clr-600-desaturated:var(--clr-green-desaturated-600);--clr-700-desaturated:var(--clr-green-desaturated-700)}details.warning{--clr-primary-hsl:var(--clr-warning-hsl);--clr-500:var(--clr-brown-500);--clr-600:var(--clr-brown-600);--clr-700:var(--clr-brown-700);--clr-500-desaturated:var(--clr-brown-desaturated-500);--clr-600-desaturated:var(--clr-brown-desaturated-600);--clr-700-desaturated:var(--clr-brown-desaturated-700)}details>summary{color:var(--clr-500);cursor:pointer;font-family:inherit;font-size:16px;font-weight:700;letter-spacing:-.025em;line-height:26px;max-width:min-content;transition:outline .4s cubic-bezier(.22,1,.36,1);-webkit-user-select:auto;user-select:auto;white-space:nowrap}details>summary:hover{background:none;color:var(--clr-700)}details>summary:focus-visible{border-radius:8px;color:#000;outline:none;text-decoration:underline;text-decoration-thickness:2;text-underline-position:under}details>summary:focus-visible::marker{color:inherit}details>summary::marker{color:var(--clr-600-desaturated);color:hsl(var(--clr-primary-hsl)/.8)}details>summary:hover::marker{color:inherit}details>summary:active{transform:scale(.975);transition:transform .3s cubic-bezier(.22,1,.36,1),outline .4s cubic-bezier(.22,1,.36,1),background-color .2s linear}details>:nth-child(2):last-child{background:hsl(var(--clr-primary-hsl)/.1);border:1.5px solid hsl(var(--clr-primary-hsl)/.075);border-radius:8px;gap:1rem;justify-content:flex-start;padding:.75rem 1rem 1rem;position:relative}details>:nth-child(2):last-child label{color:var(--clr-700-desaturated);font-weight:600;letter-spacing:-.0175em}details>:nth-child(2):last-child>p:last-child:not([class]){color:var(--clr-500-desaturated)}</style>
';

$CONTRACT_STYLES_PDF = '
<link rel="preconnect" href="https://cdn.skypack.dev">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<style>
@import url("https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700,400italic");
@import url("https://fonts.googleapis.com/css?family=Arapey");
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wdth,wght@75,600;100,400;100,600;100,700;100,800");

    @page {
        margin-right: 1in;
        margin-left: 0.5in;
        margin-top: 0.5in;
        padding: 0;
    }
    body {
        font-family: "Libre Baskerville", serif;
        font-size: 14px;
        line-height: 1.5;
        color: #333;
        margin: 0px;
        padding: 0px; 
    }

    /* Typography */
    h1 {
        font-family: "Libre Baskerville", serif;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
        border-top: 3px solid #000;
        border-bottom: 1px solid #000;
        padding: 10px 0;
        margin-bottom: 20px;
    }

    h2 {
        font-size: 16px;
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    p {
        margin-bottom: 10px;
    }

    /* Lists */
    ul, ol {
        margin-left: 20px;
        margin-bottom: 10px;
    }

    ul li, ol li {
        margin-bottom: 5px;
    }

    /* Containers */
    #content {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        background-color: #fff;
    }

    .compiled-signatures {
        display: table;
        width: 100%;
        border-spacing: 2rem; /* Adjust spacing between columns */
    }

    .compiled-signature {
        display: table-cell;
        vertical-align: top; /* Align items to the top */
        text-align: left;
        width: 40%; /* Adjust width as needed */
        font-size: 12px;
    }

    .compiled-signature img {
        max-width: 100%;
        height: auto;
        border: 1px solid #000;
        margin-top: 10px;
    }

    /* Signature Date */
    .date-ip {
        font-size: 12px;
        font-style: italic;
        margin-top: 10px;
    }

    /* Borders and Spacing */
    .border-top {
        border-top: 1px solid #ccc;
        margin-top: 20px;
        padding-top: 10px;
    }

    /* Buttons (Optional, if needed) */
    .button {
        display: inline-block;
        background-color: #0056b3;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        text-align: center;
    }

    .button:hover {
        background-color: #004494;
    }

    /* Print Styles */
    @media print {
        .noprint {
            display: none;
        }
    }
</style>

';

$FOOTER_SIGNED_PRINTABLE = '
<div class="compiled-signatures">
  <div class="compiled-signature">[DEV_SIGNATURE]</div><!--.compiled-signature-->
  <div class="compiled-signature">[CLIENT_SIGNATURE]</div><!--.compiled-signature-->
</div><!--.compiled-signatures-->
</body>
</html>
';

$FOOTER_SIGNED = '
<div class="compiled-signatures">
  <div class="compiled-signature">[DEV_SIGNATURE]</div><!--.compiled-signature-->
  <div class="compiled-signature">[CLIENT_SIGNATURE]</div><!--.compiled-signature-->
</div><!--.compiled-signatures-->
<div style="margin-top: 20px; font-size: 12px; text-align: center; color: #999;">
SHA-256 of PDF Hash: [HASH]
</div>
<div id="ui-signed">  
  <div class="noprint margin-top invert-colors flexi | animate slide delay-3"
       style="justify-content: center;">
      <button class="icon-button button" type="button" onclick="printContract()">
          <span>Print</span>
          <span class="icon">
              <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em"
                  width="1em" xmlns="http://www.w3.org/2000/svg">
                  <path d="M820 436h-40c-4.4 0-8 3.6-8 8v40c0 4.4 3.6 8 8 8h40c4.4 0 8-3.6 8-8v-40c0-4.4-3.6-8-8-8zm32-104H732V120c0-4.4-3.6-8-8-8H300c-4.4 0-8 3.6-8 8v212H172c-44.2 0-80 35.8-80 80v328c0 17.7 14.3 32 32 32h168v132c0 4.4 3.6 8 8 8h424c4.4 0 8-3.6 8-8V772h168c17.7 0 32-14.3 32-32V412c0-44.2-35.8-80-80-80zM360 180h304v152H360V180zm304 664H360V568h304v276zm200-140H732V500H292v204H160V412c0-6.6 5.4-12 12-12h680c6.6 0 12 5.4 12 12v292z">
                  </path>
              </svg>
          </span>
      </button>
  </div>
</div><!--.ui-signed-->
</div> <!--#content-->
<script id="contract_script_signed">
function printContract() {
  window.print();
}
</script>
</body>
</html>';
