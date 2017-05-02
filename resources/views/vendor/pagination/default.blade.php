@if ($paginator->hasPages())
    <div class="ui center aligned grid">
        <div class="twelve wide column">
            <div class="ui buttons">
                <a href="{{ $paginator->url(1) }}" class="ui {{ $paginator->onFirstPage() ? 'disabled' : '' }} button">
                    <i class="angle double left icon"></i>
                </a>
                <a href="{{ $paginator->previousPageUrl() }}" class="ui {{ $paginator->onFirstPage() ? 'disabled' : '' }} button">
                    <i class="angle left icon"></i>
                </a>

                <a href="" class="ui disabled grey button">
                    {{ $paginator->currentPage() }}
                </a>
                @if($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="ui button">...</a>
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="ui button">
                        {{ $paginator->lastPage() }}
                    </a>
                @endif

                <a href="{{ $paginator->nextPageUrl() }}" class="ui {{ $paginator->hasMorePages() ? '' : 'disabled' }} button">
                    <i class="angle right icon"></i>
                </a>
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="ui {{ $paginator->hasMorePages() ? '' : 'disabled' }} button">
                    <i class="angle double right icon"></i>
                </a>
            </div>
            <select class="ui compact dropdown">
                @for($i = 1; $i <= $paginator->lastPage(); ++$i)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <div class="ui paginator button">Go!</div>
        </div>
    </div>
@endif
