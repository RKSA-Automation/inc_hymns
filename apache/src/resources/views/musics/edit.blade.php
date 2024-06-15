<!-- Include CSS file in your Blade view -->
<link href="{{ asset('css/dropdown.css') }}" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hymn Management - Edit') }}
        </h2>
    </x-slot>

    <div class="py-10 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                <!-- Edit Music Form -->
                <form method="POST" action="{{ route('musics.update', ['music' => $musics->id]) }}" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                
                    <div class="flex flex-wrap">
                    <div class="w-full md:w-1/3 px-4">
                        <!-- Church Hymn -->
                        <div class="mb-4 mt-4">
                            <label for="edit_church_hymn_id" class="block text-sm font-bold text-gray-700 mb-2">Church Hymn:</label>
                            <select required id="edit_church_hymn_id" name="edit_church_hymn_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="" disabled>Select Church Hymn</option>
                                @foreach($churchHymns as $churchHymn)
                                    <option value="{{ $churchHymn->id }}" {{ $churchHymn->id == $musics->church_hymn_id ? 'selected' : '' }}>{{ $churchHymn->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="w-full md:w-1/3 px-4">
                        <!-- Title -->
                        <div class="mb-4 mt-4">
                            <label for="edit_title" class="block text-sm font-bold text-gray-700 mb-2">Title:</label>
                            <input required type="text" id="edit_title" name="edit_title" value="{{ $musics->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        
                        </div>
                    </div>

                    <div class="w-full md:w-1/3 px-4">
                            <!-- Song Number -->
                            <div class="mb-4 mt-4">
                                <label for="edit_song_number" class="block text-sm font-bold text-gray-700 mb-2">Hymn Number:</label>
                                <input required type="text" id="edit_song_number" name="edit_song_number"  value="{{ $musics->song_number }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                        </div>
                    </div>

                    <!-- File Inputs -->
                    <div class="flex flex-wrap">
                        <!-- Left Column -->
                        <div class="w-full md:w-1/2 px-4">
                            <div class="mb-4">
                                <label for="edit_vocals_mp3_path" class="block text-sm font-bold text-gray-700 mb-2">Vocals:</label>
                                <input type="file" id="edit_vocals_mp3_path" name="edit_vocals_mp3_path" class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="audio/mpeg, audio/mp3">
                                <label id="edit_vocals_mp3_path_label" class="block text-sm text-gray-700 mt-2">Filename: <b>{{ str_replace('music_files/', '', $musics->vocals_mp3_path) }}</b></label>
                            </div>
                            <div class="mb-4">
                                <label for="edit_organ_mp3_path" class="block text-sm font-bold text-gray-700 mb-2">Organ:</label>
                                <input type="file" id="edit_organ_mp3_path" name="edit_organ_mp3_path" class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="audio/mpeg, audio/mp3">
                                <label id="edit_organ_mp3_path_label" class="block text-sm text-gray-700 mt-2">Filename: <b>{{ str_replace('music_files/', '', $musics->organ_mp3_path) }}</b></label>
                            </div>
                            <div class="mb-4">
                                <label for="edit_preludes_mp3_path" class="block text-sm font-bold text-gray-700 mb-2">Preludes:</label>
                                <input type="file" id="edit_preludes_mp3_path" name="edit_preludes_mp3_path" class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="audio/mpeg, audio/mp3">
                                <label id="edit_preludes_mp3_path_label" class="block text-sm text-gray-700 mt-2">Filename: <b>{{ str_replace('music_files/', '', $musics->preludes_mp3_path) }}</b></label>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="w-full md:w-1/2 px-4">
                            <div class="mb-4">
                                <label for="edit_music_score_path" class="block text-sm font-bold text-gray-700 mb-2">Music Score:</label>
                                <input type="file" id="edit_music_score_path" name="edit_music_score_path" class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept=".pdf">
                                <label id="edit_music_score_path_label" class="block text-sm text-gray-700 mt-2">Filename: <b>{{ str_replace('music_files/', '', $musics->music_score_path) }}</b></label>
                            </div>
                            <div class="mb-4">
                                <label for="edit_lyrics_path" class="block text-sm font-bold text-gray-700 mb-2">Lyrics:</label>
                                <input type="file" id="edit_lyrics_path" name="edit_lyrics_path" class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept=".pdf">
                                <label id="edit_lyrics_path_label" class="block text-sm text-gray-700 mt-2">Filename: <b>{{ str_replace('music_files/', '', $musics->lyrics_path) }}</b></label>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const fileInputs = [
                                {inputId: 'edit_vocals_mp3_path', labelId: 'edit_vocals_mp3_path_label'},
                                {inputId: 'edit_organ_mp3_path', labelId: 'edit_organ_mp3_path_label'},
                                {inputId: 'edit_preludes_mp3_path', labelId: 'edit_preludes_mp3_path_label'},
                                {inputId: 'edit_music_score_path', labelId: 'edit_music_score_path_label'},
                                {inputId: 'edit_lyrics_path', labelId: 'edit_lyrics_path_label'}
                            ];

                            fileInputs.forEach(fileInput => {
                                const inputElement = document.getElementById(fileInput.inputId);
                                const labelElement = document.getElementById(fileInput.labelId);

                                inputElement.addEventListener('change', function(event) {
                                    const fileName = event.target.files[0] ? event.target.files[0].name : 'No file selected';
                                    labelElement.innerHTML = `Filename: <b>${fileName}</b>`;
                                });
                            });
                        });
                    </script>




                    <div class="flex flex-wrap">

                    <!-- Left Column -->
                    <div class="w-full md:w-1/2 px-4">

                    <!-- Hidden input fields to store selected IDs -->
                    <input type="hidden" id="selected_category_ids" name="category_id[]" value="">
                    <input type="hidden" id="selected_instrumentation_ids" name="instrumentation_id[]" value="">
                    <input type="hidden" id="selected_ensembletype_ids" name="ensemble_type_id[]" value="">               

                    <script>
               
                    </script>

                    
<script>
    // Function to update the hidden input fields with selected IDs
    function updateHiddenInput(dropdownId) {
        let selectedContainer = document.getElementById(`edit_${dropdownId}_id`);
        let hiddenInput = document.getElementById(`selected_${dropdownId}_ids`);
        let selectedIds = [];

        // Collect all selected item IDs
        selectedContainer.querySelectorAll('.selected-tag').forEach(item => {
            let itemId = item.getAttribute('data-id');
            
            if (itemId) {
                selectedIds.push(itemId);
                console.log(itemId + '---' + hiddenInput) ;
            }
        });

        // Update the hidden input field value
        hiddenInput.value = selectedIds.join(',');
        
        //console.log(hiddenInput.value); // Log the hidden input value to debug
    }

    // Function to append a selected item to the selected items container
    function appendLoadedItem(selectedContainer, itemName, itemid, dropdownId) {
               let selectedItem = document.createElement("div");
               selectedItem.className = "selected-tag";
               selectedItem.textContent = itemName;
               selectedItem.setAttribute('data-id', itemid); // Set the data-id attribute
        
               let removeButton = document.createElement("span");
               removeButton.textContent = "×";
               removeButton.className = `remove-${dropdownId}`;
               removeButton.onclick = function () {
                    // Find the corresponding checkbox
                    let checkbox = document.querySelector(`#${dropdownId}-options-container input[type="checkbox"][value="${itemid}"]`);

                    if (checkbox) {
                        // Uncheck the corresponding checkbox
                        checkbox.checked = false;
                    }
                    // Remove the selected item element
                    selectedItem.remove();
                    
                    // Update the hidden input field
                    updateHiddenInput(dropdownId);
               };

               selectedItem.appendChild(removeButton);
               selectedContainer.appendChild(selectedItem);

               // Update the hidden input field
              updateHiddenInput(dropdownId);
           }
    // Generic object to manage selected items
    let selectedDropdownItems = {};

    // Function to toggle dropdown visibility
    function toggleDropdown(dropdownId) {
    let dropdownOptionsContainer = document.getElementById(`${dropdownId}-options-container`);
    dropdownOptionsContainer.classList.toggle("active");
    }

    // Function to handle item selection in a dropdown
    function handleDropdownSelection(checkbox, selectedContainerId, hiddenInputId) {
        let selectedContainer = document.getElementById(selectedContainerId);

        if (checkbox.checked) {
            // Append the selected item to the selectedContainer
            appendSelectedItem(selectedContainer, checkbox);
        } else {
            // Remove the item from the selectedContainer
            removeSelectedItem(selectedContainer, checkbox);
        }

        // Update the hidden input field
        updateHiddenInput(hiddenInputId.split('_')[1]);
    }

    // Function to append a selected item to the selected items container
    function appendSelectedItem(selectedContainer, checkbox) 
    {
       
        let itemName = checkbox.parentNode.textContent.trim();
        let itemId = checkbox.value;
        let selectedItem = document.createElement("div");
        selectedItem.className = "selected-tag";
        selectedItem.textContent = itemName;
       
        let removeButton = document.createElement("span");
        removeButton.textContent = "×";
        removeButton.onclick = function () {

        // Uncheck the corresponding checkbox
        checkbox.checked = false;
        // Remove the selected item element
        selectedItem.remove();
        

        };


       // Check if the item already exists in the selected container
        let alreadySelected = Array.from(selectedContainer.children).some(child => child.textContent.trim() === itemName);
        if (!alreadySelected) {
            appendLoadedItem(selectedContainer, itemName, itemId, selectedContainer.id.split('_')[1]);
        }

        selectedItem.appendChild(removeButton);
        //selectedContainer.appendChild(selectedItem);
    }

    // Function to remove a selected item from the selected items container
    function removeSelectedItem(selectedContainer, checkbox) 
    {
        Array.from(selectedContainer.children).forEach((tag) => {
        // Get the text content of the selected item and remove unwanted characters
        let tagText = tag.textContent.trim().replace(/×/g, "");

        // Get the text content of the checkbox's parent node and remove unwanted characters
        let checkboxText = checkbox.parentNode.textContent.trim().replace(/×/g, "");

        // Check if the cleaned text content matches between the selected item and checkbox
        if (tagText === checkboxText) {
        // Remove the selected item element
        tag.remove();
        }
        });
    }

    // Function to filter options in a dropdown
    function filterDropdownOptions(inputId, optionsContainerId) 
    {
        const input = document.getElementById(inputId).value.trim().toUpperCase();
        const optionsContainer = document.getElementById(optionsContainerId);
        const optionItems = optionsContainer.querySelectorAll(".option-item");

        optionItems.forEach((item) => {
        const text = item.textContent.trim().toUpperCase();
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
    document.addEventListener("click", function (event) 
    {
        //Hide dropdowns when clicking outside of the input containers and options containers
        const allComboBoxes = document.querySelectorAll(".combo-box");
        allComboBoxes.forEach((comboBox) => {
        const inputContainer = comboBox.querySelector(".input-container");
        const optionsContainer = comboBox.querySelector(".options-container");
        if (!inputContainer.contains(event.target) && !optionsContainer.contains(event.target)) {
        optionsContainer.classList.remove("active");
        }
        });
    });

</script>
                    <!-- Category -->
                    <div class="mb-4">
                        <label for="edit_category_id" class="block text-sm font-bold text-gray-700 mb-2">Category:</label>
                        <div class="combo-box">
                            <div class="input-container" onclick="toggleDropdown('category')">
                                <div id="edit_category_id" name="edit_category_id" class="selected-items">
                                    <!-- Selected categories will appear here -->

                                    @foreach($musics->categories as $category)
                                    
                                        <script>
                                            appendLoadedItem(document.getElementById('edit_category_id'), "{{ $category->name }}", "{{ $category->id }}","category");
                                        </script>
                                    @endforeach

                                </div>

                                <input type="text" id="category-input" placeholder="Select categories...">
                                <div class="dropdown-arrow"></div>
                            </div>
                            <div id="category-options-container" class="options-container">
                                <!-- Category options are populated by JavaScript -->
                                @foreach($categories as $category)
                                <div class="option-item">
                                    <label>
                                        <!-- Use category ID as the value -->
                                        <input type="checkbox" value="{{ $category->id }}" {{ $musics->categories->contains('id', $category->id) ? 'checked' : '' }} onclick="handleDropdownSelection(this, 'edit_category_id', 'selected_category_ids')">
                                          {{ $category->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Instrumentation -->
                    <div class="mb-4">
                        <label for="edit_instrumentation_id" class="block text-sm font-bold text-gray-700 mb-2">Instrumentation:</label>
                        <div class="combo-box">
                            <div class="input-container" onclick="toggleDropdown('instrumentation')">
                                <div id="edit_instrumentation_id" name="edit_instrumentation_id" class="selected-items">
                                    <!-- Selected instrumentations will appear here -->
                                    @foreach($musics->instrumentations as $instrumentation)
                                        <script>
                                            appendLoadedItem(document.getElementById('edit_instrumentation_id'), "{{ $instrumentation->name }}", "{{ $instrumentation->id }}", 'instrumentation');
                                        </script>
                                    @endforeach
                                </div>
                                <input type="text" id="instrumentation-input" placeholder="Select instrumentations...">
                                <div class="dropdown-arrow"></div>
                            </div>
                            <div id="instrumentation-options-container" class="options-container">
                                <!-- Instrumentation options are populated by JavaScript -->
                                @foreach($instrumentations as $instrumentation)
                                    <div class="option-item">
                                        <label>
                                            <input type="checkbox" value="{{ $instrumentation->id }}" {{ $musics->instrumentations->contains('id', $instrumentation->id) ? 'checked' : '' }} onclick="handleDropdownSelection(this, 'edit_instrumentation_id', 'selected_instrumentation_ids')">
                                            {{ $instrumentation->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <!-- Ensemble Type -->
                    <div class="mb-4">
                        <label for="edit_ensembletype_id" class="block text-sm font-bold text-gray-700 mb-2">Ensemble Type:</label>
                        <div class="combo-box">
                            <div class="input-container" onclick="toggleDropdown('ensembleType')">
                                <div id="edit_ensembletype_id" name="edit_ensembletype_id" class="selected-items">
                                    <!-- Selected ensembleTypes will appear here -->
                                    @foreach($musics->ensembleTypes as $ensembleType)
                                        <script>
                                            appendLoadedItem(document.getElementById('edit_ensembletype_id'), "{{ $ensembleType->name }}", "{{ $ensembleType->id }}", 'ensembletype');
                                        </script>
                                    @endforeach
                                </div>
                                <input type="text" id="ensembleType-input" placeholder="Select ensembleTypes...">
                                <div class="dropdown-arrow"></div>
                            </div>
                            <div id="ensembleType-options-container" class="options-container hidden">
                                <!-- Ensemble Type options are populated by JavaScript -->
                                @foreach($ensembleTypes as $ensembleType)
                                    <div class="option-item">
                                        <label>
                                            <input type="checkbox" value="{{ $ensembleType->id }}" {{ $musics->ensembleTypes->contains('id', $ensembleType->id) ? 'checked' : '' }} onclick="handleDropdownSelection(this, 'edit_ensembletype_id', 'hidden_ensembletype_ids')">
                                            {{ $ensembleType->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <!-- Hidden input fields to store selected IDs -->
                    <input type="hidden" id="selected_lyricist_ids" name="lyricist_id[]" value="">
                    <input type="hidden" id="selected_composer_ids" name="composer_id[]" value="">
                    <input type="hidden" id="selected_arranger_ids" name="arranger_id[]" value="">

                    <!-- Lyricist Dropdown -->
                    <div class="mb-4">
                        <label for="edit_lyricist_id" class="block text-sm font-bold text-gray-700 mb-2">Lyricist:</label>
                        <div class="combo-box">
                            <div class="input-container" onclick="toggleDropdown('lyricist')">
                                <div id="edit_lyricist_id" name="edit_lyricist_id" class="selected-items">
                                        <!-- Selected lyricists will appear here -->
                                        @foreach($musics->lyricists as $creator)
                                            <script>
                                                appendLoadedItem(document.getElementById('edit_lyricist_id'), "{{ $creator->name }}", "{{ $creator->id }}", 'lyricist');
                                            </script>

                                        @endforeach
                                </div>
                                <input type="text" id="lyricist-input" placeholder="Select lyricists...">
                                <div class="dropdown-arrow"></div>
                            </div>
                            <div id="lyricist-options-container" class="options-container">
                                <!-- Lyricist options are populated by JavaScript -->
                                @foreach($creators as $creator)
                                    <div class="option-item">
                                        <label>
                                            <input type="checkbox" value="{{ $creator->id }}" {{ $musics->lyricists->contains('id', $creator->id) ? 'checked' : '' }} onclick="handleDropdownSelection(this, 'edit_lyricist_id','selected_lyricist_ids')">
                                        
                                            {{ $creator->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


</div>


                <!-- Right Column -->
                <div class="w-full md:w-1/2 px-4">
                            <!-- Composer Dropdown -->
                            <div class="mb-4">
                                <label for="edit_composer_id" class="block text-sm font-bold text-gray-700 mb-2">Composer:</label>
                                <div class="combo-box">
                                    <div class="input-container" onclick="toggleDropdown('composer')">
                                        <div id="edit_composer_id" name="edit_composer_id"  class="selected-items">
                                            <!-- Selected composers will appear here -->
                                            @foreach($musics->composers as $creator)
                                                <script>
                                                    appendLoadedItem(document.getElementById('edit_composer_id'), "{{ $creator->name }}", "{{ $creator->id }}", 'composer');
                                                </script>

                                            @endforeach
                                        </div>
                                        <input type="text" id="composer-input" placeholder="Select composers...">
                                        <div class="dropdown-arrow"></div>
                                    </div>
                                    <div id="composer-options-container" class="options-container">
                                        <!-- Composer options are populated by JavaScript -->
                                        @foreach($creators as $creator)
                                            <div class="option-item">
                                                <label>
                                                    <input type="checkbox" value="{{ $creator->id }}" {{ $musics->composers->contains('id', $creator->id) ? 'checked' : '' }} onclick="handleDropdownSelection(this, 'edit_composer_id','selected_composer_ids')">
                                    
                                                    {{ $creator->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Arranger Dropdown -->

                            <div class="mb-4">
                                <label for="edit_arranger_id" class="block text-sm font-bold text-gray-700 mb-2">Arranger:</label>
                                <div class="combo-box">
                                    <div class="input-container" onclick="toggleDropdown('arranger')">
                                        <div id="edit_arranger_id" name="edit_arranger_id"  class="selected-items">
                                            <!-- Selected arrangers will appear here -->
                                            @foreach($musics->arrangers as $creator)
                                                <script>
                                                    appendLoadedItem(document.getElementById('edit_arranger_id'), "{{ $creator->name }}", "{{ $creator->id }}", 'arranger');
                                                </script>

                                            @endforeach
                                        </div>
                                        <input type="text" id="arranger-input" placeholder="Select arrangers...">
                                        <div class="dropdown-arrow"></div>
                                    </div>
                                    <div id="arranger-options-container" class="options-container">
                                        <!-- Arranger options are populated by JavaScript -->
                                        @foreach($creators as $creator)
                                            <div class="option-item">
                                                <label>
                                                    <input type="checkbox" value="{{ $creator->id }}" {{ $musics->arrangers->contains('id', $creator->id) ? 'checked' : '' }} onclick="handleDropdownSelection(this, 'edit_arranger_id','selected_arranger_ids')">
                                    
                                                    {{ $creator->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            

                            <div class="mb-4">
                                <label for="edit_language_id" class="block text-sm font-bold text-gray-700 mb-2">Language:</label>
                                <select required id="edit_language_id" name="edit_language_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="" disabled>Select Language</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}" {{ $language->id == $musics->language_id ? 'selected' : '' }}>{{ $language->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                </div>
</div>

                    <!-- Verses Used -->
                    <div class="mb-4">
                        <label for="edit_versesused" class="block text-sm font-bold text-gray-700 mb-2">Reference Verses:</label>
                        <textarea id="edit_versesused" name="edit_versesused" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $musics->verses_used }}</textarea>
                    </div>

                    <!-- Buttons to submit or close modal -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update
                        </button>
                        <button type="button" class="bg-gray-600 hover:bg-gray-800 text-black font-bold py-2 px-4 rounded ml-2 focus:outline-none focus:shadow-outline" onclick="closeAddMusicModal()">
                            Cancel
                        </button>
                    </div>

                    <script>
                        // Function to close the modal and redirect to the music page
                        function closeAddMusicModal() {
                            // Add your redirection logic here
                            window.location.href = '/musics'; // Replace '/music' with the URL of your music page
                        }
                    </script>
                </form>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>

