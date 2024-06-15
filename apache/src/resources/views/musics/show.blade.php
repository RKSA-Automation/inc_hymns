<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery before Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>

<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center my-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Music Details') }}
            </h2>
            <div>
            
                <a href="{{ route('musics.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                
<!-- Show Music Details Button -->
<button id="showMusicDetailsBtn" class="show-details-btn">
    <i class="fas fa-info"></i>
</button>

<!-- Display Music Details -->
<div id="musicDetails" class="music-details">
    <!-- Title -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Title:</p>
        <p><i>{{ $music->title }}</i></p>
    </div>

    <!-- Song Number -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Hymn Number:</p>
        <p>{{ $music->song_number }}</p>
    </div>

    <!-- Categories -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Category:</p>
        <ul class="list-disc list-inside" id="categoriesList">
            @foreach ($music->categories->take(3) as $category)
                <li>{{ $category->name }}</li>
            @endforeach
            @foreach ($music->categories->skip(3) as $category)
                <li class="hidden">{{ $category->name }}</li>
            @endforeach
        </ul>
        @if ($music->categories->count() > 3)
            <button onclick="toggleList('categoriesList', this)">See More</button>
        @endif
    </div>

    <!-- Instrumentation -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Instrumentation:</p>
        <ul class="list-disc list-inside" id="instrumentationList">
            @foreach ($music->instrumentations->take(3) as $instrumentation)
                <li>{{ $instrumentation->name }}</li>
            @endforeach
            @foreach ($music->instrumentations->skip(3) as $instrumentation)
                <li class="hidden">{{ $instrumentation->name }}</li>
            @endforeach
        </ul>
        @if ($music->instrumentations->count() > 3)
            <button onclick="toggleList('instrumentationList', this)">See More</button>
        @endif
    </div>

    <!-- Ensemble Type -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Ensemble Type:</p>
        <ul class="list-disc list-inside" id="ensembleTypeList">
            @foreach ($music->ensembleTypes->take(3) as $ensembleType)
                <li>{{ $ensembleType->name }}</li>
            @endforeach
            @foreach ($music->ensembleTypes->skip(3) as $ensembleType)
                <li class="hidden">{{ $ensembleType->name }}</li>
            @endforeach
        </ul>
        @if ($music->ensembleTypes->count() > 3)
            <button onclick="toggleList('ensembleTypeList', this)">See More</button>
        @endif
    </div>

    <!-- Lyricists -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Lyricist:</p>
        <ul class="list-disc list-inside" id="lyricistsList">
            @foreach ($music->lyricists->take(3) as $lyricist)
                <li>{{ $lyricist->name }}</li>
            @endforeach
            @foreach ($music->lyricists->skip(3) as $lyricist)
                <li class="hidden">{{ $lyricist->name }}</li>
            @endforeach
        </ul>
        @if ($music->lyricists->count() > 3)
            <button onclick="toggleList('lyricistsList', this)">See More</button>
        @endif
    </div>

    <!-- Composer -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Composer:</p>
        <ul class="list-disc list-inside" id="composerList">
            @foreach ($music->composers->take(3) as $composer)
                <li>{{ $composer->name }}</li>
            @endforeach
            @foreach ($music->composers->skip(3) as $composer)
                <li class="hidden">{{ $composer->name }}</li>
            @endforeach
        </ul>
        @if ($music->composers->count() > 3)
            <button onclick="toggleList('composerList', this)">See More</button>
        @endif
    </div>

    <!-- Arranger -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Arranger:</p>
        <ul class="list-disc list-inside" id="arrangerList">
            @foreach ($music->arrangers->take(3) as $arranger)
                <li>{{ $arranger->name }}</li>
            @endforeach
            @foreach ($music->arrangers->skip(3) as $arranger)
                <li class="hidden">{{ $arranger->name }}</li>
            @endforeach
        </ul>
        @if ($music->arrangers->count() > 3)
            <button onclick="toggleList('arrangerList', this)">See More</button>
        @endif
    </div>

    <!-- Language -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Language:</p>
        <p>{{ $music->language->name }}</p>
    </div>

    <!-- Verses Used -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Verses Used:</p>
        <p>{{ $music->verses_used }}</p>
    </div>
</div>

<script>
function toggleList(listId, button) {
    const list = document.getElementById(listId);
    const items = list.querySelectorAll('li.hidden');

    if (list.classList.contains('expanded')) {
        list.classList.remove('expanded');
        items.forEach(item => {
            item.style.display = 'none';
        });
        button.innerText = 'See More';
    } else {
        list.classList.add('expanded');
        items.forEach(item => {
            item.style.display = 'list-item';
        });
        button.innerText = 'See Less';
    }
}

document.getElementById('showMusicDetailsBtn').addEventListener('click', function() {
    const musicDetails = document.getElementById('musicDetails');
    musicDetails.classList.toggle('hidden');

    const icon = this.querySelector('i');
    if (musicDetails.classList.contains('hidden')) {
        icon.classList.remove('fa-arrow-left');
        icon.classList.add('fa-arrow-right');
    } else {
        icon.classList.remove('fa-arrow-right');
        icon.classList.add('fa-arrow-left');
    }
});


</script>

<style>
.music-details {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    max-height: 95vh; /* Set a maximum height */
    overflow-y: auto; /* Enable vertical scrolling */
    position: fixed;
    top: 50%;
    left: 50px; /* Adjust this value as needed */
    transform: translateY(-50%);
    z-index: 1000;
}

.show-details-btn {
    position: fixed;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    transition: background-color 0.3s;
}

.show-details-btn:hover {
    background-color: #0056b3;
}

.show-details-btn i {
    font-size: 18px;
}

.list-inside {
    max-height: 90px; /* Set the max height to show 3 items by default */
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.list-inside.expanded {
    max-height: none; /* Allow full height when expanded */
}


</style>

<div class="music-container">


    <div class="music-player-details">


    <style>
        /* Custom CSS styles for music details section */

        .music-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px; /* Adjust the gap between left and right sections */
        }

        .music-player-details {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%; /* Make the music-player-details take the full width of the container */
        }
        .music-player {
            position: fixed;
            bottom: 0;
            width: 100%;
            max-width: 800px;
            z-index: 50;
            display: flex;
            flex-direction: column;
            align-items: center; /* Center horizontally */
            justify-content: center; /* Center vertically */
            text-align: center; /* Center text */
            margin-bottom:0px;
            background-color: rgba(21, 21, 21, 0.1);
        }
 
        .music-score {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center horizontally */
            justify-content: center; /* Center vertically */
            text-align: center; /* Center text */
            width: 100%;
            max-width: 800px;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .tab-button-mp3 {
            background-color: #f9f9f9; /* Green background */
            border: none;
            color: #2d2a2a;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .tab-button-mp3:hover {
            background-color: #e3dfdf; /* Darker green on hover */
        }

        .tab-button-mp3.active {
            background-color: #303639; /* Blue background for active tab */
            
            color: #f9f9f9;
        }

        .tab-button {
            background-color: #f9f9f9; /* Green background */
            border: none;
            color: #2d2a2a;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .tab-button:hover {
            background-color: #e3dfdf; /* Darker green on hover */
        }

        .tab-button.active {
            background-color: #303639; /* Blue background for active tab */
            
            color: #f9f9f9;
        }

        /* Ensure the PDF container is responsive */
        .pdf-container {
            width: 100%;
            overflow-x: auto;
        }

        /* Ensure each canvas scales responsively */
        .pdf-container canvas {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 10px auto;
        }

        /* Responsive Styles (Optional) */
        @media (max-width: 768px) {
            .music-container {
                flex-direction: column; /* Stack sections vertically on smaller screens */
            }

            .music-score {
                flex-basis: 100%; /* Full width for PDF on smaller screens */
            }
        }

        .font-semibold {
            font-weight: 600;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .list-disc {
            list-style-type: disc;
        }

        .list-inside {
            padding-left: 1.5rem;
        }
    </style>
           

            <div class="music-player" >
                <!-- Tab buttons -->
                <div class="flex tab-buttons">
                    <button class="tab-button-mp3 active" data-path="{{ asset('storage/' . $music->vocals_mp3_path) }}">Vocals</button>
                    <button class="tab-button-mp3" data-path="{{ asset('storage/' . $music->organ_mp3_path) }}">Organ</button>
                    <button class="tab-button-mp3" data-path="{{ asset('storage/' . $music->preludes_mp3_path) }}">Preludes</button>
                    <button class="tab-button ml-2 active" data-path="{{ asset('storage/' . $music->music_score_path) }}">Music Score</button>
                    <button class="tab-button" data-path="{{ asset('storage/' . $music->lyrics_path) }}">Lyrics Only</button>
                </div>

                <div class="flex row mt-1 mb-0">
                    <!-- Audio player -->
                    <audio id="musicPlayer" controls preload="auto" >
                        <!-- Include source elements -->
                        <source id="audioSource" src="#" type="audio/mpeg">
                    </audio>
                    <!-- Tab Lyrics -->
                    <div class="tab-buttons">
                        
                    </div>
                </div>
            </div>


 <!-- JavaScript to handle dropdown and audio playback -->
 <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const musicPlayer = document.getElementById('musicPlayer');

                    // Handle click events for tab buttons
                    const tabButtons = document.querySelectorAll('.tab-button-mp3');
                    tabButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const path = button.getAttribute('data-path');
                            switchTrack(path);
                        });
                    });
                });
                // Get the audio element
                const musicPlayer = document.getElementById('musicPlayer');
                function seekAudio(event) {
                    console.log('Click event detected on progress bar.');
                    console.log('Offset X:', event.offsetX);

                    const clickX = event.offsetX;
                    const width = this.offsetWidth;
                    const audioDuration = musicPlayer.duration;
                    const seekTime = (clickX / width) * audioDuration;

                    console.log('Width:', width);
                    console.log('Audio Duration:', audioDuration);
                    console.log('Seek Time:', seekTime);

                    musicPlayer.currentTime = seekTime;
                }

                // Attach seek event listener to the audio progress bar
                musicPlayer.addEventListener('click', seekAudio);

                // Function to switch audio source and maintain playback position
                function switchTrack(path) {
                    const audioSource = document.getElementById('audioSource');
                    const musicPlayer = document.getElementById('musicPlayer');
                    const currentTime = musicPlayer.currentTime;

                    // Set new audio source path
                    audioSource.src = path;

                    // Load and play the new audio source
                    musicPlayer.load();
                    musicPlayer.play();

                    // Restore playback position if available
                    musicPlayer.addEventListener('loadedmetadata', function() {
                        //alert(currentTime);
                        musicPlayer.currentTime = currentTime;
                    });
                }
            </script>


            <!-- Music Score (Right Side) -->
            <div class="music-score">
                <!-- PDF or Lyrics Container -->
                <div class="pdf-container">
                    <!-- Canvas for PDF rendering -->
                    <div id="pdf-container"></div>
                </div>
            </div>

    </div>
</div>
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
<script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<!-- JavaScript/jQuery to handle tab switching -->
<script>
$(document).ready(function() {
    // Initial rendering based on active tab
    renderContent($('.tab-button.active').data('path'));


        // Handle tab button click
        $('.tab-button-mp3').click(function() {
        // Remove active class from all buttons
        $('.tab-button-mp3').removeClass('active');

        // Add active class to the clicked button
        $(this).addClass('active');
    });



    // Handle tab button click
    $('.tab-button').click(function() {
        // Remove active class from all buttons
        $('.tab-button').removeClass('active');

        // Add active class to the clicked button
        $(this).addClass('active');

        // Get the path from the button's data attribute
        var path = $(this).data('path');

        // Render content based on the clicked button's path
        renderContent(path);
    });

    // Function to render content (PDF or lyrics) based on path
    function renderContent(path) {
        if (path.toLowerCase().endsWith('.pdf')) {
            // Display PDF content
            renderPDF(path);
        } else {
            // Display lyrics content
            renderLyrics(path);
        }
    }

    // Function to render PDF content
    function renderPDF(pdfPath) {
        // Clear the PDF container
        $('#pdf-container').empty();

        // Use PDF.js to render the PDF
        pdfjsLib.getDocument(pdfPath).promise.then(function(pdf) {
            // Loop through each page and render it
            for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                pdf.getPage(pageNum).then(function(page) {
                    var viewport = page.getViewport({ scale: 1.0 });
                    
                    // Create a canvas for each page
                    var canvas = document.createElement('canvas');
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    $('#pdf-container').append(canvas);

                    var context = canvas.getContext('2d');

                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };

                    page.render(renderContext);
                });
            }
        });
    }

// Function to render lyrics content
function renderLyrics(lyricsPath) {

    // Clear the PDF container and replace with lyrics content
    $('#pdf-container').html('<p>Loading lyrics...</p>');

    // Fetch the lyrics content from the server and display it
    $.ajax({
        url: lyricsPath,
        success: function(data) {
            $('#pdf-container').html('<pre style="white-space: pre-wrap; word-wrap: break-word; font-size: 18px;">' + data + '</pre>');
        },
        error: function() {
            $('#pdf-container').html('<p>Failed to load lyrics.</p>');
        }
    });
}

});
</script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
