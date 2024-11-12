function toggleRequired() {
    var purpose = document.getElementById("colorselector").value;
    var companyFields = document.getElementsByClassName("commercial");

    var allFields = document.querySelectorAll('input, textarea, select');
        allFields.forEach(function(field) {
            field.removeAttribute('required');
        });

        if (purpose === "Commercial") {
            for (var i = 0; i < companyFields.length; i++) {
                var inputs = companyFields[i].getElementsByTagName("input");
                for (var j = 0; j < inputs.length; j++) {
                    inputs[j].setAttribute('required', true);
                }
                var textarea = companyFields[i].getElementsByTagName("textarea")[0];
                if (textarea) {
                    textarea.setAttribute('required', true);
                }
            }
        }
    }
    document.getElementById("colorselector").addEventListener("change", toggleRequired);
    window.addEventListener("load", toggleRequired);
