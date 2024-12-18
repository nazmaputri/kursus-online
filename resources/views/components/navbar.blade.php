<nav id="navbar" class="bg-transparent shadow-none dark:bg-gray-900 fixed top-0 left-0 w-full z-50 transition-all duration-300">
    <div class="max-w-screen-xl mx-auto p-4 flex flex-wrap items-center justify-between">
        <!-- Logo -->
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('storage/eduflix.png') }}" class="h-16 transition-transform transform hover:scale-105 duration-300" alt="Logo">
            <span id="navbar-text" class="text-sky-600 text-2xl font-semibold dark:text-white transition-transform transform hover:scale-105 duration-300">EduFlix</span>
        </a>

        <!-- Mobile Toggle Button -->
        <button id="menu-toggle" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>

        <!-- Navbar Links -->
        <div class="hidden w-full lg:flex md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col md:flex-row md:space-x-3 rtl:space-x-reverse mt-4 md:mt-0 p-4 md:p-0 bg-transparent md:bg-transparent rounded-lg dark:bg-gray-800 md:dark:bg-transparent">
                <li class="mt-2 md:mt-0">
                    <a href="#home" class="nav-link block py-2 px-4 text-sky-600 rounded-sm transition-all duration-300 hover:border-b-2 hover:border-sky-600 dark:text-white">Home</a>
                </li>
                <li class="mt-2 md:mt-0">
                    <a href="#about" class="nav-link block py-2 px-4 text-sky-600 rounded-sm transition-all duration-300 hover:border-b-2 hover:border-sky-600 dark:text-white">About</a>
                </li>
                <li class="mt-2 md:mt-0">
                    <a href="#category" class="nav-link block py-2 px-4 text-sky-600 rounded-sm transition-all duration-300 hover:border-b-2 hover:border-sky-600 dark:text-white">Category</a>
                </li>
                <li class="mt-2 md:mt-0">
                    <a href="#price" class="nav-link block py-2 px-4 text-sky-600 rounded-sm transition-all duration-300 hover:border-b-2 hover:border-sky-600 dark:text-white">Price</a>
                </li>
                <li class="mt-2 md:mt-0">
                    <a href="#rating" class="nav-link block py-2 px-4 text-sky-600 rounded-sm transition-all duration-300 hover:border-b-2 hover:border-sky-600 dark:text-white">Rating</a>
                </li>
                <!-- Button -->
                <li class="mt-4 md:mt-0">
                    <a href="/login" class="block py-2 px-4 bg-white text-sky-600 border border-sky-600 rounded-full hover:bg-sky-600 hover:text-white transition">Daftar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
window.addEventListener("scroll", function () {
    const navbar = document.getElementById("navbar");

    // Mengubah background navbar saat di-scroll
    if (window.scrollY > 50) {
        navbar.classList.add("bg-white", "bg-opacity-80", "shadow-md");
        navbar.classList.remove("bg-transparent", "shadow-none");
    } else {
        navbar.classList.add("bg-transparent", "shadow-none");
        navbar.classList.remove("bg-white", "bg-opacity-80", "shadow-md");
    }

    // Menambahkan kelas aktif pada navbar link berdasarkan section yang terlihat
    const sections = document.querySelectorAll("section");
    const navLinks = document.querySelectorAll(".nav-link");

    let current = "";

    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;

        if (window.scrollY >= (sectionTop - sectionHeight / 3) && window.scrollY < (sectionTop + sectionHeight - sectionHeight / 3)) {
            current = section.getAttribute("id");
        }
    });

    navLinks.forEach(link => {
        const href = link.getAttribute("href").substring(1); // Remove the '#' from href
        if (href === current) {
            link.classList.add("text-sky-500", "border-b-2", "border-sky-500");
            link.classList.remove("text-sky-600");
        } else {
            link.classList.remove("text-sky-500", "border-b-2", "border-sky-500");
            link.classList.add("text-sky-600");
        }
    });
});

// Toggle menu untuk navbar di mobile view
const menuToggle = document.getElementById('menu-toggle');
const navbarDefault = document.getElementById('navbar-default');

menuToggle.addEventListener('click', () => {
    navbarDefault.classList.toggle('hidden');
    navbarDefault.classList.toggle('flex');
});

// Menutup menu setelah klik di mobile view
const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        // Hanya menutup jika dalam mode mobile
        if (window.innerWidth < 1024) {
            navbarDefault.classList.add('hidden');
            navbarDefault.classList.remove('flex');
        }
    });
});

// Smooth scroll with offset to handle fixed navbar
document.querySelectorAll('a.nav-link').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetSection = document.querySelector(this.getAttribute('href'));
        const offset = 80; // Adjust this value based on your navbar height
        const scrollToPosition = targetSection.offsetTop - offset;

        window.scrollTo({
            top: scrollToPosition,
            behavior: 'smooth'
        });
    });
});
</script>
