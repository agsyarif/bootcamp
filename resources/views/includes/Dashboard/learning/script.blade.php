<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="{{ url('https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js') }}" defer></script>
<script src="{{ asset('/js/dashboard/init-alpine.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/icon/js/all.js') }}">
<script src="{{ asset('js/dashboard/script_tambahan.js') }}"></script>

<script>
    const btn = document.querySelector("button.mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");
    const backdrop = document.querySelector('.navbar-backdrop');
    const close = document.querySelector('.navbar-close');

    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
        btn.classList.toggle("hidden");
    });
    close.addEventListener("click", () => {
        menu.classList.toggle("hidden");
        btn.classList.toggle("hidden");
    });
</script>

{{-- bats --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/dashboard/script_learning.js') }}"></script>
