@if(\Session::get("success"))
    <div id="success-msg" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded fixed top-5 right-5 w-92 shadow-lg transform transition-transform translate-x-full" role="alert">
        <div class="flex items-start">
            <span class="block sm:inline mr-4">{{ \Session::get("success") }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="hideMsg()">
                    <title>Close</title>
                    <path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.586 7.066 4.652a1 1 0 00-1.414 1.414l3.334 3.334-3.334 3.334a1 1 0 001.414 1.414L10 12.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l3.334-3.334z"/>
                </svg>
            </span>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var msg = document.getElementById("success-msg");
            msg.classList.remove("translate-x-full");
            msg.classList.add("translate-x-0");

            setTimeout(function() {
                hideMsg();
            }, 3000);
        });

        function hideMsg() {
            var msg = document.getElementById("success-msg");
            msg.classList.remove("translate-x-0");
            msg.classList.add("translate-x-full");
            setTimeout(function() {
                msg.style.display = "none";
            }, 500);
        }
    </script>
@endif
