import './swiper.js';
const searchButton = document.getElementById('search-button');
const modal = document.getElementById('modal');
const modalContent = modal.querySelector('.relative.transform'); // Pastikan elemen ini sesuai dengan struktur modal Anda

function openModal() {
    modal.classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
        modalContent.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
    }, 10);
}

function closeModal() {
    modalContent.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
    modalContent.classList.add('opacity-0', 'translate-y-4', 'sm:scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 200); // Sesuaikan dengan durasi animasi keluar
}

searchButton.addEventListener('click', openModal);

// Menutup modal saat mengklik di luar area modal
modal.addEventListener('click', (e) => {
    if (!modalContent.contains(e.target)) {
        closeModal();
    }
});

// Menutup modal saat menekan tombol Escape
document.addEventListener('keydown', (e) => {
    if (e.key === "Escape") {
        closeModal();
    }
});

// Menutup modal saat menggulir halaman
document.addEventListener('scroll', closeModal);


  const menuButton = document.getElementById('user-menu-button');
        const menu = document.getElementById('user-menu');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
    
        menuButton.addEventListener('click', () => {
            menu.classList.toggle('opacity-0');
            menu.classList.toggle('scale-95');
            menu.classList.toggle('invisible');
            menu.classList.toggle('opacity-100');
            menu.classList.toggle('scale-100');
        });
    
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('opacity-0');
            mobileMenu.classList.toggle('scale-95');
            mobileMenu.classList.toggle('opacity-100');
            mobileMenu.classList.toggle('scale-100');
        });
    
        // Close dropdown jika klik di luar
        document.addEventListener('click', (event) => {
            if (!menu.contains(event.target) && !menuButton.contains(event.target)) {
                menu.classList.add('opacity-0', 'scale-95', 'invisible');
                menu.classList.remove('opacity-100', 'scale-100');
            }
        });
