<!-- Пагинация -->
@if($paginator->hasPages())
    <nav
        class="inline-flex items-center gap-2 mt-8"
        role="navigation"
        aria-label="Пагинация"
    >
        @if($paginator->onFirstPage())
            <!-- Кнопка "Назад" -->
            <span class="px-3 py-2 rounded-lg border border-white/10 text-gray-400 hover:border-fuchsia-500/40">
                    &laquo;
                </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-3 py-2 rounded-lg border border-white/10 text-gray-300 hover:border-fuchsia-500/40">
                &laquo;
            </a>
        @endif

        @foreach($elements as $element)
            @if(is_string($element))
                <span class="px-3 py-2 rounded-lg border border-white/10 text-gray-400 hover:border-fuchsia-500/40">{{ $element }}</span>
            @endif

            @if(is_array($element))
                @foreach($element as $page => $url)
                    @if($page == $paginator->currentPage())
                        <span class="px-3 py-2 rounded-lg border border-white/10 text-gray-400 hover:border-fuchsia-500/40">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-2 rounded-lg border border-white/10 text-gray-400 hover:border-fuchsia-500/40">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        <!-- Кнопка "Вперед" -->
        @if($paginator->hasMorePages())
            <a
                href="{{ $paginator->nextPageUrl() }}"
                class="px-3 py-2 rounded-lg border border-white/10 text-gray-400 hover:border-fuchsia-500/40"
                aria-label="Следующая страница"
            >
                &raquo;
            </a>
        @else
            <span class="px-3 py-2 rounded-lg border border-white/10 text-gray-400 hover:border-fuchsia-500/40">
                    &raquo;
                </span>
        @endif
    </nav>
@endif
