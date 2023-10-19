<div wire:loading.delay.class="opacity-10">
    @foreach ($users as $user)
        @livewire('user-card', ['user' => $user, 'loop' => $loop], key($user->id))
    @endforeach
    @if ($loadAmount >= $totalRecords)
        <p class="text-gray-800 font-bold text-2xl text-center my-10">No Remaining Records!</p>
    @endif

    <script>
        const lastRecord = document.getElementById('last_record');
        const options = {
            root: null,
            threshold: 1,
            rootMargin: '0px'
        }
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    @this.loadMore()
                }
            });
        });
        observer.observe(lastRecord);
    </script>
</div>
