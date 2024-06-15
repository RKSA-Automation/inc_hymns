document.addEventListener("DOMContentLoaded", function () {
    // Generic dropdown object to manage selected items
    let selectedDropdownItems = {};

    // Function to toggle dropdown visibility
    function toggleDropdown(dropdownId) {
        let dropdownOptionsContainer = document.getElementById(
            `${dropdownId}-options-container`
        );
        dropdownOptionsContainer.classList.toggle("active");
    }

    // Function to handle item selection in a dropdown
    function handleDropdownSelection(checkbox, selectedContainerId) {
        let selectedContainer = document.getElementById(selectedContainerId);
        let itemId = checkbox.value;
        let itemName = checkbox.parentNode.textContent.trim();

        if (checkbox.checked) {
            selectedDropdownItems[itemId] = { id: itemId, name: itemName };
            appendSelectedItem(selectedContainer, itemName, itemId);
        } else {
            delete selectedDropdownItems[itemId];
            removeSelectedItem(selectedContainer, itemName);
        }
    }

    // Function to append a selected item to the selected items container
    function appendSelectedItem(selectedContainer, itemName, itemId) {
        let selectedItem = document.createElement("div");
        selectedItem.className = "selected-tag";
        selectedItem.textContent = itemName;

        let removeButton = document.createElement("span");
        removeButton.textContent = "×";
        removeButton.onclick = function () {
            removeButton.parentNode.remove();
            delete selectedDropdownItems[itemId];
        };

        selectedItem.appendChild(removeButton);
        selectedContainer.appendChild(selectedItem);
    }

    // Function to remove a selected item from the selected items container
    function removeSelectedItem(selectedContainer, itemName) {
        Array.from(selectedContainer.children).forEach((tag) => {
            if (tag.textContent === itemName) {
                tag.remove();
            }
        });
    }

    // Function to filter options in a dropdown
    function filterDropdownOptions(inputId, optionsContainerId) {
        const input = document.getElementById(inputId).value.toUpperCase();
        const optionsContainer = document.getElementById(optionsContainerId);
        const optionItems = optionsContainer.querySelectorAll(".option-item");

        optionItems.forEach((item) => {
            const text = item.textContent.toUpperCase();
            const checkbox = item.querySelector('input[type="checkbox"]');
            if (text.includes(input)) {
                item.style.display = "";
                if (checkbox) {
                    checkbox.style.display = "inline-block";
                }
            } else {
                item.style.display = "none";
                if (checkbox) {
                    checkbox.style.display = "none";
                }
            }
        });
    }

    // Attach event listeners for document click and input change
    document.addEventListener("click", function (event) {
        Object.keys(selectedDropdownItems).forEach((itemId) => {
            let optionsContainer = document.getElementById(
                `${itemId}-options-container`
            );
            if (
                !event.target.closest(`#${itemId}-input`) &&
                !event.target.closest(`#${itemId}-options-container`)
            ) {
                optionsContainer.classList.remove("active");
            }
        });
    });

    // Function to attach input event listeners for filtering options
    function attachFilterListeners(inputId, optionsContainerId) {
        const inputElement = document.getElementById(inputId);
        inputElement.addEventListener("input", function () {
            filterDropdownOptions(inputId, optionsContainerId);
            toggleDropdown(inputId.replace("-input", "")); // Open dropdown if not already open
        });
    }

    // Initialize filter listeners for each dropdown
    attachFilterListeners("language-input", "language-options-container");
    attachFilterListeners("lyricist-input", "lyricist-options-container");
    attachFilterListeners("composer-input", "composer-options-container");
    attachFilterListeners("arranger-input", "arranger-options-container");
});
