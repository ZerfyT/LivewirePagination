<div>
    @foreach ($users as $user)
        @livewire('user-card', ['user' => $user], key($user->id))
    @endforeach

    @if ($hasMorePages)
        <script>
            function debounce(func, delay) {
                let timeoutId;
                return function () {
                    clearTimeout(timeoutId);
                    timeoutId = setTimeout(func, delay);
                };
            }
            window.addEventListener('scroll', debounce(function () {
                let scrollHeight = document.documentElement.scrollHeight;
                let clientHeight = document.documentElement.clientHeight;
                let scrollTop = document.documentElement.scrollTop;
                let scrollPercentage = (scrollTop / (scrollHeight - clientHeight)) * 100;

                if (scrollPercentage >= 90) {
                    window.Livewire.dispatch('load-more');
                }
            }, 1000));
            // window.onscroll = debounce(function(ev) {
            //     if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            //         window.Livewire.dispatch('load-more');
            //     }
            // }, 1000);
            document.addEventListener('userStore', (e) => {
                console.log(e);
            });
        </script>
    @endif
</div>
